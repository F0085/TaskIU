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
       //public $servidor='http://18.188.234.88/';
           public $servidor='http://localhost:8000/';


    //SUBAREAS POR AREAS
    public function SubAreaPorArea($idarea){
       $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "SubAreaPorArea/{$idarea}");
        return json_decode((string) $response->getBody(), true);
    }

    //ROLES POR SUBAREAS
    public function RolesPorSubArea($subarea){
       $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "RolesPorSubArea/{$subarea}");
        return json_decode((string) $response->getBody(), true);
    }

    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Roles");
        return json_decode((string) $response->getBody(), true);
     }



    // public function ListaRolesPorAreas($idArea){

    //     $client = new Client([
    //       'base_uri' => $this->servidor,
    //     ]);
    //     $response = $client->request('GET', "RolesArId/{$idArea}");
    //     return json_decode((string) $response->getBody(), true);
    // }


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

            $data = ['Descripcion'=>$request->Descripcion,
                     'Id_Sub_Area'=>$request->Id_Sub_Area]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

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
          'base_uri' => $this->servidor,
        ]);
        $res = $client->request('GET', "Roles/{$id}");
        if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         return json_decode((string) $res->getBody(), true);
        }
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
          'base_uri' => $this->servidor.'Roles/'.$id,
        ]);
        $data = ['Descripcion'=>$request->Descripcion,
                 'Id_Sub_Area'=>$request->Id_Sub_Area];       
        $res = $client->request('PUT','',['form_params' => $data]);        
        if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
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
          'base_uri' => $this->servidor,
        ]);
        $res = $client->request('DELETE', "Roles/".$id);
    }
}
