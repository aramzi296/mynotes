<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Laravel'))</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('styles')
    </head>
    <body class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
        <x-navbar />

        <main class="mx-auto max-w-4xl px-6 py-10 lg:px-8">
            @yield('content')
        </main>

        @yield('scripts')
    </body>
</html>
