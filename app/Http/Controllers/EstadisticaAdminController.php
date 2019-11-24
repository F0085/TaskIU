<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EstadisticaAdminController extends Controller
{
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
    public function index(){
    	$TotalTareasAdmin=$this->TotalTareasAdmin();
    	$Usuarios=$this->Usuarios();
    	return view('GestionEstadistica.EstadisticaAdmin')->with(['TotalTareasAdmin'=>$TotalTareasAdmin,'Usuarios'=>$Usuarios]);
    }
    public function TotalTareasAdmin(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalTareasAdmin");
        return json_decode((string) $response->getBody(), true);
    }
    public function Usuarios(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios");
        return json_decode((string) $response->getBody(), true);
    }

    public function TotalTareasResponsablesLaboralAdmin($Id_Usuario,$Anio, $Mes)
    {
    
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalTareasResponsablesLaboral/{$Id_Usuario}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

    public function TotalTareasResponsablesPersonalAdmin($Id_Usuario,$Anio, $Mes)
    {
    
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalTareasResponsablesPersonal/{$Id_Usuario}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

    public function EfectividadLaboral($Id_Usuario,$Anio, $Mes)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "EfectividadPorMeses/{$Id_Usuario}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

    public function EfectividadPersonal($Id_Usuario,$Anio, $Mes)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "EfectividadPorMesesPersonales/{$Id_Usuario}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }


    public function TotalEstadisticaAdmin()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalEstadisticaAdmin");
        return json_decode((string) $response->getBody(), true);
    }

    public function TotalEstadisticaUsuario($Id_Usuario)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalEstadisticaUsuario/{$Id_Usuario}");
        return json_decode((string) $response->getBody(), true);
    }


    
}
