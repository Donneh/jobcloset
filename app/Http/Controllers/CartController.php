<?php

namespace App\Http\Controllers;

use Adyen\Client;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CheckoutPaymentMethod;
use Adyen\Model\Checkout\PaymentRequest;
use Adyen\Service\Checkout\PaymentsApi;
use App\Models\Product;
use App\Services\CartService;
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

    public function checkout(Request $request)
    {
        $client = new Client();
        $client->setXApiKey("AQEnhmfuXNWTK0Qc+iScu0sPouafTZhECp1BoQu5ME23whtIkNPjok3jEMFdWw2+5HzctViMSCJMYAc=-HQHoz+nKFCikwIKwnQOxsx3dJhrJLg+AAyYR5VzKZew=-2y#<T_n5QCG(m)Jn");
        $client->setEnvironment(\Adyen\Environment::TEST);
        $client->setTimeout(30);

        $service = new PaymentsApi($client);
        $requestOptions['idempotencyKey'] = uniqid();

        $paymentMethod = new CheckoutPaymentMethod();
        $paymentMethod->setType("scheme")
            ->setEncryptedCardNumber("test_4111111111111111")
            ->setEncryptedExpiryMonth("test_03")
            ->setEncryptedExpiryYear("test_2030")
            ->setEncryptedSecurityCode("test_737")
            ->setHolderName("John Smith");

        $amount = new Amount();
        $amount->setCurrency("EUR")
            ->setValue(CartService::getCartTotal()->getMinorAmount()->toInt());

        $paymentRequest = new PaymentRequest();
        $paymentRequest->setAmount($amount)
            ->setReference("YOUR_ORDER_NUMBER")
            ->setPaymentMethod($paymentMethod)
            ->setReturnUrl("https://your-company.com/checkout?shopperOrder=12xy..")
            ->setMerchantAccount("LIOWebdesignECOM");

        $result = $service->payments($paymentRequest, $requestOptions);

        dd($result);
        return true;
    }
}
