<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TareasController extends Controller
{
	    public $servidor='http://18.188.234.88/';
          //public $servidor='http://localhost:8000/';
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
	public function TareasPorTipoPendiente($estado, $tipo)
    {
      session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasPorTipoPendiente/{$estado}/{$tipo}/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);
    }

      //TAREAS POR TIPO DE TAREA PERSONAL O TRABAJO
  public function TareasPorTipo($estado, $tipo)
    {
      session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasPorTipo/{$estado}/{$tipo}/{$_SESSION['id']}");
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

    
    //LISTA TAREA CPM
    public function TareasAdministrador($estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);

        if($estado == 'Pendiente'){
          $response = $client->request('GET', "TareasAdministrador/{$estado}");
          $resultado= json_decode((string) $response->getBody(), true);
          foreach ($resultado as $key => $value) {

            $this->ComprobarTareaFecha($value['Id_tarea'],$value['FechaFin'],$value['Hora_Fin']);
          }
        } 
        $response = $client->request('GET', "TareasAdministrador/{$estado}");
        return json_decode((string) $response->getBody(), true);
    }

   //LISTA TAREA CPM
    public function tareasCPM($estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "tareasCPM/{$estado}");
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
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        if($estado == 'Pendiente'){
        $response = $client->request('GET', "TareasEstado/{$estado}/{$_SESSION['id']}");
        $resultado= json_decode((string) $response->getBody(), true);
        foreach ($resultado as $key => $value) {

          $this->ComprobarTareaFecha($value['Id_tarea'],$value['FechaFin'],$value['Hora_Fin']);
        }
        } 
        $response = $client->request('GET', "TareasEstado/{$estado}/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);
    }

     public function TareasEstadoAdministrador($estado)
    {
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasEstadoAdministrador/{$estado}");
        return json_decode((string) $response->getBody(), true);
    }



    public function show($id){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Tareas/{$id}");
        return json_decode((string) $response->getBody(), true);
    }

    // //TRAE LAS OBSERVACIONES POR EL ID TAREA 
    // public function Observaciones($idTarea){
    //     $client = new Client([
    //       'base_uri' => $this->servidor,
    //     ]);
    //     $response = $client->request('GET', "Observaciones/{$idTarea}");
    //     return json_decode((string) $response->getBody(), true);
    // }


    public function TareasPendientesPorTareas(Request $request){
        $idtareas=$request->idtarea;
        session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasPendientesPorTareas/{$idtareas}/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);

        
    }

    public function GuardarSeguimientoTarea(Request $request){
        $idtareas=$request->idtarea;
   
        $client = new Client([
          'base_uri' => $this->servidor.'Observaciones',
        ]);

        $idtareas=(int)($idtareas); 
        //CLIENTE API Tareas       
        $clientTarea = new Client([
          'base_uri' => $this->servidor.'Tareas/'.$idtareas,
        ]);

        $dataTarea = ['Estado_Tarea'=>'Terminada'];


        $resul=$this->TareasPendientesPorTareas($request);
        if(empty($resul)){
           $resTarea = $clientTarea->request('PUT','',['form_params' => $dataTarea]); 
           return 0;
         


         
        }else{
         return 1; // TIENE TAREAS PENDIENTES
        }
    }

        public function ComprobarTareaFecha($idtareas,$FechaFin,$HoraFin){
          // 2019-10-30 00:00:00
          $FechaFin=$FechaFin.' '.$HoraFin;
          $FechaFin=strtotime ($FechaFin); 
          
          $fechaactual=date('Y-m-j H:i:s');
          $fechaactual=strtotime ($fechaactual); 
        
          if($FechaFin < $fechaactual){

            $client = new Client([
                'base_uri' => $this->servidor.'Tareas/'.$idtareas,
            ]);
            $data = ['Estado_Tarea'=>"Vencida"]; 
            $res = $client->request('PUT','',['form_params' => $data]); 
            return json_decode((string) $res->getBody(), true);
          }
        // $client = new Client([
        //   'base_uri' => $this->servidor.'Observaciones',
        // ]);

        // $idtareas=(int)($idtareas); 
        // //CLIENTE API Tareas       
        // $clientTarea = new Client([
        //   'base_uri' => $this->servidor.'Tareas/'.$idtareas,
        // ]);

        // $dataTarea = ['Estado_Tarea'=>'Terminada'];


        // $resul=$this->TareasPendientesPorTareas($request);
        // if(empty($resul)){
        //    $resTarea = $clientTarea->request('PUT','',['form_params' => $dataTarea]); 
        //    return 0;
         


         
        // }else{
        //  return 1; // TIENE TAREAS PENDIENTES
        // }
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

    public function update (Request $request , $id){

      //CLIENTE PARA LAS TAREAS
      $client = new Client([
          'base_uri' => $this->servidor.'Tareas/'.$id,
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
    $clientServer = new Client([
                'base_uri' => $this->servidor,
    ]);

        $data = ['Id_Tipo_Tarea'=>$request->tipoTarea,
                 'Nombre'=>$request->Nombre,
                 'FechaInicio'=>$request->FechaIn,
                 'Hora_Inicio'=>$request->HoraIn,
                 'Hora_Fin'=>$request->HoraFin,
                 'FechaFin'=>$request->FechaFin,
                 'Descripcion'=>$request->descripcion]; 



        $res = $client->request('PUT','',['form_params' => $data]); 
        $ResultadoTareas=json_decode((string) $res->getBody(), true);
           
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
          if($request->ResponsablesTask != null){
             $resDeletePa = $clientServer->request('DELETE', "Responsables/".$id);
            foreach ($request->ResponsablesTask as $key => $responsables) {
                $dataResponsables = ['Id_Usuario'=>$responsables,
                   'Id_Tarea'=>$id];
                  $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
            }
          }else{
             $resDeletePa = $clientServer->request('DELETE', "Responsables/".$id);
          }
          if($request->ParticipantesTask != null){
            $resDeleteRe = $clientServer->request('DELETE', "Participantes/".$id);
            foreach ($request->ParticipantesTask as $key => $participantes) {
                  $dataParticipantes = ['Id_Usuario'=>$participantes,
                  'Id_Tarea'=>$id];
                  $ResultParticipantes= $ClienteParticipantes->request('POST','',['form_params' => $dataParticipantes]);
              } 
          }else{
            $resDeleteRe = $clientServer->request('DELETE', "Participantes/".$id);
          }
          
            if($request->ObservadoresTask !=null){


              $resDelete = $clientServer->request('DELETE', "Observadores/".$id);

              foreach ($request->ObservadoresTask as $key => $observadores) {
                  $dataObservadores = ['Id_Usuario'=>$observadores,
                   'Id_Tarea'=>$id];
                  $ResultObservadores= $ClienteObservadores->request('POST','',['form_params' => $dataObservadores]);
              
              } 
            }else{
              $resDelete = $clientServer->request('DELETE', "Observadores/".$id);
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
    }
    public function MisTareasParticipantes($Id_Usuario,$estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "MisTareasParticipantes/{$Id_Usuario}");
        $resultado= json_decode((string) $response->getBody(), true);
        $arrae=array();
        foreach ($resultado as $key => $value) {

          if($value['tarea']['Estado_Tarea'] == $estado){
          $arrae[$key]= array($value['tarea']);
          }
       
        }
           return $arrae;
    }

   public function MisTareasObservadores($Id_Usuario,$estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "MisTareasObservadores/{$Id_Usuario}");
        $resultado= json_decode((string) $response->getBody(), true);
        $arrae=array();
        foreach ($resultado as $key => $value) {

          if($value['tarea']['Estado_Tarea'] == $estado){
          $arrae[$key]= array($value['tarea']);
          }
       
        }
           return $arrae;
    }


    public function HoraFechaSistema(){
      $arrae=array();
      $arrae['Fecha']= array($fecha=date('Y-m-d'));
      $arrae['Hora']= array($fecha=date('H:i:s'));
      return $arrae;
    }

    public function validarFechas(Request $request){
      $arrae=array();
      $date=date('Y-m-d');
      $hora=date('H:i');
      $HoraActual=strtotime ($hora); 
 
      $Fecha_Actual = strtotime ($date); 
      $FechaInicio=strtotime($request->FechaIn);
      $FechaLimite=strtotime($request->FechaFin);
      $HoraInicio=strtotime($request->HoraIn);
      $HoraLimite=strtotime($request->HoraFin);
      if($Fecha_Actual>$FechaInicio){
        $arrae['FIN']= '0';
      }else{
        $arrae['FIN']= '1';
      }

      if($FechaLimite<$FechaInicio){
        $arrae['FFIN']= '0';
      }else{
        $arrae['FFIN']= '1';
      }
      if($HoraActual>$HoraInicio){
        $arrae['HIN']= '0';
      }else{
        $arrae['HIN']= '1';
      }

      if($HoraLimite<$HoraInicio){
        $arrae['HFIN']= '0';
      }else{
        $arrae['HFIN']= '1';
      }

      return $arrae;
    }


}
