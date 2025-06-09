<div class="container-fluid px-4">
    <div class="row header-event">
        <div class="col-xl-4 col-md-3 col-xs-12">
            <h1 class="name-shop">Sự kiện</h1>
        </div>

        <div class="col-xl-4 col-md-3 col-xs-12">
            <div class="btn-group mb-3" role="group" aria-label="Filter status">
                <input type="radio" class="btn-check" id="statusAll" value="all"
                    wire:click="updateStatus($event.target.value)" autocomplete="off">
                <label class="btn btn-outline-check {{ $status === 'all' ? 'btn-bg-check' : 'btn-hover' }}"
                    for="statusAll">Tất cả</label>

                <input type="radio" class="btn-check" id="statusPublished" value="1"
                    wire:click="updateStatus($event.target.value)" autocomplete="off">
                <label class="btn btn-outline-check {{ $status === '1' ? 'btn-bg-check' : 'btn-hover' }}"
                    for="statusPublished">Đã đăng</label>

                <input type="radio" class="btn-check" id="statusUnpublished" value="0"
                    wire:click="updateStatus($event.target.value)" autocomplete="off">
                <label class="btn btn-outline-check {{ $status === '0' ? 'btn-bg-check' : 'btn-hover' }}"
                    for="statusUnpublished">Chưa đăng</label>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-xs-12 d-flex justify-content-end">
            <div class="form-search">
                <div class="d-flex align-items-center form-inline">
                    <input wire:key="search-input" wire:model.live.debounce.300ms="search" class="form-control w-100 "
                        name="name" type="search" placeholder="Tìm kiếm sự kiện...." aria-label="Search" required>
                    <button class="btn button-filter" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-container">
        <div class="container-table">
            <div class="row">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Mã video</th>
                            <th style="width: 300px" scope="col">Sự kiện</th>
                            <th scope="col">Ngày đăng</th>
                            <th scope="col">Tác giả</th>
                            <th style="width: 170px" scope="col">Trạng thái</th>
                            <th scope="col">###</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            @php
                                $eventStatus = $event['is_public'] != 0 ? 'public' : 'private';
                                $event['is_public'] = $event['is_public'] != 0 ? 'Đã đăng' : 'Chưa đăng';
                            @endphp
                            <tr wire:key="event-{{ $event['id'] }}">
                                <td scope="row">{{ $event['id'] }}</td>
                                <td>{{ $event['video_id'] ?? 'Không có' }}</td>
                                <td class="name">
                                    <span class="name-more">{{ $event['name'] }}</span>
                                </td>
                                <td>{{ $event['post_date'] }}</td>
                                <td>{{ $event['author'] }}</td>
                                <td>
                                    <span class="status {{ $eventStatus }}">{{ $event['is_public'] }}</span>
                                </td>
                                <td>
                                    <a href="/event/detail/{{ $event['id'] }}" class="">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
