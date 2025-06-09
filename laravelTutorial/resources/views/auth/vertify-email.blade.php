{{-- Nhớ chạy ở git bash 
mailpit -s 127.0.0.1:1025 -l 127.0.0.1:8025 & --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<p>Please verify your email by clicking the link sent to your email.</p>
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Resend Verification Email</button>
</form>
