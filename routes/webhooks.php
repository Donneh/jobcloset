<?php


use App\Http\Controllers\AdyenWebhookController;

Route::post('/payment/webhook', [AdyenWebhookController::class, 'handle'])->name('payment.webhook');
