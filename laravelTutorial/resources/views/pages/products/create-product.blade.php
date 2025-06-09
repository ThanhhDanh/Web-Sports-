@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/create-product.css') }}">
@endsection

@section('title', 'Tạo sản phẩm')

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h2 class="text-center mb-3">Tạo sản phẩm</h2>
        <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name input -->
            <div class="mb-3 @error('name') is-invalid  @enderror">
                <label for="name" class="form-label @error('name') text-danger  @enderror">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            @error('name')
                <div class="text-danger text-error">{{ $message }}</div>
            @enderror

            <!-- Description input -->
            <div class="mb-3 @error('description') is-invalid  @enderror">
                <label for="description" class="form-label @error('description') text-danger  @enderror">Mô tả</label>
                <textarea rows="5" id="description" class="form-control" name="description"></textarea>
            </div>
            @error('description')
                <div class="text-danger text-error">{{ $message }}</div>
            @enderror

            <!-- Image input -->
            <div class="mb-3 @error('image') is-invalid  @enderror">
                <label for="image" class="form-label @error('image') text-danger  @enderror">Ảnh</label>
                <input id="image" type="file" class="form-control" name="image">
            </div>
            @error('image')
                <div class="text-danger text-error">{{ $message }}</div>
            @enderror
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    <!-- Price input -->
                    <div class="mb-3 @error('price') is-invalid  @enderror">
                        <label for="price" class="form-label @error('price') text-danger  @enderror">Giá</label>
                        <div class="form-input">
                            <input id="price" type="text" class="form-control" name="price">
                            <div class="icon-input">
                                VNĐ
                            </div>
                        </div>
                    </div>
                    @error('price')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror

                    <!-- Category_id input -->
                    <div class="mb-3 @error('category_id') is-invalid  @enderror">
                        <label for="category_id" class="form-label @error('category_id') text-danger  @enderror">Loại sản
                            phẩm</label>
                        <select class="form-select" name="category_id">
                            <option value="-- Create --">-- Loại sản phẩm --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror

                    <!-- User_id input -->
                    <div class="mb-3 @error('user_id') is-invalid  @enderror">
                        <label for="user_id" class="form-label @error('user_id') text-danger  @enderror">Người tạo</label>
                        <select class="form-select" name="user_id">
                            <option value="-- Create --">-- Người tạo --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    @error('user_id')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    {{-- Màu sắc select --}}
                    <div class="mb-3 @error('colors') is-invalid @enderror">
                        <label for="colors" class="form-label @error('colors') text-danger @enderror">Màu sắc</label>
                        <select id="colors" name="colors[]" class="form-control" multiple>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('colors')
                        <div class="text-danger text-error">{{ $message }}</div>
                    @enderror

                    {{-- Size select --}}
                    <div class="mb-3 @error('sizes') is-invalid @enderror">
                        <label for="sizes" class="form-label @error('sizes') text-danger @enderror">Kích thước</label>
                        <select id="sizes" name="sizes[]" class="form-control" multiple>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">
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

            <button type="submit" class="btn btn-success">Tạo sản phẩm</button>
        </form>
    </div>
@endsection
