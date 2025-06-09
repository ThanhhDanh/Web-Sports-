@extends('welcome')

@section('title', 'Tạo sự kiện')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/create-event.css') }}">
@endsection

@section('content')
    <div class="container-form container-lg container-md container-sm mt-5">
        <h2 class="text-center mb-3">Thêm sự kiện</h2>
        <form class="form" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name input -->
            <div class="mb-5 @error('name') is-invalid  @enderror">
                <div class="row">
                    <div class="col-xl-2 col-sm-2 col-xs-12">
                        <label for="name" class="form-label @error('name') text-danger  @enderror">Tên sản phẩm</label>
                    </div>
                    <div class="col-xl-10 col-sm-10 col-xs-12">
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                            <div class="text-danger text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description input -->
            <div class="mb-5 @error('description') is-invalid  @enderror">
                <div class="row">
                    <div class="col-xl-2 col-sm-2 col-xs-12">
                        <label for="description" class="form-label @error('description') text-danger  @enderror">Mô
                            tả</label>
                    </div>
                    <div class="col-xl-10 col-sm-10 col-xs-12">
                        <textarea rows="5" id="description" class="form-control" name="description"></textarea>
                        @error('description')
                            <div class="text-danger text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Video_id input -->
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    <div class="mb-5 @error('video_id') is-invalid  @enderror">
                        <div class="row">
                            <div class="col-xl-2 col-sm-2 col-xs-12">
                                <label for="video_id" class="form-label @error('video_id') text-danger  @enderror">
                                    Mã video
                                </label>
                            </div>
                            <div class="col-xl-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="video_id" name="video_id">
                                @error('video_id')
                                    <div class="text-danger text-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post_date input -->
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    <div class="mb-5 @error('post_date') is-invalid  @enderror">
                        <div class="row">
                            <div class="col-xl-3 col-sm-3 col-xs-12">
                                <label for="post_date" class="form-label @error('post_date') text-danger  @enderror">
                                    Ngày đăng
                                </label>
                            </div>
                            <div class="col-xl-9 col-sm-9 col-xs-12">
                                <input type="date" class="form-control" id="post_date" name="post_date">
                                @error('post_date')
                                    <div class="text-danger text-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Author input -->
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    <div class="mb-5 @error('author') is-invalid  @enderror">
                        <div class="row">
                            <div class="col-xl-2 col-sm-2 col-xs-12">
                                <label for="author" class="form-label @error('author') text-danger  @enderror">
                                    Tác giả
                                </label>
                            </div>
                            <div class="col-xl-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="author" name="author">
                                @error('author')
                                    <div class="text-danger text-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image input -->
                <div class="col-xl-6 col-sm-6 col-xs-12">
                    <div class="mb-5 @error('image') is-invalid  @enderror">
                        <div class="row">
                            <div class="col-xl-3 col-sm-3 col-xs-12">
                                <label for="image" class="form-label @error('image') text-danger  @enderror">Ảnh</label>
                            </div>
                            <div class="col-xl-9 col-sm-9 col-xs-12">
                                <input id="image" type="file" class="form-control" name="image">
                                @error('image')
                                    <div class="text-danger text-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Thêm sự kiện</button>
        </form>
    </div>
@endsection
