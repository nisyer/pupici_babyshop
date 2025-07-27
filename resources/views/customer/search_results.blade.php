@extends('layout.app') <!-- ikut layout customer -->

@section('title', 'Search Results')

@section('content')
@vite('resources/css/search_results.css')
<div class="main-content">
    <h2>Search Results for "{{ $query }}"</h2>

    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <div class="products">
            @foreach($products as $product)
                <a href="{{ route('product.show', $product->id) }}" class="product-card">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>RM{{ number_format($product->price, 2) }}</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
