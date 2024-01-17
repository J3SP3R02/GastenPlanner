<?php

namespace App\Supports;

use App\Models\Wedding;
use Mollie\Laravel\Facades\Mollie;

trait Payment{

    public function start(Wedding $wedding){
        //$price = config('weddingplanner.price');
        $price = "15.00";
        /*if ($wedding->referralcode()->exists()) {
            $price -= $wedding->referralcode->discount;
        } */

        $description = "Test";  //__('event.create.payment.description', ['domain' => $wedding->domain]);

        $payment = self::createPayment($wedding, $description, $price);

        $wedding->transaction_id = $payment->id;
        $wedding->save();

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function createPayment(Wedding $wedding, $description, /*string $amount*/)
    {
        $webhookenabled = env('MOLLIE_WEBHOOK_ENABLED');

        if ($webhookenabled == 1) {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey(env('MOLLIE_KEY', 'test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'));
            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    "currency" => "EUR",
                    "value" => "15.00" // "You must send the correct number of decimals, thus we enforce the use of strings" -Mollie documentation
                ],
                'description' => $description, //"Example order #12345",
                'redirectUrl' => route(('payment_status'), ['unique_code' => $wedding]),
                'cancelUrl' => route('homepage'),
                'method' => 'ideal',
                "webhookUrl" => route('mollie.webhook'),
                //"metadata" => [
                    //"order_id" => "12345"
                //],
            ]);

            return redirect($payment->getCheckoutUrl(), 303);
        }
        else {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey(env('MOLLIE_KEY', 'test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'));
            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    "currency" => "EUR",
                    "value" => "15.00" // "You must send the correct number of decimals, thus we enforce the use of strings" -Mollie documentation
                ],
                'description' => $description,
                'redirectUrl' => route('payment.success'),
                'cancelUrl' => route('homepage'),
                'method' => 'ideal',
            ]);

            return redirect($payment->getCheckoutUrl(), 303);
        };
    }
}