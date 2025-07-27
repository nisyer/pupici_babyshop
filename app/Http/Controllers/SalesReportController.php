<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index()
    {
        return view('seller.salesreport');
    }

    public function filter(Request $request)
    {
        $request->validate([
            'month' => 'required',
        ]);

        $month = $request->month;

        $orders = Order::with('products')
        ->where('status', 'delivered') // ← TAMBAH baris ini
        ->whereMonth('created_at', Carbon::parse($month)->month)
        ->whereYear('created_at', Carbon::parse($month)->year)
        ->get();


        $totalSales = 0;
        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                $totalSales += $product->price * $product->pivot->quantity;
            }
        }

        // Hantar juga $totalSales ke view
        return view('seller.salesreport', compact('orders', 'month', 'totalSales'));
    }
}
