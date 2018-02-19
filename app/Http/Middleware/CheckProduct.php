<?php

namespace App\Http\Middleware;

use Closure;
use User;
use App\Product;

class CheckProduct
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
      $user = $request->user();

      $user->load('products');

      $uri = $request->path();
      $uri = explode('/', $uri);
      $uri = (int)$uri[1];

      foreach($user->products as $product) {
        if ($product->id === $uri)
        {
          return $next($request);
        }
      }

      $producto = Product::where('id', $uri)->first();

      if ($user->roll && $user->group === $producto->owner)
      {
        return $next($request);
      }

      return redirect('/');
    }
}
