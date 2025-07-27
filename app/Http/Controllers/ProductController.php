<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 1. Show Add Product Form (for Seller)
    public function create()
    {
        $categories = Category::all();
        $seller = auth('seller')->user(); // make sure 'seller' guard is used
        return view('product.Addproduct', compact('categories', 'seller'));
    }

    // 2. Store New Product (for Seller)
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'design' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }

        // Save product
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'color' => $request->color ?? '-',
            'size' => $request->size ?? '-',
            'design' => $request->design ?? '-',
            'image' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // 3. Show All Products (for Disable Product List)
    public function showDisableList()
    {
        $products = Product::all();
        return view('product.disable-list', compact('products'));
    }

    // 4. Update Product Active Status (Enable/Disable)
    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = $request->input('is_active');
        $product->save();

        return redirect()->route('product.disable.list')->with('success', 'Product status updated successfully!');
    }

 public function showUpdateProductList()
{
    $products = Product::all();
    return view('product.updateproductlist', compact('products'));
}

public function editProductForm($id)
{
    $product = Product::findOrFail($id);
    return view('product.editproduct', compact('product'));
}

public function updateProductDetails(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        // tambah rules lain ikut keperluan
    ]);

    $product = Product::findOrFail($id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->color = $request->color;
    $product->design = $request->design;
    $product->save();

    return redirect()->route('staff.product.list')->with('success', 'Product updated successfully.');
}

public function search(Request $request)
{
    $query = $request->input('query');

    $products = Product::where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();

    return view('customer.search_results', compact('products', 'query'));
}

}
