@extends('layouts.layout')
@section('title')
<title>Recuperar Senha - Vagas Maceió</title>
@endsection
@section('css')
    <style>
        body {
            background-color: #e5e5e5;
        }

        input {
            height: 58px !important;
            color: black !important;
        }

        input::placeholder {
            font-size: 1.3rem;
            text-align: center;
        }

        @media (min-width: 768px) and (min-height: 768px) {
            footer {
                position: fixed;
                width: 100%;
                bottom: 0%;
            }
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center h-100 align-items-lg-center">
                <div class="col-11 col-lg-6 text-center roboto fw-medium py-5 py-lg-5">
                    <h2 class="fs-20 text-black">Recuperar senha:</h2>
                    <form method="POST" action="{{ route('password.email') }}"
                        class="needs-validation gap-2 d-flex flex-column mt-5" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border-secondary rounded-0 fs-15"
                                        id="floatingInput" placeholder="E-mail" name="email" value="{{ old('email') }}"
                                        required>
                                    <label class="fs-15 text-black" for="floatingInput">E-mail</label>
                                    <div class="invalid-feedback fs-14">
                                        Digite o e-mail cadastrado.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-success fs-18 py-3 w-100">Recuperar senha</button>
                            </div>
                            @if (session('status'))
                                <div class="col-12 mt-5">
                                    <span class="fs-14 text-success d-block">Link de redefinição enviado para seu
                                        e-mail!</span>
                                    <span class="fs-14 text-success d-block">Caso não encontre na caixa principal, verifique
                                        seu spam.</span>
                                </div>
                            @elseif($errors->get('email'))
                                <div class="col-12 mt-5">
                                    <span class="fs-14 text-danger d-block">Não encontramos este e-mail.</span>
                                </div>
                            @endif
                            <div class="col-12 mt-5">
                                <p class="fs-16 text-black">Caso não possua cadastro, <a
                                        href="{{ route('register') }}"><strong>clique aqui</strong></a>.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script>
        function hasVerticalScroll() {
            return document.body.scrollHeight > window.innerHeight;
        }

        function setFooterStyle() {
            const footer = document.querySelector('footer');

            if (hasVerticalScroll()) {
                footer.style.position = 'static';
            } else {
                footer.style.position = 'fixed';
                footer.style.bottom = '0';
                footer.style.width = '100%';
            }
        }

        window.addEventListener('load', setFooterStyle);
        window.addEventListener('scroll', setFooterStyle);
        window.addEventListener('resize', setFooterStyle);
    </script>
@endsection
