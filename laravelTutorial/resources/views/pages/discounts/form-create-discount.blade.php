<form method="POST" action="{{ route('discounts.store') }}">
    @csrf

    <!-- Name input -->
    <div class="mb-3 @error('name') is-invalid  @enderror">
        <label for="name" class="form-label @error('name') text-danger  @enderror">Tên phiếu</label>
        <input placeholder="Tên phiếu..." type="text" class="form-control" id="name" name="name">
    </div>
    @error('name')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Price_discount input -->
    <div class="mb-3 @error('price_discount') is-invalid  @enderror">
        <label for="price_discount" class="form-label @error('price_discount') text-danger  @enderror">Giá giảm</label>
        <input placeholder="Giá giảm..." id="price_discount" class="form-control" name="price_discount"></input>
    </div>
    @error('price_discount')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Expirate_time input -->
    <div class="mb-3 @error('expirate_time') is-invalid  @enderror">
        <label for="expirate_time" class="form-label @error('expirate_time') text-danger  @enderror">Ngày hết
            hạn</label>
        <input placeholder="Ngày hết hạn..." id="expirate_time" type="date" class="form-control"
            name="expirate_time"></input>
    </div>
    @error('expirate_time')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Amount_discount input -->
    <div class="mb-3 @error('amount_discount') is-invalid  @enderror">
        <label for="amount_discount" class="form-label @error('amount_discount') text-danger  @enderror">
            Số lượng phiếu
        </label>
        <input placeholder="Số lượng phiếu..." id="amount_discount" type="number" class="form-control"
            name="amount_discount"></input>
    </div>
    @error('amount_discount')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-success">Tạo</button>
</form>
