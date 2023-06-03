@props(['item'])

<li class="relative splide__slide" wire:key="{{ $item['id'] }}" x-data x-init="tippy($el, {
    content: $refs.content.innerHTML,
    allowHTML: true
})">
    <div class="hidden" x-ref="content">
        <p class="prose text-sm text-white">{{ $item['overview'] }}</p>
    </div>
    <a class="flex justify-center" href="{{ route('movies.details', ['movie_id' => $item['id']]) }}">
        <div class="relative inline-flex flex-col mx-auto">
            <img src="{{ $item['poster_path'] }}" alt="{{ $item['title'] }} Poster">
            <div class="absolute top-1 right-2 z-20 text-xl">
                <button class="border-2 px-1 rounded-full hover:bg-red-600 duration-300">
                    <i class="ri-heart-3-line"></i>
                </button>
            </div>
            <div class="absolute bottom-2 z-20 left-2 right-0">
                <p class="text-left">{{ $item['title'] }}</p>
                <div class="flex items-end gap-1">
                    <i class="ri-star-fill text-yellow-300"></i>
                    <h6 class="text-sm">{{ $item['vote_average'] }}</h6>
                </div>
            </div>
            <div class="bg-gradient-to-t from-black to-transparent absolute inset-0 z-10"></div>
        </div>
    </a>
</li>
