<!DOCTYPE html>
<html>
<head>
    <title>Update Product List</title>
    @vite('resources/css/updateproductdetails.css') {{-- CSS file --}}
</head>
<body>

<div class="container">
    <h2>Product List</h2>

    {{-- Back Button --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('staff.dashboard') }}" class="back-button">← Back </a>
    </div>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price (RM)</th>
                <th>Quantity</th>
                <th>Color</th>
                <th>Size</th>
                <th>Design</th>
                <th>Description</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->color ?? '-' }}</td>
                <td>{{ $product->size ?? '-' }}</td>
                <td>{{ $product->design ?? '-' }}</td>
                <td>{{ $product->description ?? '-' }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="Image" width="60">
                    @else
                        -
                    @endif
                </td>
                <td><a href="{{ route('staff.product.edit', $product->id) }}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
