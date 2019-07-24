<?php

namespace App\Http\Controllers;

use App\GestionUsuariosController;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
// use GuzzleHttp\Request;


class AreasController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public $servidor='http://localhost:8000/';

    public function RegistroArea(Request $request){

        $client = new Client([
          'base_uri' => $this->servidor.'Area',
        ]);

        $data = ['Descripcion'=>$request->Descripcion];

        $res = $client->request('POST', '', ['form_params' => $data]);

        return $res;
     
    }

    public function ListaArea(){

        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
     //return $areas;
       // return view('GestionAdministrativa.AdministracionGeneral')->with(['Area'=>$Usuarios]);
       // return $Usuarios;
    }

       public function sesion(){
       session_start();
      
        $_SESSION['usuario']='JUAN';
       // session_destroy();
        //header("Location:GestionAdministrativa.AdministracionGeneral.blade.php");
       return redirect('/home');
    }



   
    public function AreasRoles()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "ListAreaRoles");
        return json_decode((string) $response->getBody(), true);
    }


    
    public function ListaRoles(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Roles");
        return json_decode((string) $response->getBody(), true);
    }

    //TRAE LAS AREAS DISTINTAS DE AREAROLES
    public function DistintAreas(){
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "disntinArea");
        return json_decode((string) $response->getBody(), true);
    }

    public function index2()
    {
        $Areas=$this->ListaArea();
         $Roles=$this->ListaRoles();
         $AreasRoles=$this->AreasRoles();
         $DistintAreas=$this->DistintAreas();

        return view('GestionAdministrativa.AdministracionGeneral')->with(['Areas'=>$Areas,'Roles'=>$Roles, 'AreasRoles'=>$AreasRoles,'DistintAreas'=>$DistintAreas]);
    }

   
    

     public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "Area");
        return json_decode((string) $response->getBody(), true);
    }


    public function vista()
    {

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
        $client = new Client([
          'base_uri' => 'http://localhost:8000/Area',
        ]);
        $data = ['Descripcion'=>$request->Descripcion]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

        $res = $client->request('POST','',['form_params' => $data]);
               
         if ($res->getStatusCode()==200){
         return json_decode((string) $res->getBody(), true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GestionUsuariosController  $gestionUsuariosController
     * @return \Illuminate\Http\Response
     */
    public function show(GestionUsuariosController $gestionUsuariosController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GestionUsuariosController  $gestionUsuariosController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id=Crypt::decrypt($id);
        $client = new Client([
          'base_uri' => 'http://localhost:8000/',
        ]);
        $response = $client->request('GET', "Area/{$id}");
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GestionUsuariosController  $gestionUsuariosController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id=(int)($id);
        $client = new Client([
          'base_uri' => 'http://localhost:8000/Area/'.$id,
        ]);
        $data = ['Descripcion'=>$request->Descripcion]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX
        $res = $client->request('PUT','',['form_params' => $data]);        
         if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
         return json_decode((string) $res->getBody(), true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GestionUsuariosController  $gestionUsuariosController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $client = new Client([
          'base_uri' => 'http://localhost:8000/',
        ]);
        $res = $client->request('DELETE', "Area/".$id);

    }
}
