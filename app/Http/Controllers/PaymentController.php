<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkoutEmphasis(Request $request, $id)
    {
        $user = $request->user();
        return $user->checkout(['price_1OaV1ADrHbA1kD5pplDeaxRH' => 1], [
            'success_url' => route('payment.success', [
                'product' => 'Destaque',
                'id' => $id
            ]),
            'cancel_url' => route('payment.cancel'),
        ]);
    }

    public function checkoutNormal(Request $request, $id)
    {
        $user = $request->user();
        return $user->checkout(['price_1OaV1oDrHbA1kD5plNnTpkM4' => 1], [
            'success_url' => route('payment.success', [
                'product' => 'Normal',
                'id' => $id
            ]),
            'cancel_url' => route('payment.cancel'),
        ]);
    }

    public function paymentConfirmed($product, $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->update(['choiced_plan' => $product]);
        return 'ok!';
    }

    public function simularPagamentoPix($qrcode_id)
    {
        $curl = curl_init();

        $qrCode = 'QRCO_1A83D54F-31E3-451F-B974-229C3B0A3276';

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://sandbox.api.pagseguro.com/pix/pay/{$qrCode}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_CAINFO => base_path('public/cacert.pem'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => [
                "Authorization: 53B6EE1D97EB45159B11D5C1DCE3B4C7",
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function pix()
    {
        $endpoint = 'https://api.pagseguro.com/orders';
        $token = 'caef53dc-e9ee-4d00-8662-02045d55009c0519f1464183b1678d072d4ba286af3b7e21-799d-4171-9f8a-e7708419b8fe';

        $body =
            [
                "reference_id" => "ex-00001",
                "customer" => [
                    "name" => "Jose da Silva",
                    "email" => "email@test.com",
                    "tax_id" => "12345678909",
                    "phones" => [
                        [
                            "country" => "55",
                            "area" => "11",
                            "number" => "999999999",
                            "type" => "MOBILE"
                        ]
                    ]
                ],
                "items" => [
                    [
                        "name" => "nome do item",
                        "quantity" => 1,
                        "unit_amount" => 500
                    ]
                ],
                "qr_codes" => [
                    [
                        "amount" => [
                            "value" => 500
                        ],
                    ]
                ],
                "shipping" => [
                    "address" => [
                        "street" => "Avenida Brigadeiro Faria Lima",
                        "number" => "1384",
                        "complement" => "apto 12",
                        "locality" => "Pinheiros",
                        "city" => "São Paulo",
                        "region_code" => "SP",
                        "country" => "BRA",
                        "postal_code" => "01452002"
                    ]
                ],
                "notification_urls" => [
                    "https://alexandrecardoso-pagseguro.ultrahook.com"
                ]
            ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_CAINFO, base_path('public/cacert.pem'));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization: Bearer ' . $token
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            dd($error);
            die();
        }

        $data = json_decode($response, true);

        dd($data);
    }
}
