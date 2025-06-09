@extends('welcome')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('title', 'Sản phẩm')

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h1>Danh sách sản phẩm</h1>
        <div class="grid mb-5">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-xs-12">
                    <div class="form-search">
                        <form method="GET" action="{{ route('products.search') }}"
                            class="d-flex align-items-center form-inline">
                            <input class="form-control w-50 me-5" name="name" type="search"
                                placeholder="Tìm kiếm sản phẩm...." aria-label="Search" required>
                            <button class="btn button-filter" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Filter size and color --}}
                <div class="col-xl-6 col-md-6 col-xs-12">
                    <form method="GET" action="{{ route('products.index') }}">
                        <div class="row align-items-center">
                            <div class="col-xl-5 col-md-5 col-xs-12">
                                <div class="form-filter">
                                    <select placeholder="Tìm kiếm theo size..." id="size" name="size"
                                        class="tom-select">
                                        <option value="">Tất cả</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}"
                                                {{ request('size') == $size->id ? 'selected' : '' }}>
                                                {{ $size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-5 col-md-5 col-xs-12">
                                <div class="form-filter">
                                    <select placeholder="Tìm kiếm theo màu..." id="color" name="color"
                                        class="tom-select">
                                        <option value="">Tất cả</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}"
                                                {{ request('color') == $color->id ? 'selected' : '' }}>
                                                {{ $color->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-2 col-xs-12">
                                <button type="submit" class="btn button-filter ms-3">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @yield('search')

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <x-common.sort column="id" :sortColumn="request('column')" :sortDirection="request('sort')">
                                        ID
                                    </x-common.sort>
                                </th>
                                <th scope="col">
                                    <x-common.sort column="name" :sortColumn="request('column')" :sortDirection="request('sort')">
                                        Tên sản phẩm
                                    </x-common.sort>
                                </th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Giá sản phẩm</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $product->id }}</th>
                                        <td style="width: 300px">{{ $product->name }}</td>
                                        <td>
                                            <img class="img-product" src="{{ $product->image }}"
                                                alt="{{ $product->name }}">
                                        </td>
                                        <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ $product->user->name }}</td>
                                        <td>{{ $product->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <a href="/product/detail/{{ $product->id }}"
                                                class="btn btn-primary btn-detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="6">
                                    <div class="text-center d-flex align-items-center justify-content-center">
                                        @include('components.common.empty', [
                                            'title' => 'Chưa có sản phẩm nào!',
                                        ])
                                        <a class="link-product" href="/products/create">Tạo sản phẩm!!</a>
                                    </div>
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Phân trang -->
        <div class="paginate d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('extraScript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll(".tom-select").forEach(function(el) {
                new TomSelect(el, {
                    allowEmptyOption: false,
                    create: false,
                    plugins: ['virtual_scroll'],
                    valueField: "value",
                    labelField: "text",
                    searchField: "text",
                    maxOptions: 50,
                    preload: false, // no data now when search is loaded
                    firstUrl: function() {
                        return;
                    },
                    load: function(query, callback) {
                        fetch()
                            .then(response => response.json())
                            .then(data => callback(data))
                            .catch(() => callback([]));
                    }
                });
            });
        });
    </script>
@endsection
