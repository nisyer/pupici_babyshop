@extends('layout.app')

@section('title', $product->name . ' - PUPICI Babyshop')

@vite('resources/css/homepage.css')
@vite('resources/css/product-details.css')

@section('content')
<div class="product-details-container">
    <!-- Product Image -->
    <div class="product-details-image">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%; max-width: 400px; border-radius: 1rem; background: #fff; box-shadow: 0 2px 12px rgba(52,152,219,0.07);">
    </div>

    <!-- Product Details -->
    <div class="product-details-info">
        <h1 style="font-size: 2.5rem; color: #4a463a; margin-bottom: 1.2rem;">{{ $product->name }}</h1>
        <div style="font-size: 2rem; color: #6b5c3a; margin-bottom: 1.2rem;">RM{{ number_format($product->price, 2) }}</div>

        @if($product->size && $product->size != '-')
        <div style="font-size: 1.1rem; color: #888; margin-bottom: 1.2rem;">Size: {{ $product->size }}</div>
        @endif

        <div style="font-size: 1.1rem; color: #444; margin-bottom: 2rem;">
            {{ $product->description }}
        </div>

        @if($product->design && $product->design != '-')
        <div style="font-size: 1.05rem; color: #555; margin-bottom: 1.5rem;">
            <b>Design:</b> {{ $product->design }}
        </div>
        @endif

        <form action="{{ route('customer.cart.add') }}" method="POST" style="margin-top: 1.5rem;">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="product-details-addcart">Add to Cart</button>
</form>

    </div>
</div>
@endsection
