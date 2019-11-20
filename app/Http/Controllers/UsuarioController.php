<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsuarioController extends Controller
{


    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }

    //LISTA DE LAS AREAS
    public function ListaAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
    }
   
    //LLAMADA LA VISTA DE REGISTRO PARA EL ADMINISTRADOR
    public function RegistroAdmin()
    {
        $Usuarios=$this->index();  //LISTA DE USUARIOS
        $Area=$this->ListaAreas();  //LISTA DE AREA

        return view('GestionUsuarios.registro')->with(['Usuarios'=>$Usuarios, 'Area'=>$Area]);
    }


    //LLAMADA LA VISTA DE REGISTRO PARA EL USUARIO NORMAL
    public function RegistroUserNormal()
    {
        $Usuarios=$this->index();  //LISTA DE USUARIOS
        $Area=$this->ListaAreas();  //LISTA DE AREA
        return view('GestionUsuarios.register')->with(['Usuarios'=>$Usuarios, 'Area'=>$Area]);
    }


    //LISTA DE USUARIOS
    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios");
        return json_decode((string) $response->getBody(), true);
    }
 
    //GUARDAR USUARIO
    public function store(Request $request)
    {

        $client2 = new Client([
             'base_uri' => $this->servidor,
        ]);
        $response = $client2->request('GET', "buscarUsuario/{$request->Email}"); //  POR EMAIL
        $user= json_decode((string) $response->getBody(), true);
        $userCedula=$this->PrepararUsuario($request->Cedula);
         // dd($user);
      
        if($request->ValorAdmin=='Z'){
            //VALIDO SI EL USUARIO SE ECNUENTRA REGISTRADO CON SU EMAIL
            if(empty($user) == false  || $userCedula['email'] != null ){
                return $user='1'; //USUARIO SE ENCUENTRA REGISTRADO CORRECTAMENTE           
            }else if(empty($userCedula) == false ){ // SE ENCUENTRA EL USUARIO PERTENECIENTE A LA BASE DE DATOS
                //CLIENTE PARA CONSUMIR LA API
                $client = new Client([
                    'base_uri' => $this->servidor.'Usuarios/'.$userCedula['Id_Usuario'],
                ]);

                $clave= base64_encode($request->Clave);
                $tipoUser=(int)($request->TipoUser);
                $data = ['Sexo'=>$request->Sexo, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'Celular'=>$request->Celular, 'email'=>$request->Email, 'Password'=>$clave]; 
             

                //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
                $res = $client->request('PUT','',['form_params' => $data]);  

                 if ($res->getStatusCode()==200 || $res->getStatusCode()==201){             
                    $client2 = new Client([
                         'base_uri' => $this->servidor.'UsuariosRoles',
                    ]);
                    $dataUsRol = ['Id_Usuario'=>$userCedula['Id_Usuario'], 'Id_Roles'=>$request->Rol,]; 
                    $client2->request('POST','',['form_params' => $dataUsRol]);
                    return $user='2';         
                }
            }else{
              return $user='3';  //NO SE ENCUENTRA REGISTRADO EN LA BASE DE DATOS DEL SISTEMA POR FAVOR CONTACTESE CON EL ADMINISTRADOR
            }
                 
        }

        if($request->ValorAdmin=='A'){
            //VALIDO SI EL USUARIO SE ECNUENTRA REGISTRADO CON SU EMAIL
            if(empty($user) == false  || $userCedula['email'] != null ){
                return $user='1'; //USUARIO SE ENCUENTRA REGISTRADO CORRECTAMENTE           
            }else if(empty($userCedula) == false ){ // SE ENCUENTRA EL USUARIO PERTENECIENTE A LA BASE DE DATOS
                //CLIENTE PARA CONSUMIR LA API
                $client = new Client([
                    'base_uri' => $this->servidor.'Usuarios/'.$userCedula['Id_Usuario'],
                ]);

                $clave= base64_encode($request->Clave);
                $tipoUser=(int)($request->TipoUser);
                $data = ['Sexo'=>$request->Sexo, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'Celular'=>$request->Celular, 'email'=>$request->Email, 'Password'=>$clave]; 
             

                //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
                $res = $client->request('PUT','',['form_params' => $data]);  

                if ($res->getStatusCode()==200 || $res->getStatusCode()==201){             
                    $client2 = new Client([
                         'base_uri' => $this->servidor.'UsuariosRoles',
                    ]);
                    $dataUsRol = ['Id_Usuario'=>$userCedula['Id_Usuario'], 'Id_Roles'=>$request->Rol,]; 
                    $client2->request('POST','',['form_params' => $dataUsRol]);
                    return $user='2';         
                }
            }else{
               //CLIENTE PARA CONSUMIR LA API
                $client = new Client([
                     'base_uri' => $this->servidor.'Usuarios',
                ]);

                $clave= base64_encode($request->Clave);
                $tipoUser=(int)($request->TipoUser);
                $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Sexo'=>$request->Sexo, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'Celular'=>$request->Celular, 'email'=>$request->Email, 'Password'=>$clave]; 
             

                //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
                $res = $client->request('POST','',['form_params' => $data]);

                 if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
                    $Usuario= json_decode((string) $res->getBody(), true);
                    $client2 = new Client([
                         'base_uri' => $this->servidor.'UsuariosRoles',
                    ]);
                    $dataUsRol = ['Id_Usuario'=>$Usuario['Id_Usuario'], 'Id_Roles'=>$request->Rol,]; 
                    $client2->request('POST','',['form_params' => $dataUsRol]);
                    return $user='2';
                }  
            }
                 
        }
        
    }

    public function PrepararUsuario($cedula){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "buscarUsuarioPreparar/{$cedula}");
        return json_decode((string) $response->getBody(), true);
    }


    public function show($id)
    {
        
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios/{$id}");
        return json_decode((string) $response->getBody(), true);
    }

    //EDITAR USUARIO
    public function edit($id)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios/{$id}");
        return json_decode((string) $response->getBody(), true);
    }

    //ACTUALIZAR USUARIO
    public function update(Request $request, $id)
    {
        $id=(int)($id); 
        //CLIENTE API USUARIOS       
        $client = new Client([
          'base_uri' => $this->servidor.'Usuarios/'.$id,
        ]);
        //ACTUALIZO USUARIO ROLES
        $client2 = new Client([
          'base_uri' => $this->servidor.'UsuariosRoles/'.$id,
        ]);
        //EN CASO DE ACTUALIAZR LA CONTRASEÑA
        if($request->ActClaveCHE == 1){
            $clave= base64_encode($request->Clave);
            $tipoUser=(int)($request->TipoUser);
            $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'email'=>$request->Email, 'Password'=>$clave]; 
            $data2 = ['Id_Roles'=>$request->Id_Rol];

        }else if( $request->ActClaveCHE == 0 ){
            $tipoUser=(int)($request->TipoUser);
            $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'email'=>$request->Email];
            $data2 = ['Id_Roles'=>$request->Id_Rol];
        }


        $res = $client->request('PUT','',['form_params' => $data]);  
        $res2 = $client2->request('PUT','',['form_params' => $data2]);      
        if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
         return json_decode((string) $res->getBody(), true);
        }
    }

    //ACTUALIZAR PERFIL

    public function ActPerfil(Request $request, $id)
    {
        $id=(int)($id); 
        //CLIENTE API USUARIOS       
        $client = new Client([
          'base_uri' => $this->servidor.'Usuarios/'.$id,
        ]);
        $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Direccion'=>$request->Direccion, 'Celular'=>$request->Celular,'Fecha_Nacimiento'=>$request->FechaNacimiento,'Intereses'=>$request->Intereses,'Instagram'=>$request->Instagram,'Facebook'=>$request->Facebook,'Twitter'=>$request->Twitter
        ];     
        $res = $client->request('PUT','',['form_params' => $data]);      
        if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
         $this->reiniciarSesion();
         return json_decode((string) $res->getBody(), true);
        }
    }

    public function destroy($id)
    {
        //
    }


    public function Perfil(){   

        return view('PerfilUsuario.Perfil');
    }


    //ACTUALIZAR PERFIL
    public function CambiarClave(Request $request)
    {
        session_start();
        $PasswordAct=base64_encode($request->PasswordAtc);
        $PasswordCambio=base64_encode($request->Password);
        if($_SESSION['Password']==$PasswordAct){
            if($request->Password == $request->PasswordConfir){
                //CLIENTE API USUARIOS       
                $client = new Client([
                  'base_uri' => $this->servidor.'Usuarios/'.$_SESSION['id'],
                ]);
                $data = ['Password'=>$PasswordCambio];     
                $res = $client->request('PUT','',['form_params' => $data]);      
                if ($res->getStatusCode()==200 || $res->getStatusCode()==201){

                           // $this->reiniciarSesion();
                 return json_decode((string) $res->getBody(), true);
          
                }
            }else{
                return $resul=1; //CONTRASEÑAS NO COINCIDEN
            }

        }else{
            return $resul=0; // CONTRASEÑA ACTUAL NO ES LA CORRECTA

        }
        // $id=(int)($id); 
       


    }




    public function reiniciarSesion(){
        session_start();
       $client = new Client([
          'base_uri' => $this->servidor.'Login',
        ]);

        $data = ['email'=>$_SESSION['email'],'password'=>$_SESSION['Password']]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
      
        $response = $client->request('POST','',['form_params' => $data]);
               
        $UsuariosLogin= json_decode((string) $response->getBody(), true);
   
         
        if($UsuariosLogin !=null){
            session_destroy();
            session_start();
            $_SESSION['id']=$UsuariosLogin[0]['Id_Usuario'];
            $_SESSION['nombre']=$UsuariosLogin[0]['Nombre'];
            $_SESSION['apellido']=$UsuariosLogin[0]['Apellido'];
            $_SESSION['cedula']=$UsuariosLogin[0]['Cedula'];
            $_SESSION['celular']=$UsuariosLogin[0]['Celular'];
            $_SESSION['direccion']=$UsuariosLogin[0]['Direccion'];
            $_SESSION['email']=$UsuariosLogin[0]['email'];
            $_SESSION['sexo']=$UsuariosLogin[0]['Sexo'];
            $_SESSION['Id_tipo_Usuarios']=$UsuariosLogin[0]['Id_tipo_Usuarios'];
            $_SESSION['Instagram']=$UsuariosLogin[0]['Instagram'];
            $_SESSION['Facebook']=$UsuariosLogin[0]['Facebook'];
            $_SESSION['Twitter']=$UsuariosLogin[0]['Twitter'];
            $_SESSION['Intereses']=$UsuariosLogin[0]['Intereses'];
            $_SESSION['Fecha_Nacimiento']=$UsuariosLogin[0]['Fecha_Nacimiento'];
            $_SESSION['Password']=$UsuariosLogin[0]['Password'];
           
        }
    }
}
