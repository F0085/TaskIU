<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Mail;
use Illuminate\Support\Facades\Crypt;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }


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
        //COMPARO QUE EL ESTADO DE LA REUNION DE  ACUERDO AL PARAMETRO Y CREO UN ARREGLO SEGUN EL ESTADO
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

    public function EstadoVencimiento($Fecha){
          $Fecha=strtotime ($Fecha); 
          
          $fechaactual=date('Y-m-j H:i:s');
          $fechaactual=strtotime ($fechaactual); 
           if($Fecha < $fechaactual){
            return 1;
           }
        
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

       //  $data = ['Tema' => $request->Tema,
       //           'Fecha' => $request->FechaIn,
       //          'Hora' => $request->HoraIn,
       //          'Tipo' => 'Participante'];
       //          // dd($data);
       //  // dd($data);
       // Mail::send('GestionReunion.Email.email', $data, function ($m){
       //       $m->to('leonardosabando@gmail.com')
       //      ->subject('INVITACIÓN A REUNIÓN');
       //      // ->attach('documentoCertificados/'.$ruta);
       //  });
       
         session_start();
        //CLIENTE PARA LAS REUNIONES
        $client = new Client([
          'base_uri' => $this->servidor.'Reunion',
        ]);
                //CLIENTE PARA LAS REUNIONES
        $clienUser = new Client([
          'base_uri' => $this->servidor,
        ]);


        //CLIENTE PARA RESPONSABLES
        $Clienteresponsable = new Client([
                  'base_uri' => $this->servidor.'Reunio_Responsable',
        ]); 

        //CLIENTE PARA PARTICIPANTES
        $ClienteParticipantes= new Client([
                  'base_uri' => $this->servidor.'Reunio_Participante',
        ]); 

        //CLIENTE NOTIFICACIONES
        $ClienteNotificaciones = new Client([
              'base_uri' => $this->servidor.'Notificaciones',
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
        $Id_Reunion=Crypt::encrypt($ResultadoReunion['Id_Reunion']);
    
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
            if($request->ResponsablesReunion != null){
                foreach ($request->ResponsablesReunion as $key => $responsables) {
                    $dataResponsables = ['Id_Usuario'=>$responsables,
                     'Id_Reunion'=>$ResultadoReunion['Id_Reunion']];
                    $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
                     //BUSCAR EL CORREO DEL PARTICIPANTE
                    $responseRespo = $clienUser->request('GET', "Usuarios/{$responsables}");
                    $resultRespo= json_decode((string) $responseRespo->getBody(), true);
                    $Id_Usuario=Crypt::encrypt($responsables);

                    $descripcionNotificacion='Ha sido invitado como Responsable a la reunión'.' "'.$ResultadoReunion['Tema'].'", para confirmar su asistencia por favor revise su correo electrónico.';
                    $dataNotificacion = ['Id_Usuario'=>$responsables,
                        'FechaLimite'=>$ResultadoReunion['FechadeReunion'],
                        'VistaWeb'=>'0',
                        'VistaMovil'=>'0',
                        'tipo'=>'Reunion',
                        'tipoRol'=>'Responsable',
                        'descripcion'=>$descripcionNotificacion,
                        'Id_Ttar_Reu'=>$ResultadoReunion['Id_Reunion']];
                    $ClienteNotificaciones->request('POST','',['form_params' => $dataNotificacion]);

                    $dataEmail = ['Tema' => $request->Tema,
                                  'Fecha' => $request->FechaIn,
                                  'Hora' => $request->HoraIn,
                                  'Tipo' => 'Responsable',
                                  'Id_Reunion'=>$Id_Reunion,
                                  'Id_Usuario'=>$Id_Usuario];
                    Mail::send('GestionReunion.Email.email', $dataEmail, function ($m) Use($resultRespo){
                         $m->to($resultRespo['email'])
                        ->subject('INVITACIÓN A REUNIÓN');
                        // ->attach('documentoCertificados/'.$ruta); //ADJUNTAR UN ARCHIVO
                    });
                }
            }
            if($request->ParticipantesReunion != null){
                foreach ($request->ParticipantesReunion as $key => $participantes) {
                   //PARA GUARDAR EL PARTICIPANTES
                    $dataParticipantes = ['Id_Usuario'=>$participantes,
                     'Id_Reunion'=>$ResultadoReunion['Id_Reunion'],'asistencia'=>'0'];
                    $ResultParticipantes= $ClienteParticipantes->request('POST','',['form_params' => $dataParticipantes]);
                    //BUSCAR EL CORREO DEL PARTICIPANTE
                    $responseParti = $clienUser->request('GET', "Usuarios/{$participantes}");
                    $resultPar= json_decode((string) $responseParti->getBody(), true);
                    $Id_Usuario=Crypt::encrypt($participantes);

                    $descripcionNotificacion='Ha sido invitado como Participante a la reunión'.' "'.$ResultadoReunion['Tema'].'", para confirmar su asistencia por favor revise su correo electrónico.';
                    $dataNotificacion = ['Id_Usuario'=>$participantes,
                        'FechaLimite'=>$ResultadoReunion['FechadeReunion'],
                        'VistaWeb'=>'0',
                        'VistaMovil'=>'0',
                        'tipo'=>'Reunion',
                        'tipoRol'=>'Participante',
                        'descripcion'=>$descripcionNotificacion,
                        'Id_Ttar_Reu'=>$ResultadoReunion['Id_Reunion']];
                    $ClienteNotificaciones->request('POST','',['form_params' => $dataNotificacion]);
                    $dataEmail = ['Tema' => $request->Tema,
                                  'Fecha' => $request->FechaIn,
                                  'Hora' => $request->HoraIn,
                                  'Tipo' => 'Participante',
                                  'Id_Reunion'=>$Id_Reunion,
                                  'Id_Usuario'=>$Id_Usuario];
                    Mail::send('GestionReunion.Email.email', $dataEmail, function ($m) Use($resultPar){
                         $m->to($resultPar['email'])
                        ->subject('INVITACIÓN A REUNIÓN');
                        // ->attach('documentoCertificados/'.$ruta); //ADJUNTAR UN ARCHIVO
                    });
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
        if($request->Suspender=='Suspender'){
             $data = ['Conclusion'=>$request->Conclusion,
            'Estado'=>'Suspendida'];
        }else{
            $data = ['Conclusion'=>$request->Conclusion,
               'Estado'=>'Terminada'];
        }
 
        $res = $client->request('PUT','',['form_params' => $data]); 
        return json_decode((string) $res->getBody(), true);

    }

    public function ModificarReunion(Request $request, $id)
    {
                  //CLIENTE PARA LAS REUNION
        $clientServer = new Client([
          'base_uri' => $this->servidor,
        ]);
          //CLIENTE PARA LAS REUNION
        $client = new Client([
          'base_uri' => $this->servidor.'Reunion/'.$id,
        ]);
                //CLIENTE PARA RESPONSABLES
        $Clienteresponsable = new Client([
                  'base_uri' => $this->servidor.'Reunio_Responsable',
        ]); 

        //CLIENTE PARA PARTICIPANTES
        $ClienteParticipantes= new Client([
                  'base_uri' => $this->servidor.'Reunio_Participante',
        ]); 

        $data = ['Tema'=>$request->Tema,
                 'Orden_del_Dia'=>$request->Orden_del_Dia,
                 'Lugar'=>$request->Lugar,
                 'FechadeReunion'=>$request->FechaIn,
                 'HoraReunion'=>$request->HoraIn];
 
        $res = $client->request('PUT','',['form_params' => $data]); 
        $ResultadoReunion =json_decode((string) $res->getBody(), true);
    
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
            if($request->ResponsablesReunion != null){
                $resDeleteRes= $clientServer->request('DELETE', "Reunio_Responsable/".$id); 
                foreach ($request->ResponsablesReunion as $key => $responsables) {
                    $dataResponsables = ['Id_Usuario'=>$responsables,
                     'Id_Reunion'=>$ResultadoReunion['Id_Reunion']];
                    $ResultResponsables = $Clienteresponsable->request('POST','',['form_params' => $dataResponsables]);
                }
            }
            if($request->ParticipantesReunion != null){
                $resDeletePa = $clientServer->request('DELETE', "Reunio_Participante/".$id);
                foreach ($request->ParticipantesReunion as $key => $participantes) {
                    $dataParticipantes = ['Id_Usuario'=>$participantes,
                     'Id_Reunion'=>$ResultadoReunion['Id_Reunion'],'asistencia'=>'1'];
                    $ResultParticipantes= $ClienteParticipantes->request('POST','',['form_params' => $dataParticipantes]);
                } 
            }
            return json_decode((string) $res->getBody(), true);
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
