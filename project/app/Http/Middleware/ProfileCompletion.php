<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if(!empty($user->email) && empty($user->email_verified_at) && empty($user->mobile))
        {
            return redirect()->route('customer.sales-process.profile-completion');
        }

        if(!empty($user->mobile) && empty($user->mobile_verified_at) && empty($user->email))
        {

            return redirect()->route('customer.sales-process.profile-completion');
        }

        if(empty($user->first_name) || empty($user->last_name) || empty($user->national_code))
        {
            return redirect()->route('customer.sales-process.profile-completion');
        }
        return $next($request);
    }
}
