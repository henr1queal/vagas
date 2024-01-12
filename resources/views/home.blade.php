@extends('layouts.layout')
@section('title')
    Vagas Maceió
@endsection
@section('css')
    <style>
        aside {
            background-color: #CFC6C6;
            width: 30%;
            height: 100%;
        }

        main {
            width: 70%;
        }

        @media (min-width: 1024px) {
            .vacancy-wrapper {
                height: 75dvh;
            }

            .content {
                height: 82%;
            }

            .search {
                height: 8%;
            }

            #input-search {
                width: 70%;
            }

            form button {
                width: 30%;
            }
        }

        #input-search {
            background-image: url(https://www.w3schools.com/css/searchicon.png);
            background-position: center left 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
        }

        .date {
            top: -30px;
            left: 15px;
            width: 50px;
            height: 50px;
            background-color: #f7eded;
            -webkit-box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
        }

        .daily {
            -webkit-box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            border: 1px solid #edecec;
        }

        .title {
            color: #003366;
        }

        .my-6 {
            margin-top: 5rem !important;
            margin-bottom: 5rem !important;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex vacancy-wrapper">
        <aside class="d-flex justify-content-center align-items-center flex-wrap">
            <h4 class="text-black montserrat fs-20 fw-normal"><strong>Filtros:</strong></h4>
        </aside>
        <main class="row m-0 justify-content-center align-items-center h-100" style="background-color: #e5e5e5;">
            <div class="col-lg-11 search px-0">
                <form class="d-flex montserrat h-100 gap-4">
                    <input class="form-control me-2 fs-16 fw-normal border-dark" type="search" id="input-search"
                        placeholder="Busque aqui pela área de seu interesse..." aria-label="Search">
                    <button class="btn btn-success fs-16" type="submit"><strong>Buscar</strong></button>
                </form>
            </div>
            <div class="col-lg-11 overflow-auto content ps-0">
                <h2 class="montserrat fs-24 text-center pb-4"><strong>Vagas em aberto (325):</strong></h2>
                <div class="row bg-white my-6 py-5 m-0 position-relative rounded-3 daily">
                    <div class="py-2"></div>
                    <div
                        class="d-flex flex-column justify-content-center border-1 border-dark text-center rounded-3 position-absolute date">
                        <p class="text-black montserrat fs-18 mb-0"><strong>12</strong></p>
                        <p class="text-black montserrat fs-15 mb-0">Jan.</p>
                    </div>
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                </div>
                <div class="row bg-white my-6 py-5 m-0 position-relative rounded-3 daily">
                    <div class="py-2"></div>
                    <div
                        class="d-flex flex-column justify-content-center border-1 border-dark text-center rounded-3 position-absolute date">
                        <p class="text-black montserrat fs-18 mb-0"><strong>12</strong></p>
                        <p class="text-black montserrat fs-15 mb-0">Jan.</p>
                    </div>
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                </div>
                <div class="row bg-white my-6 py-5 m-0 position-relative rounded-3 daily">
                    <div class="py-2"></div>
                    <div
                        class="d-flex flex-column justify-content-center border-1 border-dark text-center rounded-3 position-absolute date">
                        <p class="text-black montserrat fs-18 mb-0"><strong>12</strong></p>
                        <p class="text-black montserrat fs-15 mb-0">Jan.</p>
                    </div>
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar Empresa:
                            Confidencial.</h3>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
