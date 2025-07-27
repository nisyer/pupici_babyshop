<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .main-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .filter-form {
            text-align: center;
            margin-bottom: 2rem;
        }

        .filter-form input[type="month"] {
            padding: 8px;
            font-size: 1rem;
        }

        .filter-form button {
            padding: 8px 16px;
            background-color: #007BFF;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 8px;
            margin-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            background-color: #e0f0ff;
        }

        .back-button {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .total-sales {
            margin-top: 1rem;
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('dashboard') }}" class="back-button">← Back</a>
            <h2 class="section-title" style="flex-grow: 1; text-align: center; margin-right: 40px;">Sales Report</h2>
        </div>

        <form method="POST" action="{{ route('sales.report.filter') }}" class="filter-form">
            @csrf
            <label for="month">Select Month:</label>
            <input type="month" name="month" required>
            <button type="submit">Filter</button>
        </form>

        @isset($orders)
            @if($orders->count())
                <h4>Report for: {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Payment (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <div class="total-sales">
                    Total Sales: RM {{ number_format($totalSales, 2) }}
                </div>
            @else
                <p style="text-align: center;">No sales found for the selected month.</p>
            @endif
        @endisset
    </div>
</body>
</html>
