<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\PaymentCallBackRequest;
use App\Models\Code;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class PaymobController extends Controller
{
    protected $paymob;

    public function __construct(PaymobService $paymob)
    {
        $this->paymob = $paymob;
    }

    public function initiatePayment()
    {
        $config = Config::select('price_of_card')->first();

        if (!$config || !is_numeric($config->price_of_card)) {
            return response()->json(['error' => 'Invalid price value'], 400);
        }

        $amount = (float) $config->price_of_card;
        $order = $this->paymob->createOrder($amount);

        if (!isset($order['id'])) {
            return response()->json(['error' => 'Failed to create order'], 400);
        }

        $paymentKey = $this->paymob->getPaymentKey($order['id'], $amount, auth('api')->user());

        if (!$paymentKey) {
            return response()->json(['error' => 'Failed to generate payment key'], 400);
        }
        $payment = Payment::create([
            'order_id' => $order['id'],
            'user_id' => auth('api')->user()->id,
            'amount' => $amount,
        ]);
        return  $paymentKey;
    }

    public function getPaymentLink()
    {
        $iframe = env('IFRAME_ID');
        $token = $this->initiatePayment();
        return Response::api(__('message.Success'), 200, true, null, [
            'link' => "https://accept.paymob.com/api/acceptance/iframes/$iframe?payment_token=$token"
        ]);
    }

    public function paymentCallback(PaymentCallBackRequest $request)
    {
        $payment = Payment::where('order_id', $request->order)->first();
        if (!$payment) {
            return response()->view('payment.result', [
                'status' => 'failed',
                'message' => __('message.failed'),
            ], 404);
        }
        $status = $request->success == "true" ? 'success' : ($request->pending == "true" ? 'pending' : 'failed');

        $payment->update([
            'trnx_id' => $request->id,
            'txn_response_code' => $request->txn_response_code,
            'message' => $request->data_message,
            'pending' => $request->pending == "true" ? true : false,
            'success' => $request->success == "true" ? true : false,
            'type' => $request->source_data_type,
            'source_data_sub_type' => $request->source_data_sub_type,
            'status' => $status,
        ]);
        if ($payment->success == true) {
            $code = Code::where('user_id',  null)->first();
            if ($code) {
                $code->update([
                    'user_id' => $payment->user_id,
                    'start_date' => now(),
                    'end_date' => now()->addYear(),
                ]);
            } else {
                do {
                    $code = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                } while (Code::where('code', $code)->exists());
                Code::create([
                    'code' => $code,
                    'user_id' => $payment->user_id,
                    'start_date' => now(),
                    'end_date' => now()->addYear(),
                ]);
            }
        }
        $redirectUrl = env('FRONTEND_URL') . "setting?status={$payment->status}&message=" . urlencode($payment->message ?? __('message.' . $payment->status));

        return redirect()->to($redirectUrl);
    }
}
