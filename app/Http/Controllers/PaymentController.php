<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        return redirect()->route('payment.simulate', $order->id);
    }

    public function simulate(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        return view('user.payment.simulate', compact('order'));
    }

    public function simulatePay(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        // Buat record payment dummy
        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'payment_code'    => 'PAY-' . strtoupper(uniqid()),
                'payment_method'  => $order->payment_method,
                'payment_channel' => $order->payment_detail,
                'amount'          => $order->total_amount,
                'status'          => 'paid',
                'paid_at'         => now(),
                'transaction_id'  => 'DUMMY-' . strtoupper(uniqid()),
            ]
        );

        // Update status order
        $order->update(['status' => 'waiting_confirmation']);

        // Update semua tracking lama jadi bukan latest
        OrderTracking::where('order_id', $order->id)
                     ->update(['is_latest' => false]);

        // Tambah tracking baru
        OrderTracking::create([
            'order_id'    => $order->id,
            'status'      => 'waiting_confirmation',
            'title'       => 'Pesanan Terverifikasi',
            'description' => 'Pembayaran dikonfirmasi. Pesanan masuk dalam antrean kurasi hari ini.',
            'happened_at' => now(),
            'is_latest'   => true,
        ]);

        return redirect()->route('checkout.success', $order->id);
    }

    public function callback(Request $request)
    {
        // Midtrans webhook callback (untuk production)
        return response()->json(['status' => 'ok']);
    }
}
