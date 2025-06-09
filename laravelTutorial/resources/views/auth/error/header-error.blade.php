<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-sm container-lg container-md">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('storage/logo.webp') }}" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" aria-current="page"
                    href="/">Home</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-link" aria-current="page" href="/login">Đăng nhập</a>
                <a class="nav-link" aria-current="page" href="/register">Đăng ký</a>
            </div>
        </div>
</nav>
