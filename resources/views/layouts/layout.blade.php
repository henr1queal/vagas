<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .roboto {
            font-family: 'Roboto', sans-serif;
        }

        .montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        html {
            font-size: 62.5%;
        }
        
        .fs-15 {
            font-size: 1.5rem;
        }
        
        .fs-16 {
            font-size: 1.6rem;
        }
        
        .fs-18 {
            font-size: 1.8rem;
        }
        
        .fs-20 {
            font-size: 2.0rem;
        }
        
        .fs-24 {
            font-size: 2.4rem;
        }

        .fs-32 {
            font-size: 3.2rem;
        }

        nav {
            background-color: #CFC6C6;
        }

        nav .vr {
            color: #686464;
            width: 2px;
            opacity: 0.5;
        }

        header {
            height: 25dvh;
            background-color: #003366;
        }
    </style>
    @yield('css')
</head>

<body>
    @yield('content')
    @yield('scripts')
</body>

</html>
