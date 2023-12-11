<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased bg-slate-100">
    <div class="min-h-screen md:flex max-w-screen-2xl mx-auto">

        <x-sidebar />

        <main class="p-2 px-4 md:px-2 w-full mt-20 md:mt-0">
            <x-main-card>
                {{ $slot }}
            </x-main-card>
        </main>

        @livewire('notifications')

        @filamentScripts
        @vite(['resources/js/app.js'])
    </div>
    </body>
</html>
