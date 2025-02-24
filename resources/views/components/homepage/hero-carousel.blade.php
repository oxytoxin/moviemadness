@props([
    'items' => [],
])

<div class="w-full relative" x-data="{ showTrailer: false, player: null }">
    <div class="fixed grid place-items-center inset-0 bg-gray-900 bg-opacity-70 z-30" x-cloak x-show="showTrailer" x-transition.opacity x-init="player = YouTubePlayer('trailer', {
        playerVars: {
            modestbranding: true,
        }
    })">
        <div class="md:w-2/3 w-full px-4 md:h-[70vh]" @click.away="player?.stopVideo().then(() => showTrailer = false)">
            <div id="trailer" class="w-full h-full"></div>
        </div>
    </div>
    <x-splide id="discover" type="loop" perPage="1" arrows="false" autoplay="true" interval="5000">
        @foreach ($items as $item)
            <li class="splide__slide cursor-grab">
                <div class="w-full h-[40rem] relative">
                    <div class="bg-black md:hidden bg-opacity-70 absolute inset-0 z-10 pointer-events-none"></div>
                    <div class="gradient md:block hidden absolute inset-0 z-10 pointer-events-none"></div>
                    <img class="w-full select-none h-full object-cover object-center" src="{{ $item['backdrop_path'] }}" alt="{{ $item['title'] }} Backdrop">
                    <div class="absolute bottom-8 left-4 z-10 flex items-stretch gap-4">
                        <div class="w-48 hidden md:flex items-end">
                            <img class="bg-cover bg-center" src="{{ $item['poster_path'] }}" alt="{{ $item['title'] }} Poster">
                        </div>
                        <div class="space-y-4 flex flex-col">
                            <h4 class="text-4xl text-shadow font-bold">{{ $item['title'] }}</h4>
                            <div class="flex gap-4 text-sm">
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
                                @isset($item['trailer']['key'])
                                    <button @click="player?.loadVideoById('{{ $item['trailer']['key'] }}'); showTrailer = true" class="inline-flex items-center px-2 py-1 gap-1 bg-green-700 hover:bg-green-500 duration-200 rounded-lg">
                                        <i class="ri-play-circle-line"></i>
                                        <p class="text-xs md:text-sm">Watch Trailer</p>
                                    </button>
                                @endisset
                                <a class="inline-flex items-center border border-amber-700 px-2 py-1 gap-1 hover:bg-amber-500 bg-amber-600 duration-200 text-slate-800 hover:text-black rounded-lg" href="{{ route('movies.details', [
                                    'movie_id' => $item['id'],
                                ]) }}">
                                    <p class="text-xs md:text-sm">View Details</p>
                                    <i class="ri-arrow-right-circle-fill"></i>
                                </a>
                                <button class="inline-flex items-center border px-2 py-1 gap-1 hover:bg-white duration-200 hover:text-slate-700 rounded-lg" wire:click="addToWatchlist({{ $item['id'] }})">
                                    <i class="ri-loader-4-line animate-spin" wire:loading.delay wire:target="addToWatchlist({{ $item['id'] }})"></i>
                                    <i class="ri-bookmark-line" wire:loading.delay.remove wire:target="addToWatchlist({{ $item['id'] }})"></i>
                                    <p class="text-xs md:text-sm">Add to Watchlist</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </x-splide>
</div>
