<?php

namespace App\Livewire;

use App\Models\Comments;
use App\Models\InvoiceDetails;
use App\Models\Invoices;
use App\Models\Products;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardContent extends Component
{

    // Lấy số lượng sản phẩm
    public function getCountProducts()
    {
        return Products::count();
    }

    // Lấy doanh thu tuần hiện tại
    public function getRevenueInvoicesWeek()
    {
        return Invoices::whereBetween('created_at', [now()->startOfWeek()->timezone('Asia/Ho_Chi_Minh'), now()->timezone('Asia/Ho_Chi_Minh')])->sum('total_amount');
    }

    // Lấy doanh thu tháng hiện tại
    public function getRevenueInvoicesMonth()
    {
        return Invoices::whereBetween('created_at', [now()->startOfMonth()->timezone('Asia/Ho_Chi_Minh'), now()->timezone('Asia/Ho_Chi_Minh')])->sum('total_amount');
    }

    // Lấy danh sách doanh thu của sản phẩm trong tháng hiện tại
    // public function getProductsSoldThisMonth()
    // {
    //     return InvoiceDetails::selectRaw('product_id, SUM(quantity) as total_sold')
    //         ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
    //         ->where('status_payment', '!=', 'Hủy thanh toán')
    //         ->groupBy('product_id')
    //         ->with('product')
    //         ->get();
    // }

    public function getProductsSoldThisMonth()
    {
        return InvoiceDetails::selectRaw('product_id, SUM(quantity) as total_sold, SUM(quantity * products.price) as total_revenue')
            ->join('products', 'invoice_details.product_id', '=', 'products.id')
            ->whereBetween('invoice_details.created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->where('invoice_details.status_payment', '!=', 'Cancel')
            ->groupBy('invoice_details.product_id', 'products.price')
            ->with('product')
            ->get();
    }

    // Lấy danh sách doanh thu của sản phẩm trong năm hiện tại
    public function getProductsSoldThisYear()
    {
        return InvoiceDetails::selectRaw('product_id, SUM(quantity) as total_sold, SUM(quantity * products.price) as total_revenue')
            ->join('products', 'invoice_details.product_id', '=', 'products.id')
            ->whereBetween('invoice_details.created_at', [now()->startOfYear(), now()->endOfYear()])
            ->where('invoice_details.status_payment', '!=', 'Cancel')
            ->groupBy('invoice_details.product_id', 'products.price')
            ->with('product')
            ->get();
    }

    //Lấy danh sách top 5 sản phẩm bán chạy
    public function getTopProductsSelling()
    {
        // Lấy top 5 sản phẩm bán chạy nhất, kèm theo doanh thu
        $topProducts = Products::join('invoice_details', 'products.id', '=', 'invoice_details.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('SUM(invoice_details.quantity) as total_sold'),
                DB::raw('SUM(invoice_details.quantity * products.price) as total_revenue')  // Tính doanh thu
            )
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        $topProducts->map(function ($product) {
            $product->image_url = $product->getImageAttribute();
            return $product;
        });

        return $topProducts->toArray();
    }

    //Hiện thông tin đánh giá người dùng mới nhất
    public function getInfoUserAppreciated()
    {
        $comments = Comments::where('is_reply', false)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return $comments;
    }

    public function render()
    {
        // dd($this->getTopProductsSelling());
        return view('livewire.dashboard-content')->with([
            'countProducts' => $this->getCountProducts(),
            'revenueInvoicesWeek' => $this->getRevenueInvoicesWeek(),
            'revenueInvoicesMonth' => $this->getRevenueInvoicesMonth(),
            'productsSoldThisMonth' => $this->getProductsSoldThisMonth(),
            'productsSoldThisYear' => $this->getProductsSoldThisYear(),
            'getTopProductsSelling' => $this->getTopProductsSelling(),
            'getInfoUserAppreciated' => $this->getInfoUserAppreciated()
        ]);
    }
}
