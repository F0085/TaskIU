<?php
  session_start(); 
    
?>
@extends('layouts.app')
@section('contenido')
<div id="cargar"></div>
<div class="col-lg-12" id="cardPefil">

	    <div class="card">
	        <div class="card-body">
	            <div class="media align-items-center mb-4">
	                <img class="mr-3" src="images/form-user.png" width="80" height="80" alt="">
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
		                       <!--   <p style="color: black"><b><i class="fa fa-birthday-cake"></i>    Cumpleaños:</b> </p> -->
		                        <p style="color: black"><b><i class="fa fa-child"></i>    Edad:</b>  </p>
		                        <p style="color: black"><b><i class="fa fa-instagram"></i>    Instagram:</b> @if(isset($_SESSION['Instagram'])){{$_SESSION['Instagram']}}@endif</p>
		                        <p style="color: black"><b><i class="fa  fa-facebook"></i>    Facebook:</b> @if(isset($_SESSION['Facebook'])){{$_SESSION['Facebook']}}@endif</p>
		                         <p style="color: black"><b><i class="fa  fa-twitter"></i>    Twitter:</b> @if(isset($_SESSION['Twitter'])){{$_SESSION['Twitter']}}@endif</p>
		                        <p style="color: black"><b><i class="fa fa-heart"></i>    Intereses:</b> @if(isset($_SESSION['Intereses'])){{$_SESSION['Intereses']}}@endif</p>
	                   		 </div>
	                    </div>
	                </div>
	                <div class="col-12 text-center">
	                    <button onclick="VistaEditarPerfil()" class="btn btn-primary px-5">Editar Perfil</button>
	                </div>
	            </div>

	            <!-- <h4>About Me</h4>
	            <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
	            <ul class="card-profile__info">
	                <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
	                <li><strong class="text-dark mr-4">Email</strong> <span>name@domain.com</span></li>
	            </ul> -->
	        </div>
	    </div>
</div>


