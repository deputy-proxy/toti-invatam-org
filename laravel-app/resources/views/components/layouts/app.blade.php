<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? \App\Models\SiteSetting::get('seo_default_title','Împreună Învățăm') }}</title>
    <meta name="description" content="{{ $description ?? \App\Models\SiteSetting::get('seo_default_description','Fundația care conectează cunoașterea cu cei care au nevoie de ea.') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'Împreună Învățăm' }}">
    <meta property="og:description" content="{{ $description ?? '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&family=instrument-serif:400,400i&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col bg-white">
    <x-site-header />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-site-footer />

    @livewireScripts
</body>
</html>
