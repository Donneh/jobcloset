<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdyenWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Handle method called with request:', ['request' => $request->all()]);

        return response()->json(['success' => true]);
    }
}
