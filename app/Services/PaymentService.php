<?php

namespace App\Services;

use Adyen\AdyenException;
use Adyen\Client;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Model\Checkout\CreateCheckoutSessionResponse;
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
        $this->client->setEnvironment(config('adyen.environment'));
        $this->client->setXApiKey(config('adyen.api_key'));

        $this->paymentsApi = new PaymentsApi($this->client);
    }

    public function createCheckoutRequest(Amount $totalPrice)
    {
        $checkoutRequest = new CreateCheckoutSessionRequest();
        $checkoutRequest->setAmount($totalPrice);
        $checkoutRequest->setMerchantAccount(config('adyen.merchant_account'));
        $checkoutRequest->setReference(uuid_create());
        $checkoutRequest->setReturnUrl("https://jobcloset.test/payment/redirect");
        $checkoutRequest->setCountryCode('BE');
        $checkoutRequest->setShopperLocale('nl-BE');
        $checkoutRequest->setShopperEmail(auth()->user()->email);

        return $checkoutRequest;
    }

    /**
     * @throws AdyenException
     */
    public function createPaymentSession(CreateCheckoutSessionRequest $checkoutRequest): CreateCheckoutSessionResponse
    {
        return $this->paymentsApi->sessions($checkoutRequest);
    }
}
