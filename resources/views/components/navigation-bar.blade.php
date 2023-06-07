<nav @class([
    'py-4 flex-col md:flex-row items-center gap-4 bg-black bg-opacity-50 md:bg-transparent px-16 inset-x-0 z-10 flex justify-between',
    'absolute' => Route::is('home'),
])>
    <div>
        <p class="text-2xl p-2 border-2 italic">MovieMadness</p>
    </div>
    <x-navigation-links />
    <div class="text-xl flex gap-4 items-center">
        <a href="{{ route('movies.search') }}">
            <i class="ri-search-line"></i>
        </a>
        @auth
            <a class="text-sm border px-2 bg-amber-600 py-1" href="{{ route('user.watchlist') }}">My List</a>
            <div class="relative" x-cloak x-data="{ show: false }">
                <button @click="show = !show">
                    <div class="rounded-full w-8 h-8 border-2 border-white flex items-center justify-center">
                        <i class="ri-user-line"></i>
                    </div>
                </button>
                <div class="bg-white text-right py-2 text-sm rounded text-black w-32 absolute right-0 top-12" x-show="show" x-transition @click.away="show = false">
                    <form class="hover:bg-gray-300" method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full p-2 text-right">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
        @guest
            <a class="text-sm" href="{{ route('login') }}">
                Login
            </a>
            <a class="text-sm" href="{{ route('register') }}">
                Register
            </a>
        @endguest
    </div>
</nav>
