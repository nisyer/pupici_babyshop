<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerAccountController extends Controller
{
    public function show()
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);
        return view('customer.account', compact('customer'));
    }

    public function update(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customer.account')->with('success', 'Account information updated successfully!');
    }
}
