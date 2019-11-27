<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ConfirmAsistencia($Id_Reunion,$Id_Usuario,$tipo){
        $Id_Reunion= Crypt::decrypt($Id_Reunion);
        $Id_Usuario= Crypt::decrypt($Id_Usuario);
        $client = new Client([
              'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Reunion/{$Id_Reunion}");
        $Reunion=json_decode((string) $response->getBody(), true);

        $clientAsis = new Client([
          'base_uri' => $this->servidor.'ActualizarAsistencia/'.$Id_Usuario.'/'.$Id_Reunion,
        ]);
        if($tipo=='C'){

            $data = ['asistencia'=>'1',
                    'motivo'=>''];       
            $res = $clientAsis->request('PUT','',['form_params' => $data]);
            return view('ConfirmarAsistencia.Confirmar')->with(['Reunion'=>$Reunion]);
        }else if($tipo == 'NA'){
            $Id_Reunion= Crypt::encrypt($Id_Reunion);
            $Id_Usuario= Crypt::encrypt($Id_Usuario);
            $data = ['asistencia'=>'0'];       
            $res = $clientAsis->request('PUT','',['form_params' => $data]);
            return view('ConfirmarAsistencia.NoAsiste')->with(['Id_Reunion'=>$Id_Reunion,'Id_Usuario'=>$Id_Usuario]);
        }
    }


    public function GuardarMotivo(Request $request,$Id_Reunion,$Id_Usuario){
        $Id_Reunion= Crypt::decrypt($Id_Reunion);
        $Id_Usuario= Crypt::decrypt($Id_Usuario);
        $client = new Client([
              'base_uri' => $this->servidor,
        ]);

        $clientAsis = new Client([
          'base_uri' => $this->servidor.'ActualizarAsistencia/'.$Id_Usuario.'/'.$Id_Reunion,
        ]);
        $data = ['motivo'=>$request->motivo];       
        $res = $clientAsis->request('PUT','',['form_params' => $data]);
        return redirect('/');

    }

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
        
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor.'ActualizarAsistencia/'.$_SESSION['id'].'/'.$id,
        ]);
        $data = ['asistencia'=>$request->asistencia];       
        $res = $client->request('PUT','',['form_params' => $data]);

        if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         return 1;
        }
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
