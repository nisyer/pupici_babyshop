<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return & Refund Requests</title>
    @vite('resources/css/returnrefund.css')
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            padding: 6px 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
            min-width: 120px;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 8px;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<a href="{{ route('seller.dashboard') }}" class="back-button">← Back</a>
<div class="main-content">
    <h2 class="order-list-title">Return & Refund Requests</h2>

    @if($returnOrders->isEmpty())
        <p>No return requests found.</p>
    @else
    <table class="order-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Total Price (RM)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returnOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="dropdown-button" onclick="toggleDropdown(this)">Action ▾</button>
                            <div class="dropdown-content">
                                <form action="{{ route('seller.approveReturn', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item approve">Approve</button>
                                </form>
                                <form action="{{ route('seller.rejectReturn', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item reject">Reject</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<script>
function toggleDropdown(button) {
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle("show");
}

window.addEventListener("click", function(e) {
    if (!e.target.matches('.dropdown-button')) {
        document.querySelectorAll(".dropdown-content").forEach(menu => {
            menu.classList.remove("show");
        });
    }
});
</script>
</body>
</html>
