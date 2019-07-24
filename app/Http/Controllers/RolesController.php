<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles_UsuarioModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $servidor='http://localhost:8000/';



    public function index()
    {
        return $this->ListaRolesAreas();
        return $roles_usuario=Roles_UsuarioModel::all();
    
         return view('ingreso_roles')->with(['roles_usuario'=>$roles_usuario]);    
     }

    //ROLES CON AREAS
    public function ListaRolesAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Roles");
        return json_decode((string) $response->getBody(), true);
    }

    public function ListaRolesPorAreas($idArea){

        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "RolesArId/{$idArea}");
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
              'base_uri' => $this->servidor.'Roles',
            ]);

            $data = ['Descripcion'=>$request->descripcion,
                     'nivel'=>$request->nivel]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

            $res = $client->request('POST','',['form_params' => $data]);
                   
             if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
             return json_decode((string) $res->getBody(), true);
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
          'base_uri' => 'http://localhost:8000/',
        ]);
        $response = $client->request('GET', "Roles/{$id}");
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
          'base_uri' => 'http://localhost:8000/Roles/'.$id,
        ]);
        $data = ['Descripcion'=>$request->Descripcion, 'nivel'=>$request->Nivel]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
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
        $client = new Client([
          'base_uri' => 'http://localhost:8000/',
        ]);
        $res = $client->request('DELETE', "Roles/".$id);
    }
}
