<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CheckoutController extends Controller
{
public function showCheckout()
{
    $customerId = session('customer_id');

    if (!$customerId) {
        return redirect()->route('customer.login')->with('error', 'Please login to continue.');
    }

    $cart = Cart::where('customer_id', $customerId)
                ->with(['cartProducts.product'])
                ->first();

    if (!$cart || $cart->cartProducts->isEmpty()) {
        return redirect()->back()->with('error', 'Cart is empty.');
    }

    return view('customer.checkout', compact('cart'));
}

public function placeOrder(Request $request)
{
    $customerId = session('customer_id');

    // Validate input
    $request->validate([
        'name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'payment' => 'required|string',
    ]);

    // Dapatkan cart customer
    $cart = Cart::where('customer_id', $customerId)
                ->with('cartProducts.product')
                ->first();

    if (!$cart || $cart->cartProducts->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Kira jumlah keseluruhan harga
    $totalPrice = 0;
    foreach ($cart->cartProducts as $cartItem) {
        $productPrice = $cartItem->product->price;
        $totalPrice += $productPrice * $cartItem->quantity;
    }

    // Simpan order
    $order = new \App\Models\Order();
    $order->customer_id = $customerId;
    $order->date = now(); // ikut column migration anda
    $order->total_price = $totalPrice;
    $order->save();

    // Masukkan item dalam pivot table order_product
    foreach ($cart->cartProducts as $cartItem) {
        $order->products()->attach($cartItem->product_id, [
            'quantity' => $cartItem->quantity,
            'color' => $cartItem->color ?? '',
            'design' => $cartItem->design ?? '',
        ]);
    }

    // Kosongkan cart selepas berjaya order
    $cart->cartProducts()->delete();
    $cart->delete();

    return redirect()->route('customer.orders')->with('success', 'Order placed successfully!');
}



}
