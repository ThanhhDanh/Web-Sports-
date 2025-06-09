<?php

namespace App\Livewire;

use App\Models\Discounts;
use App\Models\Invoices;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceEditForm extends Component
{
    public $invoice;
    public $selectedUser;
    public $phone;
    public $email;
    public $statusPayment;
    public $paymentMethod;
    public $description;
    public $signature;
    public $selectedProducts = [];
    public $selectedColors = [];
    public $selectedSizes = [];
    public $discounts;
    public $selectedDiscount;
    public $selectedDiscountPrice;
    public $tax = 10;
    public $totalAmount = 0;
    public $discountAmount = 0;
    public $isAdmin;

    protected $rules = [
        'selectedUser' => 'required',
        'selectedProducts' => 'required',
        'statusPayment' => 'required',
        'paymentMethod' => 'required',
    ];

    protected $messages = [
        'selectedUser.required' => 'Vui lòng chọn người dùng.',
        'selectedProducts.required' => 'Vui lòng chọn sản phẩm.',
        'statusPayment.required' => 'Vui lòng chọn trạng thái thanh toán.',
        'paymentMethod.required' => 'Vui lòng chọn phương thức thanh toán.',
    ];

    public function mount(Invoices $invoice)
    {
        $this->isAdmin = Auth::user()->hasRole('admin');
        $this->invoice = $invoice;
        $this->selectedUser = $invoice->user_id;
        $this->phone = $invoice->user->phone ?? '';
        $this->email = $invoice->user->email ?? '';
        $this->description = $invoice->description;
        $this->signature = $invoice->signature ? decrypt($invoice->signature) : '';

        $firstInvoiceDetail = $invoice->invoiceDetails->first();

        if ($firstInvoiceDetail) {
            $this->statusPayment = $firstInvoiceDetail->status_payment;
            $this->paymentMethod = $firstInvoiceDetail->method_payment;
            $this->selectedDiscount = $firstInvoiceDetail->discount_id;
            $this->selectedDiscount = $firstInvoiceDetail->discount_id;
        }

        $this->selectedProducts = $invoice->products->mapWithKeys(function ($product) use ($invoice) {
            $invoiceDetail = $invoice->invoiceDetails()->where('product_id', $product->id)->first();
            return [
                $product->id => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->price,
                    'discount' => $product->pivot->discount_id ?? 0,
                    'tax' => $this->tax,
                    'color' => $invoiceDetail->color->id ?? '',
                    'size' => $invoiceDetail->size->id ?? '',
                    'colors' => $product->colors->toArray(),
                    'sizes' => $product->sizes->toArray(),
                ]
            ];
        })->toArray();

        // dd($this->selectedProducts);

        $this->calculateTotalAmount();

        foreach ($this->selectedProducts as $id => $product) {
            $this->selectedColors[$id] = $product['color'];
            $this->selectedSizes[$id] = $product['size'];
        }

        $this->discounts = Discounts::all();
        $this->selectedDiscountPrice = $this->selectedDiscount ? Discounts::find($this->selectedDiscount)->price_discount : 0;
    }

    public function calculateTotalAmount()
    {
        $this->discountAmount = 0;
        $this->totalAmount = 0;

        $fixedDiscount = $this->selectedDiscountPrice;

        foreach ($this->selectedProducts as $product) {
            $quantity = $product['quantity'];
            $price = $product['price'];

            $this->totalAmount += ($price * $quantity);
        }

        $this->discountAmount = $fixedDiscount;
        $this->totalAmount -= $this->discountAmount;

        $this->totalAmount = max($this->totalAmount, 0);

        $this->invoice->update([
            'total_amount' => $this->totalAmount
        ]);
    }

    public function addDiscount($discountId)
    {
        $discount = Discounts::find($discountId);

        if (!$discount) {
            $this->dispatch('showError', 'Mã giảm giá không hợp lệ!');
            return;
        }
        $this->selectedDiscount = $discountId;
        $this->selectedDiscountPrice = $discount->price_discount;

        $this->calculateTotalAmount();
    }

    public function updateColor($colorId, $productId)
    {
        if (isset($this->selectedProducts[$productId])) {
            $this->selectedProducts[$productId]['color'] = $colorId;
        }
    }

    public function updateSize($sizeId, $productId)
    {
        if (isset($this->selectedProducts[$productId])) {
            $this->selectedProducts[$productId]['size'] = $sizeId;
        }
    }

    public function addProduct($productId)
    {
        $this->validate();

        $product = Products::find($productId);
        if ($product) {
            if ($this->isAdmin) {
                // Admin chỉ hiển thị sản phẩm, không tăng số lượng
                $this->dispatch('showError', 'Bạn không có quyền thêm sản phẩm!');
                return;
            }

            if (isset($this->selectedProducts[$productId])) {
                $this->selectedProducts[$productId]['quantity']++;
            } else {
                // Nếu sản phẩm chưa có, thêm sản phẩm mới vào
                $this->selectedProducts[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'color' => $product->colors->first()->id ?? '',
                    'size' => $product->sizes->first()->id ?? '',
                    'colors' => $product->colors->toArray(),
                    'sizes' => $product->sizes->toArray(),
                    'quantity' => 1,
                    'discount' => 0,
                    'tax' => 10,
                ];
            }

            // Tính lại tổng số tiền
            $this->calculateTotalAmount();
        }
    }


    public function removeProduct($productId)
    {
        if ($this->isAdmin) {
            $this->dispatch('showError', 'Bạn không có quyền xóa sản phẩm!');
            return;
        }

        if (isset($this->selectedProducts[$productId])) {
            unset($this->selectedProducts[$productId]);
        }
        $this->calculateTotalAmount();
    }

    public function updateInvoice()
    {


        $this->invoice->update([
            'user_id' => $this->selectedUser,
            'description' => $this->description,
            'total_amount' => $this->totalAmount,
            'signature' => encrypt($this->signature),
        ]);

        foreach ($this->selectedProducts as $productId => $productData) {
            $product = $this->invoice->invoiceDetails()->where('product_id', $productId)->first();

            $colorId = $productData['color'] ?: ($productData['colors'][0]['id'] ?? '');
            $sizeId = $productData['size'] ?: ($productData['sizes'][0]['id'] ?? '');

            if ($product) {
                $product->update([
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['price'],
                    'discount_id' => $productData['discount'],
                    'status_payment' => $this->statusPayment,
                    'method_payment' => $this->paymentMethod,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                ]);
            } else {
                $this->invoice->invoiceDetails()->create([
                    'product_id' => $productId,
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['price'],
                    'discount_id' => $productData['discount'],
                    'status_payment' => $this->statusPayment,
                    'method_payment' => $this->paymentMethod,
                    'invoice_id' => $this->invoice->id,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                ]);
            }
        }

        $this->calculateTotalAmount();

        return redirect()->route('invoices.index')->with('success', 'Hóa đơn đã được cập nhật thành công!');
    }

    public function render()
    {
        return view('livewire.invoice-edit-form', [
            'users' => User::all(),
            'products' => Products::all(),
        ]);
    }
}
