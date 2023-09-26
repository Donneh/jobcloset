<?php

namespace App\Http\Controllers;

use Adyen\AdyenException;
use Adyen\Client;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CheckoutPaymentMethod;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Model\Checkout\CreateCheckoutSessionResponse;
use Adyen\Model\Checkout\PaymentRequest;
use Adyen\Service\Checkout\PaymentsApi;
use App\Models\Product;
use App\Services\CartService;
use Brick\Math\Exception\MathException;
use Brick\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $items = [];

        $items = CartService::getCart();
        $total = CartService::getCartTotal();

        return Inertia::render('Cart/Index', compact('items', 'total'));
    }

    public function store(Product $product)
    {
        CartService::addToCart($product);
    }

    public function destroy(Product $product)
    {
        CartService::removeProductFromCart($product);

        return Redirect::route('cart.index')->with('message', 'Item removed from cart!');
    }

    public function remove(Product $product)
    {
        CartService::removeFromCart($product);

        return Redirect::route('cart.index')->with('message', 'Product removed successfully!');
    }

    /**
     * @throws AdyenException
     * @throws MathException
     */
    public function checkout(Request $request)
    {
        $client = new Client();
        $client->setApplicationName(config("adyen.application_name"));
        $client->setEnvironment(\Adyen\Environment::TEST);
        $client->setXApiKey(config("adyen.api_key"));

        $service = new PaymentsApi($client);

        $checkoutRequest = new CreateCheckoutSessionRequest();
        $cartTotal = CartService::getCartTotal()->getMinorAmount()->toInt();
        $amount = new Amount();
        $amount->setCurrency("EUR");
        $amount->setValue($cartTotal);
        $checkoutRequest->setAmount($amount);
        $checkoutRequest->setMerchantAccount(config("adyen.merchant_account"));
        $checkoutRequest->setReturnUrl("https://jobcloset.test/shop");
        $checkoutRequest->setReference("123123");
        $checkoutRequest->setCountryCode("NL");

        $response = $service->sessions($checkoutRequest);

        return Inertia::render('Checkout/Index', [
            'items' => CartService::getCart(),
            'sessionId' => $response->getId(),
            'sessionData' => $response->getSessionData(),
            'total' => CartService::getCartTotal(),
        ]);
    }
}
