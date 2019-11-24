<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class GestionAdministrativaController extends Controller
{
	//ESTA VARIABLE ES EL SERVIDOR QUE CONTIENE LAS APIS
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
    
    //TRAER TODAS LAS AREAS REGISTRADAS
    public function ListaArea(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
    }



    //PARA TRAER LOS ROLES
    public function ListaRoles(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Roles");
        return json_decode((string) $response->getBody(), true);
    }


    public function SubArea(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "SubArea");
        return json_decode((string) $response->getBody(), true);
    }

    public function AreaSubArea(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "AreaSubArea");
        return json_decode((string) $response->getBody(), true);
    }

    //LLAMADA A LA VISTA PRINCIPAL DE LA GESTION ADMINISTRATIVA
    public function index()
    {
   
            $Areas=$this->ListaArea();
            $SubArea=$this->SubArea();
            $AreaSubArea=$this->AreaSubArea();
            $ListaRoles=$this->ListaRoles();
           // $DistintAreas=$this->DistintAreas();
            return view('GestionAdministrativa.AdministracionGeneral')->with(['Areas'=>$Areas, 'SubArea'=>$SubArea,'AreaSubArea'=>$AreaSubArea,'ListaRoles'=>$ListaRoles]);

    }

}
