<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-black font-rubik flex flex-col text-white w-full">
    <div class="content min-h-screen">
        <x-navigation-bar />
        @isset($slot)
            {{ $slot }}
        @endisset
        <x-footer />
    </div>

    @livewireScripts
</body>

</html>
