{{-- wire:poll cập nhật component mặc định 2s --}}
<div>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 name-shop">Bamboo</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-revenue text-white mb-4">
                        <div class="card-body">
                            Số lượng sản phẩm
                            <div class="card-content">
                                <span class="card-data">{{ number_format($countProducts, 2, '.', ',') }}</span>
                                <span class="card-unit">sản phẩm</span>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="text-white stretched-link" href="/products">View Details</a>
                            <div class=" text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-revenue-warning text-white mb-4">
                        <div class="card-body">
                            Doanh thu tuần
                            <div class="card-content">
                                <span class="card-data">{{ number_format($revenueInvoicesWeek, 2, '.', ',') }}</span>
                                <span class="card-unit">VNĐ</span>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="/">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-revenue-success text-white mb-4">
                        <div class="card-body">
                            Doanh thu tháng
                            <div class="card-content">
                                <span class="card-data">{{ number_format($revenueInvoicesMonth, 2, '.', ',') }}</span>
                                <span class="card-unit">VNĐ</span>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="/">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i style="color: var(--text-primary)" class="fas fa-chart-area me-1"></i>
                            Biểu đồ doanh thu tháng
                        </div>
                        <div class="card-body">
                            <div id="chart-data-month" data-product-month='@json($productsSoldThisMonth)'></div>
                            <canvas id="myAreaChart" width="100%" height="60"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i style="color: var(--text-primary)" class="fas fa-chart-bar me-1"></i>
                            Biểu đồ doanh thu năm
                        </div>
                        <div class="card-body">
                            <div id="chart-data-year" data-product-year='@json($productsSoldThisYear)'></div>
                            <canvas id="myBarChart" width="100%" height="60"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body card-table">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card-header">
                                <i class="fa-solid fa-fire me-1 text-danger"></i>
                                Top 5 sản phẩm bán chạy
                            </div>
                            <table class="dashboard-table table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th style="width: 100px;">Số lượng đã bán</th>
                                        <th>Doanh thu sản phẩm</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Số lượng đã bán</th>
                                        <th>Doanh thu sản phẩm</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($getTopProductsSelling as $item)
                                        <tr>
                                            <td class="top-name">
                                                <span class="top-more">{{ $item['name'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ asset($item['image_url']) }}" alt="{{ $item['name'] }}">
                                            </td>
                                            <td>{{ $item['total_sold'] }}</td>
                                            <td>{{ number_format($item['total_revenue'], 0, ',', '.') }} vnđ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card-header">
                                <i class="fa-solid fa-star me-1 text-warning"></i>
                                Đánh giá của khách hàng
                            </div>
                            <div class="comments">
                                @foreach ($getInfoUserAppreciated as $comment)
                                    <div class="comment-item" data-aos-duration="2000" data-aos="fade-up"
                                        data-aos-anchor-placement="top-bottom">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="d-flex align-items-center justify-content-start me-5">
                                                <img src="{{ $comment->user->getFirstMediaUrl('avatar') }}"
                                                    alt="{{ $comment->user->name }}">
                                                <span class="name-user-comment">
                                                    {{ $comment->user->last_name ?? 'Ẩn ' }}
                                                    {{ $comment->user->name ?? 'danh' }}
                                                </span>
                                            </div>
                                            <span class="content-user-comment">{{ $comment->description }}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <span
                                                class="date-created">{{ \Carbon\Carbon::parse($comment->created_at)->locale('vi')->timezone('Asia/Ho_Chi_Minh')->diffForHumans() }}</span>
                                            <span>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $comment->rate_level)
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                    @else
                                                        <i class="fa-regular fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    @section('extraScript')
        <script src="{{ asset('js/dashboard.js') }}"></script>
    @endsection

</div>
