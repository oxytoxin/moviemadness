<div x-data x-cloak>
    <x-navigation-bar />

    <div wire:ignore>
        <x-homepage.hero-carousel :items="$discover_movies" />
    </div>
    <div class="md:px-16 px-4">
        <div class="space-y-8 mt-16">
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
        <div class="mt-20">
            <h2 class="text-center text-2xl font-bold">BROWSE BY GENRE</h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-8 md:px-20 mt-8">
                @foreach ($genres as $genre)
                    <a href="#">
                        <p class="text-center hover:ring-2 ring-white duration-500 p-2 md:p-4">
                            {{ $genre['name'] }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="md:mt-40 mt-20 md:px-32 flex flex-col md:flex-row items-stretch w-full" id="about">
            <div class="flex-1">
                <p class="prose text-white text-xl">
                    Welcome to MovieMadness, <br>
                    your premier destination for exploring movies, watching trailers, and creating your personalized movie watchlists.
                    Immerse yourself in the world of cinema and embark on an extraordinary journey of movie magic.
                </p>
            </div>
            <div class="flex-1 flex flex-col justify-between items-end">
                <div class="hidden md:block">
                    <x-navigation-links />
                </div>
                <div class="flex text-2xl mt-20 gap-4">
                    <i class="ri-instagram-fill"></i>
                    <i class="ri-facebook-box-fill"></i>
                    <i class="ri-twitter-fill"></i>
                    <i class="ri-google-fill"></i>
                </div>
            </div>
        </div>
        <div class="flex mt-20 md:mt-40 flex-col md:flex-row items-center gap-4 justify-between text-sm">
            <ul class="flex gap-16">
                <a href="#">
                    <li>Privacy Policy</li>
                </a>
                <a href="#">
                    <li>Terms of Service</li>
                </a>
            </ul>
            <div>
                <p>&copy; 2023</p>
            </div>
        </div>
    </div>
    <div class="mt-4"></div>
</div>
