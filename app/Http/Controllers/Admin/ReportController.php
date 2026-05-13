<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        $revenue = Order::whereIn('status', ['completed', 'delivered'])
                        ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
                        ->groupBy('month')
                        ->get();

        return view('admin.reports.index', compact('revenue'));
    }
}
