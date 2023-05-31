<div>
    <nav class="py-4 flex justify-between">
        <div>
            <p class="text-2xl">MovieMadness</p>
        </div>
        <ul class="flex gap-8 items-center">
            <a href="#">
                <li>Home</li>
            </a>
            <a href="#">
                <li>Discover</li>
            </a>
            <a href="#">
                <li>Movie Release</li>
            </a>
            <a href="#">
                <li>Forum</li>
            </a>
            <a href="#">
                <li>About</li>
            </a>
        </ul>
        <div class="text-xl flex gap-4 items-center">
            <i class="ri-search-line"></i>
            <i class="ri-notification-2-line"></i>
            <div class="rounded-full w-8 h-8 border-2 border-white flex items-center justify-center">
                <i class="ri-user-line"></i>
            </div>
        </div>
    </nav>
    <div class="w-full absolute -z-10 inset-0 bottom-auto" x-cloak x-init="new Splide('.splide').mount()" x-data="{ current: 0 }">
        <section class="splide h-full" aria-label="Splide Basic HTML Example">
            <div class="splide__track h-full">
                <ul class="splide__list ">
                    @foreach ($upcoming_movies as $upcoming_movie)
                        <li class="splide__slide cursor-grab">
                            <div class="w-full h-[40rem] relative">
                                <div class="gradient absolute inset-0 z-10 pointer-events-none"></div>
                                <img class="w-full select-none h-full object-cover object-center" src="{{ $upcoming_movie['backdrop_path'] }}" alt="{{ $upcoming_movie['title'] }} Backdrop">
                                <div class="absolute bottom-4 left-4 z-10 flex items-stretch gap-4">
                                    <img class="" src="{{ $upcoming_movie['poster_path'] }}" alt="{{ $upcoming_movie['title'] }} Poster">
                                    <div class="space-y-4 flex flex-col">
                                        <h4 class="text-4xl text-shadow font-bold">{{ $upcoming_movie['title'] }}</h4>
                                        <div class="flex gap-4 text-sm">
                                            @if ($upcoming_movie['runtime'])
                                                <p>{{ $this->formatRunTime($upcoming_movie['runtime']) }}</p>
                                            @endif
                                            @if ($upcoming_movie['vote_count'])
                                                <p>{{ $upcoming_movie['vote_average'] }}</p>
                                                <p>{{ $upcoming_movie['vote_count'] }}</p>
                                            @endif
                                        </div>
                                        <p class="prose text-white">{{ $upcoming_movie['overview'] }}</p>
                                        <div class="flex-1"></div>
                                        <div class="flex gap-4">
                                            <button>Watch Trailer</button>
                                            <a class="inline-flex items-center border px-2 py-1 gap-2 hover:bg-white duration-200 hover:text-slate-700 rounded-lg" href="#">
                                                <i class="ri-bookmark-line"></i>
                                                <span class="text-sm">Add to Watchlist</span>
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
        @dump($upcoming_movies)

    </div>
</div>
