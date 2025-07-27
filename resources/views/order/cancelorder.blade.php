<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancelled Orders</title>
    @vite('resources/css/cancelorder.css')
</head>
<body>
<a href="{{ route('staff.dashboard') }}" class="back-button">← Back</a>
<div class="main-content">
    <h2 class="order-list-title">Cancelled Orders</h2>

    @if($cancelledOrders->isEmpty())
        <p>No cancelled orders found.</p>
    @else
        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Total Price (RM)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cancelledOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</td>
                        <td>{{ number_format($order->total_price, 2) }}</td>
                        <td><span class="cancelled">{{ $order->status }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
