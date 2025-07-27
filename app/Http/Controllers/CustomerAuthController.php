<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CustomerAuthController extends Controller
{
    /**
     * Show customer login form
     */
    public function showLoginForm()
    {
        return view('customer.logincustomer');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            session(['customer_id' => $customer->id]);
            return redirect()->route('customer.home');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

    /**
     * Customer dashboard
     */
    public function dashboard()
    {
        if (!session('customer_id')) {
            return redirect()->route('customer.login');
        }

        return view('customer.home');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->forget('customer_id');
        return redirect()->route('customer.login');
    }

    /**
     * Show register form
     */
    public function showRegisterForm()
    {
        return view('customer.register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();

        session(['customer_id' => $customer->id]);

        return redirect()->route('customer.home');
    }
    
    public function home()
    {
        if (!session('customer_id')) {
            return redirect()->route('customer.login');
        }

        // optionally you could fetch products from the DB here
        return view('customer.home');
    }

    // Papar form reset password
public function showResetForm()
{
    return view('customer.reset-password');
}

// Proses tukar password
public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:customers,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $customer = Customer::where('email', $request->email)->first();
    $customer->password = Hash::make($request->password);
    $customer->save();

    return redirect()->route('customer.login')->with('success', 'Password has been reset successfully!');
}

}

