<?php
  session_start(); 
    
?>
@extends('layouts.app')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Organization Chart Plugin</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/jquery.orgchart.css">
    <script
    src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <style type="text/css">
      #ul-data {
        position: relative;
        top: -60px;
        display: inline-block;
        margin-left: 10%;
        width: 30%;
        margin-right: 6%;
      }
      #chart-container { display: inline-block; width: 50%; }
      #ul-data li { font-size: 32px; }
    </style>
  </head>
  <body  >
    <form class="table-responsive" style="overflow:scroll; height:100%; width:100%;">
      <ul id="ul-data" style="display: none">
        <li>CLINICA CARDIOCENTRO MANTA
          <ul>
            @foreach($DistintAreas as $v)
              <li>{{$v['Area']}}  
              <ul >
                @foreach($AreasRoles as $valor) 
                    @if($valor['Area']==$v['Area'])
                <li><center>



                  {{'<'.'a style="cursor: pointer" onclick="UserRol('.$valor['Id_Area'].','.$valor['Id_Roles'].');" data-toggle="modal" data-target="#inforOrganigrama" >'.$valor['Rol'].'</a>'}}</center>
 <!--                  <ul>
                    <li>hola</li>
                    <li>hol3</li>
                  </ul> -->
                </li>@endif
                @endforeach
               <!--  <li>Hei Hei
                  <ul>
                    <li>Pang Pang</li>
                    <li>Xiang Xiang</li>
                  </ul>
                </li> -->
              </ul>
            </li>@endforeach
          </ul>
        </li>
      </ul>
      <div id="chart-container"></div>
    </form>
    <!--   <script type="text/javascript" src="js/jquery.min.js"></script> -->
     @include('Organigrama.modalInforOrg')

    <script type="text/javascript">
      $(function() {

        $('#chart-container').orgchart({
          'data' : $('#ul-data')
        });

      });
    </script>
          <script src="{{ asset('js/Organigrama.js') }}"></script>
  </body>
</html>



@endsection