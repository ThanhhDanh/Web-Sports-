@props(['column', 'sortColumn', 'sortDirection'])

@php
    $query = request()->query();
    $query['column'] = $column;
    $query['sort'] = $sortColumn === $column && $sortDirection === 'asc' ? 'desc' : 'asc';
    $url = url()->current() . '?' . http_build_query($query);
@endphp

<a class="mw-100" href="{{ $url }}">
    {{ $slot }}
    @if ($sortColumn === $column)
        @if ($sortDirection === 'asc')
            <i style="color: var(--text-primary);" class="ms-2 fa-solid fa-arrow-up-short-wide"></i>
        @else
            <i style="color: var(--text-primary);" class="ms-2 fa-solid fa-arrow-up-wide-short"></i>
        @endif
    @else
        <i style="color: var(--text-primary);" class="ms-2 fa-solid fa-sort"></i>
    @endif
</a>
