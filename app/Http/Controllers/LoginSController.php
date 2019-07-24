<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class LoginSController extends Controller
{
   public $servidor='http://localhost:8000/';
   //  public $servidor='http://172.172.174.180:8000/';
    

    public function index(){
        return view('auth.login');
    }
    //  public function Login(Request $request){  
         
    //     $email= base64_encode($request->email);

    //     $clave= base64_encode($request->clave);
    //     // dd($email.'   '.$clave);
   
    //     //$email=$request->email;
    //     $client = new Client([
    //       'base_uri' => $this->servidor,
    //     ]);
    //     $response = $client->request('GET', "login/{$email}/{$clave}");
    //     $UsuariosLogin= json_decode((string) $response->getBody(), true);
    //     if($UsuariosLogin !=null){
    //         session_start();
    //         $_SESSION['id']=$UsuariosLogin[0]['id'];
    //         $_SESSION['nombre']=$UsuariosLogin[0]['name'];
    //         $_SESSION['email']=$UsuariosLogin[0]['email'];
    //         return redirect('/');
    //     }else{
    //         return back()->withInput();
    //     }
    // }

    public function Login(Request $request){  


        $client = new Client([
          'base_uri' => $this->servidor.'Login',
        ]);
        $password= base64_encode($request->password);
        $data = ['email'=>$request->email,'password'=>$password]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

        $response = $client->request('POST','',['form_params' => $data]);
               
        $UsuariosLogin= json_decode((string) $response->getBody(), true);
     
        if($UsuariosLogin !=null){

            session_start();
            $_SESSION['id']=$UsuariosLogin[0]['Id_Usuario'];
            $_SESSION['nombre']=$UsuariosLogin[0]['Nombre'];
            $_SESSION['email']=$UsuariosLogin[0]['email'];
            return redirect('/');
        }else{
            return back()->withInput();
        }
    }


    public function logout(){
        session_start();    
        session_destroy();
        return redirect('/');
    }
}
