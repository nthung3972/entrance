<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>My Laravel Appffefwefwef</h1>
        </header>
        
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
