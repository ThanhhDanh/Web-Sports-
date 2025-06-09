@extends('welcome')

@section('title', 'Cập nhật hóa đơn')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/create-invoice.css') }}">
@endsection

@section('content')
    @livewire('invoice-edit-form', ['invoice' => $invoice])
@endsection

@section('extraScript')
    <script src="{{ asset('js/invoice.js') }}"></script>
@endsection
