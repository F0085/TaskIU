<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class GestionAdministrativaController extends Controller
{
	//ESTA VARIABLE ES EL SERVIDOR QUE CONTIENE LAS APIS
	public $servidor='http://localhost:8000/';
    
    //TRAER TODAS LAS AREAS REGISTRADAS
    public function ListaArea(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
    }


    //PARA EXTRAER LAS AREAS CON SUS RESPETIVOS ROLES
    public function AreasRoles()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ListAreaRoles");
        return json_decode((string) $response->getBody(), true);
    }
        //PARA EXTRAER LAS AREAS CON SUS RESPETIVOS ROLES
    public function AreasRoles2()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ListAreaRoles2");
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

    //TRAE LAS AREAS DISTINTAS DE AREAROLES
    public function DistintAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "disntinArea");
        return json_decode((string) $response->getBody(), true);
    }

    //LLAMADA A LA VISTA PRINCIPAL DE LA GESTION ADMINISTRATIVA
    public function index()
    {
        $Areas=$this->ListaArea();
        $Roles=$this->ListaRoles();
        $AreasRoles=$this->AreasRoles2();
       // $DistintAreas=$this->DistintAreas();
        return view('GestionAdministrativa.AdministracionGeneral')->with(['Areas'=>$Areas,'Roles'=>$Roles, 'AreasRoles'=>$AreasRoles]);
    }

}
