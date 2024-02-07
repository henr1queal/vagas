@extends('layouts.layout')
@section('title')
    <title>Vagas não aprovadas - Vagas Maceió</title>
@endsection
@section('css')
    <style>
        .bg-orange {
            background-color: orange;
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
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container px-4 py-5 roboto">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success mb-5 fs-15 montserrat">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1 class="fs-20 text-center mb-5"><strong>Vaga com aprovação pendente:</strong></h1>
                    <ol class="list-group list-group-numbered mt-3">
                        @foreach ($vacancies as $vacancy)
                            <li
                                class="list-group-item d-flex flex-column flex-lg-row justify-content-between align-items-start fs-15 p-4">
                                <div class="ms-2 me-auto order-3 order-lg-2">
                                    <div class="fw-bold fs-18">{{ $vacancy->title }}</div>
                                    <div class="d-flex flex-column flex-lg-row gap-lg-2 mt-3">
                                        <div>
                                            <p class="mb-0" href="">Criada em:
                                                {{ $vacancy->created_at->format('d/m/Y') . ' às ' . $vacancy->created_at->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row gap-3 gap-lg-3 mt-3 mt-lg-0">
                                        <div>
                                            <a href="{{ route('vacancy.edit', ['vacancy' => $vacancy]) }}">Editar</a>
                                        </div>
                                        <hr class="vr my-0 px-0 h-75 align-self-center opacity-75" style="width: 1px;">
                                        <div>
                                            <a target="_blank"
                                                href="{{ route('vacancy.preview', ['vacancy' => $vacancy]) }}">Pré-visualizar</a>
                                        </div>
                                        <hr class="vr my-0 px-0 h-75 align-self-center opacity-75" style="width: 1px;">
                                        <div>
                                            <a target="_blank"
                                                href="{{ route('vacancy.approve', ['vacancy' => $vacancy]) }}">Aprovar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-1 order-lg-3 d-lg-block text-end">
                                    @if ($vacancy->choiced_plan === 'Normal')
                                        <span class="badge fs-14 bg-primary rounded-pill">Normal</span>
                                    @else
                                        <span class="badge fs-14 bg-orange text-black rounded-pill">Destaque</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </main>
@endsection
