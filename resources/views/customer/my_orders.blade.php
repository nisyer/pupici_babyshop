@extends('layout.app')

@section('title', 'My Orders')
@vite('resources/css/myorder.css')

@section('content')
<div class="order-list container">
    <h2>My Orders</h2>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        @foreach ($orders as $order)
            <div class="order-card">
                <h3>Order ID:{{ $order->id }}</h3>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Total Payment:</strong> RM{{ number_format($order->total_price, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Design</th>
                            <th>Colour</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->design ?? '-' }}</td>
                                <td>{{ $product->color ?? '-' }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="order-actions">
                    @php $status = strtolower(trim($order->status)); @endphp

                    @if ($status === 'pending')
                        <form action="{{ route('customer.order.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                            @csrf
                            <button type="submit" class="action-button cancel-button">Cancel</button>
                        </form>
                    @elseif ($status === 'delivered')
                        <form action="{{ route('customer.returnOrderSubmit', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure to request a return for this order?');">
                            @csrf
                            <button type="submit" class="action-button btn-return">Return & Refund</button>
                        </form>

                       <a href="{{ route('customer.giveFeedback', ['order' => $order->id, 'product' => $product->id]) }}">Give Feedback</a>


                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
