<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hasNotPaid
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
        if (auth()->user()->has_paid == 0)
        {
            return $next($request);
        }
        else
        {
            return redirect('/payment_instructions')->with('message', 'You have already paid');
        }
        
    }
}