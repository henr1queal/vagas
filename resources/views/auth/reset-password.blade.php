@extends('layouts.layout')
@section('title')
    Criar nova senha - Vagas Maceió
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
                    <h2 class="fs-20 text-black">Crie sua nova senha:</h2>
                    <form method="POST" action="{{ route('password.store') }}"
                        class="needs-validation gap-2 d-flex flex-column mt-5" novalidate>
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border-secondary rounded-0 fs-15"
                                        id="email" placeholder="E-mail" name="email" value="{{ $request->email }}"
                                        autofocus autocomplete="email" required>
                                    <label class="fs-15 text-black" for="email">E-mail</label>
                                    <div class="invalid-feedback fs-14">
                                        Digite o e-mail cadastrado.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control border-secondary rounded-0 fs-15"
                                        id="password" placeholder="Senha" name="password" autocomplete="new-password"
                                        required>
                                    <label class="fs-15 text-black" for="password">Senha</label>
                                    <div class="invalid-feedback fs-14">
                                        Digite sua nova senha.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control border-secondary rounded-0 fs-15"
                                        id="password_confirmation" placeholder="Confirme sua nova senha"
                                        name="password_confirmation" autocomplete="new-password" required>
                                    <label class="fs-15 text-black" for="password_confirmation">Confirme sua nova
                                        senha</label>
                                    <div class="invalid-feedback fs-14">
                                        Digite novamente sua nova senha.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-success fs-18 py-3 w-100">Salvar nova senha</button>
                            </div>
                            <div class="col-12 mt-5">
                                @if ($errors->get('email'))
                                    @foreach ($errors->get('email') as $error)
                                        <span class="fs-14 text-danger d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                                @if ($errors->get('password'))
                                    @foreach ($errors->get('password') as $error)
                                        <span class="fs-14 text-danger d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                                @if ($errors->get('password_confirmation'))
                                    @foreach ($errors->get('password_confirmation') as $error)
                                        <span class="fs-14 text-danger d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
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
