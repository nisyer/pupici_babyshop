<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Product: {{ $product->name }}</title>
    <style>
        body {
            background: #f0f8ff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 2.5rem auto;
            background: #fff;
            padding: 2rem 2.2rem 1.5rem 2.2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(52, 122, 183, 0.10), 0 1.5px 8px rgba(52,152,219,0.08);
        }

        h2 {
            color: #357ab7;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 0.3rem;
            font-weight: 600;
            font-size: 1rem;
            color: #222;
            margin-top: 1.1rem;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            box-sizing: border-box;
            padding: 0.7rem;
            font-size: 1.05rem;
            border: 1.5px solid #e3eafc;
            border-radius: 0.5rem;
            background: #f8fbff;
            transition: border 0.2s, box-shadow 0.2s;
            margin-bottom: 1rem;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border: 1.5px solid #357ab7;
            outline: none;
            box-shadow: 0 0 0 2px #e3eafc;
            background: #fff;
        }

        button {
            display: inline-block;
            background: linear-gradient(90deg, #a1c4fd 0%, #c2e9fb 100%);
            color: #357ab7;
            border: none;
            border-radius: 0.5rem;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 0.8rem 2.2rem;
            margin-top: 0.7rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(52,152,219,0.08);
        }

        button:hover {
            background: linear-gradient(90deg, #c2e9fb 0%, #a1c4fd 100%);
            color: #1a4e7a;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product: {{ $product->name }}</h2>

    <form method="POST" action="{{ route('staff.product.update', $product->id) }}">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label>Price (RM):</label>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="{{ $product->quantity }}" required>

        <label>Color:</label>
        <input type="text" name="color" value="{{ $product->color }}">

        <label>Design:</label>
        <input type="text" name="design" value="{{ $product->design }}">

        <button type="submit">Save</button>
    </form>
</div>

</body>
</html>
