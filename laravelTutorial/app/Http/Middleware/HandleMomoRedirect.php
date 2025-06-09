<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleMomoRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('resultCode') && $request->resultCode == 0) {
            session()->flash('success', 'Thanh toán thành công!');
        } elseif ($request->has('resultCode')) {
            session()->flash('error', 'Thanh toán thất bại!');
        }

        return $next($request);
    }
}