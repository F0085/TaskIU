<div id="cargatareas"></div>
<div id="ModalTareasEditar"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 id="TituloTareaEditar" class="modal-title"> </h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                   <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" style="color: black"><b>Descripción:</b></label>
                                <p style="color: black; font-size: 13px" id="descripcionTareaEditar"></p>

                            </div>
                        </div>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
                                <textarea class="form-control input-default" id="ObservacionTareaSeguimiento"></textarea>
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input">
                                    <label class="custom-file-label">Escoger Archivo</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" style="color: black"><i class="fa fa-bookmark"></i>  <b>SubTareas</b></label>
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
                                        <tbody id="tablaTareaEditar">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">

                   </div>
                   <div class="col-md-5">
                       <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <p style="color: black; font-size: 13px"><b>Fecha Inicio:</b></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p style="color: black; font-size: 13px" class="badge badge-info" id="FechaInicioTareaEditar"></p>
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
                                                    <p style="color: black; font-size: 13px" class="badge badge-warning" id="FechaLimiteTareaEditar"></p>
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
                                                    <p id="ResponsablesTaskEditar" style="color: black; font-size: 13px"></p>
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
                                                    <p id="ParticipantesTaskEditar" style="color: black; font-size: 13px"></p>
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
                                                    <p id="ObservadoresTaskEditar" style="color: black; font-size: 13px"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                       </div>
                   </div> 
                </div>

            </div>
            <div class="modal-footer" style="display: block">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-success">Iniciar Tarea</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-dark">Terminar Tarea</button>
                            </div>
                            <div class="col-md-4">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mas
                                  </button>
                                  <div class="dropdown-menu">
                                    <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-star-o"></i>  Agregar a favorito</a>
                                    <a class="dropdown-item" href="javascript:void(0);" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-pencil-square-o"></i>  Editar Tarea</a>
<!--                                     <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a> -->
                                  </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-5">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
<!--                         <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button> -->
                    </div>
                </div>


            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionTareas/ModalTareasEditar.blade.php ENDPATH**/ ?>