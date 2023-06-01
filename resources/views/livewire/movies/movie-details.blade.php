<div class="md:px-16 px-4 mt-8" x-data>
    <div class="mt-12 flex justify-between items-end">
        <div>
            <div class="flex items-center gap-4">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <p class="border rounded-full px-2">{{ oxy_get_formatted_runtime($movie['runtime']) }}</p>
            </div>
            <blockquote class="italic prose-p mt-4">"{{ $movie['tagline'] != '' ? $movie['tagline'] : '--------' }}"</blockquote>
        </div>
        <div class="text-sm text-right">
            <div class="text-sm mt-2">
                @foreach ($movie['genres'] as $genre)
                    @if ($loop->iteration != 1)
                        <i class="ri-git-commit-fill"></i>
                    @endif
                    <span>{{ $genre['name'] }}</span>
                @endforeach
            </div>
            <p>{{ date_create($movie['release_date'])?->format('F d, Y') }}</p>
        </div>
    </div>
    <div class="mt-4" x-data="{ player: null }">
        @if (!app()->environment('production'))
            @if (count($movie['videos']))
                <div x-init="player = YouTubePlayer('player', {
                    playerVars: {
                        modestbranding: true,
                    }
                });
                player.loadVideoById('{{ collect(collect($movie['videos'])->first())->first()['key'] }}');">
                    <div class="">
                        <div class="w-full h-[70vh]" id="player"></div>
                    </div>
                </div>
            @else
                <img class="w-full h-[40rem] select-none object-cover object-center" src="{{ $movie['backdrop_path'] }}" alt="{{ $movie['title'] }} Backdrop">
            @endif
        @else
            <div class="bg-red-200">
                <div class="w-full h-[70vh]" id="player"></div>
            </div>
        @endif
        <div class="mt-8">
            <div class="flex items-stretch overflow-x-auto overflow-y-hidden pb-4 gap-4">
                @foreach ($movie['videos'] as $type => $video_collection)
                    @if ($loop->iteration != 1)
                        <div class="w-1 flex-shrink-0 mb-6 bg-white"></div>
                    @endif
                    <div class="flex-shrink-0">
                        <div class="flex gap-4">
                            @foreach ($video_collection as $video)
                                <button class="w-48 aspect-video focus:outline-none" @click="player?.stopVideo().then(() => player.loadVideoById('{{ $video['key'] }}'))">
                                    <img class="block object-cover object-center w-full hover:scale-105 duration-200" src="{{ $video['thumbnail'] }}" alt="{{ $video['name'] }} Thumbnail" />
                                </button>
                            @endforeach
                        </div>
                        <h3>{{ str($type)->plural(count($video_collection))->upper() }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-8">
        <div class="flex justify-between items-end">
            <h4 class="text-2xl font-semibold">OVERVIEW</h4>
            <a class="inline-flex items-center border px-2 py-1 gap-1 hover:bg-white duration-200 hover:text-slate-700 rounded-lg" href="#">
                <i class="ri-bookmark-line"></i>
                <p class="text-xs md:text-sm">Add to Watchlist</p>
            </a>
        </div>
        <div class="flex mt-8 justify-between items-start">
            <div class="w-3/4">
                <p class="prose text-white">
                    {{ $movie['overview'] }}
                </p>
                <div class="mt-16">
                    <h4 class="text-xl font-semibold">CAST</h4>
                    <div class="pr-8 mt-2">
                        <x-splide id="cast" perPage="5" breakpoints="{
                            480: {
                                perPage: 2,
                                pagination: false,
                            }
                        }">
                            @foreach ($movie['credits']['cast'] as $cast)
                                <li class="relative splide__slide text-sm flex-shrink-0">
                                    <img src="{{ $cast['profile_path'] }}" alt="{{ $cast['name'] }} Profile">
                                    <div class="absolute opacity-0 hover:opacity-100 p-2 flex flex-col justify-end z-20 bg-black bg-opacity-70 duration-200 inset-0">
                                        <p class="text-base">{{ $cast['name'] }}</p>
                                        <p>as {{ $cast['character'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </x-splide>
                    </div>
                </div>
                <div class="mt-16">
                    <h4 class="text-xl font-semibold">CREW</h4>
                    <div class="pr-8 mt-2">
                        <x-splide id="crew" perPage="5" breakpoints="{
                            480: {
                                perPage: 2,
                                pagination: false,
                            }
                        }">
                            @foreach ($movie['credits']['crew'] as $crew)
                                <li class="relative w-max text-sm splide__slide">
                                    <img src="{{ $crew['profile_path'] }}" alt="{{ $crew['name'] }} Profile">
                                    <div class="absolute opacity-0 hover:opacity-100 p-2 flex flex-col justify-end z-20 bg-black bg-opacity-70 duration-200 inset-0">
                                        <p class="text-base">{{ $crew['name'] }}</p>
                                        <p>{{ $crew['job'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </x-splide>
                    </div>
                </div>
            </div>
            <div class="w-1/4 gap-2 flex flex-col border-2 p-8">
                <div class="flex justify-between">
                    <p>Status</p>
                    <p>{{ $movie['status'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p>Budget</p>
                    <p>{{ xformatted_dollar($movie['budget']) }}</p>
                </div>
                <div class="flex justify-between">
                    <p>Revenue</p>
                    <p>{{ $movie['revenue'] ? xformatted_dollar($movie['revenue'], 0) : 'unknown' }}</p>
                </div>
                <div class="mt-2">
                    <p>Keywords</p>
                    <div class="flex mt-2 flex-wrap gap-2">
                        @forelse ($movie['keywords']['keywords'] as $keyword)
                            <a href="">
                                <p class="p-1 rounded text-sm text-slate-900 bg-gray-300">{{ $keyword['name'] }}</p>
                            </a>
                        @empty
                            <p>No keywords found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h4 class="text-2xl mt-16 font-semibold">SIMILAR MOVIES</h4>
        <div class="mt-2">
            <x-splide id="similar" breakpoints="{
            480: {
                perPage: 2,
                pagination: false,
            },
        }">
                @foreach ($movie['similar']['results'] as $similar)
                    <x-movies.poster :item="$similar" />
                @endforeach
            </x-splide>
        </div>
    </div>
    <div class="mt-40"></div>
</div>
