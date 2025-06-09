@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/detail-invoice.css') }}">
@endsection

@section('title', 'Chi tiết hóa đơn')

@section('content')
    <div class="container-fluid px-4">
        <div class="container bg-container">
            <h1 class="mb-3 ps-4 name-detail-invoice">Chi tiết hóa đơn</h1>
            <div class="row">
                <div class="col-xl-8 col-sm-8 col-xs-12">
                    <div class="header-invoice-detail d-flex align-items-center justify-content-between">
                        <div class="info-store">
                            <img src="{{ asset('storage/logo.webp') }}" alt="Logo">
                            <span class="name-shop">The Sports</span>
                        </div>
                        @php
                            // Lấy chi tiết hóa đơn mới nhất của hóa đơn này
                            $latestInvoiceDetail = $invoice->invoiceDetails->sortByDesc('created_at')->first();

                            $checkStatusPayment = '';

                            if ($latestInvoiceDetail) {
                                switch ($latestInvoiceDetail->status_payment) {
                                    case 'Paid':
                                        $checkStatusPayment = 'paid';
                                        break;
                                    case 'Pending':
                                        $checkStatusPayment = 'text-warning';
                                        break;
                                    case 'Cancel':
                                        $checkStatusPayment = 'cancel';
                                        break;
                                }
                            }
                        @endphp

                        <span class="info-paid {{ $checkStatusPayment }}">
                            {{ $latestInvoiceDetail ? $latestInvoiceDetail->status_payment : 'Chưa có' }}
                        </span>

                    </div>

                    {{-- Thời gian xác định --}}
                    <div class="row time-invoice-detail">
                        <div class="col-xl-4 col-md-6">
                            <div class="header-date date-now">
                                <span class="title-date">Ngày hiện tại:</span>
                                @php
                                    use Carbon\Carbon;
                                    $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
                                @endphp

                                <span class="date">{{ $date }}</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="header-date date-create-at">
                                <span class="title-date">Ngày mua:</span>
                                <span
                                    class="date">{{ $invoice->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="header-date id-invoice">
                                <span class="title-id">Mã hóa đơn:</span>
                                <span class="id">{{ $invoice->id }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Thông tin ngừi mua, nơi bán --}}
                    <div class="row info-invoice-detail">
                        <div class="col-xl-6 col-sm-6 col-xs-12">
                            <div class="invoiced-to info-to">
                                <h3>Hóa đơn của:</h3>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M588.8 883.2c0 14.08-11.52 25.6-25.6 25.6h-38.4c-14.08 0-25.6-11.52-25.6-25.6V140.8c0-14.08 11.52-25.6 25.6-25.6h38.4c14.08 0 25.6 11.52 25.6 25.6v742.4z"
                                                fill="#C89005"></path>
                                            <path
                                                d="M563.2 921.6h-38.4c-21.76 0-38.4-16.64-38.4-38.4V140.8c0-21.76 16.64-38.4 38.4-38.4h38.4c21.76 0 38.4 16.64 38.4 38.4v742.4c0 21.76-16.64 38.4-38.4 38.4z m-38.4-793.6c-7.68 0-12.8 5.12-12.8 12.8v742.4c0 7.68 5.12 12.8 12.8 12.8h38.4c7.68 0 12.8-5.12 12.8-12.8V140.8c0-7.68-5.12-12.8-12.8-12.8h-38.4z"
                                                fill="#231C1C"></path>
                                            <path
                                                d="M819.2 550.4c0 14.08-11.52 25.6-25.6 25.6H294.4c-14.08 0-25.6-11.52-25.6-25.6V217.6c0-14.08 11.52-25.6 25.6-25.6h499.2c14.08 0 25.6 11.52 25.6 25.6v332.8z"
                                                fill="#E24F32"></path>
                                            <path
                                                d="M793.6 588.8H294.4c-21.76 0-38.4-16.64-38.4-38.4V217.6c0-21.76 16.64-38.4 38.4-38.4h499.2c21.76 0 38.4 16.64 38.4 38.4v332.8c0 21.76-16.64 38.4-38.4 38.4zM294.4 204.8c-7.68 0-12.8 5.12-12.8 12.8v332.8c0 7.68 5.12 12.8 12.8 12.8h499.2c7.68 0 12.8-5.12 12.8-12.8V217.6c0-7.68-5.12-12.8-12.8-12.8H294.4z"
                                                fill="#231C1C"></path>
                                            <path d="M345.6 268.8h179.2v25.6H345.6zM588.8 268.8h102.4v25.6h-102.4z"
                                                fill="#231C1C"></path>
                                            <path d="M358.4 358.4h140.8v25.6H358.4z" fill="#231C1C"></path>
                                            <path d="M358.4 486.4h384v25.6H358.4z" fill="#231C1C"></path>
                                        </g>
                                    </svg>
                                    <span>{{ $invoice->user->last_name }}
                                        {{ $invoice->user->name }}</span>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M588.8 883.2c0 14.08-11.52 25.6-25.6 25.6h-38.4c-14.08 0-25.6-11.52-25.6-25.6V140.8c0-14.08 11.52-25.6 25.6-25.6h38.4c14.08 0 25.6 11.52 25.6 25.6v742.4z"
                                                fill="#C89005"></path>
                                            <path
                                                d="M563.2 921.6h-38.4c-21.76 0-38.4-16.64-38.4-38.4V140.8c0-21.76 16.64-38.4 38.4-38.4h38.4c21.76 0 38.4 16.64 38.4 38.4v742.4c0 21.76-16.64 38.4-38.4 38.4z m-38.4-793.6c-7.68 0-12.8 5.12-12.8 12.8v742.4c0 7.68 5.12 12.8 12.8 12.8h38.4c7.68 0 12.8-5.12 12.8-12.8V140.8c0-7.68-5.12-12.8-12.8-12.8h-38.4z"
                                                fill="#231C1C"></path>
                                            <path
                                                d="M819.2 550.4c0 14.08-11.52 25.6-25.6 25.6H294.4c-14.08 0-25.6-11.52-25.6-25.6V217.6c0-14.08 11.52-25.6 25.6-25.6h499.2c14.08 0 25.6 11.52 25.6 25.6v332.8z"
                                                fill="#E24F32"></path>
                                            <path
                                                d="M793.6 588.8H294.4c-21.76 0-38.4-16.64-38.4-38.4V217.6c0-21.76 16.64-38.4 38.4-38.4h499.2c21.76 0 38.4 16.64 38.4 38.4v332.8c0 21.76-16.64 38.4-38.4 38.4zM294.4 204.8c-7.68 0-12.8 5.12-12.8 12.8v332.8c0 7.68 5.12 12.8 12.8 12.8h499.2c7.68 0 12.8-5.12 12.8-12.8V217.6c0-7.68-5.12-12.8-12.8-12.8H294.4z"
                                                fill="#231C1C"></path>
                                            <path d="M345.6 268.8h179.2v25.6H345.6zM588.8 268.8h102.4v25.6h-102.4z"
                                                fill="#231C1C"></path>
                                            <path d="M358.4 358.4h140.8v25.6H358.4z" fill="#231C1C"></path>
                                            <path d="M358.4 486.4h384v25.6H358.4z" fill="#231C1C"></path>
                                        </g>
                                    </svg>
                                    <span>{{ $invoice->user->phone }}</span>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M588.8 883.2c0 14.08-11.52 25.6-25.6 25.6h-38.4c-14.08 0-25.6-11.52-25.6-25.6V140.8c0-14.08 11.52-25.6 25.6-25.6h38.4c14.08 0 25.6 11.52 25.6 25.6v742.4z"
                                                fill="#C89005"></path>
                                            <path
                                                d="M563.2 921.6h-38.4c-21.76 0-38.4-16.64-38.4-38.4V140.8c0-21.76 16.64-38.4 38.4-38.4h38.4c21.76 0 38.4 16.64 38.4 38.4v742.4c0 21.76-16.64 38.4-38.4 38.4z m-38.4-793.6c-7.68 0-12.8 5.12-12.8 12.8v742.4c0 7.68 5.12 12.8 12.8 12.8h38.4c7.68 0 12.8-5.12 12.8-12.8V140.8c0-7.68-5.12-12.8-12.8-12.8h-38.4z"
                                                fill="#231C1C"></path>
                                            <path
                                                d="M819.2 550.4c0 14.08-11.52 25.6-25.6 25.6H294.4c-14.08 0-25.6-11.52-25.6-25.6V217.6c0-14.08 11.52-25.6 25.6-25.6h499.2c14.08 0 25.6 11.52 25.6 25.6v332.8z"
                                                fill="#E24F32"></path>
                                            <path
                                                d="M793.6 588.8H294.4c-21.76 0-38.4-16.64-38.4-38.4V217.6c0-21.76 16.64-38.4 38.4-38.4h499.2c21.76 0 38.4 16.64 38.4 38.4v332.8c0 21.76-16.64 38.4-38.4 38.4zM294.4 204.8c-7.68 0-12.8 5.12-12.8 12.8v332.8c0 7.68 5.12 12.8 12.8 12.8h499.2c7.68 0 12.8-5.12 12.8-12.8V217.6c0-7.68-5.12-12.8-12.8-12.8H294.4z"
                                                fill="#231C1C"></path>
                                            <path d="M345.6 268.8h179.2v25.6H345.6zM588.8 268.8h102.4v25.6h-102.4z"
                                                fill="#231C1C"></path>
                                            <path d="M358.4 358.4h140.8v25.6H358.4z" fill="#231C1C"></path>
                                            <path d="M358.4 486.4h384v25.6H358.4z" fill="#231C1C"></path>
                                        </g>
                                    </svg>
                                    <span>1A đường B, xã C, huyện D, ABC</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6 col-xs-12">
                            <div class="pay-to info-to">
                                <h3>Trả tiền cho:</h3>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M588.8 883.2c0 14.08-11.52 25.6-25.6 25.6h-38.4c-14.08 0-25.6-11.52-25.6-25.6V140.8c0-14.08 11.52-25.6 25.6-25.6h38.4c14.08 0 25.6 11.52 25.6 25.6v742.4z"
                                                fill="#C89005"></path>
                                            <path
                                                d="M563.2 921.6h-38.4c-21.76 0-38.4-16.64-38.4-38.4V140.8c0-21.76 16.64-38.4 38.4-38.4h38.4c21.76 0 38.4 16.64 38.4 38.4v742.4c0 21.76-16.64 38.4-38.4 38.4z m-38.4-793.6c-7.68 0-12.8 5.12-12.8 12.8v742.4c0 7.68 5.12 12.8 12.8 12.8h38.4c7.68 0 12.8-5.12 12.8-12.8V140.8c0-7.68-5.12-12.8-12.8-12.8h-38.4z"
                                                fill="#231C1C"></path>
                                            <path
                                                d="M819.2 550.4c0 14.08-11.52 25.6-25.6 25.6H294.4c-14.08 0-25.6-11.52-25.6-25.6V217.6c0-14.08 11.52-25.6 25.6-25.6h499.2c14.08 0 25.6 11.52 25.6 25.6v332.8z"
                                                fill="#E24F32"></path>
                                            <path
                                                d="M793.6 588.8H294.4c-21.76 0-38.4-16.64-38.4-38.4V217.6c0-21.76 16.64-38.4 38.4-38.4h499.2c21.76 0 38.4 16.64 38.4 38.4v332.8c0 21.76-16.64 38.4-38.4 38.4zM294.4 204.8c-7.68 0-12.8 5.12-12.8 12.8v332.8c0 7.68 5.12 12.8 12.8 12.8h499.2c7.68 0 12.8-5.12 12.8-12.8V217.6c0-7.68-5.12-12.8-12.8-12.8H294.4z"
                                                fill="#231C1C"></path>
                                            <path d="M345.6 268.8h179.2v25.6H345.6zM588.8 268.8h102.4v25.6h-102.4z"
                                                fill="#231C1C"></path>
                                            <path d="M358.4 358.4h140.8v25.6H358.4z" fill="#231C1C"></path>
                                            <path d="M358.4 486.4h384v25.6H358.4z" fill="#231C1C"></path>
                                        </g>
                                    </svg>
                                    <span>Bamboo</span>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M588.8 883.2c0 14.08-11.52 25.6-25.6 25.6h-38.4c-14.08 0-25.6-11.52-25.6-25.6V140.8c0-14.08 11.52-25.6 25.6-25.6h38.4c14.08 0 25.6 11.52 25.6 25.6v742.4z"
                                                fill="#C89005"></path>
                                            <path
                                                d="M563.2 921.6h-38.4c-21.76 0-38.4-16.64-38.4-38.4V140.8c0-21.76 16.64-38.4 38.4-38.4h38.4c21.76 0 38.4 16.64 38.4 38.4v742.4c0 21.76-16.64 38.4-38.4 38.4z m-38.4-793.6c-7.68 0-12.8 5.12-12.8 12.8v742.4c0 7.68 5.12 12.8 12.8 12.8h38.4c7.68 0 12.8-5.12 12.8-12.8V140.8c0-7.68-5.12-12.8-12.8-12.8h-38.4z"
                                                fill="#231C1C"></path>
                                            <path
                                                d="M819.2 550.4c0 14.08-11.52 25.6-25.6 25.6H294.4c-14.08 0-25.6-11.52-25.6-25.6V217.6c0-14.08 11.52-25.6 25.6-25.6h499.2c14.08 0 25.6 11.52 25.6 25.6v332.8z"
                                                fill="#E24F32"></path>
                                            <path
                                                d="M793.6 588.8H294.4c-21.76 0-38.4-16.64-38.4-38.4V217.6c0-21.76 16.64-38.4 38.4-38.4h499.2c21.76 0 38.4 16.64 38.4 38.4v332.8c0 21.76-16.64 38.4-38.4 38.4zM294.4 204.8c-7.68 0-12.8 5.12-12.8 12.8v332.8c0 7.68 5.12 12.8 12.8 12.8h499.2c7.68 0 12.8-5.12 12.8-12.8V217.6c0-7.68-5.12-12.8-12.8-12.8H294.4z"
                                                fill="#231C1C"></path>
                                            <path d="M345.6 268.8h179.2v25.6H345.6zM588.8 268.8h102.4v25.6h-102.4z"
                                                fill="#231C1C"></path>
                                            <path d="M358.4 358.4h140.8v25.6H358.4z" fill="#231C1C"></path>
                                            <path d="M358.4 486.4h384v25.6H358.4z" fill="#231C1C"></path>
                                        </g>
                                    </svg>
                                    <span>123456789</span>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M588.8 883.2c0 14.08-11.52 25.6-25.6 25.6h-38.4c-14.08 0-25.6-11.52-25.6-25.6V140.8c0-14.08 11.52-25.6 25.6-25.6h38.4c14.08 0 25.6 11.52 25.6 25.6v742.4z"
                                                fill="#C89005"></path>
                                            <path
                                                d="M563.2 921.6h-38.4c-21.76 0-38.4-16.64-38.4-38.4V140.8c0-21.76 16.64-38.4 38.4-38.4h38.4c21.76 0 38.4 16.64 38.4 38.4v742.4c0 21.76-16.64 38.4-38.4 38.4z m-38.4-793.6c-7.68 0-12.8 5.12-12.8 12.8v742.4c0 7.68 5.12 12.8 12.8 12.8h38.4c7.68 0 12.8-5.12 12.8-12.8V140.8c0-7.68-5.12-12.8-12.8-12.8h-38.4z"
                                                fill="#231C1C"></path>
                                            <path
                                                d="M819.2 550.4c0 14.08-11.52 25.6-25.6 25.6H294.4c-14.08 0-25.6-11.52-25.6-25.6V217.6c0-14.08 11.52-25.6 25.6-25.6h499.2c14.08 0 25.6 11.52 25.6 25.6v332.8z"
                                                fill="#E24F32"></path>
                                            <path
                                                d="M793.6 588.8H294.4c-21.76 0-38.4-16.64-38.4-38.4V217.6c0-21.76 16.64-38.4 38.4-38.4h499.2c21.76 0 38.4 16.64 38.4 38.4v332.8c0 21.76-16.64 38.4-38.4 38.4zM294.4 204.8c-7.68 0-12.8 5.12-12.8 12.8v332.8c0 7.68 5.12 12.8 12.8 12.8h499.2c7.68 0 12.8-5.12 12.8-12.8V217.6c0-7.68-5.12-12.8-12.8-12.8H294.4z"
                                                fill="#231C1C"></path>
                                            <path d="M345.6 268.8h179.2v25.6H345.6zM588.8 268.8h102.4v25.6h-102.4z"
                                                fill="#231C1C"></path>
                                            <path d="M358.4 358.4h140.8v25.6H358.4z" fill="#231C1C"></path>
                                            <path d="M358.4 486.4h384v25.6H358.4z" fill="#231C1C"></path>
                                        </g>
                                    </svg>
                                    <span>1A đường B, xã C, huyện D, ABC</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-products-invoice">
                        <h3>Thông tin sản phẩm:</h3>
                        <div class="container-table">
                            <table style="height: 140px" class="table table-borderless table-hover text-center">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Màu</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Giá sản phẩm</th>
                                        <th scope="col">Giảm giá của sản phẩm</th>
                                        <th scope="col">Thuế</th>
                                        <th scope="col">Tổng giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoiceDetails as $invoiceDetail)
                                        <tr>
                                            <td style="width: 300px">
                                                <span class="name-short">{{ $invoiceDetail->product->name }}</span>
                                            </td>
                                            <td>{{ $invoiceDetail->quantity }}</td>
                                            <td>{{ $invoiceDetail->color->name }}</td>
                                            <td>{{ $invoiceDetail->size->name }}</td>
                                            <td>{{ number_format($invoiceDetail->unit_price, 0, '.', ',') }} VNĐ</td>
                                            <td style="width: 100px">
                                                0 VNĐ
                                            </td>
                                            <td>1%</td>
                                            <td>
                                                {{ number_format($invoiceDetail->unit_price, 0, '.', ',') }} VNĐ
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="footer-table">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <span class="footer-label-table">Thuế</span>
                                <span>1%</span>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <span class="footer-label-table">Giảm giá hóa đơn</span>
                                <span>
                                    {{ number_format($invoiceDetail->discount->price_discount ?? 0, 0, '.', ',') }} VNĐ
                                </span>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <span><strong>Tổng tiền hóa đơn</strong></span>
                                <span>{{ number_format($invoiceDetail->invoice->total_amount, 0, '.', ',') }} VNĐ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 col-xs-12">
                    <div class="col-right">
                        <div class="mb-3">
                            <label for="status_payment" class="form-label">Tình trạng</label>
                            <input value="{{ $invoiceDetail->status_payment }}" type="text" disabled
                                class="form-control" id="status_payment" placeholder="Tình trạng...">
                        </div>
                        <div class="payment-details d-flex flex-column align-items-start justify-content-start">
                            <span>Phương thức thanh toán:</span>
                            <span><strong>{{ $invoiceDetail->method_payment }}</strong></span>
                        </div>
                        <div class="timeline-invoices">
                            <span>Thời gian mua:</span>
                            <div class="container-timeline">
                                <ul class="timeline-1 text-black">
                                    @foreach ($userInvoices as $invoice)
                                        <li class="event" data-date="{{ $invoice->created_at->format('m/Y') }}">
                                            <a href="/invoice/detail/{{ $invoice->id }}"
                                                class="mb-2">{{ $invoice->user->last_name }}
                                                {{ $invoice->user->name }}
                                            </a>
                                            <p>Đã đặt hàng vào
                                                {{ $invoice->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="signature-user d-flex flex-column align-items-end justify-content-end">
                <div class="d-flex flex-column align-items-center p-4 my-4 me-5">
                    <span>Chữ ký khách hàng</span>
                    <span>{{ $signature }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
