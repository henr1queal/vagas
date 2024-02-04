@extends('layouts.layout')
@section('title')
    <title>Candidatos - Vagas Maceió</title>
@endsection
@section('css')
    <style>
        .accordion-button:focus {
            box-shadow: initial;
        }

        @media (max-width: 370px) {
            .fs-15 {
                font-size: 1.4rem;
            }

            .fs-14 {
                font-size: 1.3rem;
            }
        }

        @media (min-width: 992px) {
            main {
                height: 75dvh;
                overflow: auto;
            }
        }

        @media (max-width: 480px) {
            .list-group-numbered>.list-group-item:before {
                margin-top: 10px;
                order: 2 !important;
            }

            .accordion-button::after {
                order: 3;
            }

            nav {
                height: 13dvh;
            }

            main {
                height: 62dvh;
                overflow: auto;
            }
        }

        .capitalize::first-letter {
            text-transform: uppercase;
        }

        .accordion-button::after {
            margin-left: initial;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container px-4 py-5 roboto">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success mb-5 fs-15 roboto">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1 class="fs-20 text-center mb-lg-5"><strong>Candidatos da minha vaga
                            ({{ $candidates->count() }}):</strong></h1>
                </div>
            </div>
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion fs-16 roboto" id="accordionExample">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($candidates as $candidate)
                            <div class="accordion-item">
                                <h2 class="accordion-header d-flex">
                                    <button
                                        class="accordion-button collapsed fs-16 gap-3 gap-lg-5 py-4 fw-medium flex-column flex-md-row"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $count }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $count }}">
                                        <span class="">{{ $candidate->name }}</span>
                                        <div class="ms-lg-auto text-center d-flex gap-2 flex-column flex-lg-row">
                                            @if ($candidate->candidateFiles->count() > 0)
                                                <span class="badge text-bg-primary fs-14">Enviou arquivo de currículo</span>
                                            @endif
                                            @if ($candidate->candidateFields->count() > 0)
                                                <span class="badge text-bg-info fs-14">Enviou currículo por
                                                    formulário</span>
                                            @endif
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse-{{ $count }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body"
                                        style="background-color: #e5e5e5; @if (!$loop->last) border-right: 2px dashed rgba(0,0,0,0.25); border-left: 2px dashed rgba(0,0,0,0.25); @else border-right: 2px dashed rgba(0,0,0,0.25); border-bottom: 2px dashed rgba(0,0,0,0.25); border-left: 2px dashed rgba(0,0,0,0.25); @endif">
                                        <div class="row">
                                            <h2 class="mt-2 mb-4 fs-18"><strong>Contatos e idade:</strong></h2>
                                            <div class="bg-white p-3 rounded-4">
                                                <div class="col-12">
                                                    <p class="fw-medium"><strong>Telefone/Celular:</strong>
                                                        {{ $candidate->phone }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <p class="fw-medium"><strong>Whatsapp: </strong><a
                                                            href="https://api.whatsapp.com/send?phone={{ $candidate->whatsapp }}&text=Ol%C3%A1,%20{{ strtok($candidate->name, ' ') }}!">{{ $candidate->whatsapp }}</a>
                                                    </p>
                                                </div>
                                                @if ($candidate->candidateFields->count() > 0)
                                                    @php
                                                        $birth_date = new DateTime($candidate->candidateFields->first()->birth_date);
                                                        $currentDate = new DateTime();

                                                        // Calcula a diferença entre as datas
                                                        $age = $birth_date->diff($currentDate)->y;
                                                    @endphp
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Idade:</strong> {{ $age }}
                                                            anos ({{ $birth_date->format('d/m/Y') }})</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <hr class="mt-4">
                                            @if ($candidate->candidateFiles->count() > 0)
                                                <h2 class="mt-2 mb-4 fs-18"><strong>Currículo (arquivo) e data de
                                                        envio:</strong></h2>
                                                <div class="bg-white p-3 rounded-4">
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Currículo:</strong>
                                                            <a href="{{ route('candidates.curriculum', ['filename' => $candidate->candidateFiles->first()->filename]) }}"
                                                                target="_blank" rel="noopener noreferrer">Clique para
                                                                visualizar <span
                                                                    class="badge text-bg-primary fs-14 ms-3 d-none d-lg-inline">Arquivo
                                                                    de currículo</span></a>
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Candidatou-se por arquivo em:</strong>
                                                            {{ $candidate->candidateFiles->first()->created_at->format('d/m/Y, H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr class="mt-4">
                                            @endif
                                            @if ($candidate->candidateFields->count() > 0)
                                                <h2 class="mt-2 mb-4 fs-18"><strong>Currículo gerado (formulário):</strong>
                                                    <span
                                                        class="badge text-bg-info fs-14 ms-2 d-none d-lg-inline mb-1">Currículo
                                                        por formulário</span></h2>
                                                <div class="bg-white p-3 rounded-4">
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Bairro:</strong>
                                                            {{ $candidate->candidateFields->first()->district }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Tempo de experiência:</strong>
                                                            {{ $candidate->candidateFields->first()->experience_years }}
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Estado civil:</strong>
                                                            <span
                                                                class="text-capitalize">{{ $candidate->candidateFields->first()->marital_status }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Tem filhos:</strong>
                                                            <span
                                                                class="text-capitalize">{{ $candidate->candidateFields->first()->has_children }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Disponibilidade:</strong>
                                                            <span
                                                                class="text-capitalize">{{ $candidate->candidateFields->first()->availability }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-medium"><strong>Candidatou-se por formulário
                                                                em:</strong>
                                                            {{ $candidate->candidateFields->first()->created_at->format('d/m/Y, H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($candidate->candidateFields->isNotEmpty() && $candidate->candidateFields->first()->experiences->isNotEmpty())
                                                @php
                                                    $count = 1;
                                                @endphp
                                                @foreach ($candidate->candidateFields->first()->experiences as $experience)
                                                    <hr class="mt-4">
                                                    @if ($loop->first)
                                                        <h2 class="mt-2 mb-4 fs-18"><strong>Experiências de
                                                                emprego:</strong></h2>
                                                    @endif
                                                    <p class="fw-medium"><strong>Experiência
                                                            {{ $count }}:</strong></p>
                                                    <div class="bg-white p-3 rounded-4">
                                                        <div class="col-12">
                                                            <p class="fw-medium"><strong>Nome da empresa:</strong>
                                                                {{ $experience->company_name }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="fw-medium"><strong>Cargo:</strong>
                                                                {{ $experience->job_title }}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="fw-medium"><strong>Data de admissão:</strong>
                                                                @if ($experience->start_date)
                                                                    {{ date('d/m/Y', strtotime($experience->start_date)) }}
                                                                @else
                                                                    Não preenchido
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="fw-medium"><strong>Data de rescisão:</strong>
                                                                @if ($experience->end_date)
                                                                    {{ date('d/m/Y', strtotime($experience->end_date)) }}
                                                                @else
                                                                    Não preenchido
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="fw-medium"><strong>Fale sobre sua
                                                                    experiência:</strong>
                                                                @if ($experience->description)
                                                                    {{ $experience->description }}
                                                                @else
                                                                    Não preenchido
                                                                @endif
                                                            </p>
                                                        </div>
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-3">
                                                <hr class="my-5">
                                            </div>
                                            <div class="col-auto"><span>Fim do candidato.</span></div>
                                            <div class="col-3">
                                                <hr class="my-5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </div>
                </div>
                <div class="col-12 mt-5 text-center">
                    {{ $candidates->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection