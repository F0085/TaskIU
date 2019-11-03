<div id="ModalCrearReunion" data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-plus-square"></i> Nueva Reunión</h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body estilo">
                <div id="mensajefechas"></div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Tema</b></label>
                        <input    class="form-control input-default" id="temaReunion"  placeholder="Tema de la reunión"></input>
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Lugar</b></label>
                        <input      class="form-control input-default" id="lugarReunion"  placeholder="Lugar de la reunión"></input>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label for="" style="color: black"><b>Orden del día</b></label>
                        <textarea   class="form-control input-default" id="ordendeldiaReunion" rows="3" placeholder="Descripción de la reunión"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Fecha</b></label>
                        <input  value="<?php echo date("Y-m-d");?>"     type="date" class="form-control input-default" id="FechaReunion"> 
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Hora</b></label>
                        <input value="<?php echo date('h:i');?>"   type="time" class="form-control input-default" id="HoraReunion"> 
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4" id="nose">
                       <label for="" style="color: black"><b>Responsables</b></label>
                       <br>
                        <select onchange="ResponsablesReunion()" id="ResponsablesReunion" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Responsables</b> '
                                multiple="multiple">
                                @if(isset($Usuarios))
                                @foreach($Usuarios as $v)
                                 <option value="{{$v['Id_Usuario']}}" >{{$v['Nombre']}} {{$v['Apellido']}}</option>
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
                       <select onchange="ParticipantesReunion()" id="ParticipantesReunion" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Participantes</b> '
                                multiple="multiple">
                                @if(isset($Usuarios))
                                @foreach($Usuarios as $v)
                                 <option value="{{$v['Id_Usuario']}} ">{{$v['Nombre']}} {{$v['Apellido']}}</option>
                                @endforeach
                                @endif
                        </select>
                       <br>
                       <ul class="list-group scroll"  id="listaParticipantes"></ul>
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