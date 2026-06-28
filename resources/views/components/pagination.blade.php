@props(['data'])
<div class="flex justify-center gap-2 items-center">
    <a href="{{ $data->appends(request()->query())->url(1) }}">
        <i class="fa-solid fa-angles-left"></i>
    </a>
    <a href="{{ $data->appends(request()->query())->previousPageUrl() }}">
        <i class="fa-solid fa-angle-left"></i>
    </a>
    @for ($i = 1; $i <= $data->lastPage(); $i++)
        <a
            href="{{ $data->appends(request()->query())->url($i) }}"
            class="
                px-3 py-1 rounded
                {{ $i == $data->currentPage()
                    ? 'bg-primary text-white'
                    : 'bg-white'
                }}
            "
        >
            {{ $i }}
        </a>
    @endfor
    <a href="{{ $data->appends(request()->query())->nextPageUrl() }}">
        <i class="fa-solid fa-angle-right"></i>
    </a>
    <a href="{{ $data->appends(request()->query())->url($data->lastPage()) }}">
        <i class="fa-solid fa-angles-right"></i>
    </a>
</div>  