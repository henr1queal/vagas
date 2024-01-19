@extends('layouts.layout')
@section('title')
    <title>Gerenciamento - Vagas Maceió</title>
@endsection
@section('css')
    <style>
        input,
        select {
            height: 58px !important;
            color: black !important;
        }

        input[type=checkbox] {
            height: 2rem !important;
            width: 4rem !important;
        }

        .tooltip {
            font-size: 1.4rem;
        }

        input::placeholder {
            font-size: 1.3rem;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container px-4 pt-lg-4 py-lg-5 roboto">
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center my-5">
                    <h1 class="fs-20"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg> Publique sua vaga</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-11 col-xxl-10">
                    <form action="{{ route('vacancy.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex gap-3 align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" data-bs-toggle="tooltip" data-bs-title="Ex: Enfermeiro(a)"
                                        class="bi bi-info-circle order-2 order-lg-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                    <div class="form-floating w-100 order-1 order-lg-2 mb-3">
                                        <input type="text" class="form-control border-secondary rounded-0 fs-15"
                                            id="title" placeholder="Título da vaga" name="title" required
                                            value="{{ old('title') ? old('title') : '' }}">
                                        <label class="fs-15 text-black" for="title">Título da vaga<span
                                                class="text-danger fs-15">*</span></label>
                                        <div class="invalid-feedback fs-14">
                                            O título da vaga é obrigatório.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border-secondary rounded-0 fs-15"
                                        id="salary" placeholder="Salário (R$)" name="salary"
                                        value="{{ old('salary') ? old('salary') : '' }}">
                                    <label class="fs-15 text-black" for="salary">Salário (R$)</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select border-secondary rounded-0 fs-15" id="employment_type"
                                        name="employment_type" aria-label="Regime de contratação" required>
                                        <option value="CLT" {{ old('employment_type') === 'CLT' ? 'selected' : '' }}>CLT
                                        </option>
                                        <option value="PJ" {{ old('employment_type') === 'PJ' ? 'selected' : '' }}>PJ
                                        </option>
                                    </select>
                                    <label class="fs-15 text-black" for="employment_type">Regime de contratação<span
                                            class="text-danger fs-15">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg">
                                <div class="d-flex gap-3 align-items-center pb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" data-bs-toggle="tooltip" data-bs-html="true"
                                        data-bs-title="Ex: 44 <br>(aparecerá no site 44h semanais)."
                                        class="bi bi-info-circle order-2 order-lg-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                    <div class="form-floating w-100 order-1 order-lg-2">
                                        <input type="number" class="form-control border-secondary rounded-0 fs-15"
                                            id="workload" placeholder="Carga horária" name="workload"
                                            oninput="javascript: if (this.value.length > 2) this.value = this.value.slice(0, 2);"
                                            value="{{ old('workload') ? old('workload') : '' }}">

                                        <label class="fs-15 text-black" for="workload">Carga horária</label>
                                        <div class="invalid-feedback fs-14">
                                            Apenas dois dígitos.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating mb-3">
                                    <select class="form-select border-secondary rounded-0 fs-15" id="work_shedule"
                                        name="work_shedule" aria-label="Horário de trabalho" required>
                                        <option value="Diurno" {{ old('description') === 'Diurno' ? 'selected' : '' }}>
                                            Diurno</option>
                                        <option value="Noturno" {{ old('description') === 'Noturno' ? 'selected' : '' }}>
                                            Noturno</option>
                                        <option value="Flexível" {{ old('description') === 'Flexível' ? 'selected' : '' }}>
                                            Flexível</option>
                                    </select>
                                    <label class="fs-15 text-black" for="work_shedule">Horário de trabalho<span
                                            class="text-danger fs-15">*</span></label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating mb-3">
                                    <select class="form-select border-secondary rounded-0 fs-15" id="job_type"
                                        name="job_type" aria-label="Tipo de trabalho" required>
                                        <option value="Tempo integral"
                                            {{ old('job_type') === 'Tempo integral' ? 'selected' : '' }}>Tempo integral
                                        </option>
                                        <option value="Trainee" {{ old('job_type') === 'Trainee' ? 'selected' : '' }}>
                                            Trainee</option>
                                        <option value="Estágio" {{ old('job_type') === 'Estágio' ? 'selected' : '' }}>
                                            Estágio</option>
                                        <option value="Freelance" {{ old('job_type') === 'Freelance' ? 'selected' : '' }}>
                                            Freelance</option>
                                    </select>
                                    <label class="fs-15 text-black" for="job_type">Tipo de trabalho<span
                                            class="text-danger fs-15">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-secondary rounded-0 fs-15 pt-5 pt-lg-5" name="description"
                                        placeholder="Escreva a descrição da vaga (sem informações já passadas anteriormente)." id="description"
                                        style="height: 200px" required>{{ old('description') ? old('description') : '' }}</textarea>
                                    <label for="description" class="fs-15 text-black">Mais detalhes sobre a vaga<span
                                            class="text-danger fs-15">*</span></label>
                                    <div class="invalid-feedback fs-14">
                                        Dê todas as informações complementares possíveis sobre a vaga. Este será o motivo de
                                        você receber candidatos.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center my-5">
                                <h1 class="fs-16"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                        <path
                                            d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z" />
                                    </svg> Configurações:</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3 mb-lg-0 col-lg-5 text-lg-center">
                                <div
                                    class="d-flex gap-lg-3 justify-content-between justify-content-lg-start align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="show_company"
                                            role="switch" id="show_company"
                                            @if (!old('title') || old('show_company')) @checked(true) @elseif(old('title') && !old('show_company')) @checked(false) @endif>
                                        <label class="form-check-label fs-15 ms-4 ms-lg-3" for="show_company">Exibir nome
                                            da
                                            empresa</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" data-bs-toggle="tooltip" data-bs-html="true"
                                        data-bs-title="Caso desative, será exibido 'empresa confidencial'."
                                        class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-12 mb-3 mb-lg-0 col-lg-4 text-lg-center">
                                <div
                                    class="d-flex gap-lg-3 justify-content-between justify-content-lg-start align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="show_salary"
                                            role="switch" id="show_salary"
                                            @if (old('show_salary')) checked @endif>
                                        <label class="form-check-label fs-15 ms-4 ms-lg-3" for="show_salary">Exibir
                                            salário</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" data-bs-toggle="tooltip" data-bs-html="true"
                                        data-bs-title="Caso desative aqui, ou não adicione valor ao campo Salário, será exibido <br>'a combinar'."
                                        class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-lg-5">
                            <div class="col-12 col-lg-auto text-lg-center col-xl-5">
                                <div class="d-flex flex-column gap-lg-3 justify-content-between justify-content-lg-start">
                                    <div
                                        class="d-flex flex-row gap-lg-3 align-items-center justify-content-between justify-content-lg-start w-100">
                                        <div>
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <input class="form-check-input" type="checkbox" name="email_receiver"
                                                    role="switch" id="email_receiver"
                                                    @if (!old('title') || old('email_receiver')) @checked(true) @elseif(old('title') && !old('email_receiver')) @checked(false) @endif>
                                                <label class="form-check-label fs-15 ms-4 ms-lg-3"
                                                    for="email_receiver">Receber
                                                    currículos no meu <br class="d-lg-none">e-mail cadastrado</label>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" data-bs-toggle="tooltip" data-bs-html="true"
                                            data-bs-title="Além de ter acesso a cada currículo dentro na sessão 'minhas vagas', você também os receberá por e-mail em um horário de sua escolha."
                                            class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                        </svg>
                                    </div>
                                    <div class="form-floating hour_receive_email mt-3"
                                        @if (!old('title') || old('email_receiver')) @elseif(old('title') && !old('email_receiver')) style="display: none;" @endif>
                                        <select class="form-select border-secondary rounded-0 fs-15"
                                            id="hour_receive_email" name="hour_receive_email" aria-label="Todo dia às">
                                            <option value="00:00">00:00</option>
                                            <option value="00:30">00:30</option>
                                            <option value="01:00">01:00</option>
                                            <option value="01:30">01:30</option>
                                            <option value="02:00">02:00</option>
                                            <option value="02:30">02:30</option>
                                            <option value="03:00">03:00</option>
                                            <option value="03:30">03:30</option>
                                            <option value="04:00">04:00</option>
                                            <option value="04:30">04:30</option>
                                            <option value="05:00">05:00</option>
                                            <option value="05:30">05:30</option>
                                            <option value="06:00">06:00</option>
                                            <option value="06:30">06:30</option>
                                            <option value="07:00">07:00</option>
                                            <option value="07:30">07:30</option>
                                            <option value="08:00">08:00</option>
                                            <option value="08:30" selected>08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                            <option value="19:30">19:30</option>
                                            <option value="20:00">20:00</option>
                                            <option value="20:30">20:30</option>
                                            <option value="21:00">21:00</option>
                                            <option value="21:30">21:30</option>
                                            <option value="22:00">22:00</option>
                                            <option value="22:30">22:30</option>
                                            <option value="23:00">23:00</option>
                                            <option value="23:30">23:30</option>
                                            <option value="00:00">00:00</option>
                                        </select>
                                        <label class="fs-15 text-black" for="hour_receive_email">Todo dia às</label>
                                        <div class="invalid-feedback fs-14">
                                            Insira um horário.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3 mb-lg-0 col-lg-3 text-lg-center">
                                <div class="d-flex flex-column gap-lg-3 justify-content-between justify-content-lg-start">
                                    <div
                                        class="d-flex flex-row gap-lg-3 justify-content-between justify-content-lg-start w-100 align-items-center align-items-lg-start">
                                        <div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="limit_candidates"
                                                    role="switch" id="limit_candidates"
                                                    @if (old('limit_candidates')) @checked(true) @else @checked(false) @endif>
                                                <label class="form-check-label fs-15 ms-4 ms-lg-3"
                                                    for="limit_candidates">Limite
                                                    de candidatos</label>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" data-bs-toggle="tooltip" data-bs-html="true"
                                            data-bs-title="Desative caso não queira receber um valor máximo de candidatos nesta vaga."
                                            class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                        </svg>
                                    </div>
                                    <div class="form-floating number_limit_candidates mt-3" style="display: none;">
                                        <input type="number" class="form-control border-secondary rounded-0 fs-15"
                                            id="number_limit_candidates" placeholder="Quantidade limite de candidatos"
                                            name="number_limit_candidates">
                                        <label class="fs-15 text-black" for="number_limit_candidates">Quantidade limite de
                                            candidatos</label>
                                        <div class="invalid-feedback fs-14">
                                            Insira um valor.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3 mb-lg-0 col-lg-4 text-lg-center">
                                <div class="d-flex flex-column gap-lg-3 justify-content-between justify-content-lg-start">
                                    <div
                                        class="d-flex flex-row gap-lg-3 justify-content-between justify-content-lg-start w-100 align-items-center">
                                        <div>
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <input class="form-check-input mt-3 mt-lg-0" type="checkbox"
                                                    name="receive_notification" role="switch" id="receive_notification"
                                                    min="25"
                                                    @if (old('receive_notification')) @checked(true) @else @checked(false) @endif>
                                                <label class="form-check-label fs-15 ms-4 ms-lg-3"
                                                    for="receive_notification">Receber
                                                    notificação
                                                    de <br class="d-lg-none">visualizações</label>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" data-bs-toggle="tooltip" data-bs-html="true"
                                            data-bs-title="A cada X visualizações em sua vaga, você receberá um e-mail."
                                            class="bi bi-info-circle mt-3 mt-lg-0" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                        </svg>
                                    </div>
                                    <div class="form-floating notifications_views mt-3"
                                        @if (!old('receive_notification')) style="display: none;" @endif>
                                        <select class="form-select border-secondary rounded-0 fs-15"
                                            id="notifications_views" aria-label="Receber notificações a cada"
                                            name="notifications_views">
                                            <option value="100" selected>100</option>
                                            <option value="150">150</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                        </select>
                                        <label class="fs-15 text-black" for="notifications_views">Receber notificações a
                                            cada</label>
                                        <div class="invalid-feedback fs-14">
                                            Insira um valor.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-success py-3 fs-18 px-5 roboto"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-cash me-3" viewBox="0 0 16 16">
                                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                        <path
                                            d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                                    </svg>Efetuar pagamento e pré-visualizar</button>
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
    <script src="./public/build/assets/bundle.js"></script>
    <script src="./public/build/assets/jquery.min.js"></script>
    <script src="./public/build/assets/jquery.mask.js"></script>
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
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                tooltipTriggerEl))
        })
    </script>
    <script>
        $('#salary').mask('000.000.000.000.000,00', {
            reverse: true
        });
    </script>
    <script>
        $('#salary').change(function() {
            if (!(this).value) {
                $('#show_salary').attr('checked', false)
            } else {
                $('#show_salary').attr('checked', true)
            }
        })

        $('#show_salary').change(function() {
            let salary = $('#salary');
            if (!salary.val()) {
                $(this).attr('checked', false)
            }
        })

        $('#limit_candidates').change(function() {
            if ($('#limit_candidates').is(':checked')) {
                $('.number_limit_candidates').show()
                $('#number_limit_candidates').show().prop('required', true)
            } else {
                $('.number_limit_candidates').hide()
                $('#number_limit_candidates').hide().prop('required', false)
            }
        })

        $('#receive_notification').change(function() {
            if ($('#receive_notification').is(':checked')) {
                $('.notifications_views').show()
                $('#notifications_views').prop('required', true)
            } else {
                $('.notifications_views').hide()
                $('#notifications_views').prop('required', false)
            }
        })

        $('#email_receiver').change(function() {
            if ($('#email_receiver').is(':checked')) {
                $('.hour_receive_email').show()
                $('#hour_receive_email').prop('required', true)
            } else {
                $('.hour_receive_email').hide()
                $('#hour_receive_email').prop('required', false)
            }
        })
    </script>
@endsection
