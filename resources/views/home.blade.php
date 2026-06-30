<x-home-layout>
    <x-slot:header>
        <h1 class="text-3xl font-bold text-black flex items-center gap-3">
            <i class="fa-solid fa-house text-primary"></i>
            <span>Home</span>
        </h1>
    </x-slot:header>
    <div class="flex flex-col xl:flex-row gap-6">
    
        <div class="flex flex-1 flex-col gap-10 p-4">
    
            <!-- STATS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
    
                <div class="flex flex-col bg-primary gap-3 px-6 py-5 rounded-2xl my-shadow text-white">
                    <h3 class="font-semibold text-sm">
                        <i class="fa-solid fa-list mr-1"></i>
                        Total Aduan
                    </h3>
    
                    <p class="font-bold text-5xl leading-none">
                       {{ $total_aduan }}
                    </p>
                </div>
    
                <div class="flex flex-col bg-egg gap-3 px-6 py-5 rounded-2xl my-shadow text-black">
                    <h3 class="font-semibold text-sm">
                        <i class="fa-solid fa-hourglass-half mr-1"></i>
                        Pending
                    </h3>
    
                    <p class="font-bold text-5xl leading-none">
                        {{ $pending }}
                    </p>
                </div>
               
                <div class="flex flex-col bg-egg gap-3 px-6 py-5 rounded-2xl my-shadow text-black">
                    <h3 class="font-semibold text-sm">
                        <i class="fa-solid fa-check mr-1"></i>
                        Selesai
                    </h3>
    
                    <p class="font-bold text-5xl leading-none">
                        {{ $selesai }}
                    </p>
                </div>
    
                <div class="flex flex-col bg-egg gap-3 px-6 py-5 rounded-2xl my-shadow text-black">
                    <h3 class="font-semibold text-sm">
                        <i class="fa-solid fa-xmark mr-1"></i>
                        Ditolak
                    </h3>
    
                    <p class="font-bold text-5xl leading-none">
                        {{ $ditolak }}
                    </p>
                </div>
    
            </div>
    
            <!-- BUAT ADUAN -->
            <div class="flex flex-col gap-5">
    
                <div>
                    <h2 class="text-2xl font-bold text-black">
                        Buat Aduan
                    </h2>
    
                    <p class="text-sm text-black/60 mt-1">
                        Pilih jenis bantuan yang ingin diajukan.
                    </p>
                </div>
    
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
    
                    <a  
                        href="{{ route('aduan.create', ['jenis' => 'sembako']) }}" 
                        class="bg-primary flex flex-col justify-center items-center gap-3 h-32 rounded-2xl text-white hover:bg-primary-dark cursor-pointer transition">
    
                        <i class="fa-solid fa-bowl-food text-3xl"></i>
    
                        <p class="text-lg font-semibold">
                            Sembako
                        </p>
    
                    </a>
    
                    <a
                        href="{{ route('aduan.create', ['jenis' => 'hunian sementara']) }}" 
                        class="bg-primary flex flex-col justify-center items-center gap-3 h-32 rounded-2xl text-white hover:bg-primary-dark cursor-pointer transition">
    
                        <i class="fa-solid fa-tent text-3xl"></i>
    
                        <p class="text-lg font-semibold">
                            Hunian Sementara
                        </p>
    
                    </a>
    
                    <a
                        href="{{ route('aduan.create', ['jenis' => 'pakaian']) }}" 
                        class="bg-primary flex flex-col justify-center items-center gap-3 h-32 rounded-2xl text-white hover:bg-primary-dark cursor-pointer transition">
    
                        <i class="fa-solid fa-shirt text-3xl"></i>
    
                        <p class="text-lg font-semibold">
                            Pakaian
                        </p>
    
                    </a>
    
                </div>
    
            </div>
    
        </div>
    
        <!-- RIGHT SIDEBAR -->
        <div class="w-full xl:w-120 p-4">
    
            <div class="w-full bg-egg p-5 rounded-2xl my-shadow">
    
                <h2 class="font-semibold text-xl text-black mb-5">
                    Aduan Dalam Progress
                </h2>
    
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:flex xl:flex-col gap-4">
                    @if($progress->isEmpty())
                        <div class="bg-white/50 rounded-xl p-6 text-center">
                         <i class="fa-solid fa-inbox text-4xl text-black/30 mb-3"></i>
                            <h3 class="font-semibold text-lg text-black">
                                Belum Ada Aduan
                            </h3>
                            <p class="text-black/50">
                                Buat aduan pertama Anda untuk mendapatkan bantuan.
                            </p>
                        </div>
                    @endif

                    @foreach($progress as $aduan)

                        <div class="flex flex-col gap-3 rounded-xl bg-white/50 p-4">
        
                            <h3 class="font-semibold text-base">
                                {{ $aduan['judul'] }}
                            </h3>
        
                            <div class="flex gap-2">
                                <span class="bg-primary text-xs text-white px-3 py-1 rounded-full">
                                    {{ $aduan['jenis_aduan'] }}
                                </span>
        
                                <span class="bg-accent text-xs text-white px-3 py-1 rounded-full">
                                    {{ $aduan['status'] }}
                                </span>
                            </div>
        
                            <p class="text-sm text-black/70 leading-6 line-clamp-2">
                                {{ $aduan['deskripsi'] }}
                            </p>
        
                            <a href="aduan-ku/{{ $aduan['id'] }}" class="font-medium text-primary hover:underline">
                                Lihat Detail →
                            </a>
        
                        </div>

                    @endforeach
    
    
                    
    
                </div>
    
            </div>
    
        </div>
    
    </div>
</x-home-layout>