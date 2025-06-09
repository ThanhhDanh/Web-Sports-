<div class="w-100 h-100 mb-4 p-3">
    {{-- PHẦN HIỂN THỊ COMMENT CỦA KHÁCH --}}
    <div class="header-cmt">
        <div class="product-cmt d-flex align-items-center mr-3">
            <img src="{{ $comment->product->image }}" alt="{{ $comment->product->name }}" width="50" height="50"
                class="mr-2">
            <span class="font-weight-bold">{{ $comment->product->name }}</span>
        </div>
        <div class="star-rating">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $comment->rate_level)
                    <i class="fa-solid fa-star text-warning"></i>
                @else
                    <i class="fa-regular fa-star text-muted"></i>
                @endif
            @endfor
        </div>
    </div>

    <div class="comment">
        <div class="content-cmt d-flex">
            <img src="{{ $comment->user->getFirstMediaUrl('avatar') }}" alt="{{ $comment->user->name }}" width="50"
                height="50" class="rounded-circle mr-3">
            <div class="cmt">
                <div class="comment-user">
                    <span class="name-user">{{ $comment->user->name }}:</span>
                    <span class="content-user">{{ $comment->description }}</span>
                </div>
            </div>
        </div>
        <span class="date-cmt">
            {{ \Carbon\Carbon::parse($comment->created_at)->locale('vi')->timezone('Asia/Ho_Chi_Minh')->diffForHumans() }}
        </span>
    </div>

    {{-- PHẦN HIỂN THỊ PHẢN HỒI NẾU CÓ --}}
    @if ($comment->replies->count())
        @foreach ($comment->replies as $reply)
            <div class="reply">
                <div
                    class="reply-cmt d-flex align-items-center justify-content-start flex-row-reverse mt-2 border-left pl-3">
                    <img src="{{ $reply->user->getFirstMediaUrl('avatar') }}" alt="{{ $reply->user->name }}">
                    <div class="reply-content">
                        <div class="comment-user">
                            <span class="name-user">:{{ $reply->user->name }}</span>
                            <span class="content-user">{{ $reply->description }}</span>
                        </div>
                    </div>
                </div>
                <span class="date-cmt">
                    {{ \Carbon\Carbon::parse($reply->created_at)->locale('vi')->timezone('Asia/Ho_Chi_Minh')->diffForHumans() }}
                </span>
            </div>
        @endforeach
    @else
        {{-- FORM PHẢN HỒI CHỈ HIỆN KHI CHƯA CÓ REPLY --}}
        <form method="POST" action="{{ route('comments.reply', $comment->id) }}" class="mt-3">
            @csrf
            <div class="form-floating">
                <textarea name="reply" placeholder="Leave a comment here" class="form-control"></textarea>
                <label for="reply">Phản hồi</label>
            </div>
            <button type="submit" class="btn mt-4">Gửi phản hồi</button>
        </form>
    @endif
</div>
