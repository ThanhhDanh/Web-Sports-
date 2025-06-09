<?php

namespace App\Livewire;

use App\Http\Controllers\MomoController;
use App\Models\Colors;
use App\Models\Discounts;
use App\Models\InvoiceDetails;
use App\Models\Invoices;
use App\Models\Products;
use App\Models\Sizes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class InvoiceForm extends Component
{
    public $selectedUser = '';
    public $selectedProducts = [];
    public $selectedDiscount = null;
    public $discount = null;
    public $tax = 10;
    public $statusPayment = '';
    public $paymentMethod = '';
    public $description = '';
    public $signature = '';
    public $phone = '';
    public $email = '';
    public $allSizes = [];
    public $allColors = [];
    public $productSizes = [];
    public $productColors = [];
    public $isAdmin;

    protected $rules = [
        'selectedUser' => 'required|exists:users,id',
        'phone' => 'required|string|min:10',
        'email' => 'required|string',
        'signature' => 'required|string',
    ];

    protected $messages = [
        'selectedUser.required' => 'Vui lòng chọn người dùng',
        'phone.required' => 'Vui lòng nhập số điện thoại',
        'email.required' => 'Vui lòng nhập email',
        'signature.required' => 'Vui lòng nhập chữ ký',
    ];

    // Lưu trạng thái sản phẩm chọn
    public function mount()
    {
        $this->isAdmin = Auth::user()->hasRole('admin');
        $this->allSizes = Sizes::all();
        $this->allColors = Colors::all();
    }

    // Chọn giảm giá cho hóa đơn
    public function addDiscount($discountId)
    {
        if (empty($this->selectedProducts)) {
            $this->dispatch('showError', 'Vui lòng chọn sản phẩm trước khi áp dụng giảm giá!');
            return;
        }

        $discount = Discounts::find($discountId);

        if (!$discount) {
            $this->dispatch('showError', 'Mã giảm giá không hợp lệ!');
            return;
        }

        $this->selectedDiscount = [
            'id' => $discount->id,
            'name' => $discount->name,
            'amount' => $discount->price_discount,
        ];
    }

    public function render()
    {
        return view('livewire.invoice-form', [
            'users' => User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->get(),
            'products' => Products::all(),
            'discounts' => Discounts::all(),
            'colors' => $this->allColors,
            'sizes' => $this->allSizes,
        ]);
    }

    // Thêm sản phẩm vào danh sách
    public function addProduct($productId)
    {
        $this->validate();

        $product = Products::with(['sizes', 'colors'])->find($productId);
        if ($product) {
            $this->productSizes[$productId] = $product->sizes->isNotEmpty()
                ? $product->sizes
                : $this->allSizes;

            $this->productColors[$productId] = $product->colors->isNotEmpty()
                ? $product->colors
                : $this->allColors;

            if ($this->isAdmin) {
                // Admin chỉ hiển thị sản phẩm, không tăng số lượng
                if (isset($this->selectedProducts[$productId])) {
                    $this->dispatch('showError', 'Bạn không có quyền thêm sản phẩm!');
                    return;
                }
                $this->selectedProducts[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'discount' => 0,
                    'tax' => 1,
                    'size_id' => $product->sizes->first()->id ?? (reset($this->allSizes)->id ?? null),
                    'color_id' => $product->colors->first()->id ?? (reset($this->allColors)->id ?? null),
                ];
            } else {
                if (isset($this->selectedProducts[$productId])) {
                    $this->selectedProducts[$productId]['quantity']++;
                } else {
                    $this->selectedProducts[$productId] = [
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => 1,
                        'discount' => 0,
                        'tax' => 1,
                        'size_id' => $product->sizes->first()->id ?? $this->allSizes->first()->id,
                        'color_id' => $product->colors->first()->id ?? $this->allColors->first()->id,
                    ];
                }
            }
        }
    }

    // Xóa sản phẩm khỏi danh sách
    public function removeProduct($productId)
    {
        if ($this->isAdmin) {
            $this->dispatch('showError', 'Bạn không có quyền xóa sản phẩm!');
            return;
        }

        if (isset($this->selectedProducts[$productId])) {
            unset($this->selectedProducts[$productId]);
        }
    }

    // Xóa giảm giá ra khỏi danh sách
    public function removeDiscount()
    {
        $this->selectedDiscount = null;
        session()->forget('selectedDiscount');
    }

    // Tính tổng giá
    public function getTotalAmount()
    {
        $total = 0;

        foreach ($this->selectedProducts as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        // Áp dụng giảm giá
        if ($this->selectedDiscount) {
            $total -= $this->selectedDiscount['amount'];
        }

        // Áp dụng thuế
        $total += ($total * $this->tax) / 100;

        return number_format($total, 0, '.', ',') . ' VNĐ';
    }

    // Gửi hóa đơn
    public function submitInvoice()
    {
        // if ($this->isAdmin) {
        //     $this->dispatch('showError', 'Bạn không có quyền tạo hóa đơn!');
        //     return;
        // }

        if ($this->paymentMethod === 'Momo') {
            return $this->handleMomoPayment();
        }

        // --- Mặc định: thanh toán khi nhận hàng ---
        $this->createInvoiceAndDetails();
        return redirect()->route('invoices.index')->with('success', 'Hóa đơn đã được tạo thành công!');
    }
    public function createInvoiceAndDetails($invoice = null)
    {
        $encryptedSignature = encrypt($this->signature);

        if (!$invoice) {
            $invoice = Invoices::create([
                'user_id' => $this->selectedUser,
                'description' => $this->description,
                'total_amount' => str_replace([' VNĐ', ','], '', $this->getTotalAmount()),
                'signature' => $encryptedSignature,
                'status_payment' => $this->statusPayment,
                'method_payment' => $this->paymentMethod,
            ]);
        }

        foreach ($this->selectedProducts as $productId => $product) {
            $productModel = Products::with(['sizes', 'colors'])->find($productId);

            $sizeId = $product['size_id'] ?? $productModel->sizes->first()?->id;
            $colorId = $product['color_id'] ?? $productModel->colors->first()?->id;

            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'product_id' => $productId,
                'discount_id' => $this->selectedDiscount['id'] ?? null,
                'quantity' => $product['quantity'],
                'unit_price' => $product['price'],
                'status_payment' => $this->statusPayment,
                'method_payment' => $this->paymentMethod,
                'description' => $this->description,
                'size_id' => $sizeId,
                'color_id' => $colorId,
            ]);

            if (isset($this->selectedDiscount['id'])) {
                $discount = Discounts::find($this->selectedDiscount['id']);
                $discount?->decrement('amount_discount', $product['quantity']);
            }
        }

        return $invoice;
    }
    public function handleMomoPayment()
    {
        $totalAmount = str_replace([' VNĐ', ','], '', $this->getTotalAmount());

        $productsWithId = collect($this->selectedProducts)
            ->mapWithKeys(function ($item, $id) {
                $item['id'] = $id;
                return [$id => $item];
            })->toArray();

        $momoRequest = new \Illuminate\Http\Request([
            'userId' => $this->selectedUser,
            'description' => $this->description,
            'status_payment' => $this->statusPayment,
            'method_payment' => $this->paymentMethod,
            'signature' => encrypt($this->signature),
            'totalPrice' => $totalAmount,
            'selectedProducts' => $productsWithId,
            'discountId' => $this->selectedDiscount['id'] ?? null,
        ]);

        $response = app(MomoController::class)->process($momoRequest);

        $body = $response->getData(true);

        // dd($body);

        if (!isset($body['payUrl'])) {
            $this->dispatch('showError', 'Không thể kết nối Momo. Vui lòng thử lại.');
            return;
        }

        // Redirect người dùng đến payUrl Momo
        return redirect()->away($body['payUrl']);
    }
}
