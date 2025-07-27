<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class CustomerHomeController extends Controller
{
    // Homepage dengan produk & kategori
    public function home()
    {
        $products = Product::where('is_active', 1)->get();
        $categories = Category::all();

        return view('customer.home', compact('products', 'categories'));
    }

    // View by category using ID
    public function viewByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)
            ->where('is_active', 1)
            ->get();

        return view('customer.category', compact('category', 'products'));
    }

    // View by category using name in URL
public function show($category)
{
    $categoryRecord = Category::where('name', $category)->first();

    if (!$categoryRecord) {
        return redirect('/')->with('error', 'Category not found.');
    }

    $products = Product::where('category_id', $categoryRecord->id)
        ->where('is_active', 1)
        ->get();

    return view('customer.category', [
        'category' => $categoryRecord,
        'products' => $products
    ]);
}

public function viewProduct($id)
{
    $product = Product::findOrFail($id); // pastikan model awak namanya Product

    return view('customer.product-details', compact('product'));
}

public function showProduct($id)
{
    $product = Product::findOrFail($id); // assuming Product is your model
    return view('customer.product-details', compact('product'));
}


    // For chatbot (optional)
    public function chatbotQuestions()
    {
        $questions = DB::table('chatbot_questions')->select('id', 'question', 'answer')->get();
        return response()->json($questions);
    }
}
