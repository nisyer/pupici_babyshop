<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class SellerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'products'])->get();
        return view('order.orderlist', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }

    // Form to select date
    public function orderReportForm()
    {
        return view('order.reportform');
    }

    // View order report result based on date
    public function viewOrderReport(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $selectedDate = $request->input('date');

        $orders = Order::whereDate('date', $selectedDate)
                    ->with(['customer', 'products'])
                    ->get();

        return view('order.reportresult', compact('orders', 'selectedDate'));
    }
}
