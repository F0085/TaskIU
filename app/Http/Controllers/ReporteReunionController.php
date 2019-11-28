<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use PDF;
use PDFMerger;
use Illuminate\Support\Facades\Storage;

class ReporteReunionController extends Controller
{
     public $pdf; 
    public $arraypdf=array(); 
    public $con=0;
    public $servidor;
    public function __construct()
    {
        $this->servidor=servidor();
    }
    
    public function GenerarReporte($idReunion){


       
        $client = new Client([
          'base_uri' => $this->servidor,
        ]); 
        $response = $client->request('GET', "ReporteReunionshow/{$idReunion}");
        $reunion= json_decode((string) $response->getBody(), true);


        // dd($tarea[0]['sub_tareas']);
        $pdf = PDF::loadView('ReporteReunion.Reporte',['reunion'=>$reunion[0]]);

        return $pdf->download("Reporte_".$reunion[0]['Tema'].'.pdf');

        
    }
}
