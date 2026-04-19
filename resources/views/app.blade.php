<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="appearance" content="{{ $appearance ?? 'system' }}">

        <script>
            (function () {
                var meta = document.querySelector('meta[name="appearance"]');
                var server = (meta && meta.getAttribute('content')) || 'system';
                if (server !== 'dark' && server !== 'light' && server !== 'system') {
                    server = 'system';
                }
                var stored = null;
                try {
                    stored = localStorage.getItem('appearance');
                } catch (e) {}
                var appearance = stored || server;
                if (appearance !== 'dark' && appearance !== 'light' && appearance !== 'system') {
                    appearance = 'system';
                }
                var dark =
                    appearance === 'dark' ||
                    (appearance === 'system' &&
                        window.matchMedia('(prefers-color-scheme: dark)').matches);
                document.documentElement.classList.toggle('dark', dark);
            })();
        </script>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon-16x16.png" sizes="16x16">
        <link rel="icon" href="/favicon-32x32.png" sizes="32x32">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">

        @vite(['resources/css/app.css', 'resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        <x-inertia::head>
            <title>{{ config('app.name', 'Companion') }}</title>
        </x-inertia::head>
    </head>
    <body class="font-sans antialiased">
        <x-inertia::app />
    </body>
</html>
