<?php


namespace App\Http\Middleware;

use Closure;

class UpgradeAccount
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
        if (auth()->check()) {
            if(auth()->user()->is_pro_member == 0) {
                return redirect()->route('become_pro_member');
            }
        }

        return $next($request);
    }
}
