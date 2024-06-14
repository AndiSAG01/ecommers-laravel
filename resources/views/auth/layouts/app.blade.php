<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('backend/img/favicon/icon.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap">

    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}" type="text/css">
</head>
<body>
    <main class="d-flex w-100">
        @yield('content')
    </main>

    <script src="{{ asset('backend/js/app.js') }}"></script>
</body>
</html>
