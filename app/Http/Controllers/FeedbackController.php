<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Customer;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['customer', 'product'])->get();
        return view('seller.feedback', compact('feedbacks'));
    }

}
