<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (auth('web')->check() && auth('web')->user()->user_type === 'vendor') {
            // dd(auth('web')->user());
            $vendorStatus = auth('web')->user()->vendor->status;

            if ($vendorStatus === 'pending' && !$request->routeIs('vendor.pending')) {
                return redirect()->route('vendor.pending');
            } elseif ($vendorStatus === 'rejected' && !$request->routeIs('vendor.rejected')) {
                return redirect()->route('vendor.rejected');
            }
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
