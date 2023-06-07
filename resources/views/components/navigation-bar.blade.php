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
            <button>
                <i class="ri-notification-2-line"></i>
            </button>
            <button>
                <div class="rounded-full w-8 h-8 border-2 border-white flex items-center justify-center">
                    <i class="ri-user-line"></i>
                </div>
            </button>
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
