<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrganigramaController extends Controller
{

    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }

    //TRAE LOS USUARIOS QUE PERTENECEN A UNA AREA Y ROL ESPECIFICO
    public function UserRoles($area,$rol){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "UserRoles/{$area}/{$rol}");
        return json_decode((string) $response->getBody(), true);
    }


   
    //MUESTRA LA VISTA DEL ORGANIGRAMA
    public function index()
    {  
        session_start();
      return view('Organigrama.Organigrama');
    }

        // LISTA DE AREAS ROLES
    public function DibujarOrganigrama()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Organigrama");

        return json_decode((string) $response->getBody(), true);
    }




}
