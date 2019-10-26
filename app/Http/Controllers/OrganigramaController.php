<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrganigramaController extends Controller
{

   // public $servidor='http://localhost:8000/';
    //public $servidor='http://18.188.234.88/';
    public $servidor='http://localhost:8000/';

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
