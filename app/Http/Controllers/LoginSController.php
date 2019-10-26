<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class LoginSController extends Controller
{
   //public $servidor='http://18.188.234.88/';
       public $servidor='http://localhost:8000/';
   //  public $servidor='http://172.172.174.180:8000/';
    

    public function index(){
        return view('auth.login');
    }

    //LOGUEAR O INICIAR SESIÓN
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
            $_SESSION['apellido']=$UsuariosLogin[0]['Apellido'];
            $_SESSION['cedula']=$UsuariosLogin[0]['Cedula'];
            $_SESSION['celular']=$UsuariosLogin[0]['Celular'];
            $_SESSION['direccion']=$UsuariosLogin[0]['Direccion'];
            $_SESSION['sexo']=$UsuariosLogin[0]['Sexo'];
            $_SESSION['Id_tipo_Usuarios']=$UsuariosLogin[0]['Id_tipo_Usuarios'];
            $_SESSION['email']=$UsuariosLogin[0]['email'];
            $_SESSION['Password']=$UsuariosLogin[0]['Password'];
            return redirect('/');
        }else{
            return back()->withInput();
        }
    }

    //CERRAR SESION
    public function logout(){
        session_start();    
        session_destroy();
        return redirect('/');
    }
}
