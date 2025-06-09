@extends('pages/products')

@section('search')
    @if ($products->isNotEmpty())
        @foreach ($products as $product)
            <div class="col col-sm-12 col-md-3 col-lg-3">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top img-product" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="#" class="btn btn-primary btn-detail">Details</a>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                {{ $products - links('pagination::bootstrap-5') }}
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" role="alert">
            No results found!
        </div>
    @endif
@endsection
