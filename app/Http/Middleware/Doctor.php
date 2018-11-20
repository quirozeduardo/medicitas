<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class Doctor
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
        $doctor = \App\Models\Medical\Doctor::where('user_id', Auth::user()->id)->first();
        if($doctor)
        {
            return $next($request);
        }
        else
        {
            Flash::overlay('No puedes acceder a este apartado o realizar la acción','NO ERES DOCTOR');
            return Redirect::back();
        }
    }
}
