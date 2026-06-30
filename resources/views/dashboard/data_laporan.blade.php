<x-dashboard-layout>
    <x-slot:header>    
        <div class="w-full flex justify-between items-center">
            <h1 class="text-3xl font-bold text-black">Data Laporan</h1>
            <a href="{{ route('laporan') }}" class="bg-primary text-white font-semibold px-4 py-2 rounded-xl">Buat laporan</a>
        </div>  
    </x-slot:header>
    <div class="flex flex-col flex-1 h-fit bg-egg my-shadow p-4 rounded-md gap-4">
        <form 
            method="GET"
            action="{{ route('data_laporan') }}" 
            class="flex gap-2 items-center justify-end">
            <div class="w-full md:w-fit">
                <input 
                    type="text" 
                    id="search"
                    placeholder="Cari judul laporan . . ."
                    name="search" 
                    class=" p-2 rounded-md border bg-primary/50 text-white w-full"
                    value="{{ request('search') }}"
                >
            </div>
        </form>
        <div>
            @if($data_laporan->isEmpty())
                @if(request()->hasAny(['search', 'kategori', 'status']))
                        <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                        <i class="fa-solid fa-magnifying-glass text-5xl text-black/30"></i>
                        <h3 class="text-xl font-semibold">
                            Tidak Ada Hasil
                        </h3>
                        <p class="text-black/50">
                            Tidak ditemukan laporan yang sesuai dengan filter.
                        </p>
                        <a
                            href="{{ route('data_laporan') }}"
                            class="bg-primary text-white px-4 py-2 rounded-lg"
                        >
                            Reset Filter
                        </a>
                    </div>
                @else
                    <div class="flex flex-col gap-4 justify-center items-center w-full bg-white/50 rounded-xl p-8 text-center">
                        <h3 class="text-xl font-semibold">
                            Belum Ada laporan
                        </h3>
                    </div>
                @endif
            @else
            <table class=" bg-white/50 my-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>
                            Periode
                        </th>
                        <th>Total Aduan</th>
                        <th>Dibuat Oleh</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach ($data_laporan as $laporan)            
                <tr>
                    <td data-label="Judul">{{ $laporan->judul }}</td>
                    <td data-label="Periode">
                        @if (!$laporan->tanggal_mulai && !$laporan->tanggal_selesai)
                            Semua Periode
                        @else
                            {{ $laporan->tanggal_mulai->translatedFormat('d F Y') }}
                            <span class="text-pending">sampai</span>
                            {{ $laporan->tanggal_selesai->translatedFormat('d F Y') }}
                        @endif
                    </td > 
                    <td data-label="Total Aduan">{{ $laporan->total_aduan }}</td>
                    <td data-label="Dibuat Oleh">{{ $laporan->user->nama }}</td>
                    <td data-label="Tanggal">{{ $laporan->created_at->translatedFormat('d F Y') }}</td>
                    <td data-label="Aksi">
                        <div class="flex gap-2 items-center justify-end md:justify-start">
                            <a class="font-semibold bg-primary text-white px-4 py-1 rounded" href="{{ asset('storage/' . $laporan->file) }}" target="_blank">lihat</a>
                            <a class="font-semibold bg-primary text-white px-4 py-1 rounded" href="{{ asset('storage/' . $laporan->file) }}" download>Download</a>
                        </div>
                    </td>
                </tr>
                @endforeach

               
            </table>
            @endif
        </div>
        <div class="w-full flex justify-center">        
            <x-pagination :data="$data_laporan"/>        
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/live-search.js')
    @endpush
</x-dashboard-layout>