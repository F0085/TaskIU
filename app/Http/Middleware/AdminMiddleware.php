<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
		session_start();
	    if ($_SESSION['Id_tipo_Usuarios']=='2'  ){
	        return $next($request);
	    }else{

	    return redirect('/');
		}
	}
}