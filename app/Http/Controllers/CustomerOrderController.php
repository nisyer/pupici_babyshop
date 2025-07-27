<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $customerId = session('customer_id');
        $orders = Order::where('customer_id', $customerId)->with('products')->get();

        return view('customer.my_orders', compact('orders'));
    }

    public function cancel($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        if ($order->customer_id != session('customer_id')) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $order->status = 'Cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    public function submitReturnRequest($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'Return Requested';
        $order->save();

        return redirect()->route('customer.orders')->with('success', 'Return & Refund request submitted.');
    }

    public function giveFeedback($orderId, $productId)
    {
        $order = Order::where('id', $orderId)
            ->where('customer_id', session('customer_id'))
            ->firstOrFail();

        $product = DB::table('order_product')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->where('order_product.order_id', $orderId)
            ->where('order_product.product_id', $productId)
            ->select('products.*')
            ->first();

        if (!$product) {
            abort(403, 'You cannot give feedback for this product.');
        }

        return view('customer.feedback', compact('order', 'product'));
    }

    public function submitFeedback(Request $request, $orderId, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string'
        ]);

        $exists = DB::table('order_product')
            ->where('order_id', $orderId)
            ->where('product_id', $productId)
            ->exists();

        if (!$exists) {
            abort(403, 'Invalid product for this order.');
        }

        Feedback::create([
            'order_id'    => $orderId,
            'product_id'  => $productId,
            'customer_id' => session('customer_id'),
            'rating'      => $request->rating,
            'comment'     => $request->comment,
        ]);

        return redirect()->route('customer.orders')->with('success', 'Thank you for your feedback!');
    }
}




