<div class="card card-product">
    @foreach ($products as $product)
        <div class="row item-roadmap">
            <div class="col-sm-12 col-md-2 col-lg-2">
                {{ $product->id }}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                {{ $product->name }}
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">
                {{ $product->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
            </div>
        </div>
    @endforeach
</div>
