<div class="container-fluid px-4">
    <div class="row header-event">
        <div class="col-xl-4 col-md-3 col-xs-12">
            <h1 class="name-shop">Danh sách người dùng</h1>
        </div>
        <div class="col-xl-8 col-md-9 col-xs-12 d-flex align-items-center justify-content-end">
            <div class="form-search me-5">
                <div class="d-flex align-items-center form-inline">
                    <input wire:key="search-input" wire:model.live.debounce.300ms="search" class="form-control w-100 "
                        name="name" type="search" placeholder="Tìm kiếm người dùng...." aria-label="Search"
                        required>
                    <button class="btn button-filter" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
            <div class="add-user">
                <a class="d-flex align-items-center justify-content-between" href="/register">
                    <i class="fa-solid fa-plus me-3"></i>
                    <span>Tạo người dùng</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($users as $user)
                @php
                    $roleUser = $user->getRoleNames()->first() === 'user' ? 'Khách hàng' : 'Nhân viên';
                @endphp
                <div class="col-xl-3 col-md-5 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle font-size-16 text-muted"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item p-3 text-primary" href="">
                                            <i class="fa-solid fa-user-pen me-2"></i>
                                            Cập nhật
                                        </a>
                                        <a class="dropdown-item p-3 text-danger delete-item" href="">
                                            <i class="fa-solid fa-user-xmark me-2"></i>
                                            Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $user->getFirstMediaUrl('avatar') }}" class="avatar-lg rounded-circle"
                                        data-type="image" alt="{{ $user->name }}">
                                </div>
                                <h6 class="font-size-15 mt-4 mb-2">
                                    <span class="employee-name">{{ $user->last_name }} {{ $user->name }}</span>
                                </h6>
                                <p class="text-muted mb-0 fw-medium employee-designation">
                                    {{ $roleUser }}
                                </p>
                            </div>

                            <div class="date-join d-flex gap-2 mt-4 justify-content-center">
                                <p class="text-muted fw-medium mb-0">Ngày đăng ký:</p>
                                <span>{{ $user->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="card-footer p-0">
                            <div class="row g-0">
                                <div class="col-6">
                                    <div class="text-center border-end">
                                        <div id="more" class="bg-more more p-4 text-muted employee-info mb-0">
                                            <i class="fa-solid fa-envelope me-2"></i>
                                            Email
                                        </div>
                                    </div>
                                    <div class="tooltip" id="tooltip" role="tooltip">
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <div id="more" class="bg-more more p-4 text-muted employee-info mb-0">
                                            <i class="fa-solid fa-phone me-2"></i>
                                            Điện thoại
                                        </div>
                                    </div>
                                    <div class="tooltip" id="tooltip" role="tooltip">
                                        <span>{{ $user->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
