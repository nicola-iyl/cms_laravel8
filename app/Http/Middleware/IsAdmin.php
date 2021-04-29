<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        //per evitare di accedere a determita rotte riservate all'utente admin
        $user = Auth::guard('cms')->user();
        if($user->role->name != 'admin')
        {
            return redirect()->route('shop.dashboard');
        }
        return $next($request);
    }
}
