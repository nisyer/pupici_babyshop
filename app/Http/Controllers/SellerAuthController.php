<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerAuthController extends Controller
{
    // ✅ Show login form
    public function showLoginForm()
    {
        return view('seller.loginseller'); // Pastikan view ini wujud
    }

    // ✅ Handle staff login
public function login(Request $request)
{
    $credentials = $request->only('staff_id', 'password');

    $staff = Staff::where('staff_id', $credentials['staff_id'])->first();

    if (!$staff || !Hash::check($credentials['password'], $staff->password)) {
        return redirect()->back()->withErrors(['staff_id' => 'Invalid credentials']);
    }

    // Simpan kedua-dua: id numeric & kod staff
    session([
        'staff_db_id' => $staff->id,        // primary key
        'staff_code'  => $staff->staff_id,  // M01 / S02 / ...
        'staff_name'  => $staff->name,
    ]);

    // Redirect ikut kod staff
    if (str_starts_with($staff->staff_id, 'M')) {
        return redirect()->route('dashboard'); // MANAGER
    } else {
        return redirect()->route('staff.dashboard'); // STAFF
    }
}



    // ✅ Logout staff
    public function logout()
    {
        session()->forget(['staff_id', 'staff_name', 'staff_role']);
        return redirect()->route('seller.login');
    }

    // ✅ Register new staff
    public function showRegisterForm()
    {
        return view('seller.registerstaff');
    }

    public function register(Request $request)
{
    $request->validate([
        'staff_id' => 'required|unique:staff,staff_id',
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:6',
        'role' => 'required|in:staff,manager' // tambah validasi untuk role
    ]);

    $staff = new Staff();
    $staff->staff_id = $request->staff_id;
    $staff->name = $request->name;
    $staff->phone = $request->phone;
    $staff->password = Hash::make($request->password);
    $staff->role = $request->role; // ambil dari form, bukan hardcode
    $staff->save();

    return redirect()->route('seller.dashboard')->with('success', 'Staff registered successfully.');
}
    // ✅ Staff Dashboard

public function dashboard()
{
    if (!session('staff_db_id')) {
        return redirect()->route('seller.login');
    }

    if (!Str::startsWith(session('staff_code'), 'M')) {
        return redirect()->route('staff.dashboard')->with('error', 'Unauthorized access.');
    }

    // ✅ Tambah ini
    $products = Product::all();

    $totalOrders = Order::count();
    $totalStock = Product::sum('quantity');
    $totalSales = Order::where('status', 'delivered')->sum('total_price');



    return view('seller.dashboard', compact('products', 'totalOrders', 'totalStock', 'totalSales'));
}



public function showDashboard()
{
    if (!session('staff_db_id')) {
        return redirect()->route('seller.login');
    }

    // Kalau manager masuk URL staff, redirect dia balik
    if (Str::startsWith(session('staff_code'), 'M')) {
        return redirect()->route('dashboard');
    }

    $products    = Product::all();
    $totalOrders = Order::count();
    $totalStock = Product::sum('quantity');

    return view('seller.staffdashboard', compact('products','totalOrders','totalStock'));
}

public function showAccount()
{
    $staffId = session('staff_db_id'); // ini id dari session yang kita set masa login

    $seller = \App\Models\Staff::find($staffId);

    if (!$seller) {
        return redirect()->route('seller.login')->withErrors(['login' => 'Please login first']);
    }

    return view('seller.account', compact('seller'));
}


public function updateAccount(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Ambil ID dari session
    $staffId = session('staff_db_id'); // pastikan ini betul ikut login anda
    $staff = Staff::find($staffId);

    if (!$staff) {
        return redirect()->route('seller.dashboard')->with('error', 'Staff not found.');
    }

    $staff->name = $request->name;
    $staff->phone = $request->phone;

    if ($request->filled('password')) {
        $staff->password = Hash::make($request->password);
    }

    $staff->save();

    return redirect()->route('seller.dashboard')->with('success', 'Account updated successfully.');
}

}

