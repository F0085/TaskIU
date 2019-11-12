<?php
  session_start(); 
    
?>
@extends('layouts.app')
	
@section('contenido')
<script src="{{asset('js/googleChart.js') }}"></script>
<script src="{{asset('js/Chart.min.js') }}"></script>
<script src="{{asset('js/home.js') }}"></script>

<!-- <div class="card">
    <div class="card-body"> -->
    	<!-- Button trigger modal -->
		<div class="row">
    		<div  align="center" class="col-md-12">
    				<div class="title m-b-md col-md-12">
					   {!!QrCode::size(300)->generate("http://3.134.116.54/AppMovil/CardiocentroManta.apk") !!}
					</div>
					<div align="center"><h3>Descarga la versión movil</h3></div>
    		</div>
    	</div>
		<div class="row">
		    <div class="col-md-12" >
				<div class="container-fluid mt-3">
		                <div class="row">
		                    <div class="col-lg-4 col-sm-6">
		                        <div class="card gradient-1">
		                            <div class="card-body">
		                                <h3 class="card-title text-white">Tareas Laborales</h3>
		                                <div class="d-inline-block">
		                                    <h2 class="text-white " id="TaskLaborales"></h2>
		                               <!--      <p class="text-white mb-0"><a href="/Tareas">Accede a Tareas</a></p> -->
		                                </div>
		                                <span class="float-right display-5 opacity-5"><i class="fa fa-sticky-note"></i></span>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-lg-4 col-sm-6">
		                        <div class="card gradient-2">
		                            <div class="card-body">
		                                <h3 class="card-title text-white" >Tareas Personales</h3>
		                                <div class="d-inline-block">
		                                    <h2 class="text-white" id="TAskPersonales"></h2>
		                                    <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
		                                </div>
		                                <span class="float-right display-5 opacity-5"><i class="fa fa-pencil-square-o"></i></span>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-lg-4 col-sm-6">
		                        <div class="card gradient-3">
		                            <div class="card-body">
		                                <h3 class="card-title text-white">Reuniones</h3>
		                                <div class="d-inline-block">
		                                    <h2 class="text-white" id="ReunionesDAsbor">3</h2>
		                                <!--     <p class="text-white mb-0">Jan - March 2019</p> -->
		                                </div>
		                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		      <!--  <center><img  width="100%" src="images/clinica.png"></center> -->
		    	</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<!-- <div id="piechart" ></div> -->
        <canvas id="graficogeneral"  height="120px"></canvas>
			</div>
			<div class="col-md-6">
        <div align="center" id="chart_div" style="width: 400px; height: 120px;"></div>
				<!-- <canvas id="graficoefectividad"  height="120px"></canvas> -->
			</div>

		</div>

	
    <!-- <div class="row">
      <div class="col-md-12">
        <div id="chart_div" style="width: 400px; height: 120px;"></div>
      </div>
    </div> -->
	
		


@endsection
