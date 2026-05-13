<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'waiting_confirmation')->count(),
            'total_revenue'   => Order::whereIn('status', ['completed', 'delivered'])->sum('total_amount'),
            'active_customers'=> User::where('is_admin', false)->count(),
        ];

        $recentOrders = Order::with(['user', 'items'])
                            ->latest()
                            ->limit(10)
                            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
