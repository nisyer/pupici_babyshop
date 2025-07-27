<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PUPICI Babyshop')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Files -->
    @vite('resources/css/homepage.css')
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/customeraccount.css') }}">
</head>

<body>
    <header class="header">
        <div class="logo">PUPICI</div>
        <form action="{{ route('product.search') }}" method="GET" class="search-bar">
        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <div class="icons">
            <!-- ✅ HOME BUTTON DITAMBAH DI SINI -->
            <a href="{{ route('customer.home') }}" title="Home"><i class="fas fa-home"></i></a>
            <a href="{{ route('customer.account') }}" title="My Account"><i class="fas fa-user"></i></a>
            <a href="{{ route('customer.cart.view') }}" title="Cart"><i class="fas fa-shopping-cart"></i></a>
            <a href="{{ route('customer.orders') }}" title="My Orders"><i class="fas fa-bag-shopping"></i></a>
   <!-- ✅ Logout Icon -->
    <a href="{{ route('customer.logout') }}" title="Logout"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       <i class="fas fa-sign-out-alt"></i>
    </a>

    <!-- Hidden form for logout -->
    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
        </div>
    </header>

    <nav class="category-nav">
        <ul>
           <li><a href="{{ route('category.show', ['name' => 'Baby Clothes']) }}">Baby Clothes</a></li>
           <li><a href="{{ route('category.show', ['name' => 'Toys']) }}">Toys</a></li>
           <li><a href="{{ route('category.show', ['name' => 'Bath & Care']) }}">Bath & Care</a></li>
           <li><a href="{{ route('category.show', ['name' => 'Nursery']) }}">Nursery</a></li>
           <li><a href="{{ route('category.show', ['name' => 'Bottle & Feeds']) }}">Bottle & Feeds</a></li>
           <li><a href="{{ route('category.show', ['name' => 'Diapers']) }}">Diapers</a></li>
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <img src="{{ asset('images/pupici logo new.jpeg') }}" alt="PUPICI Logo" class="footer-logo">
                <p>Your trusted babyshop for quality baby products and care essentials.</p>
            </div>
            <div class="footer-section contact">
                <h4>Contact Us</h4>
                <p>Email: support@pupici.com</p>
                <p>Phone: 011-57307390</p>
            </div>
            <div class="footer-section social">
                <h4>Follow Us</h4>
                <a href="#"><i class="fas fa-shopping-bag"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 PUPICI Babyshop. All rights reserved.
        </div>
    </footer>
</body>
</html>
