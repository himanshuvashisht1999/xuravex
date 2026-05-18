<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', ($gs['site_name'] ?? 'Xuravex'))</title>

<!-- Favicon -->
@if(isset($gs['site_favicon']))
    <link rel="icon" type="image/png" href="{{ asset('uploads/settings/' . $gs['site_favicon']) }}">
@else
    <link rel="icon" type="image/png" href="https://via.placeholder.com/32x32?text=X">
@endif

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

@stack('css')
