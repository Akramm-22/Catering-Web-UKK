<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment'])->latest();

        if ($request->status && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('receipt_number', 'like', '%'.$request->search.'%')
                  ->orWhere('customer_name', 'like', '%'.$request->search.'%');
            });
        }

        $orders = $query->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.package', 'payment', 'trackings']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);

        $order->update(['status' => $request->status]);

        OrderTracking::where('order_id', $order->id)
                     ->update(['is_latest' => false]);

        OrderTracking::create([
            'order_id'    => $order->id,
            'status'      => $request->status,
            'title'       => $order->status_label,
            'description' => $request->description ?? 'Status pesanan diperbarui oleh admin.',
            'happened_at' => now(),
            'is_latest'   => true,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function addTracking(Request $request, Order $order)
    {
        $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
        ]);

        OrderTracking::where('order_id', $order->id)
                     ->update(['is_latest' => false]);

        OrderTracking::create([
            'order_id'    => $order->id,
            'status'      => $order->status,
            'title'       => $request->title,
            'description' => $request->description,
            'happened_at' => now(),
            'is_latest'   => true,
        ]);

        return back()->with('success', 'Tracking berhasil ditambahkan.');
    }
}
