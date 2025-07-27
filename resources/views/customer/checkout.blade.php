@extends('layout.app')

@section('title', 'Checkout')

@section('content')
@vite('resources/css/checkout.css')

{{-- ✅ Success/Error Message --}}
@if(session('success'))
    <div class="alert-success-message">
        {{ session('success') }}
        @php session()->forget('success'); @endphp
    </div>
@endif


@if(session('error'))
    <div class="alert-error-message">
        {{ session('error') }}
    </div>
@endif

<div class="cart-container">
    <div class="cart-card">
        <!-- Left: Contact & Delivery -->
        <form class="checkout-form" method="POST" action="{{ route('checkout.place') }}">
            @csrf
            <h2>Contact & Delivery</h2>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="payment">Payment Type</label>
                <select id="payment" name="payment" required>
                    <option value="cod">Cash on Delivery (COD)</option>
                    <option value="online">Online Banking</option>
                </select>
            </div>

            <button type="submit" class="checkout-btn">Place Order</button>
        </form>

        <!-- Right: Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            @php $subtotal = 0; @endphp
            @foreach ($cart->cartProducts as $item)
                @php
                    $lineTotal = $item->quantity * $item->product->price;
                    $subtotal += $lineTotal;
                @endphp
                <div class="order-item">
                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                    <div>
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-qty">Qty: {{ $item->quantity }}</div>
                    </div>
                    <div class="item-price">RM{{ number_format($lineTotal, 2) }}</div>
                </div>
            @endforeach

            <hr>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>RM{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>Enter shipping address</span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span>RM{{ number_format($subtotal, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
