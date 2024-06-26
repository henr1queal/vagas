<!DOCTYPE html>
<html lang="pt" class="h-100">

<head>
    <meta name="robots" content="index, follow">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('public/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('public/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    @php
        $current_route = Route::current()->getName();
    @endphp
    @if ($current_route === 'vacancy')
        <meta name="keywords"
            content="{{ $vacancy->title }}, vagas em Maceió, empregos Maceió, vagas de emprego em maceió, vagas em alagoas, vagas de emprego em alagoas, oportunidades de trabalho, vagas de emprego">
        <meta name="description"
            content="Vaga de {{ $vacancy->title }} em Maceió/Alagoas aberta! Envie seu currículo até {{ $vacancy->days_avaliable->format('d/m/Y') }}!">
        <meta property="og:title" content="{{ $vacancy->title }} | VagasMaceio.com.br">
        <meta property="og:description"
            content="Vaga de {{ $vacancy->title }} em Maceió/Alagoas aberta! Envie seu currículo até {{ $vacancy->days_avaliable->format('d/m/Y') }}!">
    @else
        <meta name="keywords"
            content="vagas em Maceió, empregos Maceió, vagas de emprego em maceió, vagas em alagoas, vagas de emprego em alagoas, oportunidades de trabalho, vagas de emprego">
        <meta name="description"
            content="Encontre as melhores vagas de emprego em Maceió. Vagas atualizadas diariamente. Envie seu currículo agora!">
        <meta property="og:title" content="Vagas de emprego em Maceió | VagasMaceio.com.br">
        <meta property="og:description"
            content="Encontre as melhores vagas de emprego em Maceió. Vagas atualizadas diariamente. Envie seu currículo agora!">
    @endif
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TC62W5JBY8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TC62W5JBY8');
    </script>
    @php
        $currentUrl = url()->current();
        $newUrl = str_replace('://', '://www.', $currentUrl);
    @endphp
    @if ($current_route === 'home')
        <link rel="canonical" href="https://www.vagasmaceio.com.br/">
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    {{-- <meta property="og:image" content="URL_DA_SUA_IMAGEM"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    @yield('title')
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

        main,
        body {
            background-color: #e5e5e5;
        }

        footer {
            background-color: #003366;
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
            opacity: 0.5;
        }

        header {
            height: 15dvh;
            background-color: #003366;
        }

        footer {
            height: 10dvh;
        }

        @media (min-width: 992px) and (max-width: 1920px) {

            footer .first-div-footer,
            nav div {
                max-width: 93% !important;
            }
        }

        @media (min-width: 992px) {
            nav {
                height: 5dvh;
            }

            footer {
                height: 5dvh;
            }
        }

        .vacancy-wrapper {
            max-width: 1920px !important;
        }

        footer .first-div-footer,
        nav div {
            max-width: 1783px;
        }

        @media (max-width: 767px) {
            .logo {
                max-width: 120px;
            }
        }

        @media (min-width: 1921px) {
            footer>div {
                margin-left: auto !important;
                margin-right: auto !important;
                margin: 0 auto !important;
            }

            nav div,
            .vacancy-wrapper {
                margin: 0 auto !important;
                padding: 0 !important;
            }
        }
    </style>
    @yield('css')
</head>

<body class="h-100">
    <nav class="py-3">
        @if (isset($user_id))
            @if ($user_id === 1)
                @php
                    $is_admin = true;
                @endphp
            @endif
        @elseif(auth()->check() && auth()->user()->id === 1)
            @php
                $is_admin = true;
            @endphp
        @endif
        <div
            class="d-flex @if (isset($is_admin)) flex-column flex-lg-row gap-lg-4 gap-2 @else gap-4 @endif justify-content-center align-items-center justify-content-lg-end mx-auto h-100">
            @if (isset($is_admin))
                <a class="text-black d-inline-block roboto fs-18 fw-normal d-none"
                    href="{{ route('vacancy.create') }}">Publicar uma vaga</a>
                <hr class="vr my-0 d-none">
                <a class="text-black d-inline-block roboto fs-18 fw-normal" href="{{ route('dashboard') }}">Painel</a>
                <hr class="vr my-0 d-none d-lg-block">
                <a class="text-black d-inline-block roboto fs-18 fw-normal"
                    href="{{ route('vacancy.pendents') }}">Vagas pendentes</a>
            @else
                <a class="text-black d-inline-block roboto fs-18 fw-normal"
                    href="{{ route('vacancy.create') }}">Publicar uma vaga</a>
                <hr class="vr my-0 d-none d-lg-block">
                <a class="text-black d-inline-block roboto fs-18 fw-normal" href="{{ route('dashboard') }}">Painel</a>
            @endif
        </div>
    </nav>
    <header class="d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('public/logo.png') }}" alt="Vagas Maceió" class="img-fluid logo">
            </a>
            <h2 class="text-white montserrat fs-20 fw-normal mb-0 mt-3">Conectando você com o futuro.</h2>
        </div>
    </header>
    @yield('content')
    <footer>
        <div class="align-items-center row first-div-footer mx-auto h-100">
            <div class="col offset-lg-4 text-center">
                <p class="text-white montserrat fs-15 mb-0">© Vagas Maceió — {{ date('Y') }}</p>
            </div>
            <div class="col-lg-4 text-end pe-lg-0">
                <div class="d-flex flex-row gap-4 justify-content-center justify-content-lg-end align-items-center">
                    <p class="mb-0 fs-15 text-white montserrat me-lg-4">Nossas redes sociais:</p>
                    <a href="https://wa.me/558287738539" target="_blank" rel="noopener noreferrer"
                        aria-label="Visite nosso instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-whatsapp text-white" viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                        </svg>
                    </a>
                    <hr class="vr my-0 d-flex opacity-100 text-white" style="height: 20px;">
                    <a href="https://www.instagram.com/vagasmaceio.com.br/" target="_blank" rel="noopener noreferrer"
                        aria-label="Visite nosso instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-instagram text-white" viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    @yield('scripts')
</body>

</html>
