@extends('layouts.app')
@section('contenido')

<!-- PARA EL DATEPICKER -->
<!-- <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
 <link href="./plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet"> -->
<!-- <script type="text/javascript">
     $('.selectpicker').selectpicker({
    style: 'btn-default'
  });
</script> -->
@if(isset($_SESSION['Id_tipo_Usuarios']))
    @if($_SESSION['Id_tipo_Usuarios']=='2')

    <script type="text/javascript">
        $( document ).ready(function() {
            TareasGenerales('Pendiente');
        });
    </script>
    @else
        <script type="text/javascript">
        $( document ).ready(function() {
             TareasTipo('T','Pendiente');
        });
       </script>

    @endif
@endif
<div id="cargar"></div>


<div class="row">

    <div class="col-lg-12">
        <nav class="stroke">
            <div class="row">
                <div class="col-md-10">
                    <ul>
                      <li ><a class="activado" id="Pendiente"   href="javascript:void(0);" 
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasGenerales('Pendiente','');"
                            @else
                                onClick="TareasTipo('T','Pendiente');"
                            @endif
                        @endif
                        >Pendientes</a></li>
                     <!--  <li ><a  id="Proceso" data-value='Proceso' href="javascript:void(0);" 
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasGenerales('Proceso');"
                            @else
                                onClick="TareasTipo('T','Proceso');"
                            @endif
                        @endif
                        >Proceso</a></li> -->
                      <li><a id="Terminada" href="javascript:void(0);"
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasGenerales('Terminada');"
                            @else
                                onClick="TareasTipo('T','Terminada');"
                            @endif
                        @endif 
                        >Terminadas</a></li>
                        <li><a id="Vencida" href="javascript:void(0);"
                         @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasGenerales('Vencida');"
                            @else
                               onClick="TareasTipo('T','Vencida');"]}});"
                            @endif
                        @endif 
                        >Vencidas</a></li>
                        <!--  <select id="SelectTipoTarPerTra" onchange="TareasTipo(this.value,'filtro')" class=" input-default">
                            <option value="T">Creadas por mi</option>
                            <option value="T">Responsable</option>
                            <option value="T">Participante</option>
                            <option value="T">Observador</option>
                         </select> -->

                    </ul>
                </div>
                <div class="col-md-2 centerDiv" >
                   <button style="background-color: #312d79; color: white" onclick="ModalCrearTareas()" type="button" class="btn" > <i class="fa fa-plus-square"></i>  Nueva tarea</button>
                </div>
            </div>
        </nav>
        <div id="ho"></div>         
    </div>
</div>
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <ul>
            <div id="EstaTar" hidden="true"></div>
            <div class="row">
                <div class="col-md-4">
                       <h1 class="card-title" style="padding-top: 20px">LISTA DE TAREAS</h1>
                </div>
                <div class="col-md-6">
                     @if(isset($_SESSION['Id_tipo_Usuarios']))

                 <select id="SelecTipoUserTareas" onchange="TareasPorUsuario('',this.value,'{{$_SESSION['id']}}')" class="form-control input-default">
                    <option value="CPM">Creadas por mi</option>
                    <option value="MisTareasResponsables">Responsable</option>
                    <option value="MisTareasParticipantes">Participante</option>
                    <option value="MisTareasObservadores">Observador</option>
                 </select>
                 @endif
                </div>
                <div class="col-md-2">
                 <select id="SelectTipoTarPerTra" onchange="TareasTipo(this.value,'filtro')" class="form-control input-default">
                    <option value="T">Todas</option>
                    @foreach($TipoTareas as $valores)
                         <option value="{{$valores['Id_Tipo_Tarea']}}">{{$valores['Descripcion']}}</option>
                    @endforeach
                 </select>
                </div>
            </div>
               <hr style=" background-color: red; height: 1px">

                <div class="contenedor">
                    <button data-toggle="modal" data-target=".ModalCrearTareas" class="botonF1">
                      <span>+</span>
                    </button>
                </div>
            <div class="table-responsive" style="font-size: 12px">
                <table class="table  header-border table-hover  " id="myTable">
                    <thead>
                        <tr style="color: black">
               <!--              <th scope="col">#</th> -->
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha Lìmite</th>
                            <th scope="col">Creado Por</th>
                            <th scope="col">Responsables</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Observadores</th>
                            <th scope="col" rowspan="2">Tipo</th>
                        </tr>
                    </thead>
                    <tbody id="TablaTareas">
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div>
    </div>
</div>



@include('GestionTareas.ModalCrearTareas')
@include('GestionTareas.ModalTareasSeguimiento')
<link href="/css/MyStyle.css" rel="stylesheet">
<script type="text/javascript" src="{{asset('js/nav.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tareas.js')}}"></script>
 


<!--     <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> -->
    <!-- Color Picker Plugin JavaScript
    <script src="./js/plugins-init/form-pickers-init.js"></script> -->

@endsection


