<?php

namespace App\Http\Controllers;

use App\GestionUsuariosController;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
// use GuzzleHttp\Request;


class AreasController extends Controller
{

    //ESTA VARIABLE ES EL SERVIDOR QUE CONTIENE LAS APIS
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }

    //LLAMADA A LA VISTA DE AREAS
    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
    }

    //REGISTRO DE AREAS
    public function store(Request $request)
    {     
        $client = new Client([
          'base_uri' =>$this->servidor.'Area',
        ]);
        $data = ['Descripcion'=>$request->Descripcion]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

        $res = $client->request('POST','',['form_params' => $data]);
               
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         return json_decode((string) $res->getBody(), true);
        }
    }


    //EDITAR USUARIOS
    public function edit($id)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area/{$id}");
        return json_decode((string) $response->getBody(), true);
    }

        //EDITAR USUARIOS

    public function update(Request $request, $id)
    {
        $id=(int)($id);
        $client = new Client([
          'base_uri' => $this->servidor.'Area/'.$id,
        ]);
        $data = ['Descripcion'=>$request->Descripcion]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
        $res = $client->request('PUT','',['form_params' => $data]);        
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
         return json_decode((string) $res->getBody(), true);
        }
    }

    public function destroy($id)
    {

        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $res = $client->request('DELETE', "Area/".$id);

    }
}
