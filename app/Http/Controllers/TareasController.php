<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
Use Exception;



class TareasController extends Controller
{
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
      //LISTA DE USUARIOS

	public function index(){
  
      try {

      $Usuarios=$this->Usuarios();
      $Tareas=$this->TareasEstado('Pendiente');
      $TipoTareas=$this->TipoTareasPerTra();  
      return view('GestionTareas.MisTareas')->with(['Usuarios'=>$Usuarios, 'Tareas'=>$Tareas,'TipoTareas'=>$TipoTareas]);
      } catch (Exception $e) {
        return redirect('login');
      }
   
      

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
        $resul =array();
        $response = $client->request('GET', "Usuarios");
        $resultado= json_decode((string) $response->getBody(), true);
        return $resultado;
        // foreach ($resultado as $key => $value) {
        //   if($value['email'] != ''){
        //     $resul[$key]=$value;
        //   }
        // }
        // return $resul;

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
      session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "tareasCPM/{$estado}/{$_SESSION['id']}");
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
        $this->ActualizarEstadosPorfechasTodasTareas('Pendiente');
        // if($estado == 'Pendiente'){
        // $response = $client->request('GET', "TareasEstado/{$estado}/{$_SESSION['id']}");
        // $resultado= json_decode((string) $response->getBody(), true);
        //   foreach ($resultado as $key => $value) {
        //     dd($value);

        //     $this->ComprobarTareaFecha($value['Id_tarea'],$value['FechaFin'],$value['Hora_Fin']);
        //   }
        // } 
          $this->ActualizarEstadosPorfechasTodasTareas('Pendiente');
        $response = $client->request('GET', "TareasEstado/{$estado}/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);
    }

      public function ActualizarEstadosPorfechasTodasTareas($estado)
    {

        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        if($estado == 'Pendiente'){
          $response = $client->request('GET', "TareasEstadoAdministrador/{$estado}");
          $resultado= json_decode((string) $response->getBody(), true);
            foreach ($resultado as $key => $value) {
              $this->ComprobarTareaFecha($value['Id_tarea'],$value['FechaFin'],$value['Hora_Fin']);
            }
          }        
    }

     public function TareasEstadoAdministrador($estado)
    {
        // session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        if($estado == 'Pendiente'){
          $response = $client->request('GET', "TareasEstadoAdministrador/{$estado}");
          $resultado= json_decode((string) $response->getBody(), true);
            foreach ($resultado as $key => $value) {
              $this->ComprobarTareaFecha($value['Id_tarea'],$value['FechaFin'],$value['Hora_Fin']);
            }
          }
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
         $fechaactual=date('Y-m-j H:i:s');
   
        $client = new Client([
          'base_uri' => $this->servidor.'Observaciones',
        ]);

        $idtareas=(int)($idtareas); 
        //CLIENTE API Tareas       
        $clientTarea = new Client([
          'base_uri' => $this->servidor.'Tareas/'.$idtareas,
        ]);

        $dataTarea = ['Estado_Tarea'=>'Terminada','FechaEntrega'=>$fechaactual];


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

