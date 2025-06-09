@extends('welcome')

@section('title', 'Đánh giá')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
@endsection

@section('content')
    @livewire('comments')
@endsection

@section('extraScript')
    <script src="{{ asset('js/comment.js') }}"></script>
@endsection
