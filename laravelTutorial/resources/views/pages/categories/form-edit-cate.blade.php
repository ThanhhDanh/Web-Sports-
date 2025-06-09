<form method="POST" action="" id="category-edit-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Name input -->
    <div class="mb-3 @error('name-edit') is-invalid @enderror">
        <label for="name" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" id="name" name="name-edit" value="">
    </div>
    @error('name-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}
        </div>
    @enderror

    <!-- Description input -->
    <div class="mb-3 @error('description-edit') is-invalid @enderror">
        <label for="description" class="form-label">Mô tả</label>
        <textarea id="description" class="form-control" name="description-edit" rows="4"></textarea>
    </div>
    @error('description-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror

    <!-- Image input -->
    <div class="mb-3 @error('image-edit') is-invalid @enderror">
        <label for="image" class="form-label">Ảnh</label>
        <input id="image" type="file" class="form-control" name="image-edit">
        <img id="image-preview" class="img-category" src="" alt="" style="display: none;" />
    </div>
    @error('image-edit')
        <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
    @enderror


    <button type="submit" class="btn btn-success">Cập nhật</button>
</form>
