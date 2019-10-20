<?php
  session_start(); 
    
?>
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


<div id="cargar"></div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-plus-square"></i> Nueva Reunión</h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Tema</b></label>
                        <input  onkeyup="borderInput('temaReunion')"    class="form-control input-default" id="temaReunion"  placeholder="Tema de la reunión"></input>
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Lugar</b></label>
                        <input  onkeyup="borderInput('lugarReunion')"    class="form-control input-default" id="lugarReunion"  placeholder="Lugar de la reunión"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label for="" style="color: black"><b>Orden del día</b></label>
                        <textarea  onkeyup="borderInput('descripcionReunion')"    class="form-control input-default" id="descripcionReunion" rows="3" placeholder="Descripción de la reunión"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Fecha</b></label>
                        <input  value="<?php echo date("Y-m-d");?>" onkeyup="borderInput('FechaReunion')"    type="date" class="form-control input-default" id="FechaReunion"> 
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Hora</b></label>
                        <input value="<?php echo date('h:i');?>" onkeyup="borderInput('HoraReunion')"  type="time" class="form-control input-default" id="HoraReunion"> 
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
                <button type="button" onclick="GuardarReunion()" class="btn btn-primary">Aceptar </button>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <nav class="stroke">
            <div class="row">
                <div class="col-md-10">
                    <ul>
                      <li ><a class="activado" id="Pendiente" href="javascript:void(0);"  onClick="TareasGenerales('Pendiente');" >Pendientes</a></li>
                      <li><a id="Terminada" href="javascript:void(0);" onClick="TareasGenerales('Terminada');">Terminadas</a></li>
                    </ul>
                </div>
                <div class="col-md-2 centerDiv" >
                   <button style="background-color: #312d79; color: white"   data-toggle="modal" data-target=".bd-example-modal-lg" type="button" class="btn" > <i class="fa fa-plus-square"></i>  Nueva Reunión</button>
                </div>
            </div>
        </nav>   
    </div>
</div>
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <ul>
            <div id="EstaTar" hidden="true"></div>
            <div class="row">
                <div class="col-md-6">
                       <h1 class="card-title" style="padding-top: 20px">LISTA DE REUNIONES</h1>
                </div>
                <div class="col-md-6">
                     @if(isset($_SESSION['Id_tipo_Usuarios']))

                 <select id="SelecTipoUserTareas" onchange="TareasPorUsuario('',this.value,'{{$_SESSION['id']}}')" class="form-control input-default">
                    <option value="CPM">Creadas por mi</option>
                    <option value="MisTareasParticipantes">Responsable</option>
                    <option value="MisTareasParticipantes">Participante</option> 
                    <option value="MisTareasParticipantes">Observador</option> 
                 </select>
                 @endif
                </div>
            </div>
               <hr style=" background-color: red; height: 1px">

                <div class="contenedor">
                    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="botonF1">
                      <span>+</span>
                    </button>
                </div>
            <div class="table-responsive">
                <table class="table  header-border table-hover  " id="myTable">
                    <thead>
                        <tr style="color: black">
               <!--              <th scope="col">#</th> -->
                            <th scope="col">Tema</th>
                            <th scope="col">Orden del día</th>
                            <th scope="col">Lugar</th>
                            <th scope="col">Creado Por</th>
                            <th scope="col">Responsables</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Observadores</th>
                            <th scope="col" rowspan="2">Estado</th>
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


    <link href="{{asset('css/Mystyle.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/nav.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tareas.js')}}"></script>
 


<!--     <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> -->
    <!-- Color Picker Plugin JavaScript
    <script src="./js/plugins-init/form-pickers-init.js"></script> -->

@endsection

