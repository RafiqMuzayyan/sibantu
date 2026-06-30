<div class="min-w-50  relative ">
    <aside class="fixed top-0 left-0 w-50 h-full p-2">
        <div class="flex flex-col justify-between bg-egg w-full h-full rounded-md my-shadow px-4 py-4">
            <div>
                <a id="head" class="flex items-center  w-full cursor-pointer gap-1" href="/dashboard">
                    <img src="{{ asset('img/icon.png') }}" alt="login" class="w-9">
                    <h1 class="font-bold text-2xl text-black">Si<span class="text-primary">Bantu</span></h1>
                </a>
                <div class=" flex flex-col gap-4  mt-9">
                   <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 px-2 py-2 rounded
                    {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-black' }}">
                        <i class="fa-solid fa-tachograph-digital text-xl
                        {{ request()->routeIs('dashboard') ? 'text-white' : 'text-primary' }}"></i>
                        Dashboard
                    </a>
    
                    <a href="{{ route('data_aduan') }}"
                    class="flex items-center gap-2 px-2 py-2 rounded
                    {{ request()->routeIs('data_aduan') ? 'bg-primary text-white' : 'text-black' }}">
                        <i class="fa-solid fa-list text-xl
                        {{ request()->routeIs('data_aduan') ? 'text-white' : 'text-primary' }}"></i>
                        Aduan
                    </a>
    
                    <a href="{{ route('masyarakat') }}"
                    class="flex items-center gap-2 px-2 py-2 rounded
                    {{ request()->routeIs('masyarakat') ? 'bg-primary text-white' : 'text-black' }}">
                        <i class="fa-solid fa-users text-xl
                        {{ request()->routeIs('masyarakat') ? 'text-white' : 'text-primary' }}"></i>
                        Masyarakat
                    </a>
    
                    <a href="{{ route('data_laporan') }}"
                    class="flex items-center gap-2 px-2 py-2 rounded
                    {{ request()->routeIs('data_laporan') ? 'bg-primary text-white' : 'text-black' }}">
                        <i class="fa-solid fa-chart-bar text-xl
                        {{ request()->routeIs('data_laporan') ? 'text-white' : 'text-primary' }}"></i>
                        Laporan
                    </a>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" x-ref="logout">
                @csrf
                <button 
                    type="button"
                    @click="
                        open({
                            title: 'Log Out',
                            message: 'Apakah anda ingin keluar?',
                            form: $refs.logout
                        })
                    "
                    class="text-primary font-semibold cursor-pointer"
                >
                    Log Out
                </button>
            </form>
        </div>
        
    </aside>
</div>