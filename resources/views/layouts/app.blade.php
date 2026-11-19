<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('kaonta.site_title') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-amber-50 text-slate-900">
    @include('partials.nav')
    @include('partials.flash')
    <main class="mx-auto max-w-6xl px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
