<?php

namespace app\Http\Controllers\Api;

use App\Models\Wedding;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie; 

class PaymentController extends Controller
{
    public function Webhook(Request $request){
        $data = $request->validate([
            'id' => 'required|string'
        ]);

        $payment = Mollie::api()->payments->get($data['id']);

        $wedding = Wedding::where('transaction_id', $payment->id)->first();
        if ($wedding != null) {
            $wedding->payment_status = $payment->status;
            $wedding->save();
            /*if ($payment->isPaid()) {
                Mail::to($event->user->email)->send(new PaymentConfirmed($event));
            } else if ($event->retryable) {
                Mail::to($event->user->email)->send(new PaymentFailed($event));
            } */
        } else {
            //Log::debug('Attempted payment for unknown transaction ID (' . $payment->id . ': ' . $payment->description . ')');
            Return null;
        }

        return response('ok', 200);
    }

    public function paymentStatus(Request $request, Wedding $wedding)
    {
        /*if ($wedding->renewal_transaction_id != null) {
            if ($wedding->renewal_status == 'paid') {
                $request->session()->flash('success', __('event.renew.successful',
                    [
                        'date' => Carbon::createFromTimestamp($event->expires_at)->format('d-m-Y H:i')
                    ])
                );
            }else{
                $request->session()->flash('error', __('event.renew.error'));
            }
            return redirect(route('events.show', ['event' => $event]));
        } */

        if ($wedding->paid) {
            //$request->session()->flash('success', __('wedding.create.payment.successful'));
            //return redirect(route('events.show', ['wedding' => $wedding]));
            return redirect('/bruiloft/'.$wedding->getAttribute('unique_code').'/gastenlijst');
        }

        //$request->session()->flash('error', __('wedding.create.payment.error'));
        //return redirect(route('events.index'));
    }

    public function paymentSuccess(Wedding $wedding) {
        $wedding = Wedding::latest()->first();
        $wedding_id = $wedding->id;

        Wedding::where('id', $wedding_id)->update(['paid'=>1]);

        return redirect(route('homepage'));
    }
}