<div x-data x-cloak>
    <nav class="py-4 px-16 absolute inset-x-0 z-10 flex justify-between">
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
    <div wire:ignore>
        <x-homepage.hero-carousel :items="$discover_movies" />
    </div>

    <div class="px-16 space-y-8 mt-16">
        <div wire:ignore>
            <x-homepage.movie-posters-scroller id="popular" title="POPULAR" :items="$movies['popular']" />
        </div>
        <div wire:ignore>
            <x-homepage.movie-posters-scroller id="upcoming" title="UPCOMING" :items="$movies['upcoming']" />
        </div>
        <div wire:ignore>
            <x-homepage.movie-posters-scroller id="now_playing" title="NOW PLAYING" :items="$movies['now_playing']" />
        </div>
        <div wire:ignore>
            <x-homepage.movie-posters-scroller id="top_rated" title="TOP RATED" :items="$movies['top_rated']" />
        </div>
    </div>
    <div class="my-80"></div>
</div>
