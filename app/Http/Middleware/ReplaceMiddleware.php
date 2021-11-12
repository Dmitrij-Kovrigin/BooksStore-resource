<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReplaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->outfit_price) {
            $request->outfit_price = str_replace(',', '.', $request->outfit_price);
        }

        if ($request->outfit_discount) {
            $request->outfit_discount = str_replace(',', '.', $request->outfit_discount);
        }

        return $next($request);
    }
}
