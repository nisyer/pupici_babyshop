<!DOCTYPE html>
<html>
<head>
    <title>Disable Product</title>
    @vite('resources/css/dashboard.css')
    <style>
        table {
            width: 90%;
            margin: 2rem auto;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 1rem;
            border: 1px solid #ccc;
            text-align: left;
        }
        .btn {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #c82333;
        }
        h2 {
            text-align: center;
            margin-top: 2rem;
            color: #357ab7;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            margin: 1rem auto;
            width: 80%;
            border-radius: 0.4rem;
        }
        .status-form {
            display: flex;
            align-items: center;
            gap: 10px; /* spacing between select and button */
        }
        select {
            padding: 0.4rem;
        }

        /* Use .btn from add-product.css for back button styling */
        .btn-back-custom {
            background: linear-gradient(90deg, #c2e9fb 0%, #a1c4fd 100%) !important;
            color: #1a4e7a !important;
            transform: translateY(-2px);
            border: none;
            border-radius: 0.5rem;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 0.8rem 2.2rem;
            margin: 1rem 0 1rem 5%;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(52,152,219,0.08);
            display: inline-block;
            text-decoration: none;
        }

    </style>

</head>
<body>

<a href="{{ route('seller.dashboard') }}" class="btn-back-custom">← Back</a>

    <h2><i class="fas fa-ban"></i> Disable Product</h2>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price (RM)</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->is_active ? 'Able' : 'Disable' }}</td>
                    <td>
                        <form class="status-form" action="{{ route('product.disable', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="is_active">
                                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Able</option>
                                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Disable</option>
                            </select>
                            <button type="submit" class="btn">Update</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
