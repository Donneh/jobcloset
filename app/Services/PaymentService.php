<?php

namespace App\Services;

use Adyen\AdyenException;
use Adyen\Client;
use Adyen\Environment;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\AuthenticationData;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Model\Checkout\CreateCheckoutSessionResponse;
use Adyen\Service\Checkout;
use Adyen\Service\Checkout\PaymentsApi;
use App\Models\Order;

class PaymentService
{

    private Client $client;
    private PaymentsApi $paymentsApi;


    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName(config('adyen.application_name'));
        $this->client->setEnvironment(Environment::TEST);
        $this->client->setXApiKey(config('adyen.api_key'));
        $this->paymentsApi = new PaymentsApi($this->client);
    }

    public function createCheckoutRequest(Order $order, Amount $totalPrice)
    {

        $checkoutRequest = new CreateCheckoutSessionRequest();
        $checkoutRequest->setAmount($totalPrice);
        $checkoutRequest->setMerchantAccount(config('adyen.merchant_account'));
        $checkoutRequest->setReference($order->number);
        $checkoutRequest->setReturnUrl(config('app.url') . "/payment/redirect");
        $checkoutRequest->setCountryCode('NL');
        $checkoutRequest->setShopperLocale('nl-NL');
        $checkoutRequest->setShopperEmail(auth()->user()->email);
        $checkoutRequest->setMode('hosted');

        return $this->paymentsApi->sessions($checkoutRequest);

    }

    /**
     * @throws AdyenException
     */
    public function createPaymentSession(CreateCheckoutSessionRequest $checkoutRequest): CreateCheckoutSessionResponse
    {
        return $this->paymentsApi->sessions($checkoutRequest);
    }

    public function getPaymentResult($sessionId, $sessionData)
    {
        CartService::clearCart();

    }
}
