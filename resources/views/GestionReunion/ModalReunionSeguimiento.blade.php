
<div id="cargatareas"></div>
<div id="ModalReunionSeguimiento" data-backdrop="static" data-keyboard="false"  class=" estilo modal fade bd-example-modal-lg stylefuente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h3 id="TituloReunionSeguimiento" style="font-size: 20px" class="modal-title"> </h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input hidden="true" id="idReun">
                <div id="EstadoReunion"></div>
                <div class="row">
                   <div class="col-md-6">
                   	 	<div class="row">
		                   <div class="col-md-12"  > <!-- id="divObservacionSeguimiento" -->
				                <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Orden del día:</b></label>  	
		                
				                   		<div class="row">
				                   			<div class="col-md-12" >
				                   				<textarea style="color: black" class="form-control input-default" readonly="" rows="7" id="OrdendelDia"></textarea>
				                   			</div>
				                        </div>

				            </div>  
				        </div>
                        <br>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 0rem">
                        <br>
                        <div class="row">
                                <div class="col-md-12" id="PanelObservacion" > <!-- id="divObservacionSeguimiento" -->
                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Comentario:</b></label>
                                    <textarea class="form-control input-default" id="ObservacionReunionSeguimiento"></textarea><br>
                                    <div id="btnRegistrarObservacionReunion"><button onclick="RegistrarObservacionReunion()" type="button" class="btn btn-success btn-sm"><i class="fa fa-save"></i>  Registrar</button></div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="" style="color: black"><i class="fa fa-bookmark"></i>  <b>Lista de Comentarios</b></label>
                                <div id="cajacomentarioReunion" style="font-size: 12px; overflow:scroll; height:400px; width:100%;">  
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">


 
                   </div>
                   <div class="col-md-6">
                       <div class="card">
                                <div class="card-body">
<!-- 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" style="color: black"><b>Descripción:</b></label>
                                            <p style="color: black; font-size: 13px" id="descripcionReunionSeguimiento"></p>

                                        </div>
                                    </div>
                                     <hr style="height: 1px; margin-top: 0rem;margin-bottom: 0rem">
                                     <br> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <p style="color: black; font-size: 13px"><b>Fecha:</b></p>
                                                </div>
                                                <div class="col-md-7">
                                                    <p style="color: black; font-size: 13px" class="badge badge-info" id="FechaReunionSeguimiento"></p>
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



                                                    <p id="ResponsablesReunionSeguimiento" style="color: black; font-size: 13px"></p>
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
					   								<div class="table-responsive" style="font-size: 12px; overflow:scroll; height:360px; width:100%;">
					                                    <table class="table  header-border table-hover">
					                                        <thead >
					                                            <tr style="color: black">
					                                                <th>Usuario</th>
					                                                <th align="center">Asistencia</th>                                      
					                                            </tr>
					                                        </thead>
					                                        <tbody id="ParticipantesReunionSeguimiento">
	
					                                            
					                                        </tbody>

					                                        </table>
					                                 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style=" height: 1px; margin-top: 0rem;margin-bottom: 0rem">
                                     <br>
           <!--                          <div class="row">
			                            <div class="col-md-4">
			                                <button onclick="TerminarTarea()" class="btn btn-success btn-block btn-sm"><i class="fa fa-save"></i>  Registrar Asistencia</button>
			                        </div> -->

                                </div>
                       </div>
                        <div class="row">
                                <div class="col-md-12" id="PanelConclusiones" > <!-- id="divObservacionSeguimiento" -->
                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Conclusión:</b></label>
                                    <textarea rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento"></textarea><br>

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
                                <button style="cursor: pointer" onclick="TerminarReunion()" class="btn btn-success btn-block">Terminar Reunión</button>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Más
                                  </button>

                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-5 centerDiv">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
<!--                         <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button> -->
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>