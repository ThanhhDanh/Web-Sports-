@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/invoices.css') }}">
@endsection

@section('title', 'Quản lý hóa đơn')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4 name-shop">Hóa đơn</h1>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-invoice-table text-white mb-4">
                    <div class="card-body">
                        <div class="card-body-invoice">
                            <div class="card-content">
                                <span class="card-data">{{ number_format($revenueInvoiceSend, 2) }}</span>
                                <span class="card-unit">VNĐ</span>
                            </div>
                            Hóa đơn gửi
                            <div class="card-stats">
                                <span class="card-amount">{{ $countInvoiceSend }}</span>
                                <span class="card-amount-unit">Hóa đơn đã gửi</span>
                            </div>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-light rounded-circle">
                                <svg fill="#000000" width="28px" height="28px" viewBox="0 0 24 24" id="invoice-dollar"
                                    data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path id="secondary"
                                            d="M20,7H17.5A1.5,1.5,0,0,0,16,8.5h0A1.5,1.5,0,0,0,17.5,10h1A1.5,1.5,0,0,1,20,11.5h0A1.5,1.5,0,0,1,18.5,13H16"
                                            style="fill: none; stroke: #0050ae; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </path>
                                        <path id="secondary-2" data-name="secondary" d="M14,17H8m0-4h4m6-6V6m0,8V13"
                                            style="fill: none; stroke: #0050ae; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </path>
                                        <path id="primary" d="M18,18v2a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V4A1,1,0,0,1,5,3H15"
                                            style="fill: none; stroke: #0050ae; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-invoice-table text-white mb-4">
                    <div class="card-body">
                        <div class="card-body-invoice">
                            <div class="card-content">
                                <span class="card-data">{{ number_format($revenueInvoicePaid, 2) }}</span>
                                <span class="card-unit">VNĐ</span>
                            </div>
                            Hóa đơn đã trả
                            <div class="card-stats">
                                <span class="card-amount">{{ $countInvoicePaid }}</span>
                                <span class="card-amount-unit">Hóa đơn đã trả</span>
                            </div>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-light rounded-circle">
                                <svg width="28px" height="28px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g id="invoice_paid" transform="translate(-124 -248)">
                                            <rect id="Rectangle_3" data-name="Rectangle 3" width="24" height="24"
                                                transform="translate(125 249)" fill="none" stroke="#0050ae"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                            <path id="Path_26" data-name="Path 26" d="M131,273v6h24V255h-6" fill="none"
                                                stroke="#0050ae" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"></path>
                                            <path id="Path_27" data-name="Path 27" d="M144.039,256.5,134.5,266l-4.5-4.333"
                                                fill="none" stroke="#0050ae" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-invoice-table bg-invoice-tables-last mb-4">
                    <div class="card-body text-white">
                        <div class="card-body-invoice">
                            <div class="card-content">
                                <span class="card-data">{{ number_format($revenueInvoiceCancel, 2) }}</span>
                                <span class="card-unit">VNĐ</span>
                            </div>
                            Hóa đơn đã hủy
                            <div class="card-stats">
                                <span class="card-amount-cancel">{{ $countInvoiceCancel }}</span>
                                <span class="card-amount-unit">Hóa đơn đã hủy</span>
                            </div>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-light rounded-circle">
                                <svg width="28px" height="28px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M731.15 584.74c-100.99 0-182.86 81.87-182.86 182.86s81.87 182.86 182.86 182.86 182.86-81.87 182.86-182.86-81.87-182.86-182.86-182.86z m0 292.57c-60.5 0-109.71-49.22-109.71-109.71 0-60.5 49.22-109.71 109.71-109.71 60.5 0 109.71 49.22 109.71 109.71 0.01 60.49-49.21 109.71-109.71 109.71z"
                                            fill="#0050ae"></path>
                                        <path d="M657.76 740.16h146.29v54.86H657.76zM219.51 475.38h219.43v73.14H219.51z"
                                            fill="#0050ae"></path>
                                        <path
                                            d="M182.61 366.27h585.62v179.48h73.14V145.62c0-39.96-32.5-72.48-72.46-72.48h-27.36c-29.2 0-55.05 16.73-65.88 42.59-5.71 13.61-27.84 13.64-33.55 0-10.86-25.88-36.71-42.59-65.89-42.59h-18.16c-29.2 0-55.05 16.73-65.88 42.59-5.71 13.61-27.84 13.64-33.55 0-10.86-25.88-36.71-42.59-65.89-42.59h-17.43c-29.2 0-55.05 16.73-65.88 42.59-5.71 13.61-27.84 13.64-33.55 0-10.86-25.88-36.71-42.59-65.89-42.59h-27.57c-39.96 0-72.48 32.52-72.48 72.48v805.12h401.21V877.6H183.04l-0.43-511.33zM208.42 144c14.27 34.07 47.32 56.09 84.23 56.09 36.89 0 69.95-22 82.66-53.8l15.86-2.29c14.27 34.07 47.32 56.09 84.23 56.09 36.89 0 69.95-22 82.66-53.8l16.59-2.29c14.27 34.07 47.32 56.09 84.23 56.09 36.89 0 69.95-22 82.66-53.8l26.68-0.66v147.5H182.54l-0.12-146.84 26-2.29z"
                                            fill="#0050ae"></path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-search">
            <form method="GET" action="{{ route('invoices.search') }}"
                class="d-flex align-items-center justify-content-end form-inline">
                <input class="form-control w-25 me-3" name="name" type="search"
                    placeholder="Tìm kiếm hóa đơn tên khách hàng...." aria-label="Search" required>
                <button class="btn" type="submit">Tìm kiếm</button>
            </form>
        </div>
        <div class="card menu-invoices mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Hóa đơn khách hàng
            </div>
            <div class="card-body card-table">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>
                                <x-common.sort column="id" :sortColumn="request('column')" :sortDirection="request('sort')">
                                    #
                                </x-common.sort>
                            </th>
                            <th>Ảnh</th>
                            <th>
                                <x-common.sort column="user_id" :sortColumn="request('column')" :sortDirection="request('sort')">
                                    Tên
                                </x-common.sort>
                            </th>
                            <th>SĐT</th>
                            <th>Ngày lên đơn</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>SĐT</th>
                            <th>Ngày lên đơn</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($invoices->isNotEmpty())
                            @foreach ($invoices as $invoice)
                                @php
                                    // Lấy trạng thái thanh toán từ chi tiết hóa đơn mới nhất
                                    $latestInvoiceDetail = $invoice->invoiceDetails->sortByDesc('created_at')->first();
                                    $checkStatusPayment = '';

                                    if ($latestInvoiceDetail) {
                                        switch ($latestInvoiceDetail->status_payment) {
                                            case 'Paid':
                                                $checkStatusPayment = 'paid';
                                                break;
                                            case 'Pending':
                                                $checkStatusPayment = 'pending text-warning';
                                                break;
                                            case 'Cancel':
                                                $checkStatusPayment = 'cancel';
                                                break;
                                            default:
                                                $checkStatusPayment = 'text-success';
                                                break;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>
                                        <img class="img-user" src="{{ $invoice->user->getFirstMediaUrl('avatar') }}"
                                            alt="User Avatar">
                                    </td>
                                    <td>{{ $invoice->user->last_name }} {{ $invoice->user->name }}</td>
                                    <td>{{ $invoice->user->phone }}</td>
                                    <td>{{ $invoice->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                                    <td style="width: 130px; max-width: 100%;">
                                        <span class="status-invoice {{ $checkStatusPayment }}">
                                            {{ $latestInvoiceDetail ? $latestInvoiceDetail->status_payment : '' }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($invoice->total_amount, 0, '.', ',') }} VNĐ</td>
                                    <td class="text-center position-relative">
                                        <div class="bg-more more" id="more" aria-describedby="tooltip">
                                            <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 10C3.9 10 3 10.9 3 12C3 13.1 3.9 14 5 14C6.1 14 7 13.1 7 12C7 10.9 6.1 10 5 10Z"
                                                    stroke="#ffffff" stroke-width="1.5"></path>
                                                <path
                                                    d="M19 10C17.9 10 17 10.9 17 12C17 13.1 17.9 14 19 14C20.1 14 21 13.1 21 12C21 10.9 20.1 10 19 10Z"
                                                    stroke="#ffffff" stroke-width="1.5"></path>
                                                <path opacity="0.4"
                                                    d="M12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"
                                                    stroke="#ffffff" stroke-width="1.5"></path>
                                            </svg>
                                        </div>
                                        <div class="tooltip" id="tooltip" role="tooltip">
                                            <ul>
                                                <li>
                                                    <a href="/invoice/detail/{{ $invoice->id }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/invoice/edit/{{ $invoice->id }}">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
                <!-- Phân trang -->
                <div class="paginate d-flex justify-content-center my-2">
                    {{ $invoices->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extraScript')
    <script src="{{ asset('js/invoice.js') }}"></script>
@endsection
