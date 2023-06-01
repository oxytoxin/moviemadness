<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-black font-rubik text-white w-full">
    <x-navigation-bar />
    @isset($slot)
        {{ $slot }}
    @endisset
    <x-footer />

    @livewireScripts
</body>

</html>
