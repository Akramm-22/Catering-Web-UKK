<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $order = null;

        if ($request->filled('resi')) {
            $order = Order::where('receipt_number', $request->resi)
                ->where('user_id', Auth::id())
                ->with('trackings')
                ->first();

            if (!$order) {
                return back()->with('error', 'Nomor resi tidak ditemukan.');
            }
        }

        return view('user.orders.tracking', compact('order'));
    }
}
