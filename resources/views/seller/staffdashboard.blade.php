@php
    $isManager = false;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    @vite('resources/css/staffdashboard.css')
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
            <li>
                <div class="dropdown-toggle" onclick="toggleDropdown('manageOrderDropdown')">
                    <span><i class="fas fa-box-open"></i> Manage Order</span>
                    <i class="fas fa-chevron-right toggle-icon"></i>
                </div>
                <div class="dropdown-content" id="manageOrderDropdown">
                    <a href="{{ route('order.list') }}"><i class="fas fa-list"></i> Order List</a>
                    <a href="{{ route('order.cancel') }}"><i class="fas fa-times-circle"></i> Cancel Order</a>
                    <a href="{{ route('order.return') }}"> <i class="fas fa-undo"></i> Return & Refund</a>
                    <a href="{{ route('seller.orderReportForm') }}"><i class="fas fa-file-alt"></i> Order Report</a>

                </div>
            </li>
            <li><a href="{{ route('staff.product.list') }}"><i class="fas fa-edit"></i> Update Product Details</a></li>
            <li><a href="{{ route('seller.feedback') }}"><i class="fas fa-comments"></i> View Feedback</a></li>

        </ul>

        <a href="{{ route('seller.logout') }}" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome bar -->
        <div class="welcome-bar">
            <div class="welcome">
                Welcome, {{ session('staff_name') ?? 'User' }}<br>
                <small>You are logged in as Staff</small>
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
        </div>

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
    </main>
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


