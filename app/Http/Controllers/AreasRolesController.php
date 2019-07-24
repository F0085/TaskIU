<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AreasRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $servidor='http://localhost:8000/';

    public function index()
    {
        $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "AreasRoles");
        return json_decode((string) $response->getBody(), true);
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
              'base_uri' => $this->servidor.'AreasRoles',
            ]);

            $data = ['Id_Area'=>$request->IdArea,
                     'Id_Roles'=>$request->IdRol]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX

            $res = $client->request('POST','',['form_params' => $data]);
                   
             if ($res->getStatusCode()==200 || $res->getStatusCode()==201 ){
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
        $client = new Client([
            'base_uri' => $this->servidor,
        ]);
        $response = $client->request('GET', "AreasRoles/{$id}");
        return json_decode((string) $response->getBody(), true);
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
        $id=(int)($id);
        $client = new Client([
         'base_uri' => $this->servidor.'AreasRoles/'.$id,
        ]);
        $data = ['Id_Area'=>$request->IdArea,
                     'Id_Roles'=>$request->IdRol]; //EL REQUEST ES EL FORM DATA QUE VIENE EN EL AJAX       
        $res = $client->request('PUT','',['form_params' => $data]);     

         if ($res->getStatusCode()==200 || $res->getStatusCode()==201){
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
        $id=(int)($id);
         $client = new Client([
          'base_uri' => $this->servidor,
        ]);
        $res = $client->request('DELETE', "AreasRoles/".$id);
    }
}
