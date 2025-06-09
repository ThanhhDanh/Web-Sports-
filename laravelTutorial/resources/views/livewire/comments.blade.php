<div class="container-fluid px-4">
    <div class="row header-event">
        <div class="col-xl-4 col-md-3 col-xs-12">
            <h1 class="name-shop">Đánh giá</h1>
        </div>
        <div class="col-xl-8 col-md-9 col-xs-12 d-flex justify-content-end">
            <div class="form-search me-5">
                <select name="rateLevel" wire:model="rateLevel" wire:change="$refresh" class="form-control text-center">
                    <option value="">-- Tất cả --</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ request('rateLevel') == $i ? 'selected' : '' }}>
                            {{ $i }} ⭐
                        </option>
                    @endfor
                </select>
            </div>
            <div class="add-comment">
                <a class="d-flex align-items-center justify-content-between" type="button" data-bs-toggle="modal"
                    data-bs-target="#createComment">
                    <i class="fa-solid fa-plus me-3"></i>
                    <span>Tạo đánh giá</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container bg-container">
        <div class="row align-items-end">
            <div class="col-xl-7 col-md-6 col-xs-12">
                <div class="container-table mt-5">
                    <div class="paginate">
                        {{ $comments->links('pagination::bootstrap-5') }}
                    </div>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Mức độ đánh giá</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">Người dùng</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">###</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->rate_level }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($comment->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y') }}
                                    </td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->product_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div id="more" class="bg-more more px-3">
                                                <i class="fa-solid fa-eye"></i>
                                            </div>
                                            <a class="px-3 view-comment" data-comment-id="{{ $comment->id }}"
                                                href="javascript:void(0)">
                                                <i class="fa-brands fa-rocketchat"></i>
                                            </a>
                                            <a class="px-3" href="">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </div>

                                        <div id="tooltip-{{ $comment->id }}" class="tooltip" role="tooltip">
                                            <span class="name-comment">
                                                {{ $comment->user->last_name }}
                                                {{ $comment->user->name }}
                                            </span>
                                            <span class="product-comment">{{ $comment->product->name }}</span>
                                            <hr width="100%">
                                            <span class="description-comment">{{ $comment->description }}</span>
                                            @php
                                                $rating = $comment->rate_level;
                                            @endphp
                                            <div class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rating)
                                                        <i class="show-star fa-solid fa-star"></i>
                                                    @else
                                                        <i class="hide-star fa-regular fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 col-xs-12">
                <div class="data-chart py-5">
                    <div id="chart-data-comment" data-comment='@json($rateLevels)'></div>
                    <canvas id="myAreaChart" width="100%" height="80%"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Show comment --}}
    <div id="commentSidebar" class="comment-sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <h5>Phản hồi bình luận</h5>
            <button id="closeSidebar" class="btn btn-lg">&times;</button>
        </div>
        <div id="commentContent" class="sidebar-content p-3">
            <!-- Nội dung comment sẽ hiển thị ở đây -->
            <p>Đang tải...</p>
        </div>
    </div>

    <!-- Modal create comment -->
    <div wire:ignore.self class="modal fade" id="createComment" tabindex="-1" aria-labelledby="createCommentLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="submit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title" id="createCommentLabel">Tạo đánh giá</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-5 @error('rate_level') is-invalid  @enderror">
                            <label for="rate_level" class="form-label @error('rate_level') text-danger  @enderror">Mức
                                độ đánh giá (1-5)</label>
                            <input type="number" class="form-control" id="rate_level" wire:model.defer="rate_level"
                                placeholder="Mức độ đánh giá...">
                            @error('rate_level')
                                <div class="text-danger text-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-5 @error('description') is-invalid  @enderror">
                            <textarea class="form-control" placeholder="Đánh giá..." id="description" wire:model.defer="description"></textarea>
                            <label for="description"
                                class="@error('description') text-danger  @enderror">Comments</label>
                            @error('description')
                                <div class="text-danger text-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5 @error('user_id') is-invalid  @enderror">
                            <select class="form-select" wire:model.defer="user_id">
                                <option value="">-- Người đánh giá --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger text-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5 @error('product_id') is-invalid  @enderror">
                            <select class="form-select" wire:model.defer="product_id">
                                <option value="">-- Sản phẩm đánh giá --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="text-danger text-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5 @error('image') is-invalid  @enderror">
                            <label for="image" class="form-label @error('image') text-danger  @enderror">
                                Ảnh minh chứng (nếu có)
                            </label>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @error('image')
                                <div class="text-danger text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-create">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
