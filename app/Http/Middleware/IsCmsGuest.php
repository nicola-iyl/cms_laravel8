<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsCmsGuest
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard('cms')->check())
        {
            $user = Auth::guard('cms')->user();
            if($user->role->name == 'admin')
            {
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->route('shop.dashboard');
            }
        }
        return $next($request);
    }
}
