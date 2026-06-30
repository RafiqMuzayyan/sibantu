<x-dashboard-layout>
    <x-slot:header>      
        <h1 class="text-3xl font-bold text-black">Data Aduan</h1>
    </x-slot:header>
    <div class="flex flex-col flex-1 h-fit bg-egg my-shadow p-4 rounded-md gap-4">
        <form 
            method="GET"
            action="{{ route('data_aduan') }}" 
            class="flex gap-2 flex-col-reverse md:flex-row items-center justify-end">
            <div class="w-full md:w-fit">
                <input 
                    type="text" 
                    id="search"
                    placeholder="Cari Aduan atau Pelapor"
                    name="search" 
                    class=" p-2 rounded-md border bg-primary/50 text-white w-full"
                    value="{{ request('search') }}"
                >
            </div>
            <div class="w-full md:w-fit flex justify-end items-center gap-1 sm:gap-2"  >
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
        <div>
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
                            href="{{ route('data_aduan') }}"
                            class="bg-primary text-white px-4 py-2 rounded-lg"
                        >
                            Reset Filter
                        </a>
                    </div>
                @else
                    <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                        <h3 class="text-xl font-semibold">
                            Belum Ada Aduan dari Masyarakat
                        </h3>
                    </div>
                @endif
            @else
            <table class=" bg-white/50 my-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>
                            Pelapor
                        </th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach ($data_aduan as $aduan)            
                <tr>
                    <td data-label="Judul"><a class="text-primary hover:underline line-clamp-1" href="{{ route('aduan', $aduan) }}"> {{ Str::limit($aduan['judul'], 50) }} </a></td>
                    <td data-label="Pelapor">{{ $aduan->user->nama }}</td>
                    <td data-label="Kategori">{{ ucfirst(str_replace('_', ' ', $aduan['jenis_aduan'])) }}</td>
                    <td data-label="Tangal">{{ $aduan->created_at->translatedFormat('d F Y') }}</td>
                    <td data-label="Status">
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
                    <td data-label="Aksi">
                        <div class="flex items-center gap-2 justify-end md:justify-start">
                            <form
                                action="{{ route('admin.aduan.destroy', $aduan) }}"
                                method="POST"
                                x-ref="deleteForm{{ $aduan->id }}"
                            >
                            @csrf
                            @method('DELETE')
                            <button 
                                class="bg-ditolak flex w-7  h-7 rounded text-white justify-center items-center cursor-pointer" 
                                type="button"
                                @click="
                                    open({
                                        title: 'Hapus Aduan',
                                        message: 'Yakin ingin menghapus aduan ini?',
                                        form: $refs['deleteForm{{ $aduan->id }}']
                                    })
                                "
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            </form>
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
    @push('scripts')
        @vite('resources/js/live-search.js')
    @endpush
</x-dashboard-layout>