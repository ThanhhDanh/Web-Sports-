@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endsection

@section('title', 'Danh mục')

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h1>Danh mục</h1>
        <div class="grid mb-5">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="create-category">
                        <a class="btn-create" data-bs-toggle="offcanvas" href="#formCategory" role="button"
                            aria-controls="formCategory">
                            <i class="fa-solid fa-plus"></i>
                            &nbsp;
                            Tạo
                        </a>
                    </div>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <x-common.sort column="id" :sortColumn="request('column')" :sortDirection="request('sort')">
                                        ID
                                    </x-common.sort>
                                </th>
                                <th scope="col">
                                    Tên danh mục
                                </th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <img class="img-category" src="{{ $category->image }}"
                                                alt="{{ $category->name }}">
                                        </td>
                                        <td class="description"><span
                                                class="description-more">{{ $category->description }}</span></td>
                                        <td>{{ $category->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center flex-column">
                                                <a href="/category/detail/{{ $category->id }}"
                                                    class="btn-process btn btn-detail w-100">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a data-bs-toggle="offcanvas" href="#formCategoryEdit" role="button"
                                                    data-id="{{ $category->id }}" aria-controls="formCategoryEdit"
                                                    class="btn-process btn btn-info w-100 my-3">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                                <a href="" class="btn-process btn btn-danger w-100"
                                                    data-id="{{ $category->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#delete-category-modal">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="5">
                                    <div class="text-center d-flex align-items-center justify-content-center">
                                        @include('components.common.empty', [
                                            'title' => 'There is no category!',
                                        ])
                                    </div>
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Form create category --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="formCategory" aria-labelledby="formCategoryLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="formCategoryLabel">Tạo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                @include('pages.categories.form-create-cate')
            </div>
        </div>
        {{-- End form create category --}}


        {{-- Form edit category --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="formCategoryEdit" aria-labelledby="formCategoryEditLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="formCategoryEditLabel">Cập nhật</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div id="category-loading" class="text-center my-3 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                @if ($categories->isNotEmpty())
                    <div id="category-form-container" class="d-none">@include('pages.categories.form-edit-cate')</div>
                @endif
            </div>
        </div>
        {{-- End form edit category --}}

        <!-- Modal confirm delete category -->
        <div class="modal fade" id="delete-category-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa sản phầm này??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa sản phẩm này không??.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button id="btn-delete-category" type="button" class="btn btn-danger">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal confirm delete category -->

        <!-- Delete form -->
        <form method="POST" name="delete-form-category">
            @csrf
            @method('DELETE')
        </form>
        <!-- End delete form -->


        <!-- Phân trang -->
        {{-- <div class="paginate d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div> --}}
    </div>
@section('extraScript')
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
@endsection
