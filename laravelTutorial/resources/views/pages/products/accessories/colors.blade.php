@extends('pages.products.accessories.accessories')

@section('accessory-content')
    <div class="container-custom" data-accessory-type="color">
        <form class="form-create" action="{{ route('accessories.storeColor') }}" method="POST">
            @csrf
            <div class="mb-3 @error('name') is-invalid  @enderror">
                <label for="name" class="form-label @error('name') text-danger  @enderror">Màu sắc</label>
                <div class="form-input">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nhập màu sắc...">
                    <div class="icon-input">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                </div>
            </div>
            @error('name')
                <div class="text-danger text-error">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn-create">Tạo màu sắc</button>
        </form>

        <div class="list-accessories mt-5 pt-5">
            <table class="table table-borderless text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 100px">Tên màu</th>
                        <th style="width: 500px">Ngày tạo</th>
                        <th>###</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($colors->isNotEmpty())
                        @foreach ($colors as $color)
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>
                                    <span class="color-name" id="name-{{ $color->id }}">{{ $color->name }}</span>
                                    <input class="form-control" type="text" id="input-name-{{ $color->id }}"
                                        value="{{ $color->name }}" style="display: none;">
                                </td>
                                <td>{{ $color->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                                <td>
                                    <!-- Button edit -->
                                    <button type="button" class="btn-edit-accessory" data-id="{{ $color->id }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <!-- Button confirm -->
                                    <button type="button" class="btn-confirm-edit-accessory" data-id="{{ $color->id }}"
                                        style="display: none;">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="4">
                            <div class="text-center d-flex align-items-center justify-content-center">
                                @include('components.common.empty', [
                                    'title' => 'Chưa có màu sắc nào!',
                                ])
                            </div>
                        </td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('extraScript')
    <script src="{{ asset('js/accessories.js') }}"></script>
@endsection
