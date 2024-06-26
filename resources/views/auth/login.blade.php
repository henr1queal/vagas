@extends('layouts.layout')
@section('title')
<title>Login - Vagas Maceió</title>
@endsection
@section('css')
    <style>
        body {
            background-color: #e5e5e5;
        }

        input:not([type=checkbox]) {
            height: 58px !important;
            color: black !important;
        }

        .form-check-input {
            height: 20px;
            width: 20px;
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
                    <h2 class="fs-20 text-black">Realizar login:</h2>
                    <form method="POST" action="{{ route('login') }}" class="needs-validation gap-2 d-flex flex-column mt-5"
                        novalidate>
                        @csrf
                        <div class="row">
                            @if (session('status'))
                                <div class="col-12 mb-5">
                                    <span class="fs-16 text-success d-block">Senha redefinida com sucesso!</span>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="col-12 mb-5">
                                    <span class="fs-14 text-danger invalid-feedback d-block">E-mail ou senha
                                        incorretos.&nbsp;</span>
                                    @if (Route::has('password.request'))
                                        <a class="fs-14" href="{{ route('password.request') }}"><strong>Esqueci minha
                                                senha</strong></a>.
                                    @endif
                                </div>
                            @endif
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control border-secondary rounded-0 fs-15"
                                        id="password" placeholder="Senha" name="password" required minlength="8">
                                    <label class="fs-15 text-black" for="password">Senha</label>
                                    <div class="invalid-feedback fs-14">
                                        Digite sua senha.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <input id="remember_me" class="form-check-input px-3 align-self border-1 border-secondary" type="checkbox" name="remember" checked>
                                <label class="fs-15 text-black align-self ms-2" for="remember_me">Lembrar login</label>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-success fs-18 py-3 w-100">Login</button>
                            </div>
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
