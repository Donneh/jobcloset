<?php

namespace App\Http\Controllers;

use Adyen\AdyenException;
use Adyen\Client;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Model\Checkout\PaymentMethodsRequest;
use Adyen\Service\Checkout\PaymentsApi;
use App\Models\Order;
use App\Services\CartService;
use App\Services\PaymentService;
use http\Client\Response;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Inertia\Inertia;

class PaymentController extends Controller
{

    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    public function create()
    {
        try {
            $amount = new Amount([
                'currency' => 'EUR',
                'value' => CartService::getCartTotal()->getMinorAmount()->toInt(),
            ]);
            $request = $this->paymentService->createCheckoutRequest($amount);
            $response = $this->paymentService->createPaymentSession($request);

            return Inertia::render('Cart/Index', [
                'clientKey' => config('adyen.client_key'),
                'sessionId' => $response->getId(),
                'sessionData' => $response->getSessionData(),
                'items' => CartService::getCart(),
                'total' => CartService::getCartTotal(),
            ]);
        } catch (AdyenException $e) {
            dd($e->getMessage());
        }
    }

    public function redirect(Request $request)
    {
        return Inertia::render('Checkout/Redirect', [
            'redirectResult' => $request->query('redirectResult'),
            'sessionId' => $request->query('sessionId'),
        ]);
    }

    public function webhook()
    {
        return response()->json('[accepted]');
    }
}
