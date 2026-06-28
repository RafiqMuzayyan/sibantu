<nav class="flex justify-between items-center px-4 py-5">
    <div>
            <a id="head" class="flex items-center gap-2  w-full cursor-pointer " href="/">
            <img src="{{ asset('img/icon.png') }}" alt="login" class="w-9">
            <h1 class="font-bold text-2xl text-black">Si<span class="text-primary">Bantu</span></h1>
        </a>
    </div>
    <div class="flex gap-6 text-[18px] text-white font-semibold">
        <div>    
            <a 
                class="px-6 py-2 rounded-3xl {{ request()->routeIs('home') ? 'bg-primary ' : 'text-black' }} " 
                href="{{ route('home') }}"
                >Home</a>
        </div>
        <div>
            <a 
                class="{{ request()->routeIs('riwayat') ? 'bg-primary' : 'text-black' }} px-6 py-2 rounded-3xl " 
                href="{{ route('riwayat') }}"
                >Riwayat</a>
        </div>
        <div>
            <a class="{{ request()->routeIs('profile') ? 'bg-primary' : 'text-black' }} px-6 py-2 rounded-3xl " href="{{ route('profile') }}">Profile</a>
        </div>
    </div>
    <div>
        <a href="{{ route('aduan.create') }}" class="bg-primary px-6 py-2 text-white rounded-3xl font-semibold cursor-pointer hover:bg-primary-dark">
            <i class="fa-solid fa-plus"></i>
            Aduan
        </a>
    </div>
</nav>