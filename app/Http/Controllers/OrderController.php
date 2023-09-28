<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return Inertia::render('Order/Index', [
            'orders' => $orders
        ]);
    }
}
