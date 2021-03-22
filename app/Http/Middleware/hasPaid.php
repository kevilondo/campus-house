<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hasPaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // if the user hasn't paid, he won't be allowed to add an accomodation
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->has_paid == 0)
        {
            return redirect('/payment_instructions')->with('message', 'You need to pay first before posting accomodations');
        }
        else
        {
            return $next($request);
        }
    }
}
