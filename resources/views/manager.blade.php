<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst(Route::currentRouteName()) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/live-search.js'])
</head>
<body class="max-w-7xl px-4 py-8 mx-auto min-h-screen" x-data="confirmModal">
        <x-confirm-modal />
        <div class="mb-8 flex justify-between items-center w-full">
            <div class="">
                <h1 class="text-4xl font-bold text-primary">
                    Dashboard Manajer
                </h1>
    
                <p class="text-black/60 mt-2">
                    Ringkasan data laporan Sistem SiBantu
                </p>
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
                    class="bg-primary px-4 py-2 text-white cursor-pointer rounded-xl"
                >
                    Log Out
                </button>
            </form>
        </div>

        <div class="flex flex-col gap-8">
            <div>
                <div class="flex flex-col bg-primary gap-2 p-4 my-shadow rounded-xl  text-white max-w-100">
                    <h3 class="font-semibold">
                        <i class="fa-solid fa-list"></i> 
                        Total Laporan
                    </h3>
                    <p class="font-bold text-5xl">
                        {{ $total_laporan }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-8">
                <div>
                    <h1 class="text-2xl font-semibold text-black">
                        Data Laporan
                    </h1>

                    <p class="text-black/60 mt-1">
                        Daftar laporan yang telah dibuat oleh administrator.
                    </p>
                </div>
                <div class="flex flex-col flex-1 h-fit bg-egg my-shadow p-4 rounded-md gap-4">
                    <form 
                        method="GET"
                        action="{{ route('manager') }}" 
                        class="flex gap-2 items-center justify-end">
                        <div>
                            <input 
                                type="text" 
                                id="search"
                                placeholder="Cari judul laporan . . ."
                                name="search" 
                                class=" p-2 rounded-md border bg-primary/50 text-white"
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
                                    <h3 class="text-xl ">
                                        Belum ada laporan yang tersedia.
                                        Laporan akan muncul setelah administrator membuat laporan.
                                    </h3>
                                </div>
                            @endif
                        @else
                        <table class=" bg-white/50">
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
                            @foreach ($data_laporan as $laporan)            
                            <tr>
                                <td>{{ $laporan->judul }}</td>
                                <td>
                                    @if (!$laporan->tanggal_mulai && !$laporan->tanggal_selesai)
                                        Semua Periode
                                    @else
                                        {{ $laporan->tanggal_mulai->translatedFormat('d F Y') }}
                                        <span class="text-pending">sampai</span>
                                        {{ $laporan->tanggal_selesai->translatedFormat('d F Y') }}
                                    @endif
                                </td> 
                                <td>{{ $laporan->user->nama }}</td>
                                <td>{{ $laporan->created_at->diffForhumans() }}</td>
                                <td>{{ $laporan->total_aduan }}</td>
                                <td>
                                    <div class="flex gap-2 items-center">
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
            </div>
        </div>


</body>
</html>