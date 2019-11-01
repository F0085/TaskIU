<script type="text/javascript">


</script>
<div id="cargatareas"></div>
<div id="ModalTareasSeguimiento"  class=" estilo modal fade bd-example-modal-lg stylefuente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h3 id="TituloTareaSeguimiento" style="font-size: 20px" class="modal-title"> </h3>
                <button type="button" onclick="cerrarIntervalo()" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input hidden="true" id="idTar">
                <div id="EstadoObservacion"></div>
                <div class="row">
                   <div class="col-md-6">
                        <div class="row">
                                <div class="col-md-12" id="PanelObservacion" > <!-- id="divObservacionSeguimiento" -->
                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
                                    <textarea class="form-control input-default" id="ObservacionTareaSeguimiento"></textarea><br>
                                    <div id="btnRegistrarObservacion"><button onclick="RegistrarObservacion()" type="button" class="btn btn-success btn-sm">Registrar</button></div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="" style="color: black"><i class="fa fa-bookmark"></i>  <b>Lista de Observaciones</b></label>
                                <div id="cajacomentario" style="font-size: 12px; overflow:scroll; height:280px; width:100%;">  
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
                        <div class="row">
                                <div class="col-md-12" id="PanelEvidencias" >  <!-- id="divEvidenciaSeguimiento" -->
  
                                    <!-- label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                        <label class="custom-file-label">Escoger Archivo</label> 
                                    </div><br><br>
                                    <button type="button" class="btn btn-success btn-sm">Registrar</button> -->
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="" style="color: black"><i class="fa fa-bookmark"></i>  <b>Lista de Evidencias</b></label>
                                <div class="table-responsive" style="font-size: 12px; overflow:scroll; height:180px; width:100%;">
                                    <table class="table  header-border table-hover">
                                        <thead>
                                            <tr style="color: black">
                                                <th>Evidencia</th>
                                                <th>Usuario</th>
                                                <th>Fecha</th>   
                                                <th>Acción</th>                                      
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Hola</td>
                                                <td>hjk</td>
                                                <td>fds</td>
                                                <td>Ver</td>
                                            </tr>
                                            
                                        </tbody>

                                        </table>
                                 </div>
                            </div>
                        </div>
                       
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">

                   </div>
                   <div class="col-md-6">
                       <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" style="color: black"><b>Descripción:</b></label>
                                            <p style="color: black; font-size: 13px" id="descripcionTareaSeguimiento"></p>

                                        </div>
                                    </div>
                                     <hr style="height: 1px; margin-top: 0rem;margin-bottom: 0rem">
                                     <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <p style="color: black; font-size: 13px"><b>Fecha Inicio:</b></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p style="color: black; font-size: 13px" class="badge badge-info" id="FechaInicioTareaSeguimiento"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <p style="color: black; font-size: 13px"><b>Fecha Límite:</b></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p style="color: black; font-size: 13px" class="badge badge-warning" id="FechaLimiteTareaSeguimiento"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height: 1px; margin-top: 0rem;margin-bottom: 0rem">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" style="color: black"><b>Responsables </b></label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p id="ResponsablesTaskSeguimiento" style="color: black; font-size: 13px"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height: 1px; margin-top: 0rem;margin-bottom: 0rem">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" style="color: black"><b>Participantes  </b></label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p id="ParticipantesTaskSeguimiento" style="color: black; font-size: 13px"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style=" height: 1px; margin-top: 0rem;margin-bottom: 0rem">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" style="color: black"><b>Observadores </b></label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p id="ObservadoresTaskSeguimiento" style="color: black; font-size: 13px"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <br>
                                    <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" style="color: black"><i class="fa fa-bookmark"></i>  <b>SubTareas</b></label>
                                            <div class="table-responsive" style="font-size: 12px; overflow:scroll; height:180px; width:100%;">
                                                <table class="table  header-border table-hover sortable  " id="myTable">
                                                    <thead>
                                                        <tr style="color: black">
                                               <!--              <th scope="col">#</th> -->
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Nombre</th>
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Fecha Lìmite</th>
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Creado Por</th>
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Responsables</th>
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Participantes</th>
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Observadores</th>
                                                            <th style="cursor: pointer;" title="Ordenar"  scope="col" rowspan="2">Tipo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaTareaSeguimiento">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                       </div>
                   </div> 
                </div>

            </div>
            <div class="modal-footer" style="display: block">
                <div hidden="true" id="mensajePendiente"></div>
                <div class="row">
                    <div class="col-md-7" id="botoneSeguimiento">
                        <div class="row">
                            <div class="col-md-6">
                                <button onclick="TerminarTarea()" class="btn btn-success btn-block">Entregar Tarea</button>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Más
                                  </button>
                                  <div class="dropdown-menu">
                                    <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
                                    <div id="btneditar">
                                   </div>
                                  </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-5 centerDiv">
                        <button type="button" onclick="cerrarIntervalo()" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
<!--                         <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button> -->
                    </div>
                </div>


            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionTareas/ModalTareasSeguimiento.blade.php ENDPATH**/ ?>