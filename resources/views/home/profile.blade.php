<x-home-layout>
    <x-slot:header>
        <h1 class="text-3xl font-bold text-black flex items-center gap-3">
            <i class="fa-solid fa-user text-primary"></i>
            <span>Profile</span>
        </h1>
    </x-slot:header>
    <form action="{{ route('profile.update') }}" method="POST"  class="text-black" x-data="{ edit: false }">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-4 p-4">
            <label for="" class="font-semibold text-xl">Nama</label>
            <input 
                type="text" 
                value="{{ $user['nama'] }}"
                name="nama"
                class="border-b-2 py-2 outline-0"
                :readonly="!edit"
                
            >
            @error('nama')
                <p class="text-ditolak text-sm">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-col sm:flex-row gap-4 w-full">
            <div class="flex flex-col gap-4 p-4 sm:w-[50%]">
                <label for="" class="font-semibold text-xl">NIK</label>
                <input 
                    type="number" 
                    value="{{ $user['nik'] }}"
                    name="nik"
                    class="border-b-2 py-2 outline-0"
                    readonly
                >
            </div>
            <div class="flex flex-col gap-4 p-4 sm:w-[50%]">
                <label for="" class="font-semibold text-xl">Email</label>
                <input 
                    type="email" 
                    value="{{ $user['email'] }}"
                    name="email"
                    class="border-b-2 py-2 outline-0"
                    :readonly="!edit"
                >
                @error('email')
                    <p class="text-ditolak text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4" x-show="edit">
            <div class="flex flex-col gap-4 p-4 sm:col-span-2">
                <label for="" class="font-semibold text-xl">Password Lama</label>
                <input 
                    type="password" 
                    name="password_sekarang"
                    class="border-b-2 py-2 outline-0"
                    :readonly="!edit"
                >
            </div>
            <div class="flex flex-col gap-4 p-4">
                <label for="" class="font-semibold text-xl">Password Baru</label>
                <input 
                    type="password" 
                    name="password"
                    class="border-b-2 py-2 outline-0"
                    :readonly="!edit"
                >
            </div>
            <div class="flex flex-col gap-4 p-4">
                <label for="" class="font-semibold text-xl">  Konfirmasi Password Baru </label>
                <input 
                    type="password" 
                    name="password_confirmation"
                    class="border-b-2 py-2 outline-0"
                    :readonly="!edit"
                >
            </div>
        </div>
        
        <div class="flex flex-col gap-4 p-4" x-show="!edit">
            <label for="" class="font-semibold text-xl">Password</label>
            <input 
                type="password" 
                value="*******"
                class="border-b-2 py-2 outline-0"
                readonly
            >
        </div>
        <div class="ps-4">
            @error('password_sekarang')
                <p class="text-ditolak text-sm">
                    {{ $message }}
                </p>
            @enderror
            @error('password')
                <p class="text-ditolak text-sm">
                    {{ $message }}
                </p>
            @enderror
            @error('password_konfirmasi')
                <p class="text-ditolak text-sm">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <div class="flex gap-4 p-4" x-show="!edit">
                <button 
                    type="button"
                    @click="
                        open({
                            title: 'Log Out',
                            message: 'Apakah anda ingin keluar?',
                            form: $refs.logout
                        })
                    "
                    class="bg-red-500 px-4 py-2 rounded text-white cursor-pointer hover:bg-red-700"
                    x-show="!edit"
                >
                    Log Out
                </button>
                <button @click="edit = true" class="bg-yellow-500 px-4 py-2 rounded text-white cursor-pointer hover:bg-yellow-600"  type="button" x-show="!edit">
                    Edit Profile
                </button>
            </div>
            <div class="flex gap-4 p-4">
                <button @click="edit = false"  class="bg-red-500 px-4 py-2 rounded text-white cursor-pointer hover:bg-red-700" type="button" x-show="edit">
                    Cancel
                </button>
                <button @click="edit = false" class="bg-primary px-4 py-2 rounded text-white cursor-pointer hover:bg-primary-dark" x-show="edit" type="submit">
                    Submit
                </button >
            </div>
        </div>
    </form>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" x-ref="logout">
        @csrf
    </form>
</x-home-layout>