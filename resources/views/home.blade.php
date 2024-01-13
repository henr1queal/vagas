@extends('layouts.layout')
@section('title')
    Vagas Maceió
@endsection
@section('css')
    <style>
        aside {
            background-color: #CFC6C6;
            height: 100%;
        }

        .accordion-item, .accordion-button, .accordion-button:not(.collapsed) {
            background-color: #CFC6C6;
        }

        .accordion-button:not(.collapsed) {
            box-shadow: none;
        }

        .accordion-button:focus, .accordion-item {
            border: none;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed):after, .accordion-button:after {
            position: absolute;
            right: 5%;
        }

        aside .filter-wrapper {
            width: 91.3%;
        }

        #input-search::placeholder {
            font-size: 1.4rem;
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

            aside {
                width: 30%;
                max-width: 500px;
            }

            aside .filter-wrapper {
                width: auto;
            }

            .button-submit {
                position: absolute;
                bottom: 0;
            }
        }

        #input-search {
            background-image: url(https://www.w3schools.com/css/searchicon.png);
            background-position: center left 10px;
            background-repeat: no-repeat;
            padding: 12px 0px 12px 40px;
        }

        .date,
        .destaque {
            top: -30px;
            width: 50px;
            height: 50px;
            -webkit-box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
            box-shadow: 0 3px 0 0 rgba(0, 0, 0, .1);
        }

        .date {
            left: 15px;
            background-color: #f7eded;
        }

        .destaque {
            background-color: orange;
            left: 80px;
            width: fit-content;
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

        .btn-submit {
            background-color: #003366;
        }

        .btn-submit:hover {
            background-color: #157347;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex vacancy-wrapper flex-column flex-lg-row">
        <div class="accordion d-lg-none" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed py-4 text-black fs-20 montserrat" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong class="w-100 text-center">Filtros</strong>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body pt-0 pb-5">
                        <div class="filter-wrapper pt-lg-5 text-center text-lg-start">
                            <form action="" method="get" class="d-flex flex-column h-100 gap-4 gap-lg-5 position-relative">
                                <div class="work_type">
                                    <p class="fs-18 montserrat text-black mb-0">Tipo de trabalho:</p>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="work_type" id="estagio" value="Estágio"
                                            style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="estagio">Estágio</label>
                                    </div>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="work_type" id="trainee" value="Trainee"
                                            style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="trainee">Trainee</label>
                                    </div>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="work_type" id="Freelance" value="Freelance"
                                            style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="Freelance">Freelance</label>
                                    </div>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="work_type" id="tempo_integral"
                                            value="Tempo integral" style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="tempo_integral">Tempo
                                            integral</label>
                                    </div>
                                </div>
                                <div class="contract_type">
                                    <p class="fs-18 montserrat text-black mb-0">Regime de contratação:</p>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="contract_type" id="clt"
                                            value="CLT" style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="clt">CLT</label>
                                    </div>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="contract_type" id="pj"
                                            value="PJ" style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="pj">PJ</label>
                                    </div>
                                </div>
                                <div class="journey_hour">
                                    <p class="fs-18 montserrat text-black mb-0">Jornada de trabalho:</p>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="journey_hour" id="daytime" value="Diurno"
                                            style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="daytime">Diurno</label>
                                    </div>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="journey_hour" id="nocturnal"
                                            value="Noturno" style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="nocturnal">Noturno</label>
                                    </div>
                                    <div class="form-check align-items-center d-flex gap-3">
                                        <input class="form-check-input" type="radio" name="journey_hour" id="flex"
                                            value="Flexível" style="width: 15px; height: 15px;">
                                        <label class="form-check-label text-black montserrat fs-16" for="flex">Flexível</label>
                                    </div>
                                </div>
                                <div class="button-submit mt-3 mt-lg-0 mb-lg-5 pb-lg-5 w-100">
                                    <button type="submit"
                                        class="btn btn-submit text-white fs-18 montserrat w-100 align-self-end"><strong>Encontrar minha
                                            <br>vaga perfeita!</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <aside class="d-none d-lg-flex justify-content-center flex-wrap py-4 py-lg-0">
            <div class="filter-wrapper pt-lg-5 text-center text-lg-start">
                <form action="" method="get" class="d-flex flex-column h-100 gap-4 gap-lg-5 position-relative">
                    <h4 class="text-black montserrat fs-20 fw-normal text-center"><strong>Filtros:</strong></h4>
                    <div class="work_type">
                        <p class="fs-18 montserrat text-black mb-0">Tipo de trabalho:</p>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="work_type" id="estagio" value="Estágio"
                                style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="estagio">Estágio</label>
                        </div>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="work_type" id="trainee" value="Trainee"
                                style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="trainee">Trainee</label>
                        </div>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="work_type" id="Freelance" value="Freelance"
                                style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="Freelance">Freelance</label>
                        </div>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="work_type" id="tempo_integral"
                                value="Tempo integral" style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="tempo_integral">Tempo
                                integral</label>
                        </div>
                    </div>
                    <div class="contract_type">
                        <p class="fs-18 montserrat text-black mb-0">Regime de contratação:</p>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="contract_type" id="clt"
                                value="CLT" style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="clt">CLT</label>
                        </div>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="contract_type" id="pj"
                                value="PJ" style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="pj">PJ</label>
                        </div>
                    </div>
                    <div class="journey_hour">
                        <p class="fs-18 montserrat text-black mb-0">Jornada de trabalho:</p>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="journey_hour" id="daytime" value="Diurno"
                                style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="daytime">Diurno</label>
                        </div>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="journey_hour" id="nocturnal"
                                value="Noturno" style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="nocturnal">Noturno</label>
                        </div>
                        <div class="form-check align-items-center d-flex gap-3">
                            <input class="form-check-input" type="radio" name="journey_hour" id="flex"
                                value="Flexível" style="width: 15px; height: 15px;">
                            <label class="form-check-label text-black montserrat fs-16" for="flex">Flexível</label>
                        </div>
                    </div>
                    <div class="button-submit mb-lg-5 pb-lg-5 w-100">
                        <button type="submit"
                            class="btn btn-submit text-white fs-18 montserrat w-100 align-self-end"><strong>Encontrar minha
                                <br>vaga perfeita!</strong></button>
                    </div>
                </form>
            </div>
        </aside>
        <main class="row m-0 justify-content-center align-items-center h-100 w-100" style="background-color: #e5e5e5;">
            <div class="col-11 search px-0 pt-4 pt-lg-0">
                <form class="d-flex flex-column flex-lg-row montserrat h-100 gap-2 gap-lg-4">
                    <input class="form-control me-2 fs-16 fw-normal border-dark" type="search" id="input-search"
                        placeholder="Busque aqui pela área de seu interesse..." aria-label="Search">
                    <button class="btn btn-success fs-16" type="submit"><strong>Buscar</strong></button>
                </form>
            </div>
            <div class="col-11 overflow-auto content px-0 pe-lg-2 pt-4 pt-lg-0">
                <h2 class="montserrat fs-24 text-center pb-4"><strong>Vagas em aberto (9):</strong></h2>
                <div class="row bg-white my-6 py-5 m-0 position-relative rounded-3 daily">
                    <div class="py-2"></div>
                    <div
                        class="d-flex flex-column justify-content-center border-1 border-dark text-center rounded-3 position-absolute date">
                        <p class="text-black montserrat fs-18 mb-0"><strong>10</strong></p>
                        <p class="text-black montserrat fs-15 mb-0">Jan.</p>
                    </div>
                    <div
                        class="d-flex flex-column justify-content-center border-1 border-dark text-center rounded-3 position-absolute destaque">
                        <p class="text-white montserrat fs-18 mb-0"><strong>Vaga em destaque</strong></p>
                    </div>
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
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
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
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
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
                            Confidencial.</h3>
                    </div>
                    <hr class="my-3">
                    <div class="col-12 px-4">
                        <h2 class="montserrat fs-16 title" style="letter-spacing: 0.4px;"><strong>ANALISTA DE SISTEMAS
                                JÚNIOR</strong></h2>
                        <h3 class="montserrat fs-16 subtitle">Tipo de emprego: Tempo Integral / Regime: CLT</h3>
                        <h3 class="montserrat fs-16 subtitle mb-0">Carga horária: 44h semanais / Salário: A combinar
                            Empresa:
                            Confidencial.</h3>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
