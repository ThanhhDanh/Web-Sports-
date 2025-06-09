@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/detail-product.css') }}">
@endsection

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h1 class="mb-5">Chi tiết sản phẩm</h1>
        <div class="grid wrapper">
            <div class="row">
                <div class="col col-sm-12 col-md-6 col-lg-6 item-product">
                    <div class="d-flex flex-column align-items-center">
                        <img data-bs-toggle="modal" data-bs-target="#image-product-modal" class="img-product"
                            src="{{ $product->image }}" alt="{{ $product->name }}">

                        <div class="accessories">
                            <!-- Màu sắc -->
                            <p class="mb-4"><strong>Màu sắc:</strong>
                                @foreach ($product->colors as $index => $color)
                                    <span>
                                        {{ $color->name }}@if ($index < $product->colors->count() - 1)
                                            ,
                                        @endif
                                    </span>
                                @endforeach
                            </p>

                            <!-- Kích thước -->
                            <p><strong>Kích thước:</strong>
                                @foreach ($product->sizes as $index => $size)
                                    <span>
                                        {{ $size->name }}@if ($index < $product->sizes->count() - 1)
                                            ,
                                        @endif
                                    </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-12 col-md-6 col-lg-6 item-product">
                    {{-- Name input --}}
                    <label for="name">Tên sản phẩm</label>
                    <div class="input-group mb-3 content">
                        <div class="input-group-prepend">
                            <span class="input-group-text content-icon" id="basic-addon1">
                                <i class="fa-solid fa-shoe-prints"></i>
                            </span>
                        </div>
                        <input id="name" type="text" class="form-control content-name" disabled
                            placeholder="{{ $product->name }}" value="{{ $product->name }}"
                            aria-label="{{ $product->name }}" aria-describedby="basic-addon1">
                    </div>

                    {{-- Description input --}}
                    <label for="description">Mô tả sản phẩm</label>
                    <div class="input-group mb-3 content">
                        <div class="input-group-prepend">
                            <span class="input-group-text content-icon" id="basic-addon1">
                                <i class="fa-solid fa-audio-description"></i>
                            </span>
                        </div>
                        <textarea id="description" rows="5" type="text" class="form-control content-name" disabled
                            placeholder="{{ $product->description }}" aria-label="{{ $product->description }}" aria-describedby="basic-addon1">{{ $product->description }}</textarea>
                    </div>

                    {{-- Price input --}}
                    <label for="price">Giá sản phẩm</label>
                    <div class="input-group mb-3 content">
                        <div class="input-group-prepend">
                            <span class="input-group-text content-icon" id="basic-addon1">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </span>
                        </div>
                        <input id="price" type="text" class="form-control content-name" disabled
                            value="{{ number_format($product->price, 2, '.', ',') }} VNĐ"
                            placeholder="{{ $product->price }}" aria-label="{{ $product->price }}"
                            aria-describedby="basic-addon1">
                    </div>

                    {{-- Category_id input --}}
                    <label for="category_id">Danh mục sản phẩm</label>
                    <div class="input-group mb-3 content">
                        <div class="input-group-prepend">
                            <span class="input-group-text content-icon" id="basic-addon1">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                        </div>
                        <input id="category_id" type="text" class="form-control content-name" disabled
                            value="{{ $product->category->name }}" placeholder="{{ $product->category->name }}"
                            aria-label="{{ $product->category->name }}" aria-describedby="basic-addon1">
                    </div>
                    <div class="d-flex align-items-start justify-content-start ms-5">
                        <a href="/product/edit/{{ $product->id }}" class="btn btn-info w-25 me-3">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a href="" class="btn btn-danger w-25" data-id="{{ $product->id }}" data-bs-toggle="modal"
                            data-bs-target="#delete-product-modal">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Comfirm delete product --}}
    <div class="modal fade" id="delete-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa sản phẩm này??</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn xóa sản phẩm này không??.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button id="btn-delete-product" type="button" class="btn btn-danger">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Show image product --}}
    <div class="modal fade" id="image-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="show-img" src="{{ $product->image }}" alt="{{ $product->name }}" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete form -->
    <form method="POST" name="delete-form-product">
        @csrf
        @method('DELETE')
    </form>

    @section('extraScript')
        <script src="{{ asset('js/product.js') }}"></script>
    @endsection
@endsection
