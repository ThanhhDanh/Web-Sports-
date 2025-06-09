@extends('auth.admin')

@section('extraRegisterCss')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('title', 'Thêm thành viên')

@section('content')
    <section class="wrapper">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container container-form h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Đăng ký</h2>

                                <form action="{{ route('register.create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Avatar input -->
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init
                                        class="form-outline mb-4  @error('avatar')is-invalid  @enderror">
                                        <input name="avatar" type="file" id="avatar"
                                            class="form-control form-control-lg" />
                                        <label class="form-label @error('avatar')text-danger @enderror" for="avatar">Ảnh
                                            nền</label>
                                    </div>

                                    <!-- last_name input -->
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init
                                        class="form-outline mb-4  @error('last_name')is-invalid  @enderror">
                                        <input name="last_name" type="text" id="last_name"
                                            class="form-control form-control-lg" />
                                        <label class="form-label @error('last_name')text-danger @enderror"
                                            for="last_name">Họ và tên lót</label>
                                    </div>

                                    <!-- Name input -->
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init class="form-outline mb-4  @error('name')is-invalid  @enderror">
                                        <input name="name" type="text" id="name"
                                            class="form-control form-control-lg" />
                                        <label class="form-label @error('name')text-danger @enderror"
                                            for="name">Tên</label>
                                    </div>

                                    <!-- Email input -->
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init
                                        class="form-outline mb-4  @error('email')is-invalid  @enderror">
                                        <div class="form-input">
                                            <input name="email" type="email" id="email"
                                                class="form-control form-control-lg" onchange="window.verifyEmail(this)" />
                                            <div id="success" class="icon-input">
                                                <i class="text-success fa-solid fa-circle-check"></i>
                                            </div>
                                            <div id="error" class="icon-input">
                                                <i class="text-danger fa-solid fa-circle-exclamation"></i>
                                            </div>
                                        </div>
                                        <label class="form-label @error('email')text-danger @enderror"
                                            for="email">Email</label>
                                    </div>

                                    <!-- Phone input -->
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init
                                        class="form-outline mb-4  @error('phone')is-invalid  @enderror">
                                        <input name="phone" type="text" id="phone"
                                            class="form-control form-control-lg" />
                                        <label class="form-label @error('phone')text-danger @enderror"
                                            for="phone">SĐT</label>
                                    </div>

                                    <!-- Password input -->
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init
                                        class="form-outline mb-4  @error('password')is-invalid  @enderror">
                                        <input name="password" type="password" id="password"
                                            class="form-control form-control-lg" />
                                        <label class="form-label @error('password')text-danger @enderror"
                                            for="password">Mật
                                            khẩu</label>
                                        <i id="eye-see" class="eye eye-see fa-solid fa-eye"></i>
                                        <i id="eye-blind" class="eye eye-blind fa-solid fa-eye-slash"></i>
                                    </div>

                                    <!-- Password Confirmation input -->
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div data-mdb-input-init
                                        class="form-outline mb-4  @error('password_confirmation')is-invalid  @enderror">
                                        <input name="password_confirmation" type="password" id="password_confirmation"
                                            class="form-control form-control-lg" />
                                        <label class="form-label @error('password')text-danger @enderror"
                                            for="password_confirmation">Xác nhận lại mật khẩu</label>
                                        <i id="eye-see-confirm" class="eye eye-see fa-solid fa-eye"></i>
                                        <i id="eye-blind-confirm" class="eye eye-blind fa-solid fa-eye-slash"></i>
                                    </div>

                                    {{-- <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="form2Example3cg" />
                                        <label class="form-check-label" for="form2Example3g">
                                            Tôi đồng ý tất cả các tuyên bố trong <a href="#!" class="text-body"><u>Điều
                                                    khoản dịch vụ</u></a>
                                        </label>
                                    </div> --}}

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn-register btn btn-success btn-block btn-lg gradient-custom-4">Đăng
                                            ký</button>
                                    </div>

                                    {{-- <p class="text-center text-muted mt-5 mb-0">Bạn đã có tài khoản? <a href="/login"
                                            class="fw-bold text-login"><u>Đăng nhập ở đây</u></a></p> --}}

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('extraRegisterJS')
    <script src="{{ asset('js/register.js') }}"></script>
@endsection

@endsection
