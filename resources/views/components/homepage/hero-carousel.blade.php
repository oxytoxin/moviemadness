@props([
    'items' => [],
])

<div class="w-full" x-init="new Splide('#discover', {
    type: 'loop',
    arrows: false,
    autoplay: true,
    interval: 5000,
}).mount()">
    <section class="h-full splide" id="discover">
        <div class="splide__track h-full">
            <ul class="splide__list ">
                @foreach ($items as $item)
                    <li class="splide__slide cursor-grab">
                        <div class="w-full h-[40rem] relative">
                            <div class="gradient absolute inset-0 z-10 pointer-events-none"></div>
                            <img class="w-full select-none h-full object-cover object-center" src="{{ $item['backdrop_path'] }}" alt="{{ $item['title'] }} Backdrop">
                            <div class="absolute bottom-8 left-4 z-10 flex items-stretch gap-4">
                                <img class="" src="{{ $item['poster_path'] }}" alt="{{ $item['title'] }} Poster">
                                <div class="space-y-4 flex flex-col">
                                    <h4 class="text-4xl text-shadow font-bold">{{ $item['title'] }}</h4>
                                    <div class="flex gap-4 text-sm">
                                        @if ($item['runtime'])
                                            <p>{{ $this->formatRunTime($item['runtime']) }}</p>
                                        @endif
                                        @if ($item['vote_count'])
                                            <div class="flex items-center gap-8">
                                                <div class="flex items-center gap-1">
                                                    <i class="ri-star-fill text-lg text-yellow-300"></i>
                                                    <h6 class="">{{ $item['vote_average'] }}</h6>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <i class="ri-user-star-fill text-lg text-yellow-300"></i>
                                                    <h6 class="">{{ $item['vote_count'] }}</h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="prose text-white">{{ $item['overview'] }}</p>
                                    <div class="flex-1"></div>
                                    <div class="flex gap-4">
                                        <a class="inline-flex items-center px-2 py-1 gap-1 bg-green-700 hover:bg-green-500 duration-200 rounded-lg" href="#">
                                            <i class="ri-play-circle-line"></i>
                                            <p class="text-sm">Watch Trailer</p>
                                        </a>
                                        <a class="inline-flex items-center border px-2 py-1 gap-1 hover:bg-white duration-200 hover:text-slate-700 rounded-lg" href="#">
                                            <i class="ri-bookmark-line"></i>
                                            <p class="text-sm">Add to Watchlist</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

</div>
