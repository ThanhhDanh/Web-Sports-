@extends('auth.admin')

@section('extraLoginCss')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title', 'Đăng nhập')

@section('content')
    <div class="container-form">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right bg-body-tertiary" style="backdrop-filter: blur(30px);">
                    <div class="card-body shadow-5 text-center">
                        <h2 class="fw-bold mb-5">Đăng nhập</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div data-mdb-input-init class="form-outline mb-4 @error('email')is-invalid  @enderror">
                                <input name="email" type="email" id="email" class="form-control" />
                                <label class="form-label @error('email')text-danger @enderror" for="email">Email</label>
                            </div>

                            <!-- Password input -->
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div data-mdb-input-init class="form-outline mb-4 @error('password')is-invalid  @enderror">
                                <input name="password" type="password" id="password" class="form-control" />
                                <label class="form-label @error('password')text-danger @enderror" for="password">Mật
                                    khẩu</label>
                                <i id="eye-see" class="eye eye-see fa-solid fa-eye"></i>
                                <i id="eye-blind" class="eye eye-blind fa-solid fa-eye-slash"></i>
                            </div>

                            @error('failed')
                                <div class="text-danger mb-4">{{ $message }}</div>
                            @enderror

                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="remember"
                                            id="remember" />
                                        <label class="form-check-label" for="remember"> Ghi nhớ tôi </label>
                                    </div>
                                </div>

                                <div class="col d-flex justify-content-center">
                                    <!-- Simple link -->
                                    <a href="#!">Quên mật khẩu?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn-login btn btn-primary btn-block mb-4">Đăng nhập</button>

                            <!-- Register buttons -->
                            <div class="login-more text-center">
                                {{-- <p>Không phải là thành viên? <a class="link-register" href="/register">Đăng ký</a></p>
                                <p>hoặc đăng nhập:</p> --}}
                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>

                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="{{ asset('storage/bg-login.jpeg') }}" style="width: 95%" class="rounded-4 shadow-4"
                    alt="" />
            </div>
        </div>
    </div>

@section('extraLoginJS')
    <script src="{{ mix('js/login.js') }}"></script>
@endsection

@endsection
