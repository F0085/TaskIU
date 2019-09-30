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
                      <li ><a  id="Proceso" data-value='Proceso' href="javascript:void(0);" 
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasGenerales('Proceso');"
                            @else
                                onClick="TareasTipo('T','Proceso');"
                            @endif
                        @endif
                        >Proceso</a></li>
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
                        >Venncidas</a></li>
                        <!--  <select id="SelectTipoTarPerTra" onchange="TareasTipo(this.value,'filtro')" class=" input-default">
                            <option value="T">Creadas por mi</option>
                            <option value="T">Responsable</option>
                            <option value="T">Participante</option>
                            <option value="T">Observador</option>
                         </select> -->

                    </ul>
                </div>
                <div class="col-md-2 centerDiv" >
                   <button style="background-color: #312d79; color: white"   data-toggle="modal" data-target=".bd-example-modal-lg" type="button" class="btn" > <i class="fa fa-plus-square"></i>  Nueva tarea</button>
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
                    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="botonF1">
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
                            <th scope="col" rowspan="2">Progreso</th>
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



<div  class="modal fade bd-example-modal-lg" id="ModalCrearTareas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 id="TituloTareaCrear" class="modal-title"><i class='fa fa-bookmark'></i> Nueva Tarea</h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="TaskID" hidden="true">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="" style="color: black"><b>Tarea</b></label>
                            <input onkeyup="borderInput('Nombretarea')" type="text" class="form-control input-default"  placeholder="Ingrese nombre de la tarea" id="Nombretarea" name="Nombretarea" required>
                        </div>                    
                    </div>
                    <div class="col-md-3">
                            <label for="" style="color: black"><b>Tipo</b></label>
                            <select onchange="borderInput('tipoTarea')" class="form-control input-default" name="tipoTarea" id="tipoTarea">
                                <option value="5">Laboral</option>
                                <option value="2">Proyecto</option>
                                <option value="3">Reunión</option>
                            </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" style="color: black"><b>Descripción</b></label>
                        <textarea onkeyup="borderInput('descripcionTarea')" class="form-control input-default" id="descripcionTarea" rows="3" placeholder="Descripción de la tarea a realizar"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Fecha Inicio</b></label>
                        <input  value="<?php echo date("Y-m-d");?>"  onkeyup="borderInput('FechaInicioTarea')"  type="date" class="form-control input-default" id="FechaInicioTarea"> 
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Hora Inicio</b></label>
                        <input value="<?php echo date('h:i');?>" onkeyup="borderInput('HoraInicioTarea')"  type="time" class="form-control input-default" id="HoraInicioTarea"> 
                    </div>
                </div>

                          
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Fecha Límite</b></label>
                        <input value="<?php echo date("Y-m-d");?>" onkeyup="borderInput('FechaLimiteTarea')"   type="date" class="form-control input-default" id="FechaLimiteTarea"> 
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Hora Límite</b></label>
                        <input value="<?php echo date('h:i');?>" onkeyup="borderInput('HoraLimiteTarea')"  type="time" class="form-control input-default" id="HoraLimiteTarea"> 
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                       <label for="" style="color: black"><b>Responsables</b></label>
                       <br>
                        <select onchange="ResponsableTask()" id="ResponsablesTask" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Responsables</b> '
                                multiple="multiple">
                                @if(isset($Usuarios))
                                @foreach($Usuarios as $v)
                                 <option value="{{$v['Id_Usuario']}}" >{{$v['Nombre']}}</option>
                                @endforeach
                                @endif
                        </select>
                       <br>
                       <ul id="listaResponsable" class="list-group scroll">
                        </ul>
                    </div>
                    <div class="col-md-4">
                       <label for="" style="color: black"><b>Participantes</b></label>
                       <br>
                       <select onchange="ParticipantesTask()" id="ParticipantesTask" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Participantes</b> '
                                multiple="multiple">
                                @if(isset($Usuarios))
                                @foreach($Usuarios as $v)
                                 <option value="{{$v['Id_Usuario']}}">{{$v['Nombre']}}</option>
                                @endforeach
                                @endif
                        </select>
                       <br>
                       <ul class="list-group scroll"  id="listaParticipantes"></ul>
                    </div>
                    <div class="col-md-4">
                       <label for="" style="color: black"><b>Observadores</b></label>
                       <br>
                       <select onchange="observadoresTask()" id="ObservadoresTask" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Observadores</b> '
                                multiple="multiple">
                                @if(isset($Usuarios))
                                @foreach($Usuarios as $v)
                                 <option value="{{$v['Id_Usuario']}}">{{$v['Nombre']}}</option>
                                @endforeach
                                @endif
                        </select>
                       <br>
                       <ul class="list-group scroll" id="listaObservadores"></ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button>
            </div>
        </div>
    </div>
</div>
@include('GestionTareas.ModalTareasEditar')
    <link href="{{asset('css/Mystyle.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/nav.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tareas.js')}}"></script>
 


<!--     <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> -->
    <!-- Color Picker Plugin JavaScript
    <script src="./js/plugins-init/form-pickers-init.js"></script> -->

@endsection


