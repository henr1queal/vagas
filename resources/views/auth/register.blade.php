@extends('layouts.layout')
@section('title')
<title>Cadastro - Vagas Maceió</title>
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
    <div class="container">
        <div class="row justify-content-center h-100 align-items-lg-center">
            <div class="col-11 col-lg-6 text-center roboto fw-medium py-5 py-lg-5">
                <h2 class="fs-20 text-black">Cadastre-se para publicar uma vaga:</h2>
                <form method="POST" action="{{ route('register') }}" class="needs-validation gap-2 d-flex flex-column mt-5"
                    novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-secondary rounded-0 fs-15 " id="company_name"
                            placeholder="Nome da empresa" name="company_name" value="{{old('company_name')}}" required>
                        <label class="fs-15 text-black" for="company_name">Nome da empresa</label>
                        <div class="invalid-feedback fs-14">
                            O nome da empresa é obrigatório.
                        </div>
                        @if ($errors->get('company_name'))
                            @foreach ($errors->get('company_name') as $error)
                                <span class="fs-14 invalid-feedback d-block">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-secondary rounded-0 fs-15" id="cnpj"
                            placeholder="CNPJ" name="cnpj" value="{{old('cnpj')}}" required>
                        <label class="fs-15 text-black" for="cnpj">CNPJ</label>
                        <div class="invalid-feedback fs-14">
                            Caso não tenha CNPJ, entre em contato por e-mail: contato@vagasmaceio.com.br
                        </div>
                        @if ($errors->get('cnpj'))
                            @foreach ($errors->get('cnpj') as $error)
                                <span class="fs-14 invalid-feedback d-block d-block">{{ $error }}</span><br>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control border-secondary rounded-0 fs-15" id="floatingInput"
                            placeholder="E-mail" name="email" value="{{old('email')}}" required>
                        <label class="fs-15 text-black" for="floatingInput">E-mail empresarial</label>
                        <div class="invalid-feedback fs-14">
                            Utilize seu e-mail empresarial.
                        </div>
                        @if ($errors->get('email'))
                            @foreach ($errors->get('email') as $error)
                                <span class="fs-14 invalid-feedback d-block">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-secondary rounded-0 fs-15" id="password"
                                    placeholder="Senha" name="password" required>
                                <label class="fs-15 text-black" for="password">Senha</label>
                                <div class="invalid-feedback fs-14">
                                    A senha é obrigatória.
                                </div>
                                @if ($errors->get('password'))
                                    @foreach ($errors->get('password') as $error)
                                        <span class="fs-14 invalid-feedback d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-secondary rounded-0 fs-15"
                                    id="password_confirmation" name="password_confirmation" placeholder="Confirme a senha" required>
                                <label class="fs-15 text-black" for="password_confirmation">Confirme a senha</label>
                                <div class="invalid-feedback fs-14">
                                    Confirme sua senha.
                                </div>
                                @if ($errors->get('password_confirmation'))
                                    @foreach ($errors->get('password_confirmation') as $error)
                                        <span class="fs-14 invalid-feedback d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-secondary rounded-0 fs-15" id="name"
                                    placeholder="Responsável pelo RH" name="name" value="{{old('name')}}" required>
                                <label class="fs-15 text-black" for="name">Responsável pelo RH</label>
                                <div class="invalid-feedback fs-14">
                                    O nome da pessoa responsável pela vaga é obrigatória.
                                </div>
                                @if ($errors->get('name'))
                                    @foreach ($errors->get('name') as $error)
                                        <span class="fs-14 invalid-feedback d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-secondary rounded-0 fs-15" id="phone"
                                    placeholder="Telefone ou celular" name="phone" value="{{old('phone')}}" required>
                                <label class="fs-15 text-black" for="phone">Telefone ou celular</label>
                                <div class="invalid-feedback fs-14">
                                    Por favor, digite seu telefone para contato.
                                </div>
                                @if ($errors->get('phone'))
                                    @foreach ($errors->get('phone') as $error)
                                        <span class="fs-14 invalid-feedback d-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success fs-18 py-3">Cadastrar-se</button>
                    <div class="mt-5">
                        <p class="text-black fs-16">Caso já tenha cadastro, <a href="{{route('login')}}"><strong>clique aqui</strong></a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <script src="./public/build/assets/jquery.min.js"></script>
    <script src="./public/build/assets/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {
            var PhoneBehavior = function(val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(PhoneBehavior.apply({}, arguments), options);
                    }
                };

            $('#phone').mask(PhoneBehavior, spOptions);
            $('#cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
        })
    </script>
    <script>
        const form = document.querySelector('.needs-validation');
        const cnpj = document.getElementById('cnpj');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity() || !validarCnpj(cnpj.value)) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });

        cnpj.addEventListener('input', function() {
            if (cnpj.value.length >= 14 && validarCNPJ(cnpj.value)) {
                cnpj.setCustomValidity('');
            } else {
                cnpj.setCustomValidity('Por favor, insira um CNPJ válido com pelo menos 14 caracteres.');
            }

            form.classList.remove('was-validated');
        });

        function validarCNPJ(cnpj) {

            cnpj = cnpj.replace(/[^\d]+/g, '');

            if (cnpj == '') return false;

            if (cnpj.length != 14)
                return false;

            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999")
                return false;

            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0, tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;

            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;

            return true;

        }
    </script>
@endsection
