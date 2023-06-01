@props([
    'id' => 'upcoming',
    'title' => 'UPCOMING',
    'items' => [],
    'link_for_more' => '#',
])

<div>
    <div class="flex items-center justify-between">
        <h3 class="font-semibold text-xl">{{ $title }}</h3>
        <a class="hover:underline" href="{{ $link_for_more }}">See More <i class="ri-arrow-right-s-fill"></i></a>
    </div>
    <div class="mt-2">
        <div x-init="new Splide('#{{ $id }}', {
            type: 'slide',
            perPage: 7,
            gap: '1rem',
            lazyLoad: 'nearby',
            breakpoints: {
                480: {
                    perPage: 2,
                    pagination: false,
                },
            }
        }).mount()">
            <section class="splide" id="{{ $id }}">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($items as $item)
                            <li class="relative w-max splide__slide">
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
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>
