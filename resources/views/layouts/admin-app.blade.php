<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    {{-- Bootstrap 5 CDN CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 5 CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @yield('custom_css')

</head>

<body>
    @include('partials.admin-header')

    <main class="main-content">
        @yield('content')
    </main>

    @include('components.confirm-modal')
</body>

</html>