<div hidden="true" class="col-lg-12" id="editPerfil">

	    <div class="card">
	        <div class="card-body">
	            <div class="media align-items-center mb-4">
	                <img class="mr-3" src="images/form-user.png" width="80" height="80" alt="">
	                <div class="media-body">
	                    <h3 class="mb-0">Editar Perfil</h3>
	  <!--                   <p class="text-muted mb-0">@if(isset($_SESSION['Id_tipo_Usuarios'])) @if($_SESSION['Id_tipo_Usuarios'] == 1) Empleado @elseif($_SESSION['Id_tipo_Usuarios'] == 2) Administrador @endif @endif</p> -->
	                </div>
	            </div>
	            
	            <div class="row mb-5">
	                <div class="col">
	                	<div class="card  " style="padding-top: 20px">
	                		<input id="IDus" hidden="true" value="@if(isset($_SESSION['id'])) {{$_SESSION['id']}} @endif">
							<div class="row col-lg-12">
								<div class="col-md-12">
									<h3><i class="fa fa-user-o"></i>    Datos Personales</h3>
								</div>
								
							</div>
		                	<div class="row col-lg-12">
		                		<div class="col-md-6">
		                			<label >Nombre:</label>
		                			<input type="text" style="height: 30px;" name="NombrePerfil" id="NombrePerfil" class="form-control input-default" value="@if(isset($_SESSION['nombre'])) {{$_SESSION['nombre']}} @endif">
		                		</div>
		                		<div class="col-md-6">
		                			<label>Apellido:</label>
		                			<input type="text" value="@if(isset($_SESSION['apellido'])) {{$_SESSION['apellido']}} @endif" style="height: 30px;" name="ApellidoPerfil" id="ApellidoPerfil" class="form-control input-default">
		                		</div>
		                	</div>
		                	<br>
		                	<div class="row col-lg-12">
		                		<div class="col-md-6">
		                			<label>Cedula:</label>
		                			<input disabled="true" value="@if(isset($_SESSION['cedula'])) {{$_SESSION['cedula']}} @endif"  type="text" style="height: 30px;" name="CedulaPerfil" id="CedulaPerfil" class="form-control input-default">
		                		</div>
		                		<div class="col-md-6">
		                			<label>Email:</label>
		                			<input disabled="true" value="@if(isset($_SESSION['email'])) {{$_SESSION['email']}} @endif" type="text" style="height: 30px;" name="EmailPerfil" id="EmailPerfil" class="form-control input-default">
		                		</div>
		                	</div>
		                	<br>
		                	<div class="row col-lg-12">
		                		<div class="col-md-6">
		                			<label>Celular:</label>
		                			<input type="text" value="@if(isset($_SESSION['celular'])) {{$_SESSION['celular']}} @endif" style="height: 30px;" name="CelularPerfil" id="CelularPerfil" class="form-control input-default">
		                		</div>
		                		<div class="col-md-6">
		                			<label>Dirección:</label>
		                			<input type="text" value="@if(isset($_SESSION['direccion'])) {{$_SESSION['direccion']}} @endif" style="height: 30px;" name="DireccionPerfil" id="DireccionPerfil" class="form-control input-default">
		                		</div>
		                	</div>
		                	<br>
		                </div>
	                </div>
	                <div class="col">
	                    <div class="card  text-left" style="padding-top: 20px">
	                    	<div class="row col-lg-12">
								<div class="col-md-12">
									<h3><i class="fa fa-share-alt"></i>    Datos Sociales</h3>
								</div>
								
							</div>
	                    	<div class="row col-lg-12">

		                		<div class="col-md-6">
		                			<label >Fecha Nacimiento:</label>
		                			<input type="date" style="height: 30px;" value="{{$_SESSION['Fecha_Nacimiento']}}" name="FechaNacimientoPerfil" id="FechaNacimientoPerfil" class="form-control input-default">
		                		</div>
		                		<div class="col-md-6">
		                			<label>Instagram:</label>
		                			<input type="text" style="height: 30px;" value="@if(isset($_SESSION['Instagram'])) {{$_SESSION['Instagram']}} @endif" name="InstagramPerfil" id="InstagramPerfil" class="form-control input-default">
		                		</div>
		                	</div>
		                	<br>
		                	<div class="row col-lg-12">
		                		<div class="col-md-6">
		                			<label>Facebook:</label>
		                			<input value="@if(isset($_SESSION['Facebook'])) {{$_SESSION['Facebook']}} @endif"  type="text" style="height: 30px;" name="FacebookPerfil" id="FacebookPerfil" class="form-control input-default">
		                		</div>
		                		<div class="col-md-6">
		                			<label>Twitter:</label>
		                			<input value="@if(isset($_SESSION['Twitter'])) {{$_SESSION['Twitter']}} @endif"  type="text" style="height: 30px;" name="TwitterPerfil" id="TwitterPerfil" class="form-control input-default">
		                		</div>

		                	</div>
		                	<br>
		                	<div class="row col-lg-12">
		                		<div class="col-md-12">
		                			<label>Intereses:</label>
		                			<input value="@if(isset($_SESSION['Intereses'])) {{$_SESSION['Intereses']}} @endif"  type="text"  type="text" style="height: 30px;" name="InteresesPerfil" id="InteresesPerfil" class="form-control input-default">
		                		</div>
		                	</div>

		                	<br>
	                    </div>
	                </div>
	                <div class="col-12 text-center">
	                	<div id="bntEditarPerfil">
	                   	 <button onclick="VistaEditarPerfil()" class="btn btn-primary px-5">Editar Perfil</button>
	                   	</div>
	                </div>
	            </div>

	            <!-- <h4>About Me</h4>
	            <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
	            <ul class="card-profile__info">
	                <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
	                <li><strong class="text-dark mr-4">Email</strong> <span>name@domain.com</span></li>
	            </ul> -->
	        </div>
	    </div>
</div>

<script type="text/javascript" src="{{asset('js/Perfil.js')}}"></script>
@endsection