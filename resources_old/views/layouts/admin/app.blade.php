<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.admin.meta')
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-wrapper">
        @include('layouts.admin.sidebar')

        <div class="admin-main">
            @include('layouts.admin.header')

            <div class="admin-content">
                @yield('content')
            </div>

            <footer class="admin-footer">
                &copy; {{ date('Y') }} XURAVEX Admin Panel. All rights reserved.
            </footer>
        </div>
    </div>

    @include('layouts.admin.scripts')
</body>
</html>
