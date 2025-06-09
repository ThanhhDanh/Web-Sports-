<form method="POST" action="" id="discount-edit-form">
    @csrf
    @method('PUT')

    <!-- Name input -->
    <div class="mb-3 @error('name-edit') is-invalid  @enderror">
        <label for="name" class="form-label @error('name-edit') text-danger  @enderror">Tên phiếu</label>
        <input value="" placeholder="Tên phiếu..." type="text" class="form-control" id="name"
            name="name-edit">
    </div>
    @error('name-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Price_discount input -->
    <div class="mb-3 @error('price_discount-edit') is-invalid  @enderror">
        <label for="price_discount" class="form-label @error('price_discount-edit') text-danger  @enderror">Giá
            giảm</label>
        <input type="text" value="" placeholder="Giá giảm..." id="price_discount" class="form-control"
            name="price_discount-edit"></input>
    </div>
    @error('price_discount-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Expirate_time input -->
    <div class="mb-3 @error('expirate_time-edit') is-invalid  @enderror">
        <label for="expirate_time" class="form-label @error('expirate_time-edit') text-danger  @enderror">Ngày hết
            hạn</label>
        <input value="" placeholder="Ngày hết hạn..." id="expirate_time" type="date" class="form-control"
            name="expirate_time-edit"></input>
    </div>
    @error('expirate_time-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Amount_discount input -->
    <div class="mb-3 @error('amount_discount-edit') is-invalid  @enderror">
        <label for="amount_discount" class="form-label @error('amount_discount-edit') text-danger  @enderror">
            Số lượng phiếu
        </label>
        <input value="" placeholder="Số lượng phiếu..." id="amount_discount" type="number" class="form-control"
            name="amount_discount-edit"></input>
    </div>
    @error('amount_discount-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror


    <button type="submit" class="btn btn-success">Cập nhật</button>
</form>
