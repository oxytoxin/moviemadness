@props([
    'id' => 'upcoming',
    'title' => 'UPCOMING',
    'items' => [],
    'link_for_more' => '#',
    'watchlisted' => [],
])

<div>
    <div class="flex items-center justify-between">
        <h3 class="font-semibold text-xl">{{ $title }}</h3>
        <a class="hover:underline" href="{{ $link_for_more }}">See More <i class="ri-arrow-right-s-fill"></i></a>
    </div>
    <div class="mt-2">
        <x-splide breakpoints="{
                480: {
                    perPage: 2,
                    pagination: false,
                },
                900: {
                    perPage: 4,
                    pagination: false,
                },
            }" :id="$id">
            @foreach ($items as $item)
                <x-movies.poster :watchlisted="collect($watchlisted)->contains($item['id'])" :item="$item" />
            @endforeach
        </x-splide>
    </div>
</div>
