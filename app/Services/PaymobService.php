<?php

namespace App\Services;

use GuzzleHttp\Client;

class PaymobService
{
    protected $client;
    protected $apiKey;
    protected $integrationId;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://accept.paymob.com/api/']);
        $this->apiKey = env('PAYMOB_API_KEY');
        $this->integrationId = env('PAYMOB_INTEGRATION_ID');
    }

    public function getAuthToken()
    {
        $response = $this->client->post('auth/tokens', [
            'json' => ['api_key' => $this->apiKey]
        ]);

        return json_decode($response->getBody(), true)['token'] ?? null;
    }

    public function createOrder(float $amount, $currency = 'EGP')
    {
        $token = $this->getAuthToken();

        $response = $this->client->post('ecommerce/orders', [
            'json' => [
                'auth_token' => $token,
                'delivery_needed' => false,
                'amount_cents' => $amount * 100,
                'currency' => $currency,
                'items' => []
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getPaymentKey($orderId, $amount, $user)
    {
        $token = $this->getAuthToken();

        $response = $this->client->post('acceptance/payment_keys', [
            'json' => [
                'auth_token' => $token,
                'amount_cents' => $amount * 100,
                'expiration' => 3600,
                'order_id' => $orderId,
                'billing_data' => [
                    "first_name" => $user->name,
                    "last_name" => $user->name,
                    "email" => $user->email ?? "",
                    "phone_number" => $user->phone ?? "",
                    "city" => $user->city->name_arabic ?? "",
                    "country" => "EG",
                    "street" => $user->city->name_english,
                    "floor" => $user->city->name_english,
                    "apartment" => $user->city->name_english,
                    "building" => $user->city->name_english,
                ],
                'currency' => 'EGP',
                'integration_id' => $this->integrationId
            ]
        ]);

        return json_decode($response->getBody(), true)['token'] ?? null;
    }
}
