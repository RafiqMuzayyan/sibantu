<nav x-data="{ open: false }" class="px-4 py-5">
    
    <div class="flex justify-between items-center">

        <!-- Logo -->
        <div>
            <a id="head" class="flex items-center gap-2 w-full cursor-pointer" href="/">
                <img src="{{ asset('img/icon.png') }}" alt="login" class="w-9">
                <h1 class="font-bold text-2xl text-black">
                    Si<span class="text-primary">Bantu</span>
                </h1>
            </a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex gap-6 text-[18px] text-white font-semibold">
            <div>
                <a
                    class="px-6 py-2 rounded-3xl {{ request()->routeIs('home') ? 'bg-primary' : 'text-black' }}"
                    href="{{ route('home') }}">
                    Home
                </a>
            </div>

            <div>
                <a
                    class="px-6 py-2 rounded-3xl {{ request()->routeIs('riwayat') ? 'bg-primary' : 'text-black' }}"
                    href="{{ route('riwayat') }}">
                    Riwayat
                </a>
            </div>

            <div>
                <a
                    class="px-6 py-2 rounded-3xl {{ request()->routeIs('profile') ? 'bg-primary' : 'text-black' }}"
                    href="{{ route('profile') }}">
                    Profile
                </a>
            </div>
        </div>

        <!-- Desktop Button -->
        <div class="hidden md:block">
            <a href="{{ route('aduan.create') }}"
                class="bg-primary px-6 py-2 text-white rounded-3xl font-semibold hover:bg-primary-dark">
                <i class="fa-solid fa-plus"></i>
                Aduan
            </a>
        </div>

        <!-- Hamburger -->
        <button
            @click="open = !open"
            class="md:hidden text-2xl text-primary">
            <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
        </button>

    </div>

    <!-- Mobile Menu -->
    <div
        x-show="open"
        x-transition
        @click.outside="open = false"
       class="md:hidden mt-4 absolute left-0 right-0 bg-background rounded-b-2xl shadow-lg border border-gray-100 overflow-hidden z-[9999]">

        <a
            href="{{ route('home') }}"
            class="block px-5 py-3 {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-black hover:bg-gray-50' }}">
            Home
        </a>

        <a
            href="{{ route('riwayat') }}"
            class="block px-5 py-3 {{ request()->routeIs('riwayat') ? 'bg-primary text-white' : 'text-black hover:bg-gray-50' }}">
            Riwayat
        </a>

        <a
            href="{{ route('profile') }}"
            class="block px-5 py-3 {{ request()->routeIs('profile') ? 'bg-primary text-white' : 'text-black hover:bg-gray-50' }}">
            Profile
        </a>

        <div class="p-4 border-t">
            <a
                href="{{ route('aduan.create') }}"
                class="flex justify-center items-center gap-2 bg-primary py-3 rounded-xl text-white font-semibold">
                <i class="fa-solid fa-plus"></i>
                Aduan
            </a>
        </div>

    </div>

</nav>