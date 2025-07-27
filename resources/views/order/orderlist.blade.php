<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order List</title>
    @vite('resources/css/orderlist.css')
</head>
<body>
    <a href="{{ route('staff.dashboard') }}" class="back-button">← Back</a>
    <main class="main-content">
        <h2 class="order-list-title">Order List</h2>
        <div class="table-wrapper">
        <table class="order-table">
 <thead>
    <tr>
        <th>Customer Name</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    @foreach($orders as $order)
        @foreach($order->products as $product)
            <tr>
                <td>{{ $order->customer->name ?? 'Unknown' }}</td>
                <td>{{ $order->customer->phone ?? 'N/A' }}</td>
                <td>{{ $order->customer->address ?? 'N/A' }}</td>
                <td>{{ $product->name ?? 'No Name' }}</td>
                <td>{{ $product->pivot->quantity ?? 1 }}</td>
                <td>
                <form action="{{ route('seller.updateStatus', $order->id) }}" method="POST" class="status-form">
                    @csrf
                    <select name="status" class="status-select">
                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                 </select>
                    <button type="submit" class="status-update-button">Update</button>
                </form>

                </td>
            </tr>
        @endforeach
    @endforeach
</tbody>


        </table>
    </main>
</body>
</html>


