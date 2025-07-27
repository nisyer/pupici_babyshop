<!-- resources/views/order/reportresult.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Order Report</title>
    @vite('resources/css/orderreport.css')
</head>
<body>
    <a href="{{ route('seller.orderReportForm') }}" class="back-button">← Back</a>


    <div class="main-content">
        <h2>Order Report for {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}</h2>

        @if($orders->isEmpty())
            <p>No orders found for this date.</p>
        @else
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Total Price (RM)</th>
                        <th>Products</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->customer->address }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</td>
                            <td>{{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <ul>
                                    @foreach ($order->products as $product)
                                        <li>{{ $product->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
