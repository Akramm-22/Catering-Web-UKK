<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index()
{
    $orders = Order::where('user_id', Auth::id())
                ->with(['items'])->latest()->get();
    return view('user.orders.tracking', [
        'orders' => $orders, 'selectedOrder' => null,
    ]);
}

public function show($receiptNumber)
{
    $selectedOrder = Order::where('receipt_number', $receiptNumber)
                ->where('user_id', Auth::id())
                ->with(['items','trackings','payment'])->firstOrFail();
    $orders = Order::where('user_id', Auth::id())
                ->with(['items'])->latest()->get();
    return view('user.orders.tracking', compact('orders','selectedOrder'));
}
}
