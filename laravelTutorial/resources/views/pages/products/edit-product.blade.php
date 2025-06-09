@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/create-product.css') }}">
@endsection

@section('title', 'Cập nhật sản phẩm')

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h2 class="text-center mb-3">Cập nhật</h2>
        <form class="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name input --}}
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="mb-3 @error('name') is-invalid  @enderror">
                <label for="name" class="form-label @error('name') text-danger  @enderror">Tên sản phẩm</label>
                <input type="text" value="{{ $product->name }}" class="form-control" id="name" name="name">
            </div>
            @error('name')
                <div class="text-danger text-error">{{ $message }}</div>
            @enderror

            {{-- Description input --}}
            <div class="mb-3 @error('description') is-invalid  @enderror">
                <label for="description" class="form-label @error('description') text-danger  @enderror">Mô tả</label>
                <textarea rows="5" id="description" class="form-control" name="description">{{ $product->description }}</textarea>
            </div>
            @error('description')
                <div class="text-danger text-error">{{ $message }}</div>
            @enderror

            <div class="row">
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    {{-- Price input --}}
                    <div class="mb-3 @error('price') is-invalid  @enderror">
                        <label for="price" class="form-label @error('price') text-danger  @enderror">Giá sản phẩm</label>
                        <div class="form-input">
                            <input id="price" value="{{ number_format($product->price, 2, '.', ',') }}"
                                class="form-control" name="price" />
                            <div class="icon-input">
                                VNĐ
                            </div>
                        </div>
                    </div>
                    @error('price')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror

                    {{-- User_id input --}}
                    <div class="mb-3 @error('user_id') is-invalid  @enderror">
                        <label for="user_id" class="form-label @error('user_id') text-danger  @enderror">Người tạo</label>
                        <input id="user_id" value="{{ $product->user->name }}" disabled class="form-control"
                            name="user_id" />
                    </div>
                    @error('user_id')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror

                    {{-- Image input --}}
                    <div class="mb-3 @error('image') is-invalid  @enderror">
                        <label for="image" class="form-label @error('image') text-danger  @enderror">Ảnh</label>
                        <input id="image" type="file" class="form-control" name="image">
                        <img class="img-product" src="{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    @error('image')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    {{-- Chọn màu sắc --}}
                    <div class="mb-3 @error('colors') is-invalid @enderror">
                        <label for="colors" class="form-label @error('colors') text-danger @enderror">Màu sắc</label>
                        <select id="colors" name="colors[]" class="form-control" multiple>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ $product->colors->contains('id', $color->id) ? 'selected' : '' }}>
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('colors')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror

                    {{-- Chọn kích thước --}}
                    <div class="mb-3 @error('sizes') is-invalid @enderror">
                        <label for="sizes" class="form-label @error('sizes') text-danger @enderror">Kích thước</label>
                        <select id="sizes" name="sizes[]" class="form-control" multiple>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}"
                                    {{ $product->sizes->contains('id', $size->id) ? 'selected' : '' }}>
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('sizes')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
@endsection
