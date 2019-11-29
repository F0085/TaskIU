<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class NotificacionController extends Controller
{
	public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
    public function index(){
    	$client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Notificaciones");
        return json_decode((string) $response->getBody(), true);
    }

    public function ContarNotificaciones(){
    	session_start();
    	$client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ContarNotificacionWeb/{$_SESSION['id']}");
        return json_decode((string) $response->getBody(), true);
    }

    public function Task($IdTtar_Reu,$tipoRol,$idNotificacion){
        $client = new Client([
          'base_uri' => $this->servidor.'Notificaciones/'.$idNotificacion,
        ]);
        $data = ['VistaWeb'=>'1'];
        $res = $client->request('PUT','',['form_params' => $data]); 
    	 return redirect('Tareas')->with(['IdTtar_Reu'=>$IdTtar_Reu,'tipoRol'=> $tipoRol]);
    }

    public function ReunionN($IdTtar_Reu,$tipoRol,$idNotificacion){
            $client = new Client([
          'base_uri' => $this->servidor.'Notificaciones/'.$idNotificacion,
        ]);
                $data = ['VistaWeb'=>'1'];
        $res = $client->request('PUT','',['form_params' => $data]); 

    	 return redirect('Reunion')->with(['IdTtar_Reu'=>$IdTtar_Reu,'tipoRol'=> $tipoRol]);
    }
}
