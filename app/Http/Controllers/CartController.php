<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartProduct;

class CartController extends Controller
{
    // View Cart Page
public function viewCart()
{
    $customerId = session('customer_id');

    $cart = Cart::where('customer_id', $customerId)
                ->with('products') // ini penting!
                ->first();

     //dd($cart->products);

    return view('customer.cart', compact('cart'));
}

    // Add to Cart
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $customerId = session('customer_id');
        if (!$customerId) {
            return redirect()->route('customer.login')->with('error', 'Please login to add product to cart.');
        }

        $cart = Cart::firstOrCreate(
            ['customer_id' => $customerId],
            ['subtotal' => 0]
        );

        $cartProduct = CartProduct::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartProduct) {
            $cartProduct->quantity += 1;
            $cartProduct->save();
        } else {
            CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        // Kira semula subtotal
        $cart->load('products'); // pastikan relasi dimuatkan

        $cart->subtotal = $cart->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->price;
        });
        $cart->save();

        return redirect()->route('customer.cart.view')->with('success', 'Product added to cart!');
    }

    // Delete from Cart
public function remove($productId)
{
    $customerId = session('customer_id');
    $cart = Cart::where('customer_id', $customerId)->first();

    if ($cart) {
        $cart->products()->detach($productId);

        // Update subtotal kalau perlu
        $cart->load('products');
        $cart->subtotal = $cart->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->price;
        });
        $cart->save();
    }

    return redirect()->back()->with('success', 'Item removed from cart!');
}


public function decreaseQuantity($productId)
{
    $customerId = session('customer_id');
    $cart = Cart::where('customer_id', $customerId)->first();

    if (!$cart) {
        return redirect()->back()->with('error', 'Cart not found.');
    }

    $cartProduct = $cart->products()->where('product_id', $productId)->first();

    if ($cartProduct) {
        $currentQty = $cartProduct->pivot->quantity;

        if ($currentQty > 1) {
            // Update quantity -1
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $currentQty - 1
            ]);
        } else {
            // Kalau quantity tinggal 1, remove product dari cart
            $cart->products()->detach($productId);
        }
    }

    return redirect()->back()->with('success', 'Product quantity updated.');
}

public function increaseQuantity(Request $request, $productId)
{
    $customerId = session('customer_id');
    $cart = Cart::where('customer_id', $customerId)->first();

    if ($cart) {
        $cartProduct = $cart->products()->where('product_id', $productId)->first();

        if ($cartProduct) {
            $currentQty = $cartProduct->pivot->quantity;

            // Tambah quantity 1
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $currentQty + 1
            ]);
        }
    }

    return redirect()->back()->with('success', 'Quantity increased!');
}

}
