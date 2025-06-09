<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use App\Models\Discounts;
use App\Models\InvoiceDetails;
use App\Models\Invoices;
use App\Models\Products;
use App\Models\Sizes;
use App\Models\User;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display data revenue of the resource
     */
    private function getInvoiceStatistics()
    {
        return [
            'countInvoiceSend' => InvoiceDetails::count(),
            'revenueInvoiceSend' => Invoices::whereHas('invoiceDetails')->sum('total_amount'),

            'countInvoicePaid' => InvoiceDetails::where('status_payment', 'Paid')->count(),
            'revenueInvoicePaid' => Invoices::whereHas('invoiceDetails', function ($query) {
                $query->where('status_payment', 'Paid');
            })->sum('total_amount'),

            'countInvoiceCancel' => InvoiceDetails::where('status_payment', 'Cancel')->count(),
            'revenueInvoiceCancel' => Invoices::whereHas('invoiceDetails', function ($query) {
                $query->where('status_payment', 'Cancel');
            })->sum('total_amount'),
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortColumn = $request->get('column', 'id');
        $sortDirection = $request->get('sort', 'asc');

        $invoices = Invoices::orderBy($sortColumn, $sortDirection)->paginate(6);

        return view('pages.invoices.invoices')->with(array_merge([
            'invoices' => $invoices->appends(request()->query())
        ], $this->getInvoiceStatistics()));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['user']);
        })->get();
        $products = Products::all();
        $discounts = Discounts::all();
        $colors = Colors::all();
        $sizes = Sizes::all();
        return view('pages.invoices.create-invoice')->with([
            'users' => $users,
            'products' => $products,
            'discounts' => $discounts,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->method_payment === 'momo') {
            $response = app(MomoController::class)->process($request);
            $data = $response->getData(true);

            if (!isset($data['payUrl'])) {
                return response()->json(['message' => 'Không thể kết nối Momo'], 500);
            }

            return response()->json([
                'payUrl' => $data['payUrl']
            ]);
        }

        // Xử lý thanh toán tiền mặt (COD)
        $invoice = Invoices::create([
            'user_id' => $request->userId,
            'description' => $request->description,
            'total_amount' => $request->totalPrice,
            'signature' => $request->signature,
            'status_payment' => $request->status_payment,
            'method_payment' => $request->method_payment,
        ]);

        foreach ($request->selectedProducts as $productId => $product) {
            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'product_id' => $productId,
                'discount_id' => $request->discountId ?? null,
                'quantity' => $product['quantity'],
                'unit_price' => $product['price'],
                'status_payment' => $request->status_payment,
                'method_payment' => $request->method_payment,
                'description' => $request->description,
                'size_id' => $product['size_id'] ?? null,
                'color_id' => $product['color_id'] ?? null,
            ]);

            if ($request->discountId) {
                $discount = Discounts::find($request->discountId);
                $discount?->decrement('amount_discount', $product['quantity']);
            }
        }

        return response()->json([
            'message' => 'Hóa đơn đã được tạo thành công!',
            'invoice_id' => $invoice->id
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function showDetail($invoiceId)
    {
        $invoice = Invoices::with('invoiceDetails')->find($invoiceId);
        if (!$invoice || !$invoice->signature) {
            return redirect()->back()->with('error', 'Không tìm thấy hóa đơn hoặc chữ ký khách hàng.');
        }
        $signature = decrypt($invoice->signature);

        // Lấy tất cả các hóa đơn của người dùng này
        $userInvoices = Invoices::where('user_id', $invoice->user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.invoices.detail-invoice')->with([
            'invoice' => $invoice,
            'signature' => $signature,
            'invoiceDetails' => $invoice->invoiceDetails,
            'userInvoices' => $userInvoices,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = Invoices::with('products')->find($id);
        return view('pages.invoices.edit-invoice', compact('invoice'));
    }

    /**
     * Search the specified resource from storage.
     */
    public function search(Request $request)
    {
        $request->validate([
            'name' => "required|max:50",
        ], [
            'name.required' => 'Vui lòng nhập tên người dùng để tìm kiếm.',
            'name.max' => 'Tên người dùng không được vượt quá 50 ký tự.',
        ]);

        $search = $request->name;

        $invoices = Invoices::whereHas('user', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(6);

        return view('pages.invoices.invoices')->with(array_merge([
            'invoices' => $invoices
        ], $this->getInvoiceStatistics()));
    }
}
