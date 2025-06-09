@extends('welcome')

@section('title', 'Quản lý người dùng')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/management-users.css') }}">
@endsection

@section('content')
    @livewire('user-management')
@endsection


@section('extraScript')
    <script src="{{ asset('js/management-user.js') }}"></script>
@endsection
