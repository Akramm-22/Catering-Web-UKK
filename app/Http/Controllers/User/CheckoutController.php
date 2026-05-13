<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('packages.index')
                             ->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 45000;
        $service  = round($subtotal * 0.02);
        $total    = $subtotal + $shipping + $service;

        return view('user.checkout.index', compact(
            'cart', 'subtotal', 'shipping', 'service', 'total'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'address_1'      => 'required|string',
            'address_2'      => 'nullable|string',
            'address_3'      => 'nullable|string',
            'payment_method' => 'required|in:transfer_bank,e_wallet,credit_card,cod,virtual_account,qris',
            'payment_detail' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('packages.index');
        }

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 45000;
        $service  = round($subtotal * 0.02);
        $total    = $subtotal + $shipping + $service;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id'        => Auth::id(),
                'receipt_number' => 'AG-' . strtoupper(substr(uniqid(), -8)),
                'customer_name'  => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'address_1'      => $request->address_1,
                'address_2'      => $request->address_2,
                'address_3'      => $request->address_3,
                'subtotal'       => $subtotal,
                'shipping_cost'  => $shipping,
                'service_fee'    => $service,
                'total_amount'   => $total,
                'payment_method' => $request->payment_method,
                'payment_detail' => $request->payment_detail,
                'status'         => 'pending',
                'order_date'     => now(),
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'package_id' => $item['id'],
                    'name'       => $item['name'],
                    'price'      => $item['price'],
                    'qty'        => $item['qty'],
                    'subtotal'   => $item['price'] * $item['qty'],
                ]);
            }

            // Buat tracking awal
            OrderTracking::create([
                'order_id'    => $order->id,
                'status'      => 'pending',
                'title'       => 'Pesanan Diterima',
                'description' => 'Pesanan Anda telah diterima dan menunggu konfirmasi pembayaran.',
                'happened_at' => now(),
                'is_latest'   => true,
            ]);

            session()->forget('cart');
            DB::commit();

            return redirect()->route('payment.simulate', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        return view('user.checkout.success', compact('order'));
    }
}
