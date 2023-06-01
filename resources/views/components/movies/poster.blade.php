@props(['item'])

<li class="relative w-max splide__slide" x-data x-init="tippy($el, {
    content: $refs.content.innerHTML,
    allowHTML: true
})">
    <div class="hidden" x-ref="content">
        <p class="prose text-sm text-white">{{ $item['overview'] }}</p>

    </div>
    <a href="{{ route('movies.details', ['movie_id' => $item['id']]) }}">
        <img src="{{ $item['poster_path'] }}" alt="{{ $item['title'] }} Poster">
        <div class="absolute top-1 right-2 z-20 text-xl">
            <button class="border-2 px-1 rounded-full hover:bg-red-600 duration-300">
                <i class="ri-heart-3-line"></i>
            </button>
        </div>
        <div class="absolute w-full bottom-2 z-20 left-2">
            <p class="whitespace-normal">{{ $item['title'] }}</p>
            <div class="flex items-end gap-1">
                <i class="ri-star-fill text-yellow-300"></i>
                <h6 class="text-sm">{{ $item['vote_average'] }}</h6>
            </div>
        </div>
        <div class="bg-gradient-to-t from-black to-transparent absolute inset-0 z-10"></div>
    </a>
</li>
