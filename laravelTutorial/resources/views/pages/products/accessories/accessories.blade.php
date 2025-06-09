@extends('Welcome')

@section('title', 'Phụ kiện sản phẩm')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/accessories.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Phụ kiện sản phẩm</h1>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-xs-12">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center {{ Request::is('products/accessories/colors') ? 'active' : '' }}"
                                href="{{ route('accessories.color') }}">
                                🎨 Phụ kiện màu sắc sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center {{ Request::is('products/accessories/sizes') ? 'active' : '' }}"
                                href="{{ route('accessories.size') }}">
                                📏 Phụ kiện kích thước sản phẩm
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 col-xs-12">
                @yield('accessory-content')
                <form id="accessory-edit-form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" id="input-name" class="form-control" style="display: none;">
                </form>
            </div>
        </div>
    </div>
@endsection
