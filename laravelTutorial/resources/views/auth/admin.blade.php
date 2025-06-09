<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Global -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- CSS login -->
    @yield('extraLoginCss')

    <!-- CSS register -->
    @yield('extraRegisterCss')

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app" class="container-form container-lg container-md container-sm">
        @yield('content')
    </div>
    <div id="toast"></div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('extraLoginJS')
    @yield('extraRegisterJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showSuccessToast("{{ session('success') }}");
            @endif

            @if (session('error'))
                showErrorToast("{{ session('error') }}");
            @endif
        });
    </script>
</body>

</html>
