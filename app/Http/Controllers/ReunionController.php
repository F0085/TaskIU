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
        //CLIENTE PARA LAS TAREAS
        $client = new Client([
          'base_uri' => $this->servidor.'Reunion',
        ]);

        //CLIENTE PARA RESPONSABLES
        $Clienteresponsable = new Client([
                  'base_uri' => $this->servidor.'Responsables',
        ]); 

        //CLIENTE PARA PARTICIPANTES
        $ClienteParticipantes= new Client([
                  'base_uri' => $this->servidor.'Participantes',
        ]); 

        //CLIENTE PARA OBSERVADORES
        $ClienteObservadores= new Client([
                  'base_uri' => $this->servidor.'Observadores',
        ]); 

        //PARA SABER SI CREAR UNA TAREA O SUBTAREAS
        if($request->tareasIdTareas != null){
          $tipTar='S';
        }else{
          $tipTar='T';
        }
        $fecha=date('Y-m-j H:i:s');
        $data = ['Id_Usuario'=>$_SESSION['id'],
                 'Estado_Tarea'=>'Pendiente',
                 'Id_Tipo_Tarea'=>$request->tipoTarea,
                 'Nombre'=>$request->Nombre,
                 'FechaInicio'=>$request->FechaIn,
                 'Hora_Inicio'=>$request->HoraIn,
                 'Hora_Fin'=>$request->HoraFin,
                 'FechaFin'=>$request->FechaFin,
                 'FechaCreacion'=>$fecha,
                 'Descripcion'=>$request->descripcion,
                 'tareaFavorita'=>'1',
                 'tareasIdTareas'=>$request->tareasIdTareas,
                 'tip_tar'=>$tipTar]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX


        $res = $client->request('POST','',['form_params' => $data]);
        $ResultadoTareas=json_decode((string) $res->getBody(), true);
           
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
            if($request->ResponsablesTask != null){
                foreach ($request->ResponsablesTask as $key => $responsables) {
                    $dataResponsables = ['Id_Usuario'=>$responsables,
                     'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
                    $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
                }
            }
            if($request->ParticipantesTask != null){
                foreach ($request->ParticipantesTask as $key => $participantes) {
                    $dataParticipantes = ['Id_Usuario'=>$participantes,
                     'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
                    $ResultParticipantes= $ClienteParticipantes->request('POST','',['form_params' => $dataParticipantes]);
                } 
            }
            
            if($request->ObservadoresTask !=null){
              foreach ($request->ObservadoresTask as $key => $observadores) {
                  $dataObservadores = ['Id_Usuario'=>$observadores,
                   'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
                  $ResultObservadores= $ClienteObservadores->request('POST','',['form_params' => $dataObservadores]);
              } 
            }
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
