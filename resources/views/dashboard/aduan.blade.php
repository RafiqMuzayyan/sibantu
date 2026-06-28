<x-dashboard-layout>
    <div class="flex flex-col flex-1 px-4 py-8">
        <div class="flex gap-8">
            <div class="flex flex-1 flex-col gap-4">
                <div class="mb-4">
                    <h1 class="text-4xl font-bold text-primary mb-4">
                        {{ $aduan['judul'] }}
                    </h1>
                    <p class="text-base leading-7 text-black/80 max-w-4xl">
                        {{ $aduan['deskripsi'] }}
                    </p>
                </div>
                <div    
                    id="map" 
                    data-lat="{{ $aduan->latitude }}"
                    data-lng="{{ $aduan->longitude }}" 
                    class="w-full h-105 bg-egg rounded-xl overflow-hidden"
                >
                </div>
                <div class="flex gap-2">
                    @if($aduan->status === 'pending')
                        <div class="flex gap-2">
                            <form
                                action="{{ route('aduan.status', $aduan) }}"
                                method="POST"
                                x-ref="proses"
                            >
                                @csrf
                                @method('PATCH')
                                <input
                                    type="hidden"
                                    name="status"
                                    value="diproses"
                                >
                                <button
                                    class="bg-diproses text-white px-4 py-2 rounded-lg cursor-pointer"
                                    type="button"
                                    @click="
                                        open({
                                            title: 'Tolak Aduan',
                                            message: 'Yakin ingin mengubah status aduan ini?',
                                            form: $refs.proses
                                        })
                                    "
                                >
                                    Proses
                                </button>
                            </form>
                            <form
                                action="{{ route('aduan.status', $aduan) }}"
                                method="POST"
                                x-ref="tolak"
                            >
                                @csrf
                                @method('PATCH')
                                <input
                                    type="hidden"
                                    name="status"
                                    value="ditolak"
                                >
                                <button
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg cursor-pointer"
                                    type="button"
                                    @click="
                                        open({
                                            title: 'Tolak Aduan',
                                            message: 'Yakin ingin mengubah status aduan ini?',
                                            form: $refs.tolak
                                        })
                                    "
                                >
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                    @if($aduan->status === 'diproses')
                        <form
                            action="{{ route('aduan.status', $aduan) }}"
                            method="POST"
                            x-ref="selesai"
                        >
                            @csrf
                            @method('PATCH')
                            <input
                                type="hidden"
                                name="status"
                                value="selesai"
                            >
                            <button
                                class="bg-primary text-white px-4 py-2 rounded-lg cursor-pointer"
                                type="button"
                                @click="
                                    open({
                                        title: 'Selesaikan Aduan',
                                        message: 'Yakin ingin mengubah status aduan ini?',
                                        form: $refs.selesai
                                    })
                                "
                            >
                                Selesaikan
                            </button>
                        </form>
                    @endif
                    <form
                        action="{{ route('admin.aduan.destroy', $aduan) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg cursor-pointer"
                            type="button"
                            x-ref="delete"
                            @click="
                                open({
                                    title: 'Hapus Aduan',
                                    message: 'Yakin ingin menghapus aduan ini?',
                                    form: $refs.delete
                                })
                            "
                        >
                            Hapus
                        </button>

                    </form>
                    
                </div>
            </div>
            <aside class="w-105 flex flex-col gap-5">
                
                <div class="bg-egg rounded-xl p-5 my-shadow">
                    <h2 class="text-xl font-semibold text-black mb-4">
                        Bukti
                    </h2>
                    <div class="flex flex-col gap-3">
                        @if($aduan->bukti->isEmpty())
                            <p class="text-black/50">
                                Belum ada bukti yang diunggah.
                            </p>
                        @endif
                        @foreach ($aduan->bukti as $bukti)
                            <div class="flex items-center justify-between p-4 bg-white/50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-white flex items-center justify-center">
                                        @if(Str::endsWith($bukti->nama_asli, '.pdf'))
                                            <i class="fa-solid fa-file-pdf text-primary"></i>
                                        @else
                                            <i class="fa-solid fa-file-image text-primary"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <a 
                                            class="font-medium text-black"
                                            href="{{ asset('storage/' . $bukti->file) }}"
                                            target="_blank"
                                        >
                                             {{ Str::limit($bukti->nama_asli, 20) }}
                                        </a>
                                        <p class="text-xs text-black/50">
                                            Dokumen Pendukung
                                        </p>
                                    </div>
                                </div>
                                <a
                                    class="cursor-pointer p-2 rounded-lg bg-primary text-white"
                                    href="{{ asset('storage/' . $bukti->file) }}"
                                    download="{{ $bukti->nama_asli }}"
                                >
                                    <i class="fa-solid fa-arrow-down"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-egg rounded-xl p-5 my-shadow">
                    <h2 class="text-xl font-semibold text-black mb-4">
                        Status Aduan
                    </h2>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between bg-white/50 rounded-lg px-4 py-3">
                            <span class="text-sm font-medium">
                                Tanggal Pengajuan
                            </span>
                            <span class="text-sm font-semibold">
                                {{ $aduan->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <div
                            class="flex items-center justify-between bg-white/50 rounded-lg px-4 py-3">

                            <span class="text-sm font-medium">
                                Jenis
                            </span>

                            <span class="font-semibold text-black">
                                {{ ucfirst($aduan['jenis_aduan']) }}
                            </span>
                        </div>
                        <div
                            class="flex items-center justify-between bg-white/50 rounded-lg px-4 py-3">

                            <span class="text-sm font-medium">
                                Status
                            </span>

                            <span class="font-semibold text-primary">
                                {{ ucfirst($aduan['status']) }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-2 bg-white/50 rounded-lg px-4 py-3">
                            <span class="text-sm font-medium">
                                Lokasi :
                            </span>
                            <textarea 
                                class="p-0.5 outline-0" 
                                name="lokasi" 
                                id="lokasi"
                                disabled
                            >{{ $aduan['lokasi'] }}</textarea>
                        </div>
                    </div>
                </div>
                @if ($aduan->status === 'selesai')                
                    @if($aduan->feedback)
                        <div class="bg-egg rounded-xl p-5 my-shadow">
                            <h2 class="text-xl font-semibold mb-4 text-black">
                                Feedback Masyarakat
                            </h2>

                            <div class="bg-white/50 rounded-lg px-4 py-3">
                                <p>
                                    Rating:
                                    {{ str_repeat('⭐', $aduan->feedback->rating) }}
                                </p>
                                <p class="mt-3 text-black">
                                    {{ $aduan->feedback->komentar }}
                                </p>
                            </div>

                            <p class="text-sm text-black/50 mt-2">
                                Diberikan
                                {{ $aduan->feedback->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @else
                        <div class="bg-egg rounded-xl p-5 my-shadow">

                            <div class="bg-white/50 rounded-lg px-4 py-3">
                                <p>
                                    Belum ada Feedback dari masyarakat
                                </p>
                
                            </div>        
                        </div>
                    @endif
                @endif
            </aside>
        </div>
    </div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
     @vite('resources/js/detail-map.js')
@endpush
</x-dashboard-layout>