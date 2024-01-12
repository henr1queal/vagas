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
            }
            
            main {
                width: 70%;
            }
        }

        #input-search {
            background-image: url(https://www.w3schools.com/css/searchicon.png);
            background-position: center left 10px;
            background-repeat: no-repeat;
            padding: 12px 0px 12px 40px;
        }

        .date, .destaque {
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
            right: 65px;
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
    </style>
@endsection
@section('content')
    <div class="d-flex vacancy-wrapper flex-column flex-lg-row">
        <aside class="d-flex justify-content-center align-items-center flex-wrap py-4 py-lg-0">
            <h4 class="text-black montserrat fs-20 fw-normal"><strong>Filtros:</strong></h4>
        </aside>
        <main class="row m-0 justify-content-center align-items-center h-100" style="background-color: #e5e5e5;">
            <div class="col-11 search px-0 pt-4 pt-lg-0">
                <form class="d-flex flex-column flex-lg-row montserrat h-100 gap-2 gap-lg-4">
                    <input class="form-control me-2 fs-16 fw-normal border-dark" type="search" id="input-search"
                        placeholder="Busque aqui pela área de seu interesse..." aria-label="Search">
                    <button class="btn btn-success fs-16" type="submit"><strong>Buscar</strong></button>
                </form>
            </div>
            <div class="col-11 overflow-auto content px-0 pe-lg-2 pt-4 pt-lg-0">
                <h2 class="montserrat fs-24 text-center pb-4"><strong>Vagas em aberto (0):</strong></h2>
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
