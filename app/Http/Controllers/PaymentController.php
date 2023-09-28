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
use Log;
use Symfony\Component\Console\Output\ConsoleOutput;

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

            $order = $this->createOrder();

            $this->attachCartItemsToOrder($order);

            $request = $this->paymentService->createCheckoutRequest($order, $this->getOrderAmount());

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

    private function createOrder()
    {
        $user = auth()->user();
        $order = new Order([
            'number' => 'ORD-' . uuid_create() . '-' . $user->id,
            'status' => 'pending',
            'payment_method' => 'adyen',
            'payment_status' => 'pending',
            'payment_reference' => 'pending',
        ]);
        $order->user()->associate($user);
        $order->save();

        return $order;
    }

    private function attachCartItemsToOrder($order)
    {
        $cartItems = CartService::getCart();

        foreach ($cartItems as $cartItem) {
            $order->products()->attach($cartItem['product'], [
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['product']->price->getMinorAmount()->toInt(),
            ]);
        }
    }

    private function getOrderAmount()
    {
        return new Amount([
            'currency' => 'EUR',
            'value' => CartService::getCartTotal()->getMinorAmount()->toInt(),
        ]);
    }


    public function redirect(Request $request)
    {
        return Inertia::render('Checkout/Redirect', [
            'redirectResult' => $request->query('redirectResult'),
            'sessionId' => $request->query('sessionId'),
        ]);
    }

    public function webhook(Request $request)
    {
        Log::info('Webhook received');
        Log::info($request->getContent());
        Log::info('Webhook received');
        Log::info($request);

        $order = Order::where('number', $request->merchantReference)->firstOrFail();
        $order->payment_method = $request->paymentMethod;
        $order->status = $request->success;

        Log::info($order);

        if($request->success == 'true') {
            Log::info('Payment successful');
            $order->payment_status = 'paid';
            $order->payment_reference = $request->pspReference;
            // Subtract stock from products ordered
            foreach ($order->products as $product) {
                Log::info("quantity: " . $product->pivot->quantity);
                $product->stock = $product->stock - $product->pivot->quantity;
                $product->save();
                CartService::clearCart();
            }
        } else {
            Log::info('Payment failed');
            $order->payment_status = 'failed';
            $order->payment_reference = $request->reason;
        }

        $order->save();
        return response()->json('[accepted]');
    }
}
