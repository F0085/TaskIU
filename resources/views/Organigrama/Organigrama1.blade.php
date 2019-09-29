<?php
  session_start(); 
    
?>
@extends('layouts.app')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
  <head>


         <script src="{{asset('js/orgchart.js')}}"></script>


     <style type="text/css">
       html, body{
  width: 100%;
  height: 100%;
  padding: 0;
  margin:0;
  overflow: hidden;
  font-family: Helvetica;
}
#tree{
  width:100%;
  height:100%;
}
     </style>
    
  </head>
  <body>

    <div style="width:100%; height:700px;" id="orgchart"/></div>

  @include('Organigrama.modalInforOrg')

    <script src="{{asset('js/Organigrama.js')}}"></script>
    <script type="text/javascript">

        organigrama();

    </script>
   
  </body>



</html>



@endsection



 

