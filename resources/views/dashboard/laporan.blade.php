<x-dashboard-layout>

    <x-slot:header>
        <!-- HEADER -->
        <div class="flex items-stretch 
        2xl:items-center  2xl:justify-between flex-col 2
        2xl:flex-row">
    
            <h1 class="text-3xl  font-bold text-black">
                Laporan Periode Terpilih
            </h1>
    
            <form method="get" class="flex items-center justify-end gap-5">
    
                <div class="flex items-center gap-3">
    
                    <select name="kategori" class="px-4 py-2 rounded-xl border bg-primary text-white">
                         <option
                            value="semua"
                            @selected(request('kategori', 'semua') == 'semua')
                        >
                            Semua Kategori
                        </option>
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
    
                    <select name="status" class="px-4 py-2 rounded-xl border bg-primary text-white">
                         <option
                            value="semua"
                            @selected(request('status', 'semua') == 'semua')
                        >
                            Semua Status
                        </option>
                        <option
                            value="pending"
                            @selected(request('status') == 'pending')
                        >
                            Pending
                        </option>
                        <option
                            value="diproses"
                            @selected(request('status') == 'diproses')
                        >
                            Diproses
                        </option>
                        <option
                            value="selesai"
                            @selected(request('status') == 'selesai')
                        >
                            Selesai
                        </option>
                        <option
                            value="ditolak"
                            @selected(request('status') == 'ditolak')
                        >
                            Ditolak
                        </option>
                    </select>
    
                </div>
                <div class="w-px h-10 bg-black/20"></div>
                <div class="flex items-center gap-3">
    
                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="{{ request('tanggal_mulai') }}"
                        class="bg-primary text-white px-4 py-2 rounded-xl">
    
                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="{{ request('tanggal_selesai') }}"
                        class="bg-primary text-white px-4 py-2 rounded-xl">
    
                </div>
                <div class="w-px h-10 bg-black/20"></div>
                <button type="submit" class="px-4 py-2 rounded-xl font-semibold text-black border-2 cursor-pointer border-primary transition hover:bg-primary hover:text-white">
                    Tampilkan 
                </button>
            </form>
    
        </div>
    </x-slot:header>

    <!-- CONTENT -->
    <div class="flex gap-6 h-full">

        <!-- LEFT -->
        <div class="flex flex-1 flex-col gap-6">

            <div class="grid grid-cols-5 gap-4">
                <div class="flex flex-col bg-primary gap-2 p-4 my-shadow rounded-xl  text-white ">
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

            <!-- CHART -->
            <div class="w-full  bg-egg my-shadow rounded-xl p-4">

                <div class="flex justify-start mb-4 items-center">
                    <h2 class="text-2xl text-black font-semibold ">
                        Distribusi Jenis Aduan
                    </h2>
                </div>

                <div class="h-80  bg-white/50 py-2 px-4 rounded-xl">
                    @if(array_sum($values) === 0)
                        <div class="h-full flex items-center justify-center">
                            <p class="text-black/50">
                                Tidak ada data aduan.
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

            <!-- TABLE -->
           <div class="flex flex-col w-full h-fit bg-egg my-shadow p-4 rounded-md gap-4">
                <div class="flex items-center justify-start">
                    <h2 class="font-semibold text-xl text-black">
                        Data Aduan
                    </h2>
                </div>
                <div>
                    @if($data_aduan->isEmpty())
                        <div class="text-center py-10">
                            Tidak ada data untuk filter yang dipilih.
                        </div>
                    @else
                    <div class="max-h-80 overflow-y-auto">
                        <table class=" bg-white/50">
                            <tr>
                                <th>Judul</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                            @foreach ($data_aduan as $aduan)                             
                                <tr>
                                    <td>{{ Str::limit($aduan['judul'], 50) }}</td>
                                    <td>{{ $aduan->user->nama }}</td>
                                    <td>{{ $aduan['jenis_aduan'] }}</td>
                                    <td>{{ $aduan->created_at->translatedFormat('d F Y') }}</td>
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
                    </div>
                    @endif
                </div>
                
            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="w-80">

            <form
                class="flex flex-col bg-egg my-shadow rounded-2xl p-5 gap-6"
                method="POST"
                action="{{ route('laporan.generate') }}"
                id="generate-form"
            >
                @csrf
                <input
                    type="hidden"
                    name="tanggal_mulai"
                    value="{{ request('tanggal_mulai') }}"
                >
                <input
                    type="hidden"
                    name="tanggal_selesai"
                    value="{{ request('tanggal_selesai') }}"
                >
                <input
                    type="hidden"
                    name="kategori"
                    value="{{ request('kategori', 'semua') }}"
                >
                <input
                    type="hidden"
                    name="status"
                    value="{{ request('status', 'semua') }}"
                >
                <input
                    type="hidden"
                    name="chart"
                    id="chart-data"
                >
                <h2 class="font-semibold text-xl text-black">
                    Detail Laporan
                </h2>

                <div class="flex flex-col gap-4">

                    <div>
                        <p class="font-semibold text-black mb-1">
                            Judul
                        </p>
                        <input
                            type="text"
                            name="judul_laporan"
                            placeholder="Judul Laporan . . ."
                            class="text-black/80 bg-white/50 rounded-xl px-4 py-2 leading-6 w-full"
                            required
                        >
                        @error('judul_laporan')                      
                            <p class=" text-ditolak mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="w-full h-px bg-primary/20"></div>

                    <div>
                        <p class="font-semibold text-black mb-1">
                            Rentang Waktu
                        </p>
                        <p class="text-black/80">
                            @if(request('tanggal_mulai') && request('tanggal_selesai'))
                                {{ \Carbon\Carbon::parse(request('tanggal_mulai'))->translatedFormat('d F Y') }}
                                -
                                {{ \Carbon\Carbon::parse(request('tanggal_selesai'))->translatedFormat('d F Y') }}
                            @else
                                Semua Periode
                            @endif
                        </p>
                    </div>

                    <div class="w-full h-px bg-primary/20"></div>

                    <div>
                        <p class="font-semibold text-black mb-1">
                            Status
                        </p>
                        <p class="text-black/80">
                            {{ request('status', 'Semua') }}
                        </p>
                    </div>

                    <div class="w-full h-px bg-primary/20"></div>

                    <div>
                        <p class="font-semibold text-black mb-1">
                            Kategori
                        </p>
                        <p class="text-black/80">
                            
                            {{ request('kategori', 'Semua') }}
                        </p>
                    </div>

                    <div class="w-full h-px bg-primary/20"></div>

                    <textarea
                        name="deskripsi_laporan"
                        rows="5"
                        class="bg-white/50 rounded-xl p-4 leading-6"
                        placeholder="Deskripsi laporan..."
                    ></textarea>

                </div>



                <button
                    class="bg-primary text-white py-3 rounded-xl font-semibold hover:bg-primary-dark cursor-pointer" type="submit">
                    Buat Laporan
                </button>

            </form>

        </div>

    </div>
@push('scripts')
    @vite('resources/js/chart.js')
    <script>
        document
        .getElementById('generate-form')
        .addEventListener('submit', function () {

            const chart =
                Chart.getChart('dashboardChart');

            if (chart) {

                document
                    .getElementById('chart-data')
                    .value =
                        chart
                            .toBase64Image();

            }

        });
    </script>
@endpush
</x-dashboard-layout>