<x-dashboard-layout>
    <x-slot:header>      
        <h1 class="text-3xl font-bold text-black">Data Masyarakat</h1>
    </x-slot:header>
    <div class="flex flex-col flex-1 h-fit bg-egg my-shadow p-4 rounded-md gap-4">
        <div class="flex items-center justify-end">
            <form
                class="flex gap-2 items-center"
                method="GET"
                action="{{ route('masyarakat') }}" 
            >
                <div>
                    <input 
                        name="search" 
                        type="text" 
                        placeholder="Cari Masyarakat..." 
                        class=" p-2 rounded-md border bg-primary/50 text-white"
                        id="search"
                        value="{{ request('search') }}"
                    >
                </div>
                <div class="flex items-center gap-2">
                    <select
                        name="sort"
                        class="p-2 rounded-md border bg-primary text-white"
                        onchange="this.form.submit()"
                    >
                        <option value="desc" @selected(request('sort') == 'desc')>
                            Terbaru
                        </option>

                        <option value="asc" @selected(request('sort') == 'asc')>
                            Terlama
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div>
            @if($data_masyarakat->isEmpty())
                @if(request()->hasAny(['search', 'sortBy']))
                        <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                        <i class="fa-solid fa-magnifying-glass text-5xl text-black/30"></i>
                        <h3 class="text-xl font-semibold">
                            Tidak Ada Hasil
                        </h3>
                        <p class="text-black/50">
                            Tidak ditemukan masyarakat yang sesuai dengan filter.
                        </p>
                        <a
                            href="{{ route('masyarakat') }}"
                            class="bg-primary text-white px-4 py-2 rounded-lg"
                        >
                            Reset Filter
                        </a>
                    </div>
                @else
                    <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                        <h3 class="text-xl font-semibold">
                            Belum Ada Masyarakat
                        </h3>
                    </div>
                @endif
            @else
            <table class=" bg-white/50">
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>Jumlah Aduan</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($data_masyarakat as $masyarakat)                   
                    <tr>
                        <td>{{ $masyarakat['nama'] }}</td>
                        <td>{{ $masyarakat['nik'] }}</td>
                        <td>{{ $masyarakat['email'] }}</td>
                        <td>{{ $masyarakat['data_aduan_count'] }}</td>
                        <td>{{ $masyarakat->created_at->translatedFormat('d F Y') }}</td>
                        <td>
                            <a
                                href="{{ route('data_aduan', ['search' => $masyarakat -> nama]) }}"
                                class="font-semibold bg-primary text-white px-4 py-1 rounded"
                            >
                                Lihat Aduan
                            </a>
                        </td>
                    </tr>
                @endforeach

               
            </table>
            @endif
        </div>
        <div class="w-full flex justify-center">
            <x-pagination :data="$data_masyarakat"/>
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/live-search.js')
    @endpush
</x-dashboard-layout>