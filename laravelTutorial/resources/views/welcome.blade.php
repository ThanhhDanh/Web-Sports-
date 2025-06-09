<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ View::hasSection('title') ? View::yieldContent('title') : 'Dashboard' }}</title>

    <link rel="shortcut icon" href="{{ asset('images/icon-sport.webp') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- global style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- CSS Dashboard --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Tailwind -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Tom select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

    @yield('extraStyle')
    @livewireStyles


</head>

<body>
    <div class="main sb-nav-fixed" id="app">
        <!-- Dashboard -->
        @if (Auth::check() && Auth::user()->hasRole('admin'))
            @include('layouts.header')
            <div id="layoutSidenav">
                @include('layouts.left-sidebar')
                <div id="layoutSidenav_content">
                    @yield('content')
                    {{-- Nếu có section('content') thì thể hiện không thì thôi --}}
                    @if (!View::hasSection('content'))
                        @livewire('dashboard-content')
                    @endif
                </div>
            </div>
        @else
            @include('auth.error.header-error')
            @yield('error')
        @endif

        <!-- Check Route is / -->
        {{-- @if (Request::is('/'))
            <Welcome />
        @endif --}}
    </div>
    <div id="toast"></div>
    @livewireScripts
    @yield('extraScript')
    <script src="{{ mix('js/app.js') }}" defer></script>
    {{-- Tom select --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showSuccessToast("{{ session('success') }}");
            @endif

            @if (session('error'))
                showErrorToast("{{ session('error') }}");
            @endif

            // Xóa flash message khỏi history để khi F5 không hiện lại
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                        'sb-sidenav-toggled'));
                });
            }
        });
    </script>
</body>

</html>
