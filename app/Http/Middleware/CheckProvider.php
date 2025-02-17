<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProvider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('web')->check() && auth('web')->user()->user_type === 'provider') {
            // dd(auth('web')->user());
            $vendorStatus = auth('web')->user()->provider->status;

            if ($vendorStatus === 'pending' && !$request->routeIs('provider.pending')) {
                return redirect()->route('provider.pending');
            } elseif ($vendorStatus === 'rejected' && !$request->routeIs('provider.rejected')) {
                return redirect()->route('provider.rejected');
            }
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
