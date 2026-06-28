<x-home-layout>
    <x-slot:header>
        <h1 class="text-3xl font-bold text-black flex items-center gap-3">
            <i class="fa-solid fa-list text-primary"></i>
            <span>Riwayat</span>
        </h1>
    </x-slot:header>
    <div class="p-4">     
        <div class="flex flex-col flex-1 h-fit bg-egg my-shadow p-4 rounded-md gap-4">
            <div class="flex items-center justify-end">
                <form 
                    method="GET"
                    action="{{ route('riwayat') }}" 
                    class="flex gap-2 items-center">
                    <div>
                        <input 
                            type="text" 
                            id="search"
                            placeholder="Cari Aduan..."
                            name="search" 
                            class=" p-2 rounded-md border bg-primary/50 text-white"
                            value="{{ request('search') }}"
                        >
                    </div>
                    <div class="flex items-center gap-2"  >
                        <select class=" p-2 rounded-md border bg-primary text-white" name="kategori" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            <option
                                value="sembako"
                                @selected(request('kategori') == 'sembako')
                            >
                                Sembako
                            </option>
                            <option
                                value="hunian sementara"
                                @selected(request('kategori') == 'hunian sementara')
                            >
                                Hunian Sementara
                            </option>
                            <option
                                value="pakaian"
                                @selected(request('kategori') == 'pakaian')
                            >
                                Pakaian
                            </option>
                        </select>
    
                        <select class=" p-2 rounded-md border bg-primary text-white " name="status" onchange="this.form.submit()">
                            <option value="">
                                Semua Status
                            </option>
                            <option value="pending" @selected(request('status') == 'pending')>
                                Pending
                            </option>
                            <option value="diproses" @selected(request('status') == 'diproses')>
                                Diproses
                            </option>
                            <option value="selesai" @selected(request('status') == 'selesai')>
                                Selesai
                            </option>
                            <option value="ditolak" @selected(request('status') == 'ditolak')>
                                Ditolak
                            </option>
                        </select>    
                    </div>
                </form>
            </div>
            <div class="">
                @if($data_aduan->isEmpty())
                    @if(request()->hasAny(['search', 'kategori', 'status']))
                         <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                            <i class="fa-solid fa-magnifying-glass text-5xl text-black/30"></i>
                            <h3 class="text-xl font-semibold">
                                Tidak Ada Hasil
                            </h3>
                            <p class="text-black/50">
                                Tidak ditemukan aduan yang sesuai dengan filter.
                            </p>
                            <a
                                href="{{ route('riwayat') }}"
                                class="bg-primary text-white px-4 py-2 rounded-lg"
                            >
                                Reset Filter
                            </a>
                        </div>
                    @else
                        <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                            <i class="fa-solid fa-folder-open text-5xl text-black/30 "></i>
                            <h3 class="text-xl font-semibold">
                                Belum Ada Riwayat Aduan
                            </h3>
                            <p class="text-black/50 ">
                                Anda belum pernah membuat aduan.
                            </p>
                            <a
                                href="{{ route('aduan.create') }}"
                                class="bg-primary text-white px-4 py-2 rounded-lg"
                            >
                                Buat Aduan
                            </a>
                        </div>
                    @endif
                @else
                    <table class=" bg-white/50">
                    
                        <tr>
                            <th>Judul</th>
                            <th>
                                Dibuat
                            </th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($data_aduan as $aduan)                        
                            <tr>
                                <td>
                                    <a class="text-primary hover:underline" href="/aduan-ku/{{ $aduan['id'] }}">
                                        {{ Str::limit($aduan['judul'], 50) }}
                                    </a>
                                </td>
                                <td>{{ $aduan->created_at->diffForhumans() }}</td>
                                <td>{{ ucfirst($aduan['jenis_aduan']) }}</td>
                                <td>
                                    <div class="flex items-center gap-2">
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
                @endif
                
                
            </div>
            <div class="w-full flex justify-center">        
                <x-pagination :data="$data_aduan"/>            
            </div>
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/live-search.js')
    @endpush
</x-home-layout>