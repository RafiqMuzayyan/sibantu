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
<body class="p-2 flex h-screen gap-2 "  x-data="confirmModal">
    <x-flash-message />
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
<x-confirm-modal />
@stack('scripts')

</body>
</html>