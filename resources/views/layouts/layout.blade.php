<!DOCTYPE html>
<html lang="pt" class="h-100">

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
        
        .fs-14 {
            font-size: 1.4rem;
        }

        .fs-15 {
            font-size: 1.5rem;
        }
        
        .fs-16 {
            font-size: 1.6rem;
        }
        
        .fs-16-mobile {
            font-size: 1.6rem;
        }
       
        .fs-17 {
            font-size: 1.61rem;
        }
        
        .fs-18 {
            font-size: 1.8rem;
        }
        
        .fs-19 {
            font-size: 1.9rem;
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
            height: 20dvh;
            background-color: #003366;
        }

        @media (min-width: 992px) {
            nav {
                height: 5dvh;
            }
        }
    </style>
    @yield('css')
</head>

<body class="h-100">
    <nav class="py-3 d-flex gap-4 justify-content-center align-items-center justify-content-md-end px-lg-5">
        <a class="text-black d-inline-block roboto fs-18 fw-normal" href="http://">Publicar uma vaga</a>
        <hr class="vr my-0">
        <a class="text-black d-inline-block roboto fs-18 fw-normal me-lg-4" href="http://">Painel</a>
    </nav>
    <header class="d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <h1 class="text-white roboto fs-32"><strong>Vagas Maceió</strong></h1>
            <h2 class="text-white montserrat fs-20 fw-normal mb-0">Conectando você com o futuro.</h2>
        </div>
    </header>
    @yield('content')
    @yield('scripts')
</body>

</html>
