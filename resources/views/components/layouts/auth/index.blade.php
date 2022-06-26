<!DOCTYPE html>
<html lang="{{  str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link href="{{ asset(mix('administratix/css/app.css')) }}" rel="stylesheet" />
        @livewireStyles

        @yield('styles')
        @stack('styles')
    </head>
    <body>
        <x-dynamic-component :component="config('administratix.views.layouts.admin.components.sidebar')" />
        <x-dynamic-component :component="config('administratix.views.layouts.admin.components.navbar.index')" />
        <main class="w-full ml-256 mt-56">    
            <div class="main-content">
                {{ $slot }}
            </div>
            <x-dynamic-component :component="config('administratix.views.layouts.admin.components.footer')" />
        </main>
        
        @livewireScripts
        @yield('scripts')
        @stack('scripts')
    </body>
</html>