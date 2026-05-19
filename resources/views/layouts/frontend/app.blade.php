<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.frontend.meta')
    @vite(['resources/css/app.css', 'resources/css/frontend.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.frontend.partials.age-verification')

    <div id="app">
        @include('layouts.frontend.header')

        <main>
            @yield('content')
        </main>

        @include('layouts.frontend.footer')
    </div>

    @include('layouts.frontend.scripts')
</body>
</html>
