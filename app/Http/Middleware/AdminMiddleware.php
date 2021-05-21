<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware 
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
        /* $user = User::where('email',$request['email'])->first();
        if($user != null)
            if( $user['is_admin'] == 1) */
            $user = auth()->user();
            if($user != null)
                if($user['is_admin'] == 1)
                    return $next($request);
        return redirect()->route('dashboard');
        
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }    
}
