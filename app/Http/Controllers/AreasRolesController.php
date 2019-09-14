<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AreasRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $servidor='http://localhost:8000/';

    // LISTA DE AREAS ROLES
    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ListAreaRoles");
        return json_decode((string) $response->getBody(), true);
    }

    //REGISTRAR AREAS ROLES
    public function store(Request $request)
    {
        $client = new Client([
          'base_uri' => $this->servidor.'AreasRoles',
        ]);

        $data = ['Id_Area'=>$request->IdArea,
                 'Id_Roles'=>$request->IdRol]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

        $res = $client->request('POST','',['form_params' => $data]);
               
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         return json_decode((string) $res->getBody(), true);
        }
    }


    //EDITAR AREAS ROLES
    public function edit($id)
    {
        $client = new Client([
            'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "AreasRoles/{$id}");
        return json_decode((string) $response->getBody(), true);
    }


    //ACTUALIZAR AREAS ROLES
    public function update(Request $request, $id)
    {
        $id=(int)($id);
        $client = new Client([
         'base_uri' => $this->servidor.'AreasRoles/'.$id,
        ]);
        $data = ['Id_Area'=>$request->IdArea,
                     'Id_Roles'=>$request->IdRol]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX       
        $res = $client->request('PUT','',['form_params' => $data]);     

         if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
         return json_decode((string) $res->getBody(), true);
        }
    }

    //ELIMINAR AREAS ROLES
    public function destroy($id)
    {
        $id=(int)($id);
         $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $res = $client->request('DELETE', "AreasRoles/".$id);
    }
}
