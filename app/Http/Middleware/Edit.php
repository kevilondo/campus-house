<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Accomodation;

class Edit
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
        $accomodation = Accomodation::find($request->id);

        if ($accomodation->user_id != auth()->user()->id)
        {
            return redirect('/');
        }
        else
        {
            return $next($request);
        }
        
    }
}
