<div class="md:px-16 px-4 flex-1 flex flex-col">
    <h1 class="text-center text-4xl my-16">MY WATCHLIST</h1>
    <div class="flex flex-col gap-8 md:px-16 flex-1">
        @forelse ($watchlisted as $watchlist_item)
            <div class="border p-4 flex gap-4 md:flex-row flex-col">
                <img class="md:h-48 flex-shrink-0" src="{{ $watchlist_item['other_details']['movie_poster_path'] }}" alt="{{ $watchlist_item['other_details']['movie_title'] }} Poster">
                <div class="flex flex-1 flex-col">
                    <h4 class="text-2xl">{{ $watchlist_item['other_details']['movie_title'] }}</h4>
                    <h6 class="text-sm text-slate-400">Added: {{ $watchlist_item->created_at->format('h:i A m/d/Y') }}</h6>
                    <p class="prose text-white italic mt-2">
                        {{ $watchlist_item['other_details']['movie_overview'] }}
                    </p>
                    <div class="flex-1"></div>
                    <div class="flex justify-end items-center mt-16 gap-2">
                        @if ($watchlist_item->status != App\Models\WatchlistItem::COMPLETED)
                            <button class="inline-flex items-center px-2 py-1 gap-1 bg-green-700 hover:bg-green-500 duration-200 rounded-lg" wire:click="complete({{ $watchlist_item->id }})">
                                <i class="ri-check-line"></i>
                                <p class="text-xs md:text-sm">Mark as Watched</p>
                            </button>
                        @else
                            <span class="text-sm cursor-pointer italic" title="{{ $watchlist_item->watched_at?->format('h:i A F d, Y') }}">Completed {{ $watchlist_item->watched_at?->diffForHumans() }}</span>
                        @endif

                        <button class="inline-flex items-center px-2 py-1 gap-1 bg-red-700 hover:bg-red-500 duration-200 rounded-lg" wire:click="removeFromList({{ $watchlist_item->id }})">
                            <i class="ri-delete-bin-6-line"></i>
                            <p class="text-xs md:text-sm">Remove from List</p>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="grid place-items-center flex-1 h-full">No movie added to watchlist.</div>
        @endforelse
    </div>
    <div class="text-black mt-16">
        {{ $watchlisted->links() }}
    </div>
</div>
