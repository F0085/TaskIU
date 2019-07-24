<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //public $servidor='http://172.172.174.180:8000/';
    public $servidor='http://localhost:8000/';
   
    public function vista()
    {
        $Usuarios=$this->index();  //LISTA DE USUARIOS
        $Area=$this->ListaAreas();  //LISTA DE AREA

        return view('registro')->with(['Usuarios'=>$Usuarios, 'Area'=>$Area]);
    }

    public function RegistroUser()
    {
        $Usuarios=$this->index();  //LISTA DE USUARIOS
        $Area=$this->ListaAreas();  //LISTA DE AREA

        return view('auth.register')->with(['Usuarios'=>$Usuarios, 'Area'=>$Area]);
    }

    public function ListaAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $client = new Client([
             'base_uri' => $this->servidor.'Usuarios',
        ]);

       // $emailToken= base64_encode($request->Email);
        $clave= base64_encode($request->Clave);
        $tipoUser=(int)($request->TipoUser);

        $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Sexo'=>$request->Sexo, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'Celular'=>$request->Celular, 'email'=>$request->Email, 'Password'=>$clave]; 


        //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
        $res = $client->request('POST','',['form_params' => $data]);

       
               
         if ($res->getStatusCode()==201 || $res->getStatusCode()==201){
            $Usuario= json_decode((string) $res->getBody(), true);
          
            $client2 = new Client([
                 'base_uri' => $this->servidor.'StoreUserRoles',
            ]);
            $data = ['Id_Usuario'=>$Usuario['Id_Usuario'], 'Id_Roles'=>$request->Rol]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
            $res = $client2->request('POST','',['form_params' => $data]);
            return $Usuario;
                    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios/{$id}");
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id=(int)($id);
        $client = new Client([
          'base_uri' => $this->servidor.'Usuarios/'.$id,
        ]);
        
        if($request->ActClaveCHE == 1){
            $clave= base64_encode($request->Clave);
            $tipoUser=(int)($request->TipoUser);
            $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'email'=>$request->Email, 'Password'=>$clave]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
        }else if( $request->ActClaveCHE == 0 ){
            $tipoUser=(int)($request->TipoUser);
            $data = ['Nombre'=>$request->Nombres, 'Apellido'=>$request->Apellidos, 'Cedula'=>$request->Cedula, 'Direccion'=>$request->Direccion, 'Id_tipo_Usuarios'=>$tipoUser, 'email'=>$request->Email]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
        }
        $res = $client->request('PUT','',['form_params' => $data]);        
        if ($res->getStatusCode()==200){
         return json_decode((string) $res->getBody(), true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
