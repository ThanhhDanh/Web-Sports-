@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/detail-category.css') }}">
@endsection

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <div class="grid wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 item-category">
                    <img class="img-category" src="{{ $category->image }}" alt="{{ $category->name }}">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 item-category">
                    <ul class="content ms-5 mb-5">
                        <li class="content-name">{{ $category->name }}</li>
                        <li class="content-description">{{ $category->description }}</li>
                    </ul>
                </div>
            </div>
            {{-- Roadmap --}}
            <div class="wrapper-roadmap">
                <span>Danh sách sản phẩm</span>
                @foreach ($products as $product)
                    <div class="row item-roadmap">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <img class="img-roadmap" src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2 content-roadmap">{{ $product->name }}</div>
                        <div class="col-sm-12 col-md-5 col-lg-5 content-roadmap">{{ $product->description }}</div>
                        <div class="col-sm-12 col-md-2 col-lg-2 content-roadmap">
                            {{ $product->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</div>
                        <div class="col-sm-12 col-md-1 col-lg-1 content-roadmap">
                            <a class="btn-roadmap-detail" href="/product/detail/{{ $product->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
