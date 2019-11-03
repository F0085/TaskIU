<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $servidor='http://18.188.234.88/';
    //public $servidor='http://localhost:8000/';
    
    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Documento");
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
    public function guardarDocumento(Request $request){

        dd($request);
    }

    public function store(Request $request)
    {
        $Ruta = $request->archivo;
        $Nombre = basename($Ruta);
        
        session_start();
        $fechaactual=date('Y-m-j H:i:s');

        $client = new Client([
          'base_uri' => $this->servidor.'Documento',
        ]);
        $data = ['Descripcion'=>$request->Descripcion,
                 'Ruta'=>$Nombre,
                 'Id_Tarea'=>$request->Id_Tarea,
                 'Id_Usuario'=>$_SESSION['id'],
                 'Fecha'=>$fechaactual]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

        $res = $client->request('POST','',['form_params' => $data]);
               
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
            $ext = pathinfo($Ruta, PATHINFO_EXTENSION);
            \Storage::disk('Documento')->put($Nombre,  \File::get($Ruta));
            $public_path = public_path();
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
        $response = $client->request('GET', "Documento/{$id}");
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
