@extends('layouts.layout')
@section('title')
    {{$vacancy->title}} - Vagas Maceió
@endsection
@section('css')
    <style>
        aside {
            background-color: #CFC6C6;
            height: 100%;
        }

        .title {
            color: #003366;
            text-transform: uppercase;
        }

        @media(min-width: 992px) {
            aside {
                width: 30%;
                max-width: 500px;
            }

            .vacancy-wrapper {
                height: 75dvh;
            }

            .btn-submit {
                width: 30%;
            }
        }


        .btn-submit {
            background-color: #003366;
        }

        .btn-submit:hover {
            background-color: #157347;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex vacancy-wrapper">
        <aside class="d-none d-lg-flex justify-content-center py-4 pt-lg-5 details-desktop">
            <div class="d-flex flex-column gap-5 text-lg-center" id="details">
                <h3 class="fs-20 montserrat text-black d-none d-lg-block"><strong>Detalhes sobre a vaga:</strong></h3>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Postada em:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->created_at->format('d/m/Y') }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Empresa:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->company_name }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Tipo de trabalho:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->job_type }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Regime de contratação:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->employment_type }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Carga horária:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->workload }}h semanais</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Salário:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">R$ {{ $vacancy->salary }}</h4>
                    </div>
                </div>
            </div>
        </aside>
        <main class="row m-0 justify-content-center pt-5 py-lg-5 h-100 w-100">
            <div class="col-11 h-100 overflow-auto pb-5 pb-lg-0">
                <div class="d-flex flex-column gap-5">
                    <div class="d-flex flex-row justify-content-center gap-4 align-items-center">
                        <div class="d-none d-lg-flex flex-column justify-content-center cursor-pointer" onclick="goBack()"
                            type="button">
                            <span class="fs-14 montserrat text-black">voltar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto" width="30" height="30"
                                fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </div>
                        <div class="top-desc d-flex flex-column gap-2 text-center w-100">
                            <h2 class="title montserrat fs-24 mb-lg-0"><strong>{{ $vacancy->title }}</strong></h2>
                            <h3 class="fs-19 montserrat text-black d-lg-none"><strong>Detalhes sobre a vaga:</strong></h3>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <div class="details-mobile">
                        </div>
                        <div>
                            <h4 class="montserrat fs-18 text-black"><strong>Descrição da vaga:</strong></h4>
                            <p class="montserrat fs-18 text-black fw-medium">{{ $vacancy->description }}</p>
                        </div>
                        <button type="button" class="btn btn-submit text-white fs-18 montserrat py-4"><strong>Eu quero
                                esta vaga!</strong></button>
                                
                        <div class="d-flex d-lg-none flex-column justify-content-center cursor-pointer text-center" onclick="goBack()"
                            type="button">
                            <span class="fs-14 montserrat text-black">voltar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto" width="30" height="30"
                                fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('scripts')
    <script>
        function goBack() {
            if (window.history.length > 1) {
                var previousPage = document.referrer;

                if (previousPage.includes(window.location.origin)) {
                    window.history.back();
                } else {
                    window.location.href = '{{ route('home') }}';
                }
            } else {
                window.location.href = '{{ route('home') }}';
            }
        }
    </script>
    <script>
        function moveFormFilters(device) {
            let formFilters = document.getElementById('details');
            if (device === 'desktop') {
                var filter = document.querySelector('.details-desktop');
            } else {
                var filter = document.querySelector('.details-mobile');
            }

            filter.appendChild(formFilters);
        }

        function checkScreenWidth() {
            if (window.innerWidth >= 1024) {
                moveFormFilters('desktop');
            } else {
                moveFormFilters('mobile');
            }
        }

        window.addEventListener('resize', function() {
            checkScreenWidth();
        });

        document.addEventListener('DOMContentLoaded', function() {
            checkScreenWidth();
        });
    </script>
@endsection
