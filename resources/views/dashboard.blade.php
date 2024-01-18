@extends('layouts.layout')
@section('title')
    Gerenciamento - Vagas Maceió
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
    <div class="container px-4 roboto">
        <div class="row">
            <div class="col-12 text-center my-5">
                <h1 class="fs-20">Publique sua vaga</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-11 col-lg-10">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex gap-3 align-items-center pb-3 pb-lg-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                data-bs-toggle="tooltip" data-bs-title="Ex: Enfermeiro(a)" class="bi bi-info-circle order-2 order-lg-1"
                                viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                            <div class="form-floating w-100 order-1 order-lg-2">
                                <input type="text" class="form-control border-secondary rounded-0 fs-15" id="password"
                                    placeholder="Título da vaga" name="password" required>
                                <label class="fs-15 text-black" for="password">Título da vaga<span
                                        class="text-danger">*</span></label>
                                <div class="invalid-feedback fs-14">
                                    Digite sua senha.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border-secondary rounded-0 fs-15" id="salary"
                                placeholder="Salário (R$)" name="salary" required>
                            <label class="fs-15 text-black" for="salary">Salário (R$)</label>
                            <div class="invalid-feedback fs-14">
                                Digite sua senha.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <select class="form-select border-secondary rounded-0 fs-15" id="employment_type"
                                name="employment_type" aria-label="Regime de contratação" required>
                                <option value="CLT">CLT</option>
                                <option value="PJ">PJ</option>
                            </select>
                            <label class="fs-15 text-black" for="employment_type">Regime de contratação<span
                                    class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg">
                        <div class="d-flex gap-3 align-items-center pb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Ex: 44 <br>(aparecerá no site 44h semanais)." class="bi bi-info-circle order-2 order-lg-1"
                                viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                            <div class="form-floating w-100 order-1 order-lg-2">
                                <input type="number" class="form-control border-secondary rounded-0 fs-15" id="workload"
                                    placeholder="Carga horária" name="workload" required>
                                <label class="fs-15 text-black" for="workload">Carga horária</label>
                                <div class="invalid-feedback fs-14">
                                    Digite sua senha.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg">
                        <div class="form-floating mb-3">
                            <select class="form-select border-secondary rounded-0 fs-15" id="work_shedule"
                                name="work_shedule" aria-label="Horário de trabalho" required>
                                <option value="Diurno">Diurno</option>
                                <option value="Noturno">Noturno</option>
                                <option value="Flexível">Flexível</option>
                            </select>
                            <label class="fs-15 text-black" for="work_shedule">Horário de trabalho<span
                                    class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-12 col-lg">
                        <div class="form-floating mb-3">
                            <select class="form-select border-secondary rounded-0 fs-15" id="job_type" name="job_type"
                                aria-label="Tipo de trabalho" required>
                                <option value="Trainee">Trainee</option>
                                <option value="Estágio">Estágio</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Tempo integral" selected>Tempo integral</option>
                            </select>
                            <label class="fs-15 text-black" for="job_type">Tipo de trabalho<span
                                    class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center my-5">
                        <h1 class="fs-16">Configurações:</h1>
                    </div>
                </div>
                <div class="row gap-4">
                    <div class="col-12">
                        <div class="d-flex gap-lg-3 justify-content-between justify-content-lg-start align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="show_company" role="switch"
                                    id="show_company" checked>
                                <label class="form-check-label fs-15 ms-4 ms-lg-3" for="show_company">Exibir nome da
                                    empresa</label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Caso desative, será exibido 'empresa confidencial'."
                                class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-lg-3 justify-content-between justify-content-lg-start align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="show_salary" role="switch"
                                    id="show_salary">
                                <label class="form-check-label fs-15 ms-4 ms-lg-3" for="show_salary">Exibir salário</label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Caso desative aqui, ou não adicione valor ao campo Salário, será exibido <br>'a combinar'."
                                class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-lg-3 justify-content-between justify-content-lg-start align-items-lg-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input mt-3 mt-lg-0" type="checkbox" name="limit_receives" role="switch"
                                    id="limit_receives">
                                <label class="form-check-label fs-15 ms-4 ms-lg-3" for="limit_receives">Limitar recebimento de
                                    <br class="d-lg-none">candidatos</label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="Desative caso não queira receber um valor máximo de candidatos nesta vaga."
                                class="bi bi-info-circle mt-3 mt-lg-0" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-lg-3 justify-content-between justify-content-lg-start align-items-lg-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input mt-3 mt-lg-0" type="checkbox" name="receive_notification"
                                    role="switch" id="receive_notification">
                                <label class="form-check-label fs-15 ms-4 ms-lg-3" for="receive_notification">Receber notificação
                                    de <br class="d-lg-none">visualizações</label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                data-bs-toggle="tooltip" data-bs-html="true"
                                data-bs-title="A cada X visualizações em sua vaga, você receberá um e-mail."
                                class="bi bi-info-circle mt-3 mt-lg-0" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                        </div>
                    </div>
                </div>
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
    <script src="./public/build/assets/bundle.js"></script>
    <script src="./public/build/assets/jquery.min.js"></script>
    <script src="./public/build/assets/jquery.mask.js"></script>
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
    </script>
@endsection
