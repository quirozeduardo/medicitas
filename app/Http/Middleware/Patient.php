<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class Patient
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
        $patient = \App\Models\Medical\Patient::where('user_id', Auth::user()->id)->first();
        if($patient)
        {
            return $next($request);
        }
        else
        {
            Flash::error('No puedes acceder a este apartado o realizar la acción','NO ERES PACIENTE');
            return Redirect::back();
        }
    }
}
