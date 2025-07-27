
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/add-product.css')
</head>
<body>
<div class="container">
    <div class="container">
    <a href="{{ route('seller.dashboard') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <h2>Add New Product</h2>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- CATEGORY --}}
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- NAME --}}
        <div class="mb-3">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        {{-- PRICE --}}
        <div class="mb-3">
            <label for="price">Price (RM)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        {{-- QUANTITY --}}
        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        {{-- DESCRIPTION --}}
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        {{-- IMAGE --}}
        <div class="mb-3">
            <label for="image">Product Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

   {{-- COLOR --}}
<div class="mb-3" id="color_field">
    <label for="color" class="form-label">Color</label>
    <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror"
        placeholder="Enter color or '-' if not applicable" value="{{ old('color') }}">
    @error('color')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- SIZE --}}
<div class="mb-3" id="size_field">
    <label for="size" class="form-label">Size</label>
    <input type="text" name="size" id="size" class="form-control @error('size') is-invalid @enderror"
        placeholder="Enter size or '-' if not applicable" value="{{ old('size') }}">
    @error('size')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- DESIGN --}}
<div class="mb-3" id="design_field">
    <label for="design" class="form-label">Design</label>
    <input type="text" name="design" id="design" class="form-control @error('design') is-invalid @enderror"
        placeholder="Enter design or '-' if not applicable" value="{{ old('design') }}">
    @error('design')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        {{-- SUBMIT --}}
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

{{-- Script to handle category changes --}}
<script>
    const categorySelect = document.getElementById('category_id');
    const colorField = document.getElementById('color_field');
    const sizeField = document.getElementById('size_field');
    const designField = document.getElementById('design_field');

    categorySelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex].text;

        // Reset all fields
        colorField.classList.add('d-none');
        sizeField.classList.add('d-none');
        designField.classList.add('d-none');

        // Show based on selected category
        if (selected === 'Baby Clothes') {
            colorField.classList.remove('d-none');
            sizeField.classList.remove('d-none');
        } else if (selected === 'Bottle & Feeds') {
            sizeField.classList.remove('d-none');
            designField.classList.remove('d-none');
        } else if (selected === 'Diapers') {
            designField.classList.remove('d-none');
        }
    });
</script>

