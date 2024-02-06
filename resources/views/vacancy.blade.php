@extends('layouts.layout')
@section('title')
    <title>Vaga de {{ $vacancy->title }} em Maceió | VagasMaceio.com.br</title>
@endsection
@section('css')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha_v3.siteKey') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('services.recaptcha_v3.siteKey') }}', {
                action: 'forms'
            }).then(function(token) {
                var recaptchaElements = document.getElementsByName('g-recaptcha-response');
                for (var i = 0; i < recaptchaElements.length; i++) {
                    recaptchaElements[i].value = token;
                }
            });
        });
    </script>
    <style>
        .grecaptcha-badge {
            width: 70px !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
            left: 4px !important;
        }

        .grecaptcha-badge:hover {
            width: 256px !important;
        }

        .preview-banner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffcc00;
            color: #000;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            overflow: hidden;
        }

        input {
            color: black !important;
        }


        .modal-backdrop.show {
            opacity: 0.75;
        }

        .banner-content {
            white-space: nowrap;
            animation: moveText 7s linear infinite;
        }

        @keyframes moveText {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-165%);
            }
        }

        @media(min-width: 992px) {
            .banner-content {
                animation: moveText 15s linear infinite;
            }

            @keyframes moveText {
                from {
                    transform: translateX(78%);
                }

                to {
                    transform: translateX(-78%);
                }
            }
        }

        .btn-whatsapp-pulse {
            position: fixed;
            bottom: 11.5%;
            right: 5%;
            font-size: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            border-radius: 50%;
            animation-name: pulse;
            animation-duration: 1.5s;
            animation-timing-function: ease-out;
            animation-iteration-count: infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
            }

            80% {
                box-shadow: 0 0 0 14px rgba(37, 211, 102, 0);
            }
        }

        aside {
            background-color: #CFC6C6;
            height: 100%;
        }

        .title {
            color: #003366;
            text-transform: uppercase;
        }

        @media(min-width: 1400px) {
            aside {
                width: 25%;
            }
        }

        @media(min-width: 992px) {
            .btn-whatsapp-pulse {
                bottom: 9%;
                right: 5%;
            }

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

        .btn-submit:hover,
        .btn-submit:active,
        .btn-submit:focus-visible {
            background-color: #157347 !important;
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
                        <h3 class="fs-18 montserrat text-black"><strong>Inscrições até:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->days_available->format('d/m/Y') }} às
                            {{ $vacancy->days_available->format('H:i') }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Empresa:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">
                            {{ $vacancy->show_company ? $vacancy->company_name : 'Confidencial' }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Tipo de trabalho:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->job_type }}</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Regime de contratação:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">{{ $vacancy->employment_type }}</h4>
                    </div>
                    @if ($vacancy->workload)
                        <div class="d-flex flex-column">
                            <h3 class="fs-18 montserrat text-black"><strong>Carga horária:</strong></h3>
                            <h4 class="fs-16 montserrat text-black">{{ $vacancy->workload }}h semanais</h4>
                        </div>
                    @endif
                    <div class="d-flex flex-column">
                        <h3 class="fs-18 montserrat text-black"><strong>Salário:</strong></h3>
                        <h4 class="fs-16 montserrat text-black">
                            {{ $vacancy->show_salary ? 'R$ ' . $vacancy->salary : 'A combinar' }}</h4>
                    </div>
                </div>
            </div>
        </aside>
        <main class="row m-0 justify-content-center {{ !isset($preview_mode) ? 'pt-5 py-lg-5' : '' }} h-100 w-100">
            @if (isset($preview_mode))
                <div class="col-12 position-relative">
                    <div class="preview-banner z-2">
                        <div class="banner-content">
                            <p class="fs-18 montserrat mb-0"><strong>Modo Pré-visualização. Por favor, efetue o pagamento
                                    para
                                    obter acesso completo.</strong></p>
                        </div>
                    </div>
                </div>
            @endif
            <div
                class="col-11 h-100 overflow-auto pb-5 pb-lg-0 mb-4 mb-lg-0 {{ isset($preview_mode) ? 'pt-5 mt-5' : '' }}">
                @if ($errors->any())
                    <div class="alert alert-danger fs-16 mb-4 montserrat">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success-candidate-fields') || session('success-candidate-file'))
                    <div class="alert alert-success fs-16 mb-5 montserrat fw-medium">
                        <p>Agora você está na disputa! Aguarde um retorno do recrutador. Boa sorte!</p>
                    </div>
                @endif
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
                            <p class="montserrat fs-18 text-black fw-medium">{!! nl2br(e($vacancy->description)) !!}</p>
                        </div>
                        <button type="button" class="btn btn-submit text-white fs-18 montserrat py-4"
                            data-bs-toggle="modal" data-bs-target="#curriculumModal"><strong>Eu quero
                                esta vaga!</strong></button>
                        <div class="d-flex d-lg-none flex-column justify-content-center cursor-pointer text-center w-25 mx-auto"
                            onclick="goBack()" type="button">
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
            <div class="modal fade roboto" id="curriculumModal" tabindex="-1" aria-labelledby="curriculumModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fs-18" id="curriculumModalLabel"><strong>Escolha uma opção:</strong></h2>
                            <button type="button" class="btn-close fs-16" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body gap-3 d-flex flex-row justify-content-center">
                            <button type="button" class="btn btn-primary w-100 py-3 fs-16" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#curriculumFile">Currículo em <br
                                    class="d-sm-none">arquivo</button>
                            <button type="button" class="btn btn-primary w-100 py-3 fs-16" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#curriculumFields">Crie seu <br
                                    class="d-sm-none">currículo</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade roboto" id="curriculumFile" tabindex="-1" aria-labelledby="curriculumFileLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fs-18" id="curriculumFileLabel"><strong>Adicione seu currículo</strong>
                            </h2>
                            <button type="button" class="btn-close fs-16" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->fileErrors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->fileErrors->all() as $error)
                                            <li class="fs-16 montserrat fw-medium">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="contactFormFile" class="row g-3 needs-validation"
                                action="{{ route('candidate.store-file') }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="mb-3 fs-16">
                                    <label for="name_form_file">Nome completo</label>
                                    <input type="text" class="form-control fs-16" id="name_form_file"
                                        name="name_form_file"
                                        @if (old('name_form_file')) value="{{ old('name_form_file') }}" @endif
                                        placeholder="Digite seu nome" required>
                                    <div class="invalid-feedback">
                                        Informe seu nome completo.
                                    </div>
                                </div>
                                <div class="fs-16 mb-3">
                                    <label for="phone_form_file">Telefone/Celular</label>
                                    <input type="text" class="form-control fs-16" maxlength="15" id="phone_form_file"
                                        @if (old('phone_form_file')) value="{{ old('phone_form_file') }}" @endif
                                        placeholder="(82) 9 0000-0000" name="phone_form_file" required>
                                    <div class="invalid-feedback">
                                        Informe seu telefone ou celular.
                                    </div>
                                </div>
                                <div class="fs-16 mb-3">
                                    <label for="whatsapp_form_file">Whatsapp</label>
                                    <input type="text" class="form-control fs-16" maxlength="15"
                                        id="whatsapp_form_file" placeholder="(82) 9 0000-0000" name="whatsapp_form_file"
                                        @if (old('whatsapp_form_file')) value="{{ old('whatsapp_form_file') }}" @endif
                                        required>
                                    <div class="invalid-feedback">
                                        Informe seu whatsapp.
                                    </div>
                                </div>
                                <div class="mb-3 fs-16">
                                    <label for="curriculum" class="form-label">.pdf, .doc ou .docx<span
                                            class="text-danger fs-14">*</span></label>
                                    <input class="form-control form-control-lg fs-16" name="curriculum" type="file"
                                        id="curriculum" accept=".pdf,.doc,.docx" required>
                                    <div class="invalid-feedback">
                                        Você precisa adicionar um arquivo.
                                    </div>
                                    <input type="hidden" name="vacancy" value="{{ $vacancy->id }}">
                                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                </div>
                                <div>
                                    <button type="submit"
                                        class="g-recaptcha btn btn-success fs-16 w-100 py-3 d-flex flex-row justify-content-center gap-4 align-items-center"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
                                            <path
                                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z" />
                                            <path
                                                d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
                                        </svg> <strong>Enviar candidatura</strong></button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button"
                                class="btn btn-secondary fs-16 w-100 py-3 d-flex flex-row justify-content-center gap-4 align-items-center"
                                data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#curriculumModal"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                </svg> <strong>Voltar</strong></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade roboto" id="curriculumFields" tabindex="-1" aria-labelledby="curriculumFieldsLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fs-18" id="curriculumFieldsLabel"><strong>Preencha seus dados</strong>
                            </h2>
                            <button type="button" class="btn-close fs-16" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->postErrors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->postErrors->all() as $error)
                                            <li class="fs-16 montserrat fw-medium">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="contactFormFields" action="{{ route('candidate.store-fields') }}" method="post"
                                class="fs-16 needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Nome completo<span
                                            class="text-danger fs-14">*</span>:</label>
                                    <input type="text" class="form-control fs-16" id="full_name" name="full_name"
                                        required @if (old('full_name')) value="{{ old('full_name') }}" @endif>
                                    <div class="invalid-feedback">
                                        Informe seu nome completo.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Data de Nascimento:<span
                                            class="text-danger fs-14">*</span></label>
                                    <input type="date" class="form-control fs-16" id="birth_date" name="birth_date"
                                        required @if (old('birth_date')) value="{{ old('birth_date') }}" @endif>
                                    <div class="invalid-feedback">
                                        Informe sua data de nascimento.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone/Celular<span
                                            class="text-danger fs-14">*</span></label>
                                    <input type="text" class="form-control fs-16" id="phone" name="phone"
                                        placeholder="(82) 9 0000-0000" required
                                        @if (old('phone')) value="{{ old('phone') }}" @endif>
                                    <div class="invalid-feedback">
                                        Informe seu telefone ou celular.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">Whatsapp:<span
                                            class="text-danger fs-14">*</span></label>
                                    <input type="text" class="form-control fs-16" id="whatsapp" name="whatsapp"
                                        placeholder="(82) 9 0000-0000" required
                                        @if (old('whatsapp')) value="{{ old('whatsapp') }}" @endif>
                                    <div class="invalid-feedback">
                                        Informe seu whatsapp.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="district" class="form-label">Bairro:<span
                                            class="text-danger fs-14">*</span></label>
                                    <input type="text" class="form-control fs-16" id="district" name="district"
                                        required @if (old('district')) value="{{ old('district') }}" @endif>
                                    <div class="invalid-feedback">
                                        Informe seu bairro.
                                    </div>
                                </div>

                                <div class="d-flex flex-row gap-5 mb-3">
                                    <div>
                                        <label class="form-check-label">Estado civil:<span
                                                class="text-danger fs-14">*</span></label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="single"
                                                name="marital_status" value="solteiro(a)" required
                                                @if (old('marital_status') === 'solteiro(a)') @checked(true) @endif>
                                            <label for="single" class="form-check-label">Solteiro (a)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="married"
                                                name="marital_status" value="casado(a)" required
                                                @if (old('marital_status') === 'casado(a)') @checked(true) @endif>
                                            <label for="married" class="form-check-label">Casado (a)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="divorced"
                                                name="marital_status" value="divorciado(a)" required
                                                @if (old('marital_status') === 'divorciado(a)') @checked(true) @endif>
                                            <label for="divorced" class="form-check-label">Divorciado (a)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="widower"
                                                name="marital_status" value="viúvo(a)" required
                                                @if (old('marital_status') === 'viúvo(a)') @checked(true) @endif>
                                            <label for="widower" class="form-check-label">Viúvo (a)</label>
                                            <div class="invalid-feedback">
                                                Escolha uma opção.
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="vacancy" value="{{ $vacancy->id }}">
                                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                    <div class="ms-lg-5">
                                        <label class="form-check-label">Filhos:<span
                                                class="text-danger fs-14">*</span></label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="children_yes"
                                                name="has_children" value="sim" required
                                                @if (old('has_children') === 'sim') @checked(true) @endif>
                                            <label for="children_yes" class="form-check-label">Sim</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="children_no"
                                                name="has_children" value="não" required
                                                @if (old('has_children') === 'não') @checked(true) @endif>
                                            <label for="children_no" class="form-check-label">Não</label>
                                            <div class="invalid-feedback ms-n4">
                                                Escolha uma opção.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="availability" class="form-label fs-16">Horário Disponível:<span
                                            class="text-danger fs-14">*</span></label>
                                    <select class="form-select fs-16" id="availability" name="availability" required>
                                        <option value="dia"
                                            @if (old('availability') === 'dia') @checked(true) @endif>Dia
                                        </option>
                                        <option value="noite"
                                            @if (old('availability') === 'noite') @checked(true) @endif>Noite
                                        </option>
                                        <option value="qualquer horário"
                                            @if (old('availability') === 'qualquer horário') @checked(true) @endif>Qualquer
                                            Horário</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Escolha uma disponibilidade.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="experience_years" class="form-label">Tempo de Experiência na
                                        Função:<span class="text-danger fs-14">*</span></label>
                                    <select class="form-select fs-16" id="experience_years" name="experience_years"
                                        required>
                                        <option value="Não tenho experiência"
                                            @if (old('experience_years') === 'Não tenho experiência') @checked(true) @else @checked(true) @endif>
                                            Não
                                            tenho experiência</option>
                                        <option value="Menos de 1 ano"
                                            @if (old('experience_years') === 'Menos de 1 ano') @checked(true) @endif>Menos
                                            de
                                            1 ano</option>
                                        <option value="1 ano"
                                            @if (old('experience_years') === '1 ano') @checked(true) @endif>1 ano
                                        </option>
                                        <option value="2 anos"
                                            @if (old('experience_years') === '2 anos') @checked(true) @endif>2 anos
                                        </option>
                                        <option value="3 anos"
                                            @if (old('experience_years') === '3 anos') @checked(true) @endif>3 anos
                                        </option>
                                        <option value="4 anos"
                                            @if (old('experience_years') === '4 anos') @checked(true) @endif>4 anos
                                        </option>
                                        <option value="5 anos"
                                            @if (old('experience_years') === '5 anos') @checked(true) @endif>5 anos
                                        </option>
                                        <option value="6 anos"
                                            @if (old('experience_years') === '6 anos') @checked(true) @endif>6 anos
                                        </option>
                                        <option value="7 anos"
                                            @if (old('experience_years') === '7 anos') @checked(true) @endif>7 anos
                                        </option>
                                        <option value="8 anos"
                                            @if (old('experience_years') === '8 anos') @checked(true) @endif>8 anos
                                        </option>
                                        <option value="9 anos"
                                            @if (old('experience_years') === '9 anos') @checked(true) @endif>9 anos
                                        </option>
                                        <option value="10 anos ou mais"
                                            @if (old('experience_years') === '10 anos ou mais') @checked(true) @endif>10 anos
                                            ou mais</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Escolha uma opção.
                                    </div>
                                </div>
                                <div id="experiences-container" class="roboto">
                                    <h3 class="fs-16"><strong></strong></h3>
                                    @foreach (old('experiences', [['company_name' => null, 'job_title' => null, 'start_date' => null, 'end_date' => null, 'description' => null]]) as $key => $experience)
                                        <div class="experience-container mb-3">
                                            <hr class="my-5" style="border: 1px dashed black;">
                                            <div class="d-flex flex-row justify-content-between align-items-end mb-3">
                                                <h4 class="fs-16"><strong>Experiência:</strong></h4>
                                                <button type="button"
                                                    class="btn btn-danger py-3 fs-16 w-50 d-flex flex-row justify-content-center gap-lg-4 align-items-center"
                                                    onclick="deleteExperience(this)"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg>
                                                    <div class="col">Deletar esta experiência</div>
                                                </button>
                                            </div>
                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Nome da empresa:</label>
                                                <input type="text" class="form-control fs-16" id="company_name"
                                                    name="experiences[{{ $key }}][company_name]"
                                                    value="{{ $experience['company_name'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="job_title" class="form-label">Função exercida:</label>
                                                <input type="text" class="form-control fs-16" id="job_title"
                                                    name="experiences[{{ $key }}][job_title]"
                                                    value="{{ $experience['job_title'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_date" class="form-label">Data de admissão:</label>
                                                <input type="date" class="form-control fs-16" id="start_date"
                                                    name="experiences[{{ $key }}][start_date]"
                                                    value="{{ $experience['start_date'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_date" class="form-label">Data de rescisão:</label>
                                                <input type="date" class="form-control fs-16" id="end_date"
                                                    name="experiences[{{ $key }}][end_date]"
                                                    value="{{ $experience['end_date'] }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="description" class="form-label">Conte sobre sua
                                                    experiência:</label>
                                                <textarea class="form-control fs-16" id="description" name="experiences[{{ $key }}][description]">{{ $experience['description'] }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex">
                                    <button type="button"
                                        class="btn btn-primary py-3 fs-16 w-50 d-flex flex-row justify-content-center gap-lg-4 align-items-center"
                                        onclick="addExperience()"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                            height="30" fill="currentColor" class="bi bi-file-earmark-plus"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                                        </svg>
                                        <div class="col" style="width: min-content;">Adicionar
                                            Experiência</div>
                                    </button>
                                </div>
                                <button data-sitekey="{{ config('services.recaptcha_v3_alternative.siteKey') }}"
                                    data-callback="onSubmitFormFields" data-action="submitContact"
                                    class="g-recaptcha btn btn-success fs-16 w-100 py-3 mt-5 d-flex flex-row justify-content-center gap-4 align-items-center"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
                                        <path
                                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z" />
                                        <path
                                            d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
                                    </svg> <strong>Enviar candidatura</strong></button>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button"
                                class="btn btn-secondary fs-16 w-100 py-3 d-flex flex-row justify-content-center gap-4 align-items-center"
                                data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#curriculumModal"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                </svg> <strong>Voltar</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <a href="{{ route('whatsapp') }}" target="_blank" class="btn-whatsapp-pulse">
            <img src="../public/build/images/whatsapp.png" alt="Receba vagas pelo Whatsapp" class="img-fluid">
        </a>
    </div>
@endsection
@section('scripts')
    <script src="../public/build/assets/jquery.min.js"></script>
    <script src="../public/build/assets/jquery.mask.js"></script>
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
            $('#whatsapp').mask(PhoneBehavior, spOptions);
            $('#phone_form_file').mask(PhoneBehavior, spOptions);
            $('#whatsapp_form_file').mask(PhoneBehavior, spOptions);

            verificarRequisicao();
        })
    </script>
    <script>
        function verificarRequisicao() {
            var identificacaoPagina = '{{ $vacancy->id }}';

            var chaveCookie = 'requisicao_enviada_' + identificacaoPagina;
            var requisicaoEnviada = obterCookie(chaveCookie);

            if (!requisicaoEnviada) {
                enviarRequisicao();

                definirCookie(chaveCookie, 'true', 30);
            }
        }

        function obterCookie(nome) {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();
                if (cookie.indexOf(nome + '=') === 0) {
                    return cookie.substring(nome.length + 1);
                }
            }
            return null;
        }

        function definirCookie(nome, valor, minutos) {
            var dataExpiracao = new Date();
            dataExpiracao.setTime(dataExpiracao.getTime() + (minutos * 60 * 1000));
            document.cookie = nome + '=' + valor + ';expires=' + dataExpiracao.toUTCString() + ';path=/';
        }

        function enviarRequisicao() {
            var url = '{{ route('vacancy.update-views', ['vacancy' => $vacancy]) }}';
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        }
    </script>
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
    @if (!session('success-candidate-fields') && !session('success-candidate-file'))
        <script>
            function goBack() {
                if (window.location.href.indexOf('previsualizar-vaga') !== -1) {
                    window.location.href = '{{ route('payment.checkout', ['vacancy' => $vacancy]) }}';
                } else {
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
            }
        </script>
    @else
        <script>
            function goBack() {
                window.location.href = '{{ route('home') }}';
            }
        </script>
    @endif
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
    <script>
        var experienceCount = 0;

        function addExperience() {
            var experiencesContainer = document.getElementById('experiences-container');
            var experienceContainer = document.querySelector('.experience-container').cloneNode(true);

            experienceCount++;

            experienceContainer.querySelectorAll('input, textarea').forEach(function(element) {
                element.value = '';
                element.id = element.id.replace(/\[0\]/g, '[' + experienceCount + ']');
                element.name = element.name.replace(/\[0\]/g, '[' + experienceCount + ']');
            });

            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.textContent = 'Deletar Experiência';
            deleteButton.onclick = function() {
                deleteExperience(this);
            };

            experiencesContainer.appendChild(experienceContainer);

            experienceContainer.style.display = 'block';
        }

        function deleteExperience(button) {
            var experienceContainers = document.querySelectorAll('.experience-container');

            if (experienceContainers.length === 1) {
                alert('Pelo menos uma experiência deve ser mantida.');
                return;
            }

            if (confirm('Tem certeza de que deseja deletar esta experiência?')) {
                var experienceContainer = button.closest('.experience-container');
                experienceContainer.remove();
            }
        }
    </script>
    @if (session('error-candidate-fields') || $errors->postErrors->any())
        <script>
            $(document).ready(function() {
                $("#curriculumFields").modal('show');
            })
        </script>
    @endif
    @if (session('error-candidate-file') || $errors->fileErrors->any())
        <script>
            $(document).ready(function() {
                $("#curriculumFile").modal('show');
            })
        </script>
    @endif
@endsection
