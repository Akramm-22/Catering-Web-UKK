<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        $completedOrdersQuery = Order::whereIn('status', [
            'completed',
            'delivered'
        ]);

        // Total pendapatan
        $totalRevenue = $completedOrdersQuery->sum('total_amount');

        // Jumlah pesanan selesai
        $completedOrders = Order::whereIn('status', [
            'completed',
            'delivered'
        ])->count();

        // Rata-rata nilai order
        $avgOrderValue = $completedOrders > 0
            ? $totalRevenue / $completedOrders
            : 0;

        // Data revenue per bulan
        $revenue = Order::whereIn('status', [
                'completed',
                'delivered'
            ])
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'completedOrders',
            'avgOrderValue',
            'revenue'
        ));
    }
}