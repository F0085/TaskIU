<div id="Cambio_Contraseña_Modal" class="modal">
  <div class="modal-dialog" >
    <div class="modal-content">
	    <div class="modal-header">
			<h3 id="tituloTareaEditar" class="modal-title"><i class="fa fa-key"></i>    Cambiar Contraseña </h3>	        
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>

	    <div class="modal-body" style="color: black">
	    	<div id="mensajeModalClave"></div>
              <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <label><b>Contraseña Actual:</label>
                    <input id="passwordActaul" type="password" class="form-control input-default" placeholder="Contraseña Actual" name="passwordActaul" required>

                </div>
                <div class="col-md-2"></div>
              </div>        
              <div class="form-group row">
              	<div class="col-md-2"></div>
                <div class="col-md-8">
                    <label ><b>Nueva Contraseña:</label>
                    <input id="passwordCambio" type="password" class="form-control input-default" placeholder="Nueva Contraseña" name="passwordCambio" required>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="form-group row">
                	<div class="col-md-2"></div>
                	<div class="col-md-8 form-group ">
                		<label ><b>Confirmar Contraseña:</label>
                        <input  id="password-confirmCambio" type="password" class="form-control input-default" placeholder="Confirmar contraseña" name="password-confirmCambio" required>

                    </div>
                    <div class="col-md-2"></div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button onclick="ActualizarClave()" type="button" class="btn btn-info">Aceptar</button>
              </div>

      </div>
    </div>
  </div>
</div>