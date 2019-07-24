<?php
  session_start(); 
    
?>
@extends('layouts.app')

@section('contenido')

<div class="row">
    <div class="col-md-12" style="padding-top: 200px">
       <center> <h1 style="color: black; font-family: Comic Sans MS, cursive, sans-serif;"><strong><strong style="color: #dd2323">BIENVENIDO @if(isset($_SESSION['nombre'])){{$_SESSION['nombre']}}@endif</strong> A <strong style="color: blue">CARDIOCENTRO</strong> MANTA</strong></h1></center>    
      <!--  <center><img  width="100%" src="images/clinica.png"></center> -->
    </div>
</div>
@endsection
