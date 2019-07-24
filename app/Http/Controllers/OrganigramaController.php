<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrganigramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
         public $servidor='http://localhost:8000/';
     */
    public $servidor='http://localhost:8000/';


    //TRAE LOS USUARIOS QUE PERTENECEN A UNA AREA Y ROL ESPECIFICO
    public function UserRoles($area,$rol){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "UserRoles/{$area}/{$rol}");
        return json_decode((string) $response->getBody(), true);
    }

    public function index()
    {
        $Area=$this->ListaArea();
        $AreasRoles=$this->AreasRoles();
        $DistintAreas=$this->DistintAreas();
        return view('Organigrama.Organigrama')->with(['Area'=>$Area,'AreasRoles'=>$AreasRoles,'DistintAreas'=>$DistintAreas]);
    }

      //TRAE LAS AREAS DISTINTAS DE AREAROLES
    public function DistintAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "disntinArea");
        return json_decode((string) $response->getBody(), true);
    }

    public function AreasRoles()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ListAreaRoles");
        return json_decode((string) $response->getBody(), true);
    }


    public function ListaArea(){


        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
     //return $areas;
       // return view('GestionAdministrativa.AdministracionGeneral')->with(['Area'=>$Usuarios]);
       // return $Usuarios;
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
