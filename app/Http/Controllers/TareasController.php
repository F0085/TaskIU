<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TareasController extends Controller
{
	 public $servidor='http://localhost:8000/';
      //LISTA DE USUARIOS

	public function index(){
	
		$Usuarios=$this->Usuarios(); 
		$Tareas=$this->TareasEstado('Pendiente');	
	  return view('GestionTareas.MisTareas')->with(['Usuarios'=>$Usuarios, 'Tareas'=>$Tareas]);
	} 

	public function TareasPorEstado($estado){
		$Usuarios=$this->Usuarios(); 
		$Tareas=$this->TareasEstado($estado);
		 return view('GestionTareas.MisTareas')->with(['Usuarios'=>$Usuarios, 'Tareas'=>$Tareas]);
	}


    public function Usuarios()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Usuarios");
        return json_decode((string) $response->getBody(), true);
    }

    //LISTA TAREA TODAS
    public function ListaTareas()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Tareas");
        return json_decode((string) $response->getBody(), true);
    }

    //LISTA TAREA POR ESTADOS
    public function TareasEstado($estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasEstado/{$estado}");
        return json_decode((string) $response->getBody(), true);
    }




    public function store(Request $request){
    	 session_start();
    	//CLIENTE PARA LAS TAREAS
	    $client = new Client([
          'base_uri' => $this->servidor.'Tareas',
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



        $data = ['Id_Usuario'=>$_SESSION['id'],
                 'Estado_Tarea'=>'Pendiente',
                 'Id_Tipo_Tarea'=>$request->tipoTarea,
                 'Nombre'=>$request->Nombre,
                 'FechaInicio'=>$request->FechaIn,
                 'Hora_Inicio'=>$request->HoraIn,
                 'Hora_Fin'=>$request->HoraFin,
                 'FechaFin'=>$request->FechaFin,
                 'FechaCreacion'=>'2019-09-06',
                 'Descripcion'=>$request->descripcion,
                 'tareaFavorita'=>'1',
                 'tareasIdTareas'=>'']; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX


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
        	if($request->ResponsablesTask != null){
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
}
