<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst(Route::currentRouteName()) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body   x-data="{...confirmModal(), openSidebar:false}">
    <x-flash-message />
    <!-- Mobile Navbar -->
    <div class="lg:hidden flex items-center justify-between p-4 bg-background shadow-sm sticky top-0 z-40">

        
        <a class="flex items-center gap-2" href="/dashboard">
            <img src="{{ asset('img/icon.png') }}" class="w-8">
            <h1 class="font-bold text-xl">
                Si<span class="text-primary">Bantu</span>
            </h1>
        </a>
        <button type="button" class="cursor-pointer" @click.stop="openSidebar = !openSidebar">

            <i
                :class="openSidebar
                    ? 'fa-solid fa-xmark'
                    : 'fa-solid fa-bars'"
                class="text-2xl text-primary"
            ></i>

        </button>

    </div>
    <div class="p-2 flex h-screen gap-2 relative">
        <x-sidebar />
        <div class=" flex flex-col w-full flex-1 ">
    
            {{-- head --}}
            @if (isset($header))
                <div class="py-7.5 ">
                    {{ $header }}
                </div>
            @endif
    
            <main class="flex flex-col gap-4 w-full h-fit">
                {{ $slot }}
            </main>
    
        </div>
    </div>
<x-confirm-modal />
@stack('scripts')

</body>
</html>