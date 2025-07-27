@php
    use Illuminate\Support\Str;
    $isManager = Str::startsWith(session('staff_code'), 'M');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    @vite('resources/css/dashboard.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
        <div style="text-align:center; margin-bottom:2rem;">
            <img src="{{ asset('images/pupici-logo.png') }}" alt="PUPICI Logo" style="width: 120px;">
        </div>
        <ul>
            @if($isManager)
<li class="dropdown">
    <a class="dropdown-toggle" href="#"><i class="fas fa-box"></i> Manage Product</a>
    <ul class="dropdown-content">
        <li><a href="{{ route('product.Addproduct') }}"><i class="fas fa-plus-circle"></i> Add Product</a></li>
        <li><a href="{{ route('product.disable.list') }}"><i class="fas fa-ban"></i> Disable Product</a></li>
    </ul>
</li>

                <li><a href="{{ route('report.index') }}"><i class="fas fa-chart-line"></i> Generate Sales Report</a></li>
                <li><a href="{{ route('chatbot.manage') }}"><i class="fas fa-robot"></i> Manage Chatbot</a></li>
                <li><a href="{{ route('seller.feedback') }}"><i class="fas fa-comments"></i> View Feedback</a></li>
                <li><a href="{{ route('seller.registerstaff') }}"><i class="fas fa-user-plus"></i> Register Account</a></li>
            @endif
        </ul>

        <a href="{{ route('seller.logout') }}" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome bar -->
        <div class="welcome-bar">
            <div class="welcome">
                Welcome, {{ session('staff_name') ?? 'User' }}<br>
                <small>You are logged in as {{ $isManager ? 'Manager' : 'Staff' }}</small>
            </div>
            <a href="{{ route('seller.account') }}" class="account-icon">
                <i class="fas fa-user-circle"></i>
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <h3>Total Orders</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="card">
                <i class="fas fa-boxes"></i>
                <h3>Total Stock</h3>
                <p>{{ $totalStock }}</p>
            </div>
            <div class="card">
                <i class="fas fa-money-bill-wave"></i>
                <h3>Total Sales</h3>
                <p>RM {{ number_format($totalSales, 2) }}</p>
            </div>
        </div>

        <!-- Product Table -->
 <!-- Product Table -->
<div class="product-section card-box">
    <h2>All Products</h2>
    <table class="product-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price (RM)</th>
                <th>Quantity</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Optional JavaScript -->
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('active');
    }
</script>
</body>
</html>






