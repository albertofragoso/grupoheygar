<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckRoll
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
      if (!$request->user()->roll)
      {
        return redirect('/');
      }

      return $next($request);
    }
}
