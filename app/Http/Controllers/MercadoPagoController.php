<?php

namespace App\Http\Controllers;

use App\Mail\NewVacancyAdded;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

class MercadoPagoController extends Controller
{
    public function checkout(Request $request, Vacancy $vacancy)
    {
        if ($vacancy->choiced_plan === 'Normal') {
            $id = 1;
            $title = '30 dias (normal)';
            $description = 'Seu anúncio será exibido em nosso site durante 30 dias à partir de nossa aprovação.';
        } else {
            $id = 2;
            $title = '15 dias (destaque)';
            $description = 'Seu anúncio será exibido no topo de nosso site durante 15 dias com um selo de destaque à partir de nossa aprovação.';
        }
        $paid_value = $vacancy->paid_value;
        $previous_value = $paid_value * 1.2;
        $access_token = env('MP_ACCESS_TOKEN');
        $public_key = env('MP_PUBLIC_KEY');
        // Adicione as credenciais
        MercadoPagoConfig::setAccessToken($access_token);

        $preference = new PreferenceClient();
        $client = $preference->create([
            "items" => array(
                array(
                    "id" => $id,
                    "description" => $description,
                    "title" => $title,
                    "quantity" => 1,
                    "unit_price" => $paid_value,
                )
            )
        ]);


        $client->payer = array(
            "name" => $request->user()->name,
            "email" => $request->user()->email,
        );

        $client->payment_methods = array(
            "installments" => 2
        );

        return view('preview-and-payment', [
            'preference' => $client,
            'public_key' => $public_key,
            'vacancy' => $vacancy,
            'previous_value' => $previous_value
        ]);
    }

    public function webhook(Request $request)
    {
        $payment_id = isset($request->data['id']) ? $request->data['id'] : null;
        if ($payment_id === null) {
            return;
        } else {
            $access_token = env('MP_ACCESS_TOKEN');
            $unique_id = uniqid();
            MercadoPagoConfig::setAccessToken($access_token);
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: {$unique_id}"]);

            $client = new PaymentClient();
            $payment = $client->get($payment_id, $request_options);

            $vacancy = Vacancy::find($payment->external_reference);

            $vacancy->paid_value = $payment->transaction_amount;
            $vacancy->payment_id = $payment_id;

            if ($payment->status === 'approved') {
                $vacancy->paid_status = 'paid out';
                $now_datetime = now();

                if ($vacancy->approved_by_admin === 1 && $vacancy->days_available > $now_datetime) {
                    $vacancy->days_available->addDays($payment->description === 'Normal' ? 30 : 15);
                } else {
                    $vacancy->days_available = now()->addDays($payment->description === 'Normal' ? 30 : 15);
                }
                Artisan::call('cache:clear');
                Mail::to('henriquersilva.al@gmail.com')->send(new NewVacancyAdded($vacancy->id));
            } elseif ($payment->status === 'pending' || $payment->status === 'in_process') {
                $vacancy->paid_status = 'in process';
            } else {
                $vacancy->paid_status = 'rejected';
            }
            $vacancy->updated_at = now();
            $vacancy->save();
        }
    }

    public function process(Request $request, Vacancy $vacancy)
    {
        $access_token = env('MP_ACCESS_TOKEN');
        MercadoPagoConfig::setAccessToken($access_token);
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $unique_id = uniqid();
        $request_options->setCustomHeaders(["X-Idempotency-Key: {$unique_id}"]);
        try {
            if ($request->payment_method_id === 'pix') {
                $payment = $this->pix($client, $request, $request_options, $vacancy);
            } else if ($request->payment_method_id === 'bolbradesco' || $request->payment_method_id === 'pec') {
                $payment = $this->ticket($client, $request, $request_options, $vacancy);
            } else {
                $payment = $this->card($client, $request, $request_options, $vacancy);
            }
            return response()->json($payment);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tente efetuar o pagamento novamente.');
        }
    }

    private function pix($client, $request, $request_options, $vacancy)
    {
        $payment = $client->create([
            "transaction_amount" => (float) $request->transaction_amount,
            "description" => $vacancy->choiced_plan,
            "payment_method_id" => $request->payment_method_id,
            "external_reference" => $vacancy->id,
            'notification_url' => route('payment.webhook'),
            "payer" => [
                "email" => $request->payer['email'],
            ]
        ], $request_options);

        return $payment;
    }
    private function card($client, $request, $request_options, $vacancy)
    {
        $payment = $client->create([
            "transaction_amount" => (float) $request->transaction_amount,
            "token" => $request->token,
            "installments" => $request->installments,
            "description" => $vacancy->choiced_plan,
            "payment_method_id" => $request->payment_method_id,
            "external_reference" => $vacancy->id,
            "issuer_id" => $request->issuer_id,
            'notification_url' => route('payment.webhook'),
            "payer" => [
                "email" => $request->payer['email'],
                "identification" => [
                    "type" => $request->payer['identification']['type'],
                    "number" => $request->payer['identification']['number']
                ]
            ]
        ], $request_options);

        return $payment;
    }
    private function ticket($client, $request, $request_options, $vacancy)
    {
        $payment = $client->create([
            "transaction_amount" => (float) $request->transaction_amount,
            "issuer_id" => $request->issuer_id,
            "description" => $vacancy->choiced_plan,
            "payment_method_id" => $request->payment_method_id,
            "external_reference" => $vacancy->id,
            'notification_url' => route('payment.webhook'),
            "payer" => [
                "email" => $request->payer['email'],
                "first_name" => $request->payer['first_name'],
                "last_name" => $request->payer['last_name'],
                "identification" => [
                    "type" => $request->payer['identification']['type'],
                    "number" => $request->payer['identification']['number']
                ],
                "address" => [
                    "zip_code" => $request->payer["address"]['zip_code'],
                    "street_name" => $request->payer["address"]['street_name'],
                    "street_number" => $request->payer["address"]['street_number'],
                    "neighborhood" => $request->payer["address"]['neighborhood'],
                    "city" => $request->payer["address"]['city'],
                    "federal_unit" => $request->payer["address"]['federal_unit']
                ]
            ]
        ], $request_options);

        return $payment;
    }
}
