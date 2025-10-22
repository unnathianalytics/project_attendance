<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ \App\Models\Company::first()->name ?? 'Login' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    {{-- @include('layouts.style') --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    @include('layouts.navigation')
    <flux:main>
        @yield('content')
    </flux:main>

    @include('layouts.js')
    @stack('scripts')
</body>

</html>
