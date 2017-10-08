<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('GET')) {
            Cart::instance('default')->destroy();
            Cart::instance('default')->restore(auth()->id());
            Cart::instance('default')->store(auth()->id());
        }

        return $next($request);
    }
}
