<?php

namespace App\Services;

use Adyen\AdyenException;
use Adyen\Client;
use Adyen\Environment;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\AuthenticationData;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Model\Checkout\CreateCheckoutSessionResponse;
use Adyen\Model\Checkout\PaymentLinkRequest;
use Adyen\Service;
use Adyen\Service\Checkout;
use Adyen\Service\Checkout\PaymentsApi;
use Adyen\Service\ResourceModel\Checkout\PaymentLinks;
use App\Casts\Money;
use App\Models\Order;

class PaymentService
{

    private Client $client;


    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName(config('adyen.application_name'));
        $this->client->setEnvironment(Environment::TEST);
        $this->client->setXApiKey(config('adyen.api_key'));
    }


    /**
     * Returns the payment url
     */
    public function createPaymentLinkRequest(Order $order)
    {
        $service = new Service($this->client);
        $paymentLinks = new PaymentLinks($service, '/');

        $request = new PaymentLinkRequest();

        $requestParams = [];
        $requestParams['reference'] = $order->number;
        $requestParams['amount']['currency'] = 'EUR';
        $requestParams['amount']['value'] = $order->getTotal() * 100;
        $requestParams["shopperReference"] = $order->user->email;
        $requestParams["countryCode"] = "NL";
        $requestParams["merchantAccount"] = config('adyen.merchant_account');
        $requestParams["shopperLocale"] = "nl-NL";

        foreach ($order->orderItems as $item) {
            $itemDetails = [
                'id' => $item->name,
                'amountExcludingTax' => $item->price,
                'quantity' => $item->quantity,
                'taxPercentage' => 0,
            ];
            $requestParams['lineItems'][] = $itemDetails;
        }

        $response = $paymentLinks->create($requestParams, '');

        if ($response['url']) {
            return $response['url'];
        }

        return null;
    }

    public function getPaymentLinkDetails($paymentLinkId)
    {
        $service = new Service($this->client);

        $paymentLinks = new PaymentLinks($service, '/');

        $request = new PaymentLinkRequest();

        $response = $paymentLinks->retrieve($paymentLinkId);

        \Log::info($response);

        return $response;

    }
}
