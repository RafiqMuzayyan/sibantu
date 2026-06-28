<x-home-layout>

    @php
        $isEdit = isset($aduan);
    @endphp

    <div class="flex flex-col flex-1 px-4 py-8">
        <form
            action="{{ $isEdit ? route('aduan.update', $aduan->id) : route('aduan.store') }}"
            method="POST"
            class="flex gap-8"
            enctype="multipart/form-data"
        >
            @csrf

            @if ($isEdit)
                @method('PUT')
            @endif

            <div class="flex flex-1 flex-col">

                <div class="flex flex-col gap-4 mb-4 w-full">

                    <input
                        class="text-4xl font-bold text-primary outline-0"
                        value="{{ old('judul', $aduan->judul ?? '') }}"
                        placeholder="Judul disini"
                        name="judul"
                        required
                    />
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1 border-y border-black py-2 w-fit">
                            {{ $message }}
                        </p>
                    @enderror
                    <textarea
                        name="deskripsi"
                        class="text-base leading-7 text-black/80 p-2 rounded w-full outline-1"
                        placeholder="Isi deskripsi aduan . . . ."
                        required
                    >{{ old('deskripsi', $aduan->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1 border-y border-black py-2 w-fit">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div
                    id="map"
                    class="w-full h-105 bg-egg rounded-xl overflow-hidden mb-4"
                ></div>

                <input
                    type="hidden"
                    id="latitude"
                    name="latitude"
                    value="{{ old('latitude', $aduan->latitude ?? '') }}"
                >

                <input
                    type="hidden"
                    id="longitude"
                    name="longitude"
                    value="{{ old('longitude', $aduan->longitude ?? '') }}"
                >

                <button
                    type="submit"
                    class="bg-primary py-2 font-semibold text-white rounded-xl cursor-pointer hover:bg-primary-dark"
                >
                    {{ $isEdit ? 'Simpan Perubahan' : 'Buat Aduan' }}
                </button>

                <div id="hapus-bukti-container"></div>
            </div>

            <aside class="w-105 flex flex-col gap-4">

                <div class="bg-egg rounded-xl p-5">
                    <div class="flex justify-between items-center w-full mb-4">
                        <h2 class="text-xl font-semibold text-black ">
                            Bukti
                        </h2>                 
                        <label
                            for="bukti"
                            class="cursor-pointer bg-primary text-white rounded-lg  items-center w-9 h-9 flex justify-center">
                            <i class="fa-solid fa-upload"></i>
                        </label>
                        <input
                            type="file"
                            name="bukti[]"
                            id="bukti"
                            multiple
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="hidden"
                        />           
                    </div>
                    @error('bukti')
                        <div class="bg-red-200 text-red-700 px-4 py-2 rounded-lg mb-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div
                        id="bukti-message"
                        class="hidden bg-red-200 text-red-700 px-4 py-3 rounded-lg mb-2"
                    ></div>
                    @if ($isEdit)     
                    <h3 class="font-semibold text-sm text-black mb-2">
                        Bukti Tersimpan
                    </h3>
                    @endif
                    <div id="bukti-lama" class="flex flex-col gap-3">
                        @if($isEdit)

                            @foreach($aduan->bukti as $bukti)

                                <div data-bukti-id="{{ $bukti->id }}" class="flex items-center justify-between p-4 bg-white/50 rounded-lg">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center">

                                            @if(Str::endsWith($bukti->nama_asli, '.pdf'))
                                                <i class="fa-solid fa-file-pdf text-primary"></i>
                                            @else
                                                <i class="fa-solid fa-file-image text-primary"></i>
                                            @endif

                                        </div>

                                        <div>

                                            <a 
                                                href="{{ asset('storage/' . $bukti->file) }}"
                                                target="_blank" 
                                                class="font-medium text-black">
                                                {{ Str::limit($bukti->nama_asli, 20) }}
                                            </a>

                                            <p class="text-xs text-black/50">
                                                Bukti tersimpan
                                            </p>

                                        </div>

                                    </div>

                                    <div class="flex gap-2">

                                        <a
                                            href="{{ asset('storage/' . $bukti->file) }}"
                                            download="{{ $bukti->nama_asli }}"
                                            class="cursor-pointer p-2 rounded-lg bg-primary text-white"
                                        >
                                            <i class="fa-solid fa-arrow-down"></i>
                                        </a>

                                        <button
                                            type="button"
                                            class="hapus-bukti-lama cursor-pointer p-2 rounded-lg bg-red-500 text-white"
                                            data-id="{{ $bukti->id }}"
                                        >
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>

                                    </div>

                                </div>

                            @endforeach

                        @endif
                       
                    </div>
                    @if ($isEdit)                    
                        <h3 class="font-semibold text-sm text-black my-2">
                            Bukti Baru
                        </h3>
                    @endif
                    <div id="preview-bukti" class="flex flex-col gap-3" data-existing-count="{{ $isEdit ? $aduan->bukti->count() : 0 }}">
                    </div>

                </div>
                
                <div class="bg-egg rounded-xl p-5">
                    @error('jenis_aduan')
                        <div class="bg-red-200 text-red-700 px-4 py-2 rounded-lg mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('lokasi')
                        <div class="bg-red-200 text-red-700 px-4 py-2 rounded-lg mb-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="flex flex-col gap-3">

                        <div class="flex items-center justify-between bg-white/50 rounded-lg px-4 py-3">

                            <span class="text-sm font-medium">
                                Jenis
                            </span>

                            <select name="jenis_aduan" id="jenis_aduan" required>

                                <option value="" disabled selected>
                                    Pilih Jenis Aduan
                                </option>

                               <option
                                    value="sembako"
                                    @selected(old('jenis_aduan', $aduan->jenis_aduan ?? request('jenis')) == 'sembako')
                                >
                                    Sembako
                                </option>

                                <option
                                    value="hunian sementara"
                                    @selected(old('jenis_aduan', $aduan->jenis_aduan ?? request('jenis')) == 'hunian sementara')
                                >
                                    Hunian Sementara
                                </option>

                                <option
                                    value="pakaian"
                                    @selected(old('jenis_aduan', $aduan->jenis_aduan ?? request('jenis')) == 'pakaian')
                                >
                                    Pakaian
                                </option>

                            </select>

                        </div>

                        <div class="flex flex-col gap-2 bg-white/50 rounded-lg px-4 py-3">

                            <span class="text-sm font-medium">
                                Lokasi :
                            </span>

                            <textarea
                                class="p-0.5 outline-0"
                                name="lokasi"
                                id="lokasi"
                                placeholder="Klik Lokasi Pada Peta"
                                required
                            >{{ old('lokasi', $aduan->lokasi ?? '') }}</textarea>
                           
                        </div>
        
                    </div>

                </div>

            </aside>

        </form>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        @vite('resources/js/edit-bukti.js')
        @vite('resources/js/aduan-map.js')
        @vite('resources/js/preview-bukti.js')
    @endpush

</x-home-layout>