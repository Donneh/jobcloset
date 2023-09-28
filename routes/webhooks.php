<?php


Route::post('/payment/webhook', function () {
    return response()->json(['success' => true]);
})->name('payment.webhook');
