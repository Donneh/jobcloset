<?php

namespace App\Http\Controllers;

use Adyen\Service\WebhookReceiver;
use App\Events\OrderPaid;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Prompts\Output\ConsoleOutput;

class AdyenWebhookController extends Controller
{
    public function handle(Request $request)
    {
//
        Log::info('Incoming webhook request:');
        Log::info($request->getContent());
        Log::info($request);

        $paymentLinkId = $request['additionalData_paymentLinkId'];

        if($paymentLinkId) {
            $service = new PaymentService();
            $paymentLinkDetails = $service->getPaymentLinkDetails($paymentLinkId);

            if($paymentLinkDetails['status'] == 'completed') {
                OrderPaid::fire((int)$paymentLinkDetails['reference']);
            }
        }

        return response('[accepted]', 200);
    }
}
