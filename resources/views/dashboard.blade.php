<x-dashboard-layout>
    <x-slot:header>      
        <h1 class="text-3xl font-bold text-black">Dashboard</h1>
    </x-slot:header>
    {{-- info dashboard --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
        <div class="flex flex-col col-span-2 md:col-span-1 bg-primary gap-2 p-4 my-shadow rounded-xl  text-white ">
            <h3 class="font-semibold">
                <i class="fa-solid fa-list"></i> 
                Total Aduan
            </h3>
            <p class="font-bold text-5xl">
                {{ $total_aduan }}
            </p>
        </div>
        <div class="flex flex-col bg-egg my-shadow gap-2 p-4 rounded-xl  text-black ">
            <h3 class="font-semibold">
                <i class="fa-solid fa-hourglass-half"></i> 
                Pending
            </h3>
            <p class="font-bold text-5xl">
                {{ $pending }}
            </p>
        </div>
        <div class="flex flex-col bg-egg my-shadow gap-2 p-4 rounded-xl  text-black ">
            <h3 class="font-semibold">
                <i class="fa-solid fa-clock"></i> 
                Diproses
            </h3>
            <p class="font-bold text-5xl">
                {{ $diproses }}
            </p>
        </div>
        <div class="flex flex-col bg-egg my-shadow gap-2 p-4 rounded-xl  text-black ">
            <h3 class="font-semibold">
                <i class="fa-solid fa-check"></i> 
                Selesai
            </h3>
            <p class="font-bold text-5xl">
                {{ $selesai }}
            </p>
        </div>
        <div class="flex flex-col bg-egg my-shadow gap-2 p-4 rounded-xl  text-black ">
            <h3 class="font-semibold">
                <i class="fa-solid fa-xmark"></i> 
                Ditolak
            </h3>
            <p class="font-bold text-5xl">
                {{ $ditolak }}
            </p>
        </div>
    </div>

    {{-- content --}}
    <div class="flex flex-col-reverse xl:flex-row gap-4  h-full">
        
        <div class="flex flex-1 flex-col gap-4 h-full">
            <div class="w-full  bg-egg my-shadow rounded-xl p-4">

                <div class="flex flex-col gap-2 sm:flex-row justify-between mb-4 items-center">
                    <h2 class="text-2xl text-black font-semibold ">
                        Distribusi Jenis Aduan
                    </h2>
                    <div class="flex gap-8 w-full sm:w-fit">

                        <div class="bg-white/50 py-2 px-6 rounded-xl w-full ">
                            <p class="text-sm text-black font-semibold  ">
                                Kategori Terbanyak :
                            </p>
                            <h3 class="text-[18px] text-primary font-semibold">
                                {{ $kategori_terbanyak }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="h-80  bg-white/50 py-2 px-4 rounded-xl">
                    @if(array_sum($values) === 0)
                        <div class="h-full flex items-center justify-center">
                            <p class="text-black/50">
                                Belum ada data aduan.
                            </p>
                        </div>
                    @else
                        <canvas
                            id="dashboardChart"
                            data-labels='@json($labels)'
                            data-values='@json($values)'
                        ></canvas>
                    @endif
                </div>

            </div>

            <div class="flex flex-col w-full h-fit bg-egg my-shadow p-4 rounded-xl gap-4">
               <div>
                    <h1 class="text-xl font-semibold text-black">Aduan terbaru</h1>
               </div>
                <div>
                    <table class=" bg-white/50 my-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Dibuat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        @foreach ($aduan_terbaru as  $aduan)                         
                            <tr>
                                <td data-label="Judul"><a class="text-primary hover:underline line-clamp-1" href="{{ route('aduan', $aduan) }}" >{{ Str::limit($aduan['judul'], 40) }}</a></td>
                                <td data-label="Pelapor">{{ $aduan->user->nama }}</td>
                                <td data-label="Kategori">{{ $aduan['jenis_aduan'] }}</td>
                                <td data-label="Dibuat">{{ $aduan->created_at->diffForHumans() }}</td>
                                <td data-label="status">
                                    <div class="flex items-center justify-end md:justify-start gap-2">
                                        <div  class="w-3 h-3 rounded-full {{ match($aduan->status) {
                                            'selesai' => 'bg-selesai',
                                            'pending' => 'bg-pending',
                                            'diproses' => 'bg-diproses',
                                            'ditolak' => 'bg-ditolak',
                                        } }}"></div>
                                        <span>{{ ucfirst($aduan['status']) }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div>
                    <a href={{ route('data_aduan') }} class="text-sm text-primary hover:underline ">Lihat lebih banyak . . .</a>
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col xl:w-80 h-full">
            <div class="w-full h-fit flex flex-col bg-egg my-shadow rounded-xl p-4 gap-4">
                <h2 class="font-semibold text-xl text-black">
                    Verifikasi Aduan Terbaru
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:flex xl:flex-col gap-4">
                    @if ($verifikasi_terbaru->isEmpty())
                        <div class="bg-white/50 rounded-xl p-6 text-center">
                            <i class="fa-solid fa-inbox text-4xl text-black/30 mb-3"></i>
                            <h3 class="font-semibold text-lg text-black">
                                Belum Ada Aduan
                            </h3>
                        </div>
                    @else
                        @foreach($verifikasi_terbaru as $aduan)

                        <div class="flex flex-col gap-3 rounded-xl bg-white/50 p-4">
                            <h3 class="font-semibold text-base line-clamp-1">
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
                            <a href="{{ route('aduan', $aduan) }}" class="font-medium text-primary hover:underline">
                                Lihat Detail →
                            </a>    
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/chart.js')
    @endpush
</x-dashboard-layout>