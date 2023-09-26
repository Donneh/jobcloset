<?php

namespace App\Http\Controllers;

use Adyen\AdyenException;
use Adyen\Client;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Model\Checkout\PaymentMethodsRequest;
use Adyen\Service\Checkout\PaymentsApi;
use App\Services\CartService;
use Illuminate\Log\Logger;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function create()
    {
        $amount = new Amount();
        $amount->setCurrency('EUR');
        $amount->setValue(CartService::getCartTotal()->getMinorAmount()->toInt());

        if (config('adyen.environment') === 'test') {
            $environment = \Adyen\Environment::TEST;
        } else {
            $environment = \Adyen\Environment::LIVE;
        }

        try {
            $client = new Client();
            $client->setApplicationName(config('adyen.application_name'));
            $client->setEnvironment($environment);
            $client->setXApiKey(config('adyen.api_key'));

            $paymentsApi = new PaymentsApi($client);

            $checkoutRequest = new CreateCheckoutSessionRequest();
            $checkoutRequest->setAmount($amount);
            $checkoutRequest->setMerchantAccount(config('adyen.merchant_account'));
            $checkoutRequest->setReference('Your order number');
            $checkoutRequest->setReturnUrl("http://jobcloset.test/test");
            $checkoutRequest->setCountryCode('NL');
            $checkoutRequest->setShopperEmail(auth()->user()->email);

            $checkoutResponse = $paymentsApi->sessions($checkoutRequest);

            return Inertia::render('Cart/Index', [
                'clientKey' => config('adyen.client_key'),
                'sessionId' => $checkoutResponse->getId(),
                'sessionData' => $checkoutResponse->getSessionData(),
                'items' => CartService::getCart(),
                'total' => CartService::getCartTotal(),
            ]);
        } catch (AdyenException $e) {
            Logger::error($e->getMessage());
        }

        return redirect()->route('cart.index');
    }
}
