@extends('layout.app')

@section('title', 'My Cart')
@vite('resources/css/cart.css')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Shopping Cart</h2>

    @if($cart && $cart->products->count() > 0)
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price (RM)</th>
                    <th>Quantity</th>
                    <th>Subtotal (RM)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->products as $product)
                    @php
                        $pivot = $product->pivot;
                        $subtotal = $pivot->price * $pivot->quantity;
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="70">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($pivot->price, 2) }}</td>
                        <td>
                            <div class="quantity-controls d-flex justify-content-center align-items-center">
                                {{-- Decrease --}}
                                <form action="{{ route('cart.decrease', $product->id) }}" method="POST" class="me-1 d-inline-block">

                                    @csrf
                                    <button class="btn btn-sm btn-secondary" type="submit" {{ $pivot->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                </form>

                                {{-- Quantity --}}
                                <span class="quantity-number px-2">{{ $pivot->quantity }}</span>

                                {{-- Increase --}}
                                <form action="{{ route('cart.increase', $product->id) }}" method="POST" class="ms-1 d-inline-block">

                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit">+</button>
                                </form>
                            </div>
                        </td>
                        <td>{{ number_format($subtotal, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" onsubmit="return confirm('Remove this item from cart?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Total --}}
        <div class="d-flex justify-content-end">
            <h4>
                Total: RM {{
                    number_format(
                        $cart->products->sum(fn($p) => $p->pivot->price * $p->pivot->quantity),
                    2)
                }}
            </h4>
        </div>

        {{-- Checkout --}}
        <div class="mt-3 d-flex justify-content-end">
            <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
        </div>
    @else
        <div class="alert alert-info text-center">Your cart is empty.</div>
    @endif
</div>
@endsection
