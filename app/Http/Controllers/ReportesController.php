<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use PDF;
use PDFMerger;
use Illuminate\Support\Facades\Storage;

class ReportesController extends Controller
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
    
    public function Reportes()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "TareasReporte/Terminada");
       
        $Tareas=json_decode((string) $response->getBody(), true);
     
         return view('Reportes.Reportetarea')->with(['Tareas'=> $Tareas]);
    }

    public $pdf; 
    public $arraypdf=array(); 
    public $con=0;
    public function GenerarReporte($idtarea){
        $this->pdf= new PDFMerger();
        $client = new Client([
          'base_uri' => $this->servidor,
        ]); 
            $response = $client->request('GET', "Reporteshow/{$idtarea}");
        $tarea= json_decode((string) $response->getBody(), true);

        // dd($tarea[0]['sub_tareas']);
        $pdf1 = PDF::loadView('Reportes.Documento',['tarea'=>$tarea[0]]);
         file_put_contents('Documento/'.'120'.$tarea[0]['Id_tarea'].'.pdf', $pdf1->output()); 
         $pdfFile1Path = public_path() . '/Documento/'.'120'.$tarea[0]['Id_tarea'].'.pdf';
          $this->pdf->addPDF($pdfFile1Path, 'all');
          $this->arraypdf[$this->con]='120'.$tarea[0]['Id_tarea'].'.pdf';

       $this->generarPDF($tarea,$idtarea);
        
    $this->pdf= $this->pdf->merge('stream', "mergedpdf.pdf");

    foreach ($this->arraypdf as $key => $doc) {
        Storage::disk('Documento')->delete($doc);
    }
    return $this->pdf;
 
   

       

    }

    public  function generarPDF($tarea,$idtarea){
      
          
        
        foreach ($tarea[0]['reporte_sub_tareas'] as $key => $value[0]) {
            $this->con=$this->con+1;
            
            $pdf2 = PDF::loadView('Reportes.Documento',['tarea'=>$value[0]]);
            file_put_contents('Documento/'.'120S'.$key.$value[0]['Id_tarea'].'.pdf', $pdf2->output());
            $pdfFile2Path = public_path() . '/Documento/'.'120S'.$key.$value[0]['Id_tarea'].'.pdf';
             $this->pdf->addPDF($pdfFile2Path, 'all'); 
            $this->arraypdf[$this->con]='120S'.$key.$value[0]['Id_tarea'].'.pdf';
            $this->generarPDF($value,$tarea[0]['Id_tarea']);
           
        }
        // return $pdf;

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
