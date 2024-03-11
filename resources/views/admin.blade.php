<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}" />
       
        <!-- Scripts -->
        @routes
        {{-- @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"]) --}}
        @vite(['resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="font-inter antialiased bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400">
        @inertia
        <div class="layout-wrapper layout-content-navbar">
           
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        {{-- @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv --}}
    </body>
</html>
