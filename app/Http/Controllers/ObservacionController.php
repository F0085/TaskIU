<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class ObservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
     //ESTA VARIABLE ES EL SERVIDOR QUE CONTIENE LAS APIS
    public $servidor='http://18.188.234.88/';
    //public $servidor='http://localhost:8000/';
    
    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Observaciones");
        return json_decode((string) $response->getBody(), true);
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
        session_start();
        $client = new Client([
          'base_uri' =>$this->servidor.'Observaciones',
        ]);
        $data = ['Id_Usuario'=>$_SESSION['id'],
                 'Id_Tarea'=>$request->idtarea,
                 'Descripcion'=>$request->Observacion,
                 'tipo'=>$request->tipo,
                 'ObservacionID'=>$request->Id_Observacion,
                 'Fecha'=>'2019-10-17'];
        $res = $client->request('POST','',['form_params' => $data]);
         
        if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         return json_decode((string) $res->getBody(), true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Observaciones/{$id}");
        return json_decode((string) $response->getBody(), true);
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
