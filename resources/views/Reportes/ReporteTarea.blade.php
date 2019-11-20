<?php
  session_start(); 
    
?>
@extends('layouts.app')
	
@section('contenido')
<div class="col-lg-12 es">
    <div class="card">
        <div class="card-body">
        	<div class="row">
        		<div class="col-md-12">
        			<h3>Lista de tareas de las que puede generar el resporte</h3><br>
        			<select class="form-control input-default">
        				<option>Terminadas</option>
        				<option>Pendientes</option>
        				<option>Vencidas</option>
        			</select>
        			<br>
			        	 <div class="table-responsive" style="font-size: 12px;">
			                <table class="table  header-border table-hover sortable  " id="myTable">
			                    <thead>
			                        <tr style="color: black" align="center" >
			               <!--              <th scope="col">#</th> -->
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Nombre</th>
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Fecha Creación</th>
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Tipo</th>
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Acción</th>

			                        </tr>
			                    </thead>
			                    <tbody id="TablaTareas">
			                    	@if(isset($Tareas))
				                    	@foreach($Tareas as $val)
				                    	<tr>
				                    		<td>{{$val['Nombre']}}</td>
				                    		<td align="center">{{$val['FechaCreacion']}}</td>
				                    		<td align="center">Laboral</td>
				                    		<td align="center" ><a href="GenerarReporte/{{$val['Id_tarea']}}" class="btn btn-success btn-sm"><span class="fa fa-download"></span> Descargar Reporte</a></td>
				                    	</tr>
				                    	@endforeach
			                    	@endif

			                    </tbody>
			                </table>

			                
			            </div>
        		</div>
        	</div>
        </div>
    </div>
</div>
	
 <script type="text/javascript" src="{{asset('js/sorttable.js')}}"></script>		


@endsection
