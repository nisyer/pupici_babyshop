<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('seller')->check()) {
            return $next($request);
        }

        return redirect()->route('seller.login'); // Sesuaikan ikut route login seller
    }
}

