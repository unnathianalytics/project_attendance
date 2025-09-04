<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ \App\Models\Company::first()->name ?? 'Login' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
    <meta name="supported-color-schemes" content="light dark">
    @include('layouts.style')
</head>

<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        @include('layouts.navigation')
        <main class="app-main">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @include('layouts.js')
    @stack('scripts')
</body>

</html>
