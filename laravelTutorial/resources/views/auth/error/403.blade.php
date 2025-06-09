@extends('welcome')

@section('title', '403')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
@endsection

@section('error')
    <section class="ezy__httpcodes6 gray">
        <!-- top left svg-->
        <svg class="position-absolute bottom-0 start-0" width="850" height="621" viewBox="0 0 850 621" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M557.671 394.507C642.476 480.048 827.513 471.973 850 621H-4C-4 484.826 -2.00116 182.951 -2.00116 58.5887C255.348 -80.3641 481.216 58.5887 481.216 158.287C481.216 270.839 481.216 317.388 557.671 394.507Z"
                fill="currentColor" />
        </svg>
        <!-- character svg -->
        <img class="position-absolute bottom-0 start-0 d-none d-md-block w-0"
            src="https://cdn.easyfrontend.com/pictures/httpcodes/six-character.svg" alt="" />

        <!-- container -->
        <div class="container">
            <div class="row justify-content-end align-items-center">
                <div class="col-12 col-lg-6 col-xl-5 text-center text-lg-start">
                    <h2 class="ezy__httpcodes6-heading mb-4">404</h2>
                    <p class="ezy__httpcodes6-sub-heading">Page not Available!</p>
                </div>
            </div>
        </div>
    </section>
@endsection
