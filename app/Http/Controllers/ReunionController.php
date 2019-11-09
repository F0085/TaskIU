<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public $servidor='http://18.188.234.88/';
            //public $servidor='http://localhost:8000/';

    public function Usuarios()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios");
        return json_decode((string) $response->getBody(), true);
    }
    public function index()
    {
        $Usuarios=$this->Usuarios(); 
      return view('GestionReunion.Reunion')->with(['Usuarios'=>$Usuarios]);
    }

     //LISTA REUNIONES POR ESTADOS Y DE ACUERDO AL USUARIO Q CREA
    public function ReunionPorEstado_User($estado)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ReunionPorEstado_User/{$estado}/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);
    }


    //LISTA REUNION DE RESPONSABLES
    public function MisReunionesResponsables($estado)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "MisReunionesResponsables/{$_SESSION['id']}");
        $resultado= json_decode((string) $response->getBody(), true);
        $arrae=array();

        foreach ($resultado as $key => $value) {
          if($value['reunion']['Estado'] == $estado){
          $arrae[$key]= array($value['reunion']);
          }
       
        }

           return $arrae;
    }

       //LISTA REUNION DE PARTICIPANTES
    public function MisReunionesParticipantes($estado)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "MisReunionesParticipantes/{$_SESSION['id']}");
        $resultado= json_decode((string) $response->getBody(), true);
        $arrae=array();
        foreach ($resultado as $key => $value) {
         
          if($value['reunion']['Estado'] == $estado){
          $arrae[$key]= array($value['reunion']);
          }
       
        }

           return $arrae;
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
        //CLIENTE PARA LAS REUNIONES
        $client = new Client([
          'base_uri' => $this->servidor.'Reunion',
        ]);

        //CLIENTE PARA RESPONSABLES
        $Clienteresponsable = new Client([
                  'base_uri' => $this->servidor.'Reunio_Responsable',
        ]); 

        //CLIENTE PARA PARTICIPANTES
        $ClienteParticipantes= new Client([
                  'base_uri' => $this->servidor.'Reunio_Participante',
        ]); 


        $fecha=date('Y-m-j H:i:s');
        $data = ['Id_Usuario'=>$_SESSION['id'],
                 'Tema'=>$request->Tema,
                 'Orden_del_Dia'=>$request->Orden_del_Dia,
                 'Estado'=>'Pendiente',
                 'FechaCreacion'=>$fecha,
                 'Lugar'=>$request->Lugar,
                 'FechadeReunion'=>$request->FechaIn,
                 'HoraReunion'=>$request->HoraIn];
 

        $res = $client->request('POST','',['form_params' => $data]);
        $ResultadoReunion=json_decode((string) $res->getBody(), true);
    
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
            if($request->ResponsablesReunion != null){
                foreach ($request->ResponsablesReunion as $key => $responsables) {
                    $dataResponsables = ['Id_Usuario'=>$responsables,
                     'Id_Reunion'=>$ResultadoReunion['Id_Reunion']];
                    $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
                }
            }
            if($request->ParticipantesReunion != null){
                foreach ($request->ParticipantesReunion as $key => $participantes) {
                    $dataParticipantes = ['Id_Usuario'=>$participantes,
                     'Id_Reunion'=>$ResultadoReunion['Id_Reunion'],'asistencia'=>'1'];
                    $ResultParticipantes= $ClienteParticipantes->request('POST','',['form_params' => $dataParticipantes]);
                } 
            }
            return json_decode((string) $res->getBody(), true);
        }
    }

    public function Asistencia(Request $request, $id, $Id_Usuario)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor.'ActualizarAsistencia/'.$Id_Usuario.'/'.$id,
        ]);
        $data = ['asistencia'=>$request->asistencia];       
        $res = $client->request('PUT','',['form_params' => $data]);

        if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         return 1;
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
        $response = $client->request('GET', "Reunion/{$id}");
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
          //CLIENTE PARA LAS REUNION
        $client = new Client([
          'base_uri' => $this->servidor.'Reunion/'.$id,
        ]);
        $data = ['Conclusion'=>$request->Conclusion,
             'Estado'=>'Terminada'];
        $res = $client->request('PUT','',['form_params' => $data]); 
        return json_decode((string) $res->getBody(), true);
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
