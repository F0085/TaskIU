<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
        //TRAER EFECTIVIDAD POR MESES LABORALES
    public function EfectividadPorMeses($Anio, $Mes)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "EfectividadPorMeses/{$_SESSION['id']}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

    //TRAER EFECTIVIDAD POR MESES PERSONALES
    public function EfectividadPorMesesPersonales($Anio, $Mes)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "EfectividadPorMesesPersonales/{$_SESSION['id']}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

    //RESPONSABLIDAD LABORAL  POR MESES 
    public function TotalTareasResponsablesLaboral($Anio, $Mes)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalTareasResponsablesLaboral/{$_SESSION['id']}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

      //RESPONSABLIDAD PERSONAL  POR MESES 
    public function TotalTareasResponsablesPersonal($Anio, $Mes)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalTareasResponsablesPersonal/{$_SESSION['id']}/{$Anio}/{$Mes}");
        return json_decode((string) $response->getBody(), true);
    }

    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
