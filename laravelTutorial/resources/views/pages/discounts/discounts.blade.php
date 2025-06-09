@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/discounts.css') }}">
@endsection

@section('title', 'Phiếu giảm giá')

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h1>Danh sách phiếu giảm giá</h1>
        <div class="grid mb-5">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="create-discount">
                        <a class="btn-create" data-bs-toggle="offcanvas" href="#formDiscount" role="button"
                            aria-controls="formDiscount">
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
                                    Tên
                                </th>
                                <th scope="col">Giá giảm</th>
                                <th scope="col">Ngày hết hạn</th>
                                <th scope="col">Số lượng phiếu</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @if ($discounts->isNotEmpty())
                                @foreach ($discounts as $discount)
                                    <tr>
                                        <th scope="row">{{ $discount->id }}</th>
                                        <td>{{ $discount->name }}</td>
                                        <td>{{ number_format($discount->price_discount, 0, '.', ',') }} VNĐ</td>
                                        <td>{{ $discount->expirate_time }}</td>
                                        <td>{{ $discount->amount_discount }}</td>
                                        <td>{{ $discount->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center flex-column">
                                                <a href="/discount/detail/{{ $discount->id }}"
                                                    class="btn-process btn btn-detail w-100">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a data-bs-toggle="offcanvas" href="#formDiscountEdit" role="button"
                                                    aria-controls="formDiscountEdit" data-id="{{ $discount->id }}"
                                                    class="btn-process btn btn-info w-100 my-3">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                                <a href="" class="btn-process btn btn-danger w-100"
                                                    data-id="{{ $discount->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#delete-discount-modal">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="7">
                                    <div class="text-center d-flex align-items-center justify-content-center">
                                        @include('components.common.empty', [
                                            'title' => 'There is no discount!',
                                        ])
                                    </div>
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Form create discount --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="formDiscount" aria-labelledby="formDiscountLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="formDiscountLabel">Tạo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                @include('pages.discounts.form-create-discount')
            </div>
        </div>
        {{-- End form create discount --}}


        {{-- Form edit discount --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="formDiscountEdit" aria-labelledby="formDiscountEditLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="formDiscountEditLabel">Cập nhật</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div id="discount-loading" class="text-center my-3 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                @if ($discounts->isNotEmpty())
                    <div id="discount-form-container" class="d-none">@include('pages.discounts.form-edit-discount')</div>
                @endif
            </div>
        </div>
        {{-- End form edit discount --}}

        <!-- Modal confirm delete discount -->
        <div class="modal fade" id="delete-discount-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa phiếu giảm giá này??</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa phiếu giảm giá này??.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button id="btn-delete-discount" type="button" class="btn btn-danger">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal confirm delete discount -->

        <!-- Delete form -->
        <form method="POST" name="delete-form-discount">
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
    <script src="{{ asset('js/discount.js') }}"></script>
@endsection
@endsection
