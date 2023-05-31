<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-gray-900 font-rubik text-white px-16">
    @isset($slot)
        {{ $slot }}
    @endisset
    @livewireScripts
</body>

</html>
