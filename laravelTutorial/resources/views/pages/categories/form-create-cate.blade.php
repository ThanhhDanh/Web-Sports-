<form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- Name input -->
    <div class="mb-3 @error('name') is-invalid  @enderror">
        <label for="name" class="form-label @error('name') text-danger  @enderror">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    @error('name')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Description input -->
    <div class="mb-3 @error('description') is-invalid  @enderror">
        <label for="description" class="form-label @error('description') text-danger  @enderror">Mô tả</label>
        <textarea rows="5" id="description" class="form-control" name="description"></textarea>
    </div>
    @error('description')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Image input -->
    <div class="mb-3 @error('image') is-invalid  @enderror">
        <label for="image" class="form-label @error('image') text-danger  @enderror">
            Ảnh
        </label>
        <input id="image" type="file" class="form-control" name="image">
    </div>
    @error('image')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-success">Tạo</button>
</form>
