<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orderList()
    {
        // Dummy data
        $orders = [
            [
                'id' => 1,
                'name' => 'Ali',
                'item_name' => 'Baby Bottle',
                'quantity' => 2,
                'address' => 'No.1 Jalan Merdeka, KL',
                'phone' => '0123456789',
                'payment_type' => 'Online Banking',
                'status' => 'Preparing',
            ],
            [
                'id' => 2,
                'name' => 'Siti',
                'item_name' => 'Diapers',
                'quantity' => 1,
                'address' => 'No.10 Jalan Bukit, Penang',
                'phone' => '0198765432',
                'payment_type' => 'Cash On Delivery',
                'status' => 'Shipping',
            ],
        ];

        return view('order.orderlist', compact('orders'));
    }


    public function cancelOrderPage()
{
    // Ambil semua order yang status = 'Cancelled'
    $cancelledOrders = Order::where('status', 'Cancelled')->with('customer')->get();

    return view('order.cancelorder', compact('cancelledOrders'));
}


public function viewReturnRefundRequests()
{
    $returnOrders = Order::where('status', 'Return Requested')
                         ->with('customer', 'products') // ikut nama relationship
                         ->get();

    return view('order.returnandrefund', compact('returnOrders'));
}


// ReturnRefundController.php

public function approveReturn($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'Return Approved';
    $order->save();

    return redirect()->back()->with('success', 'Return request approved.');
}

public function rejectReturn($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'Return Rejected';
    $order->save();

    return redirect()->back()->with('success', 'Return request rejected.');
}

}



