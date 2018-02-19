<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckCustomer
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

        $uri = $request->path();
        $uri = explode('/', $uri);
        $uri = (int)$uri[1];

        if ($user->id == $uri)
        {
          return $next($request);
        }

        //Verify if admin
        $usuario = User::where('id', $uri)->first();

        if ($user->roll && $user->group == $usuario->owner)
        {
          return $next($request);
        }

        return redirect('/');

    }
}
