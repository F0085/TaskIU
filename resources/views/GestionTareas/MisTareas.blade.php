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
            TareasAdmin('Pendiente');
        });
    </script>
    <!--  -->
      @else
        <script type="text/javascript">
        $( document ).ready(function() {
             TareasTipo('T','Pendiente');
        });
       </script>
    



    @endif
    
@endif

    @if(session()->has('IdTtar_Reu'))

      @if(session('tipoRol')=='MisTareasResponsables')
    
      <script type="text/javascript">
         $( document ).ready(function() {
           $('#SelecTipoUserTareas').val('MisTareasResponsables');
            // $('#TablaTareas').html('');
            TareasPorUsuario('','MisTareasResponsables','{{$_SESSION['id']}}');
            ModalTareas('{{session('IdTtar_Reu')}}');

           });
      </script>
      @endif
      @if(session('tipoRol')=='MisTareasParticipantes')
      <script type="text/javascript">
         $( document ).ready(function() {
           $('#SelecTipoUserTareas').val('MisTareasParticipantes');
            // $('#TablaTareas').html('');
           TareasPorUsuario('','MisTareasParticipantes','{{$_SESSION['id']}}');
            ModalTareas('{{session('IdTtar_Reu')}}');


           });
      </script>
      @endif
      @if(session('tipoRol')=='MisTareasObservadores')
      <script type="text/javascript">
         $( document ).ready(function() {
           $('#SelecTipoUserTareas').val('MisTareasObservadores');
            // $('#TablaTareas').html('');
           TareasPorUsuario('','MisTareasObservadores','{{$_SESSION['id']}}');
            ModalTareas('{{session('IdTtar_Reu')}}');

           });
      </script>
      @endif
  @endif










<div id="cargar"></div>

<div class="row">

<!--                     <form method="POST" action="{{url('Documentos')}}" accept-charset="UTF-8" enctype="multipart/form-data" id="frm_subirImg" name="frm_subirImg">       
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group ">
                        <input  class="btn btn-secondary  text-secondary btn-block bg-light"  type="file" name="file"  lang="es">
                      </div>
                      <button type="submit">subir</button>            
                     </form> -->

    <div class="col-lg-12">
        <nav class="stroke">
            <div class="row">
                <div class="col-md-10 estilo">
                    <ul>
                      <li ><a class="activado" id="Pendiente"   href="javascript:void(0);" 
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasAdmin('Pendiente');"
                            @else
                                onClick="TareasTipo('T','Pendiente');"
                            @endif
                        @endif
                        >Pendientes</a></li>
    <!--                   <li ><a  id="Suspendidas"  href="javascript:void(0);" 
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasAdmin('Suspendida');"
                            @else
                                onClick="TareasTipo('T','Suspendida');"
                            @endif
                        @endif
                        >Suspendidas</a></li> -->
                      <li><a id="Terminada" href="javascript:void(0);"
                        @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasEstAdministrador('Terminada');"
                            @else
                            

                                onClick="TareasTipo('T','Terminada');"
                            @endif
                        @endif 
                        >Terminadas</a></li>
                        <li><a id="Vencida" href="javascript:void(0);"
                         @if(isset($_SESSION['Id_tipo_Usuarios']))
                            @if($_SESSION['Id_tipo_Usuarios']=='2')
                                onClick="TareasEstAdministrador('Vencida');"
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
                       <h1 class="card-title" style="padding-top: 20px"><b>LISTA DE TAREAS</b></h1>
                </div>
                <div class="col-md-6" id="PanelAdminRol">
                @if(isset($_SESSION['Id_tipo_Usuarios']))

                 <select id="SelecTipoUserTareas" onchange="TareasPorUsuario('',this.value,'{{$_SESSION['id']}}')" class="form-control input-default">
                  @if(session()->has('TipoUsuario'))
                    @if(session('TipoUsuario')=='CPM')
                      <option selected="true" value="CPM">Creadas por mi</option>
                      <option value="MisTareasResponsables">Responsable</option>
                      <option value="MisTareasParticipantes">Participante</option>
                      <option value="MisTareasObservadores">Observador</option>
                    @elseif(session('TipoUsuario')=='MisTareasResponsables')
                      <option value="CPM">Creadas por mi</option>
                      <option selected="true" value="MisTareasResponsables">Responsable</option>
                      <option value="MisTareasParticipantes">Participante</option>
                      <option value="MisTareasObservadores">Observador</option>
                    @elseif(session('TipoUsuario')=='MisTareasParticipantes')
                      <option value="CPM">Creadas por mi</option>
                      <option value="MisTareasResponsables">Responsable</option>
                      <option selected="true" value="MisTareasParticipantes">Participante</option>
                      <option value="MisTareasObservadores">Observador</option>
                    @elseif(session('TipoUsuario')=='MisTareasObservadores')
                      <option value="CPM">Creadas por mi</option>
                      <option value="MisTareasResponsables">Responsable</option>
                      <option value="MisTareasParticipantes">Participante</option>
                      <option selected="true" value="MisTareasObservadores">Observador</option>
                    @endif
                  @else
                      <option value="CPM">Creadas por mi</option>
                      <option value="MisTareasResponsables">Responsable</option>
                      <option value="MisTareasParticipantes">Participante</option>
                      <option value="MisTareasObservadores">Observador</option>
                  @endif
                 </select>
                 @endif
                </div>
                <div class="col-md-2" id="PanelAdminTipoT">
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
                    <button style="cursor:pointer" onclick="ModalCrearTareas()" class="botonF1">
                      <span>+</span>
                    </button>
                </div>
            <div class="table-responsive" style="font-size: 12px; overflow:scroll; height:500px; width:100%">
                <table class="table  header-border table-hover sortable">
                    <thead id="cabeceraTareas">
                        <tr style="color: black">
        
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Nombre</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Fecha Límite</th>
                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Creado Por</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Responsables</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Participantes</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Observadores</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col" rowspan="2">Tipo</th>
                        
                        </tr>
                    </thead>
                    <tbody id="TablaTareas">
                    </tbody>
                </table>

<!--                 <nav aria-label="Page navigation example">
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
                </nav> -->
            </div>
        </div>
    </div>
</div>



@include('GestionTareas.ModalCrearTareas')
@include('GestionTareas.ModalTareasSeguimiento')

 <div class="modal fade" id="id_modal_conf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-question-circle"></span>  Confirmación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro de terminar la tarea, una vez terminada no podrá editarla?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="TerminarTarea()" >Si</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<link href="/css/MyStyle.css" rel="stylesheet">
<script type="text/javascript" src="{{asset('js/nav.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tareas.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/sorttable.js')}}"></script>


<!--     <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> -->
    <!-- Color Picker Plugin JavaScript
    <script src="./js/plugins-init/form-pickers-init.js"></script> -->

@endsection


