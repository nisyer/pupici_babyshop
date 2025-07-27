@extends('layout.app')

@section('title', $category->name . ' - PUPICI Babyshop')

@push('styles')
    @vite('resources/css/category.css')
@endpush

@section('content')
    <section class="category-header">
        <h2>{{ $category->name }}</h2>
        
    </section>

<main class="product-list">
    @forelse($products as $product)
        <a href="{{ route('product.show', $product->id) }}" class="product-card">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>RM {{ number_format($product->price, 2) }}</p>
        </a>
    @empty
        <p>No products found in this category.</p>
    @endforelse
</main>

@endsection
