<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrganigramaController extends Controller
{

    public $servidor='http://localhost:8000/';


    //TRAE LOS USUARIOS QUE PERTENECEN A UNA AREA Y ROL ESPECIFICO
    public function UserRoles($area,$rol){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "UserRoles/{$area}/{$rol}");
        return json_decode((string) $response->getBody(), true);
    }


    //TRAE LAS AREAS DISTINTAS DE AREA ROLES
    public function DistintAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "disntinArea");
        return json_decode((string) $response->getBody(), true);
    }

    //LISTA DE AREA ROLES
    public function AreasRoles()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ListAreaRoles");
        return json_decode((string) $response->getBody(), true);
    }

    //LISTA DE AREAS
    public function ListaArea(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
    }

    //MUESTRA LA VISTA DEL ORGANIGRAMA
    public function index()
    {  $AreasRoles=$this->AreasRoles();
          return view('Organigrama.Organigrama');
        $Area=$this->ListaArea();
      

        $DistintAreas=$this->DistintAreas();
        return view('Organigrama.Organigrama')->with(['Area'=>$Area,'AreasRoles'=>$AreasRoles,'DistintAreas'=>$DistintAreas]);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
