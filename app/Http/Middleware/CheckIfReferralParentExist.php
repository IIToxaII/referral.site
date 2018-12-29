<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckIfReferralParentExist
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
        if ($request->has('ref')){
            if (User::where('referral_id', $request->query('ref'))->first()){
                return $next($request);
            }
            return redirect('register');
        }
        return $next($request);
    }
}
