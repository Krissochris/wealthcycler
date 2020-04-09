<?php

namespace App\Http\Middleware;

use Closure;
use App\ReferralLink;
class StoreReferralCode
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
        $response = $next($request);
        if ($request->has('ref')){
            $referral = $request->get('ref');
            $response->cookie('ref', $referral, 24 * 60 * 7);
        }
        return $response;
    }
}
