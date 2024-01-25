@extends('layouts.layout')
@section('title')
    <title>Dashboard - Vagas Maceió</title>
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
                        <div class="alert alert-success mb-5 fs-15">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1 class="fs-20 text-center mb-5"><strong>Minhas vagas adicionadas ({{ $vacancies->count() }}):</strong>
                    </h1>
                    <a href="{{ route('vacancy.create') }}" target="_blank" rel="noopener noreferrer"
                        class="fs-16 text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg> Publicar nova vaga</a>
                    <ol class="list-group list-group-numbered mt-3">
                        @foreach ($vacancies as $vacancy)
                            {{-- {{dd($vacancy)}} --}}
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
                                        <hr class="vr d-none d-lg-block my-0 px-0 h-75 align-self-center opacity-75"
                                            style="width: 1px;">
                                        <div>
                                            <p class="mb-0" href="">Visualizações:
                                                {{ $vacancy->views_count === null ? 0 : $vacancy->views_count }}</p>
                                        </div>
                                        <hr class="vr d-none d-lg-block my-0 px-0 h-75 align-self-center opacity-75"
                                            style="width: 1px;">
                                        <div>
                                            <p class="mb-0" href="">Candidatos: {{ $vacancy->candidates->count() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row gap-3 gap-lg-3 mt-3 mt-lg-0">
                                        @if ($vacancy->paid_status === 'in process' || $vacancy->paid_status === 'rejected')
                                            <div>
                                                <a href="{{route('payment.checkout', $vacancy)}}">Efetuar pagamento</a>
                                            </div>
                                            <hr class="vr my-0 px-0 h-75 align-self-center opacity-75" style="width: 1px;">
                                        @elseif($vacancy->paid_status === 'paid out' && $vacancy->paid_status->approved_by_admin === 1 && $vacancy->days_available > $now_datetime)
                                        <div>
                                            <a href="">Gerenciar candidatos</a>
                                        </div>
                                        <hr class="vr my-0 px-0 h-75 align-self-center opacity-75" style="width: 1px;">
                                        @elseif($vacancy->paid_status === 'paid out' && $vacancy->days_available <= $now_datetime)
                                        <div>
                                            <a href="{{route('payment.checkout', $vacancy)}}">Renovar vaga</a>
                                        </div>
                                        <hr class="vr my-0 px-0 h-75 align-self-center opacity-75" style="width: 1px;">
                                        @endif
                                        <div>
                                            <a href="{{ route('vacancy.edit', ['vacancy' => $vacancy]) }}">Editar</a>
                                        </div>
                                        <hr class="vr my-0 px-0 h-75 align-self-center opacity-75" style="width: 1px;">
                                        <div>
                                            <a target="_blank"
                                                href="{{ route('vacancy.preview', ['vacancy' => $vacancy]) }}">Pré-visualizar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-1 order-lg-3 d-lg-block text-end">
                                    @if ($vacancy->choiced_plan === 'Normal')
                                        <span class="badge fs-14 bg-primary rounded-pill">Normal</span>
                                    @else
                                        <span class="badge fs-14 bg-orange text-black rounded-pill">Destaque</span>
                                    @endif
                                    @if ($vacancy->paid_status === 'in process')
                                        <span class="badge fs-14 text-bg-warning rounded-pill">Pagamento pendente</span>
                                    @elseif ($vacancy->paid_status === 'rejected')
                                        <span class="badge fs-14 text-bg-danger rounded-pill">Pagamento reprovado</span>
                                    @elseif (
                                        $vacancy->paid_status === 'paid out' &&
                                            $vacancy->approved_by_admin === 0 &&
                                            $vacancy->days_available > $now_datetime)
                                        <span class="badge fs-14 text-bg-info rounded-pill">Aguardando aprovação</span>
                                    @elseif (
                                        $vacancy->paid_status === 'paid out' &&
                                            $vacancy->approved_by_admin === 1 &&
                                            $vacancy->days_available > $now_datetime)
                                        <span class="badge fs-14 bg-success rounded-pill">Disponível até:
                                            {{ $vacancy->days_available->format('d/m/Y') }} às
                                            {{ $vacancy->days_available->format('H:i') }}</span>
                                    @else
                                        <span class="badge fs-14 bg-danger rounded-pill">Anúncio expirado</span>
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
