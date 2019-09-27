<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsuarioController extends Controller
{


    public $servidor='http://localhost:8000/';

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
        $response = $client2->request('GET', "buscarUsuario/{$request->Cedula}/{$request->Email}");
        $user= json_decode((string) $response->getBody(), true);
      
        if(empty($user) != false){
            //CLIENTE PARA CONSUMIR LA API
            $client = new Client([
                 'base_uri' => $this->servidor.'Usuarios',
            ]);

            $clave= base64_encode($request->Clave);
            $tipoUser=(int)($request->TipoUser);
            $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Sexo'=>$request->Sexo, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'Celular'=>$request->Celular, 'email'=>$request->Email, 'Password'=>$clave]; 

            //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
            $res = $client->request('POST','',['form_params' => $data]);

             if ($res->getStatusCode()==201 || $res->getStatusCode()==201){
                $Usuario= json_decode((string) $res->getBody(), true);
                $client2 = new Client([
                     'base_uri' => $this->servidor.'UsuariosRoles',
                ]);
                $data = ['Id_Usuario'=>$Usuario['Id_Usuario'], 'Id_Roles'=>$request->Rol,'Id_Area'=>$request->Id_Area]; 
                $res = $client2->request('POST','',['form_params' => $data]);
                return $Usuario;         
            }
        }else{
            return $user=1;
        }
    }


    public function show($id)
    {
        //
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
            $data2 = ['Id_Roles'=>$request->Rol, 'Id_Area'=>$request->Id_Area];

        }else if( $request->ActClaveCHE == 0 ){
            $tipoUser=(int)($request->TipoUser);
            $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'email'=>$request->Email];
            $data2 = ['Id_Roles'=>$request->Id_Rol, 'Id_Area'=>$request->Id_Area];
        }
  

        $res = $client->request('PUT','',['form_params' => $data]);  
        $res2 = $client2->request('PUT','',['form_params' => $data2]);      
        if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
         return json_decode((string) $res->getBody(), true);
        }
    }

    public function destroy($id)
    {
        //
    }
}
