<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst(Route::currentRouteName()) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'] )
    @stack('styles')
</head>
<body class="max-w-400 mx-auto" x-data="confirmModal">
    <x-flash-message />
    <x-confirm-modal />
    <x-top-bar></x-top-bar>
    @if (isset($header))
        <div class="py-6 w-full mt-4 px-4 ">
            {{ $header }}
        </div>
    @endif
    <main>
        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>