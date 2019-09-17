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
		$TipoTareas=$this->TipoTareasPerTra();	
	  return view('GestionTareas.MisTareas')->with(['Usuarios'=>$Usuarios, 'Tareas'=>$Tareas,'TipoTareas'=>$TipoTareas]);
	} 

	//TAREAS POR ESTADO PENDIENTE TERMINADAS VENCIDAS PROCESO
	public function TareasPorEstado($estado){
		$Usuarios=$this->Usuarios(); 
		$Tareas=$this->TareasEstado($estado);
		$TipoTareas=$this->TipoTareasPerTra();
		 return view('GestionTareas.MisTareas')->with(['Usuarios'=>$Usuarios, 'Tareas'=>$Tareas,'TipoTareas'=>$TipoTareas]);
	}
	
	//TAREAS POR TIPO DE TAREA PERSONAL O TRABAJO
	public function TareasPorTipo($estado, $tipo)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasPorTipo/{$estado}/{$tipo}");
        return json_decode((string) $response->getBody(), true);
    }

    //TAREAS POR TIPO DE TAREA PERSONAL O TRABAJO Y ESTADO DE LA TAREA
	public function TipoTareasPerTra()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TipoTareasPerTra");
        return json_decode((string) $response->getBody(), true);
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

    public function show($id){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Tareas/{$id}");
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

        //PARA SABER SI CREAR UNA TAREA O SUBTAREAS
        if($request->tareasIdTareas != null){
          $tipTar='S';
        }else{
          $tipTar='T';
        }

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


        //LISTA TAREA POR ESTADOS
    public function MisTareasResponsables($Id_Usuario,$estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "MisTareasResponsables/{$Id_Usuario}");
        $resultado= json_decode((string) $response->getBody(), true);
        $arrae=array();
        foreach ($resultado as $key => $value) {

          if($value['tarea']['Estado_Tarea'] == $estado){
          $arrae[$key]= array($value['tarea']);
          }
       
        }

           return $arrae;
        // if($resultado['tarea'])
    }
}
