<?php
  session_start(); 
    
?>
@extends('layouts.app')
@section('contenido')
<div class="col-lg-12">

	    <div class="card">
	        <div class="card-body">
	            <div class="media align-items-center mb-4">
	                <img class="mr-3" src="images/avatar/11.png" width="80" height="80" alt="">
	                <div class="media-body">
	                    <h3 class="mb-0">@if(isset($_SESSION['nombre'])){{$_SESSION['nombre']}} {{$_SESSION['apellido']}}@endif</h3>
	                    <p class="text-muted mb-0">@if(isset($_SESSION['Id_tipo_Usuarios'])) @if($_SESSION['Id_tipo_Usuarios'] == 1) Empleado @elseif($_SESSION['Id_tipo_Usuarios'] == 2) Administrador @endif @endif</p>
	                </div>
	            </div>
	            
	            <div class="row mb-5">
	                <div class="col">
	                    <div class="card  text-left" style="padding-top: 20px">
	                    	<div class="col-lg-12">
	                        <span class="mb-1 text-primary"><!-- <i class="icon-user"></i> --></span>
	                        <p style="color: black"><b><i class="fa fa-address-card-o"></i>    Cédula:</b> @if(isset($_SESSION['cedula'])){{$_SESSION['cedula']}}@endif </p>
	                        <p style="color: black"><b><i class="fa fa-envelope"></i>    Email:</b> @if(isset($_SESSION['email'])){{$_SESSION['email']}}@endif </p>
	                        <p style="color: black"><b><i class="fa fa-phone"></i>    Celular:</b> @if(isset($_SESSION['celular'])){{$_SESSION['celular']}}@endif </p>
	                        <p style="color: black"><b><i class="fa  fa-map-marker"></i>    Dirección:</b> @if(isset($_SESSION['direccion'])){{$_SESSION['direccion']}}@endif </p>
	                        <p style="color: black"><b><i class="fa fa-venus-double"></i>    Sexo:</b> @if(isset($_SESSION['sexo']))@if($_SESSION['sexo'] == "M") Masculino @else Femenino @endif @endif </p>
	                        </div>
	                    </div>
	                </div>
	                <div class="col">
	                    <div class="card  text-left" style="padding-top: 20px">
	                    	<div class="col-lg-12">
		                        <span class="mb-1 text-warning"></span>
		                         <p style="color: black"><b><i class="fa fa-birthday-cake"></i>    Cumpleaños:</b> </p>
		                        <p style="color: black"><b><i class="fa fa-child"></i>    Edad:</b>  </p>
		                        <p style="color: black"><b><i class="fa fa-ajust"></i>    Color Favorito:</b>  </p>
		                        <p style="color: black"><b><i class="fa  fa-utensils"></i>    Comida Favorita:</b> </p>
		                        <p style="color: black"><b><i class="fa fa-heart"></i>    Intereses:</b> </p>
	                   		 </div>
	                    </div>
	                </div>
	                <div class="col-12 text-center">
	                    <button class="btn btn-primary px-5">Editar Perfil</button>
	                </div>
	            </div>

	            <h4>About Me</h4>
	            <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
	            <ul class="card-profile__info">
	                <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
	                <li><strong class="text-dark mr-4">Email</strong> <span>name@domain.com</span></li>
	            </ul>
	        </div>
	    </div>
	</div>

</div>
@endsection