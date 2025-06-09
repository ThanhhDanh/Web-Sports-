@extends('welcome')

@section('main')
    <h1>My content {!!$name!!}</h1>
    @component('components.modal')
        @slot('title')
            Lỗi!
        @endslot
        Đã có lỗi xảy ra 1
    @endcomponent
@endsection
