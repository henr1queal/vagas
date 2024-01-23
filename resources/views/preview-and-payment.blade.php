@extends('layouts.layout')
@section('title')
    <title>Efetuar pagamento - Vagas Maceió</title>
@endsection
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <style>
        #statusScreenBrick_container header {
            height: initial !important;
            background-color: initial !important;
        }

        @media (min-width: 992px) {
            main {
                height: 75dvh;
                overflow: auto;
            }
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container roboto py-5">
            <div class="row">
                <div class="col text-center">
                    <h2 class="fs-20"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-cash me-3" viewBox="0 0 16 16">
                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                            <path
                                d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                        </svg> Efetuar pagamento
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center gap-3 gap-lg-5 mt-5">
                <div class="col-11 col-lg-4 bg-white gap-5 h-100" style="border-radius: 12px; padding: 16px;">
                    <div class="d-flex flex-column gap-3" style="padding-top: 16px; padding-bottom: 16px;">
                        <h2 class="fs-18"><strong>Vaga de {{ $vacancy->title }}</strong></h2>
                        @if ($vacancy->choiced_plan === 'Normal')
                            <h2 class="fs-16"><strong>Plano selecionado:</strong> Normal. <a
                                    href="{{ route('vacancy.edit', ['vacancy' => $vacancy]) }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-fill ms-3 me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>Editar</a></h2>
                            <h2 class="fs-16">Descrição do plano: Seu anúncio ficará ativo durante 30 dias no nosso site.
                            </h2>
                        @else
                            <h2 class="fs-16"><strong>Plano selecionado:</strong> Destaque. <a
                                    href="{{ route('vacancy.edit', ['vacancy' => $vacancy]) }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-fill ms-3 me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>Editar</a></h2>
                            <h2 class="fs-16">Descrição do plano: Seu anúncio ficará ativo durante 15 dias com selo de
                                destaque
                                no topo do nosso site.</h2>
                        @endif
                        <h2 class="fs-16"><strong>Valor:</strong> de <s class="fs-16 text-danger">R$ 99,90</s> por <span
                                class="fs-18 text-success"><strong>R$ 79,90</strong></span>.</h2>
                        <a target="_blank" class="fs-16"
                            href="{{ route('vacancy.preview', ['vacancy' => $vacancy]) }}"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-arrow-up-right-square me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z" />
                            </svg>Pré-visualizar vaga</a>
                    </div>
                </div>
                <div class="col-11 col-lg px-0">
                    <div id="paymentBrick_container"></div>
                    <div id="statusScreenBrick_container" class="mt-4"></div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        const mp = new MercadoPago('{{ env('MP_PUBLIC_KEY') }}', {
            locale: 'pt-BR'
        });
        const bricksBuilder = mp.bricks();
        const renderPaymentBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    /*
                      "amount" é o valor total a ser pago por todos os meios de pagamento
                    com exceção da Conta Mercado Pago e Parcelamento sem cartão de crédito, que tem seu valor de processamento determinado no backend através do "preferenceId"
                     */
                    amount: {{ $preference->items[0]->unit_price }},
                    preferenceId: "{{ $preference->id }}",
                    payer: {
                        email: '{{ $preference->payer['email'] }}',
                    },
                },
                customization: {
                    paymentMethods: {
                        ticket: "all",
                        bankTransfer: "all",
                        creditCard: "all",
                        maxInstallments: {{ $preference->payment_methods['installments'] }},
                    },
                    visual: {
                        showExternalReference: true
                    }
                },
                callbacks: {
                    onReady: () => {
                        /*
                         Callback chamado quando o Brick estiver pronto.
                         Aqui você pode ocultar loadings do seu site, por exemplo.
                        */
                    },
                    onSubmit: ({
                        selectedPaymentMethod,
                        formData
                    }) => {
                        // callback chamado ao clicar no botão de submissão dos dados
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        return new Promise((resolve, reject) => {
                            fetch("{{ route('payment.process', ['vacancy' => $vacancy]) }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": csrfToken
                                    },
                                    body: JSON.stringify(formData),
                                })
                                .then((response) => response.json())
                                .then((response) => {
                                    // receber o resultado do pagamento
                                    console.log(response.id)

                                    const renderStatusScreenBrick = async (bricksBuilder) => {
                                        const settings = {
                                            initialization: {
                                                paymentId: response
                                                    .id, // Payment identifier, from which the status will be checked
                                            },
                                            customization: {
                                                visual: {
                                                    hideStatusDetails: false,
                                                    hideTransactionDate: false,
                                                    style: {
                                                        theme: 'default', // 'default' | 'dark' | 'bootstrap' | 'flat'
                                                    }
                                                },
                                                backUrls: {
                                                    'error': '{{ route('dashboard') }}',
                                                    'return': '{{ route('home') }}'
                                                }
                                            },
                                            callbacks: {
                                                onReady: () => {
                                                    /*
                                                      Callback chamado quando o Brick estiver pronto.
                                                      Aqui você pode ocultar loadings do seu site, por exemplo.
                                                    */
                                                },
                                                onError: (error) => {
                                                    // callback chamado para todos os casos de erro do Brick
                                                    console.error(error);
                                                },
                                            },
                                        };
                                        window.statusScreenBrickController =
                                            await bricksBuilder.create(
                                                'statusScreen',
                                                'statusScreenBrick_container',
                                                settings,
                                            );
                                    };
                                    renderStatusScreenBrick(bricksBuilder);

                                    resolve();
                                })
                                .catch((error) => {
                                    // lidar com a resposta de erro ao tentar criar o pagamento
                                    reject();
                                });
                        });
                    },
                    onError: (error) => {
                        // callback chamado para todos os casos de erro do Brick
                        console.error(error);
                    },
                },
            };
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
        };
        renderPaymentBrick(bricksBuilder);
    </script>
@endsection
