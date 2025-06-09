@extends('welcome')

@section('title', 'Chi tiết sự kiện')

@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('css/detail-event.css') }}">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="header-event row">
            <div class="col-xl-4 col-md-4 col-xs-12">
                <h1 class="name-shop">Chi tiết sự kiện</h1>
            </div>
            <div class="col-xl-4 col-md-4 col-xs-12">
                <div class="action-event">
                    <a href="{{ route('events.edit', $event['id']) }}">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <a href="">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-8 col-xs-12">
                <div class="container bg-container">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-xs-12">
                            <img class="image-event" src="{{ $event['image'] }}" alt="">
                        </div>
                        <div class="col-xl-8 col-md-8 col-xs-12 ps-5">
                            <span class="name-event">{{ $event['name'] }}</span>
                            <button type="button" class="btn-video" data-bs-toggle="modal" data-bs-target="#videoModal"
                                data-video-url="{{ $event->video_url }}">
                                <i class="fa-solid fa-play me-3"></i>
                                Xem Video
                            </button>
                        </div>
                    </div>
                    <span class="description-event">{!! nl2br(e($event['description'])) !!}</span>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-xs-12">
                <div class="d-flex justify-content-center align-items-center flex-column gap-5">
                    <div class="container bg-container info-event">
                        <span>
                            <i class="fa-solid fa-calendar-days"></i>
                            <strong>Ngày đăng:</strong>
                            {{ \Carbon\Carbon::parse($event['post_date'])->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                        </span>
                        <span>
                            <i class="fa-solid fa-user"></i>
                            <strong>Tác giả:</strong> {{ $event['author'] }}
                        </span>
                    </div>
                    <div class="container bg-container">
                        <span class="diff-event-label">
                            Các sự kiện khác
                        </span>
                        <div class="diff-events">
                            @foreach ($otherEvents as $other)
                                <a href="{{ route('events.showDetail', $other['id']) }}">
                                    <div class="diff-event">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img src="{{ $other['image'] }}" alt="{{ $other['name'] }}">
                                            <div class="diff-event-info">
                                                <span>{{ $other['name'] }}</span>
                                                <span>
                                                    {{ \Carbon\Carbon::parse($other['post_date'])->format('d/m/Y') }}
                                                    ({{ \Carbon\Carbon::parse($other['post_date'], 'Asia/Ho_Chi_Minh')->locale('vi')->timezone('Asia/Ho_Chi_Minh')->diffForHumans() }})
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Video sự kiện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoFrame" src="" title="YouTube video" frameborder='0'
                            allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                            referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extraScript')
    <script src="{{ asset('js/event.js') }}"></script>
@endsection
