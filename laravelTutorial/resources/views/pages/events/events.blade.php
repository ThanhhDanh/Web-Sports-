@extends('welcome')

@section('title', 'Sự kiện')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
@endsection

@section('content')
    @livewire('events')
@endsection
