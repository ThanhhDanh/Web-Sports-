@extends('welcome')

@section('title', 'Trang cá nhân')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
    <div class="container-user container-lg container-sm container-md">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ Auth::user()->getFirstMediaUrl('avatar') }}" alt="{{ Auth::user()->name }}"
                            class="rounded-circle img-fluid" style="height: 150px;">
                        <h5 class="my-3">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-1">{{ $user->getRoleNames()->first() }}</p>
                        <p class="text-muted mb-4">{{ Auth::user()->email }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{ route('profile.edit', $user->id) }}" type="button" data-mdb-button-init
                                data-mdb-ripple-init class="btn w-25 btn-edit">Cập nhật</a>
                            <a type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn w-25 btn-outline-message ms-3">Nhắn tin</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    {{-- <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa-brands fa-html5 text-danger"></i>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa-brands fa-css3-alt text-info"></i>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa-brands fa-react" style="color: #55acee;"></i>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa-brands fa-js text-warning"></i>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa-brands fa-sass" style="color: rgb(250, 76, 134)"></i>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <svg width="25px" height="21px" viewBox="0 0 73 73" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>fundamentals/css/grid</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs> </defs>
                                        <g id="fundamentals/css/grid" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="container" transform="translate(2.000000, 2.000000)" fill-rule="nonzero">
                                                <rect id="mask" stroke="#004FAC" stroke-width="2" fill="#FFFFFF"
                                                    x="-1" y="-1" width="71" height="71" rx="14"> </rect>
                                                <g id="grid" transform="translate(16.000000, 16.000000)">
                                                    <polygon id="Shape" fill="#57A4FF"
                                                        points="14 14 24 14 24 24 14 24">
                                                    </polygon>
                                                    <polygon id="Shape" fill="#57A4FF"
                                                        points="14 1 24 1 24 11 14 11">
                                                    </polygon>
                                                    <polygon id="Shape" fill="#57A4FF"
                                                        points="14 28 24 28 24 38 14 38">
                                                    </polygon>
                                                    <polygon id="Shape" fill="#57A4FF"
                                                        points="1 14 11 14 11 24 1 24">
                                                    </polygon>
                                                    <polygon id="Shape" fill="#57A4FF" points="1 1 11 1 11 11 1 11">
                                                    </polygon>
                                                    <polygon id="Shape" fill="#57A4FF"
                                                        points="1 28 11 28 11 38 1 38">
                                                    </polygon>
                                                    <g id="Group" fill="#004FAC">
                                                        <path
                                                            d="M23.9032258,13.483871 L14.0967742,13.483871 C13.7582771,13.483871 13.483871,13.7582771 13.483871,14.0967742 L13.483871,23.9032258 C13.483871,24.2417229 13.7582771,24.516129 14.0967742,24.516129 L23.9032258,24.516129 C24.2417229,24.516129 24.516129,24.2417229 24.516129,23.9032258 L24.516129,14.0967742 C24.516129,13.7582771 24.2417229,13.483871 23.9032258,13.483871 Z M23.2903226,23.2903226 L14.7096774,23.2903226 L14.7096774,14.7096774 L23.2903226,14.7096774 L23.2903226,23.2903226 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M23.9032258,0 L14.0967742,0 C13.7582771,0 13.483871,0.274406121 13.483871,0.612903226 L13.483871,10.4193548 C13.483871,10.7578519 13.7582771,11.0322581 14.0967742,11.0322581 L23.9032258,11.0322581 C24.2417229,11.0322581 24.516129,10.7578519 24.516129,10.4193548 L24.516129,0.612903226 C24.516129,0.274406121 24.2417229,0 23.9032258,0 Z M23.2903226,9.80645161 L14.7096774,9.80645161 L14.7096774,1.22580645 L23.2903226,1.22580645 L23.2903226,9.80645161 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M23.9032258,26.9677419 L14.0967742,26.9677419 C13.7582771,26.9677419 13.483871,27.2421481 13.483871,27.5806452 L13.483871,37.3870968 C13.483871,37.7255939 13.7582771,38 14.0967742,38 L23.9032258,38 C24.2417229,38 24.516129,37.7255939 24.516129,37.3870968 L24.516129,27.5806452 C24.516129,27.2421481 24.2417229,26.9677419 23.9032258,26.9677419 Z M23.2903226,36.7741935 L14.7096774,36.7741935 L14.7096774,28.1935484 L23.2903226,28.1935484 L23.2903226,36.7741935 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M10.4193548,13.483871 L0.612903226,13.483871 C0.274406121,13.483871 0,13.7582771 0,14.0967742 L0,23.9032258 C0,24.2417229 0.274406121,24.516129 0.612903226,24.516129 L10.4193548,24.516129 C10.7578519,24.516129 11.0322581,24.2417229 11.0322581,23.9032258 L11.0322581,14.0967742 C11.0322581,13.7582771 10.7578519,13.483871 10.4193548,13.483871 Z M9.80645161,23.2903226 L1.22580645,23.2903226 L1.22580645,14.7096774 L9.80645161,14.7096774 L9.80645161,23.2903226 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M10.4193548,0 L0.612903226,0 C0.274406121,0 0,0.274406121 0,0.612903226 L0,10.4193548 C0,10.7578519 0.274406121,11.0322581 0.612903226,11.0322581 L10.4193548,11.0322581 C10.7578519,11.0322581 11.0322581,10.7578519 11.0322581,10.4193548 L11.0322581,0.612903226 C11.0322581,0.274406121 10.7578519,0 10.4193548,0 Z M9.80645161,9.80645161 L1.22580645,9.80645161 L1.22580645,1.22580645 L9.80645161,1.22580645 L9.80645161,9.80645161 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M10.4193548,26.9677419 L0.612903226,26.9677419 C0.274406121,26.9677419 0,27.2421481 0,27.5806452 L0,37.3870968 C0,37.7255939 0.274406121,38 0.612903226,38 L10.4193548,38 C10.7578519,38 11.0322581,37.7255939 11.0322581,37.3870968 L11.0322581,27.5806452 C11.0322581,27.2421481 10.7578519,26.9677419 10.4193548,26.9677419 Z M9.80645161,36.7741935 L1.22580645,36.7741935 L1.22580645,28.1935484 L9.80645161,28.1935484 L9.80645161,36.7741935 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M37.3870968,13.483871 L27.5806452,13.483871 C27.2421481,13.483871 26.9677419,13.7582771 26.9677419,14.0967742 L26.9677419,23.9032258 C26.9677419,24.2417229 27.2421481,24.516129 27.5806452,24.516129 L37.3870968,24.516129 C37.7255939,24.516129 38,24.2417229 38,23.9032258 L38,14.0967742 C38,13.7582771 37.7255939,13.483871 37.3870968,13.483871 Z M36.7741935,23.2903226 L28.1935484,23.2903226 L28.1935484,14.7096774 L36.7741935,14.7096774 L36.7741935,23.2903226 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M37.3870968,0 L27.5806452,0 C27.2421481,0 26.9677419,0.274406121 26.9677419,0.612903226 L26.9677419,10.4193548 C26.9677419,10.7578519 27.2421481,11.0322581 27.5806452,11.0322581 L37.3870968,11.0322581 C37.7255939,11.0322581 38,10.7578519 38,10.4193548 L38,0.612903226 C38,0.274406121 37.7255939,0 37.3870968,0 Z M36.7741935,9.80645161 L28.1935484,9.80645161 L28.1935484,1.22580645 L36.7741935,1.22580645 L36.7741935,9.80645161 Z"
                                                            id="Shape"> </path>
                                                        <path
                                                            d="M37.3870968,26.9677419 L27.5806452,26.9677419 C27.2421481,26.9677419 26.9677419,27.2421481 26.9677419,27.5806452 L26.9677419,37.3870968 C26.9677419,37.7255939 27.2421481,38 27.5806452,38 L37.3870968,38 C37.7255939,38 38,37.7255939 38,37.3870968 L38,27.5806452 C38,27.2421481 37.7255939,26.9677419 37.3870968,26.9677419 Z M36.7741935,36.7741935 L28.1935484,36.7741935 L28.1935484,28.1935484 L36.7741935,28.1935484 L36.7741935,36.7741935 Z"
                                                            id="Shape"> </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info text-dark" style="width: 50%">50%</div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="label mb-0">Tên</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ Auth::user()->last_name }} {{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="label mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!$isEditing)
                    {{-- List user created --}}
                    @include('auth.profile.list-products');
                @else
                    {{-- Edit profile --}}
                    @include('auth.profile.edit-profile');
                @endif
            </div>
        </div>
    </div>
@endsection