         $ClienteNotificaciones = new Client([
              'base_uri' => $this->servidor.'Notificaciones',
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
  
        if($request->tipoTarea=="4"){
          $dataResponsables = ['Id_Usuario'=>$_SESSION['id'],
                   'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
                  $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
        }
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
         	if($request->ResponsablesTask != null){
	         	foreach ($request->ResponsablesTask as $key => $responsables) {
	         	    $dataResponsables = ['Id_Usuario'=>$responsables,
	                 'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
	              $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
                $descripcionNotificacion='Ha sido invitado como Responsable de la tarea'.' "'.$ResultadoTareas['Nombre'].'"';
                $dataNotificacion = ['Id_Usuario'=>$responsables,
                   'FechaLimite'=>$ResultadoTareas['FechaFin'],
                   'VistaWeb'=>'0',
                   'VistaMovil'=>'0',
                    'tipo'=>'Tarea',
                    'tipoRol'=>'MisTareasResponsables',
                    'descripcion'=>$descripcionNotificacion,
                    'Id_Ttar_Reu'=>$ResultadoTareas['Id_tarea']];
                $ClienteNotificaciones->request('POST','',['form_params' => $dataNotificacion]);
	         	}
        	}
        	if($request->ParticipantesTask != null){
	         	foreach ($request->ParticipantesTask as $key => $participantes) {
	              $dataParticipantes = ['Id_Usuario'=>$participantes,
	                 'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
	              $ResultParticipantes= $ClienteParticipantes->request('POST','',['form_params' => $dataParticipantes]);
                $descripcionNotificacion='Ha sido invitado como Participante de la tarea'.' "'.$ResultadoTareas['Nombre'].'"';
                $dataNotificacion = ['Id_Usuario'=>$participantes,
                  'FechaLimite'=>$ResultadoTareas['FechaFin'],
                  'VistaWeb'=>'0',
                  'VistaMovil'=>'0',
                  'tipo'=>'Tarea',
                  'tipoRol'=>'MisTareasParticipantes',
                  'descripcion'=>$descripcionNotificacion,
                  'Id_Ttar_Reu'=>$ResultadoTareas['Id_tarea']];
                $ClienteNotificaciones->request('POST','',['form_params' => $dataNotificacion]);
	            } 
	        }
	        
            if($request->ObservadoresTask !=null){
              foreach ($request->ObservadoresTask as $key => $observadores) {
                  $dataObservadores = ['Id_Usuario'=>$observadores,
                  'Id_Tarea'=>$ResultadoTareas['Id_tarea']];
                  $ResultObservadores= $ClienteObservadores->request('POST','',['form_params' => $dataObservadores]);
                  $descripcionNotificacion='Ha sido invitado como Observador de la tarea'.' "'.$ResultadoTareas['Nombre'].'"';
                  $dataNotificacion = ['Id_Usuario'=>$observadores,
                    'FechaLimite'=>$ResultadoTareas['FechaFin'],
                    'VistaWeb'=>'0',
                    'VistaMovil'=>'0',
                    'tipo'=>'Tarea',
                    'tipoRol'=>'MisTareasObservadores',
                    'descripcion'=>$descripcionNotificacion,
                    'Id_Ttar_Reu'=>$ResultadoTareas['Id_tarea']];
                  $ClienteNotificaciones->request('POST','',['form_params' => $dataNotificacion]);
              } 
            }
            return json_decode((string) $res->getBody(), true);
        }

    }

    public function validarFechasActualizar($FechaInSub, $FechaFinSub, $FechaIn,$FechaFin,$FechaCreacion){
      $arrae=array();
      $FechaInSub = strtotime ($FechaInSub); 
      $FechaFinSub=strtotime($FechaFinSub);
      $FechaIn=strtotime($FechaIn);
      $FechaFin=strtotime($FechaFin);
      $FechaCreacion=strtotime($FechaCreacion);

      
      //CUANDO TENGA SUBTAREAS
      if($FechaIn>=$FechaInSub){
        $arrae['FIN']= '1';
      }else{
        $arrae['FIN']= '0'; //CORRRECTO
      }

      if(($FechaFin>=$FechaIn) && $FechaFin<=$FechaFinSub) {
        $arrae['FFIN']= '1';
      }else{
        $arrae['FFIN']= '0'; // CORRECTO
      }
      //SIN SUBTAERAS
      if($FechaIn<=$FechaFin){
        $arrae['FINSINSUBTAREA']= '1';
      }else{
        $arrae['FINSINSUBTAREA']= '0';
      }
      if($FechaIn>=$FechaCreacion){
        $arrae['FCreacion']= '1';
      }else{
        $arrae['FCreacion']= '0';
      }
      return $arrae;
     
    }


    public function update (Request $request , $id){
      $FechaInicioEdit=$request->FechaIn.' '.$request->HoraIn;
      $FechaFinEdit=$request->FechaFin.' '.$request->HoraFin;
      if($request->RecursiveTask != null){
        $resultado =$this->show($request->RecursiveTask);
        foreach ($resultado as $key => $value) {
            $FechaInSub=$value['FechaInicio'].' '.$value['Hora_Inicio'];
            $FechaFinSub=$value['FechaFin'].' '.$value['Hora_Fin'];
            $FechaCreacion=$value['FechaCreacion'];

            $ResulVal=$this->validarFechasActualizar($FechaInSub,$FechaFinSub,$FechaInicioEdit,$FechaFinEdit,$request->FechaCreacion);

            if($ResulVal['FIN']=='1'&& $ResulVal['FFIN'] == '1'){
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
                   $date=date('Y-m-d H:i:s');
                  $Fecha_Actual = strtotime ($date); 
                  $FechaFin=strtotime($FechaFinEdit);

                  if($FechaFin>=$Fecha_Actual){
                     $data = ['Id_Tipo_Tarea'=>$request->tipoTarea,
                             'Nombre'=>$request->Nombre,
                             'FechaInicio'=>$request->FechaIn,
                             'Hora_Inicio'=>$request->HoraIn,
                             'Hora_Fin'=>$request->HoraFin,
                             'FechaFin'=>$request->FechaFin,
                             'Descripcion'=>$request->descripcion,
                             'Estado_Tarea'=>'Pendiente']; 
                  }else{                    
                              $data = ['Id_Tipo_Tarea'=>$request->tipoTarea,
                             'Nombre'=>$request->Nombre,
                             'FechaInicio'=>$request->FechaIn,
                             'Hora_Inicio'=>$request->HoraIn,
                             'Hora_Fin'=>$request->HoraFin,
                             'FechaFin'=>$request->FechaFin,
                             'Descripcion'=>$request->descripcion]; 

                  }




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
            }else{
              $arreglo= array();
              return $arreglo['NoCumple']='0';
            }
        }

      }else{
         $ResulVal=$this->validarFechasActualizar('','',$FechaInicioEdit,$FechaFinEdit,$request->FechaCreacion);
        
        if($ResulVal['FINSINSUBTAREA']=='1' && $ResulVal['FCreacion'] == '1'){
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
                  $date=date('Y-m-d H:i:s');
                  $Fecha_Actual = strtotime ($date); 
                  $FechaFin=strtotime($FechaFinEdit);
               if($FechaFin>=$Fecha_Actual){
                     $data = ['Id_Tipo_Tarea'=>$request->tipoTarea,
                             'Nombre'=>$request->Nombre,
                             'FechaInicio'=>$request->FechaIn,
                             'Hora_Inicio'=>$request->HoraIn,
                             'Hora_Fin'=>$request->HoraFin,
                             'FechaFin'=>$request->FechaFin,
                             'Descripcion'=>$request->descripcion,
                             'Estado_Tarea'=>'Pendiente']; 
                  }else{                    
                              $data = ['Id_Tipo_Tarea'=>$request->tipoTarea,
                             'Nombre'=>$request->Nombre,
                             'FechaInicio'=>$request->FechaIn,
                             'Hora_Inicio'=>$request->HoraIn,
                             'Hora_Fin'=>$request->HoraFin,
                             'FechaFin'=>$request->FechaFin,
                             'Descripcion'=>$request->descripcion]; 

                  }


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
            }else{
              $arreglo= array();
              return $arreglo['NoCumple']='0';
            }
      }  
    }

        //LISTA TAREA POR ESTADOS
    public function MisTareasResponsables($Id_Usuario,$estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);

        //SI EL ESTADO ES PENDIENTE COMPRUEBO SI AUN SIGUEN VIGENTE CASO CONTRARIO SE PONE VENCIDA
        if($estado == 'Pendiente'){
          $response = $client->request('GET', "MisTareasResponsables/{$Id_Usuario}");
          $resultado= json_decode((string) $response->getBody(), true);
          foreach ($resultado as $key => $value) {
            if($value['tarea']['Estado_Tarea'] == $estado){
             $this->ComprobarTareaFecha($value['Id_Tarea'],$value['tarea']['FechaFin'],$value['tarea']['Hora_Fin']);
             }
          }
        } 
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



    public function TotalTareasResponsables(){
       session_start();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TotalTareasResponsables/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);

    }
    public function MisTareasParticipantes($Id_Usuario,$estado)
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        //SI EL ESTADO ES PENDIENTE COMPRUEBO SI AUN SIGUEN VIGENTE CASO CONTRARIO SE PONE VENCIDA
        if($estado == 'Pendiente'){
          $response = $client->request('GET', "MisTareasParticipantes/{$Id_Usuario}");
          $resultado= json_decode((string) $response->getBody(), true);
          foreach ($resultado as $key => $value) {
            if($value['tarea']['Estado_Tarea'] == $estado){
             $this->ComprobarTareaFecha($value['Id_Tarea'],$value['tarea']['FechaFin'],$value['tarea']['Hora_Fin']);
             }
          }
        } 
        //VUELVO A CONSULTAR YA CON EL DATO ACTUALIZADO
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
             //SI EL ESTADO ES PENDIENTE COMPRUEBO SI AUN SIGUEN VIGENTE CASO CONTRARIO SE PONE VENCIDA
        if($estado == 'Pendiente'){
          $response = $client->request('GET', "MisTareasObservadores/{$Id_Usuario}");
          $resultado= json_decode((string) $response->getBody(), true);
          foreach ($resultado as $key => $value) {
            if($value['tarea']['Estado_Tarea'] == $estado){
             $this->ComprobarTareaFecha($value['Id_Tarea'],$value['tarea']['FechaFin'],$value['tarea']['Hora_Fin']);
             }
          }
        } 
        $arrae=array();
        $response = $client->request('GET', "MisTareasObservadores/{$Id_Usuario}");
        $resultado= json_decode((string) $response->getBody(), true);
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
      $date=date('Y-m-d H:i:s');
      // $hora=date('H:i');
      // $HoraActual=strtotime ($hora); 
      $FechaInicio=$request->FechaIn.' '.$request->HoraIn;
      $FechaLimite=$request->FechaFin.' '.$request->HoraFin;
      $FechaFinHoraFinValidar=$request->FF.' '.$request->HF;
      

      $Fecha_Actual = strtotime ($date); 
      $FechaInicio=strtotime($FechaInicio);
      $FechaLimite=strtotime($FechaLimite);
      $FechaFinHoraFinValidar=strtotime($FechaFinHoraFinValidar);

      

      if($Fecha_Actual>$FechaInicio){
        $arrae['FIN']= '0';
      }else{
        $arrae['FIN']= '1'; //CORRRECTO
      }

      if($FechaLimite<$FechaInicio){
        $arrae['FFIN']= '0';
      }else{
        $arrae['FFIN']= '1'; // CORRECTO
      }

      if($request->FF != null && $request->HF != null ){
         if($FechaLimite>$FechaFinHoraFinValidar){
            $arrae['FFINHFIN']= '0';
         }else{
          $arrae['FFINHFIN']= '1';
         }
       
      }else{
        $arrae['FFINHFIN']= '1';
      }

      return $arrae;
     
    }

    public function validarinicioTarea($FechaIn,$HoraIn){
      $date=date('Y-m-d H:i:s');
      $FechaInicio=$FechaIn.' '.$HoraIn;
      $FechaInicio = strtotime ($FechaInicio); 
      $Fecha_Actual = strtotime ($date);     
      $arrae=array();  

      if($FechaInicio<=$Fecha_Actual){
        $arrae['Inicia']= '1'; //Inicia Tarea 
      }else{
        $arrae['NoInicia']= '0'; //NO INICIA TAREA
      }
      return $arrae;
    }


}
