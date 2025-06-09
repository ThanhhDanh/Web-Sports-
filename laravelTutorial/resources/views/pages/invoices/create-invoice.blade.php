@extends('welcome')

@section('title', 'Tạo hóa đơn')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/create-invoice.css') }}">
@endsection

@section('content')
    @livewire('invoice-form')
@endsection

@section('extraScript')
    <script src="{{ asset('js/invoice.js') }}"></script>
@endsection
