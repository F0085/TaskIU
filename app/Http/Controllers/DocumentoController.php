<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $servidor='http://18.188.234.88/';
    public $servidorArchivos='http://http://18.218.182.41//';
    
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

        // $nomrearchivo=$file->getClientOriginalName(); // OBTENGO EL NOMBRE DEL ARCHIVO 
        //         $extension = pathinfo($nombrearchivo, PATHINFO_EXTENSION); //OBTENGO LA EXTENSION DEL ARCHIVO
        //          $ruta = date('Ymd'). time(). "_" . "img"  . "." . $extension; // LE ASIGNO UN NOMBRE ALEATORIO
        // $Ruta = "C:\Users\José Sabando\Desktop\IMPLEMENTACION TESIS\ifth belen\PERIODO ACADEMICO.pdf";
        // \Storage::disk('local')->put($ruta,  \File::get($file));
        //         $public_path = public_path();

        // $Nombre = basename($Ruta);
        $file = $request->file('file');
        session_start();
        $fechaactual=date('Y-m-j H:i:s');

        $client = new Client([
          'base_uri' => $this->servidor.'Documento',
        ]);
         $clientArchivos = new Client([
          'base_uri' => $this->servidorArchivos,
        ]);
        $data = ['Descripcion'=>$request->Descripcion,
                 'Ruta'=>'subiendo',
                 'Id_Tarea'=>$request->Id_Tarea,
                 'Id_Usuario'=>$_SESSION['id'],
                 'Fecha'=>$fechaactual]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

        $res = $client->request('POST','',['form_params' => $data]);
               
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
           $dataArchivos = ['file'=>$file]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

            $clientArchivos->request('POST','',['form_params' => $dataArchivos]);

            
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
