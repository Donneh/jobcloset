<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdyenWebhookController extends Controller
{
    public function handle(Request $request)
    {
        return response()->json(['success' => true]);
    }
}
