<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class Autenticar
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

        $email= base64_encode($request->email);

        $clave= base64_encode($request->clave);
        // dd($email.'   '.$clave);
   
        //$email=$request->email;
        $client = new Client([
          'base_uri' => 'http://localhost:8000/',
        ]);
        $response = $client->request('GET', "login/{$email}/{$clave}");
        $UsuariosLogin= json_decode((string) $response->getBody(), true);
        if($UsuariosLogin !=null){
            return redirect('home');
        }
        return $next($request);
    }
}
