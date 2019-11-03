

function TareasAdmin(estado){
	$('#PanelAdminRol').html('');
	$('#PanelAdminTipoT').html('');
	
	$('#TablaTareas').html('');
		if(estado=='Pendiente'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').addClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }else if(estado=='Terminada'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').addClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }
	    else if(estado=='Vencida'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').addClass('activado');
	    }
	 $.get('TareasAdministrador/'+estado, function (data) {
	    	  llenarbucle(data,'0','collapse show','TablaTareas','');			 
		      $('#cargar').fadeIn(1000).html(data); 
		})
}


function TareasEstAdministrador(estado){
	$('#PanelAdminRol').html('');
	$('#PanelAdminTipoT').html('');
	 if(estado=='Proceso'){
	    	$('#Proceso').addClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }else if(estado=='Pendiente'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').addClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }else if(estado=='Terminada'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').addClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }
	    else if(estado=='Vencida'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').addClass('activado');
	    }
		$('#TablaTareas').html('');
	    $.get('TareasEstadoAdministrador/'+estado, function (data) {
					$.each(data, function(i2, $valores) { 
				    	$('#TablaTareas').append(`<tr  id="accordion${$valores['Id_tarea']}"  tr_tareas">
			                                    <td title="Abrir Tarea" > <i   class=" fa fa-sticky-note "></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
			                                     <td><b>${$valores['FechaFin']}</td>
			                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
			                                    <td id='${$valores['Id_tarea']+'25'}'>   
			                                    </td>
			                                    <td id='${$valores['Id_tarea']+'50'}'></td>
			                                    <td id='${$valores['Id_tarea']+'75'}'></td>
												<td >${$valores['tipo_tareas']['0']['Descripcion']}</td>
			                                  
			                                </tr>`);
					    $.each($valores['responsables'], function(i, $vREs) { 
					      $('#'+$valores['Id_tarea']+'25').append(`<i class="fa fa-user"></i>  ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']} <br><br>`);
					    });
					    $.each($valores['participantes'], function(i, $vPAR) { 
					      $('#'+$valores['Id_tarea']+'50').append(`<i class="fa fa-user"></i>  ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']} <br><br>`);
					    });
					    $.each($valores['observadores'], function(i, $vOBSE) { 
					      $('#'+$valores['Id_tarea']+'75').append(`<i class="fa fa-user"></i>  ${$vOBSE['usuario']['Nombre']} ${$vOBSE['usuario']['Apellido']} <br><br>`);
					    });		
				 	});
				}); 
		      	$('#cargar').fadeIn(1000).html(''); 
}

//PARA GUARDA LA TAREA
//###################################################################################
//########## GESTION TAREAS ###########################################
//###################################################################################


function GuardarTarea(){
	var Vtarea= validadorCampos('Nombretarea'); 
	var Vdescripcion= validadorCampos('descripcionTarea');
	var Vtipo= validadorCampos('tipoTarea'); 
	if(Vtarea==1 && Vdescripcion==1 && Vtipo==1 ){ // && Vfinicio==1  && Vhinicio==1  && Vffin==1 && Vhfin==1 && Vresponsables==1 && Vparticipantes==1 && Vobsevadores==1 ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);
	    var FrmData = { 
	    	Nombre: $("#Nombretarea").val(),
	    	descripcion: $("#descripcionTarea").val(),
	    	tipoTarea: $("#tipoTarea").val(),
	    	FechaIn: $("#FechaInicioTarea").val(),
	    	HoraIn: $("#HoraInicioTarea").val(),
	    	FechaFin: $("#FechaLimiteTarea").val(),
	    	HoraFin: $("#HoraLimiteTarea").val(),
	    	ResponsablesTask: $("#ResponsablesTask").val(),
	    	ParticipantesTask: $("#ParticipantesTask").val(),
	    	ObservadoresTask: $("#ObservadoresTask").val(),
	    	tareasIdTareas: $("#TaskID").val(),

	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'validarFechas', 
	        method: "POST", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
	        	
	        if(data['FIN']=='1' && data['FFIN']=='1' ){
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'Tareas', 
		        method: "POST", 
		        data: FrmData,
		        dataType: 'json',
		        success: function (data) 
		        {
		        	var htl=`<i class="fa fa-trash"></i>`;
		        	$('#cargar').fadeIn(1000).html(''); 
		        	window.location = "/Tareas";
		        },
		        error: function () { 
		            alertify.error(" Ocurrió un error, contactese con el Administrador.")
		        }
		    });
	        	}else{
	        		$('#cargar').fadeIn(1000).html('');
	        		$('#mensajefechas').html('');
					$('#mensajefechas').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> Verifique que las fechas y horas esten ingresadas correctamente (Fecha Inicio y Hora Inicio no pueden ser menor a la actual, Fecha Límite y Hora Límite no pueden ser menor a las de inicio).
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div`);
					$('#mensajefechas').hide();
			        $('#mensajefechas').prop('hidden',false);
			        $('#mensajefechas').show(500);
	        	}

	        	// $('#btnResponderObservacion').html(`<button type="button" onclick="RespuestaObservacion(${Id_Observacion})" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button>`); 
	      		 // $('#'+Id_Observacion+'c').html('');
	      		 // listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	    
	}
}

//ACTUALIZAR TAREAS
function ActualizarTarea(){
	var Vtarea= validadorCampos('Nombretarea'); 
	var Vdescripcion= validadorCampos('descripcionTarea');
	var Vtipo= validadorCampos('tipoTarea'); 
	if(Vtarea==1 && Vdescripcion==1 && Vtipo==1 ){ // && Vfinicio==1  && Vhinicio==1  && Vffin==1 && Vhfin==1 && Vresponsables==1 && Vparticipantes==1 && Vobsevadores==1 ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

	    var FrmData = { 
	    	Nombre: $("#Nombretarea").val(),
	    	descripcion: $("#descripcionTarea").val(),
	    	tipoTarea: $("#tipoTarea").val(),
	    	FechaIn: $("#FechaInicioTarea").val(),
	    	HoraIn: $("#HoraInicioTarea").val(),
	    	FechaFin: $("#FechaLimiteTarea").val(),
	    	HoraFin: $("#HoraLimiteTarea").val(),
	    	ResponsablesTask: $("#ResponsablesTask").val(),
	    	ParticipantesTask: $("#ParticipantesTask").val(),
	    	ObservadoresTask: $("#ObservadoresTask").val(),
	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Tareas'+'/'+$('#TaskID').val(), 
	        method: "PUT", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
	        	var htl=`<i class="fa fa-trash"></i>`;
	        	$('#cargar').fadeIn(1000).html(data); 
	        	window.location = "/Tareas";
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	}
}

//MOSTRAR MDODAL CREAR SUBTAREAS
function CrearSubtarea(Id_tarea,Nombretarea,tipoTarea){
	limpiarModalTareasCrear();
	$("#TaskID").val(Id_tarea);
	$("#tipoTarea").val(tipoTarea);		
	$("#tipoTarea").prop('disabled',true);	
	$("#TituloTareaCrear").html("<i class='fa fa-bookmark'></i>  "+ 'Nueva Subtarea de '+Nombretarea);
	$("#ModalTareasSeguimiento").modal("hide");
	$("#ModalCrearTareas").modal("show");
}

function TerminarTarea(){
	// var Vtarea= validadorCampos('Nombretarea'); 
	// var Vdescripcion= validadorCampos('descripcionTarea');
	// var Vtipo= validadorCampos('tipoTarea'); 
	// if(Vtarea==1 && Vdescripcion==1 && Vtipo==1 ){ // && Vfinicio==1  && Vhinicio==1  && Vffin==1 && Vhfin==1 && Vresponsables==1 && Vparticipantes==1 && Vobsevadores==1 ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);
	    var FrmData = { 
	    	// Nombre: $("#Nombretarea").val(),
	    	// descripcion: $("#descripcionTarea").val(),
	    	// tipoTarea: $("#tipoTarea").val(),
	    	// FechaIn: $("#FechaInicioTarea").val(),
	    	// HoraIn: $("#HoraInicioTarea").val(),
	    	// FechaFin: $("#FechaLimiteTarea").val(),
	    	// HoraFin: $("#HoraLimiteTarea").val(),
	    	// ResponsablesTask: $("#ResponsablesTask").val(),
	    	// ParticipantesTask: $("#ParticipantesTask").val(),
	    	// ObservadoresTask: $("#ObservadoresTask").val(),
	    	idtarea: $("#idTar").val(),
	    	Observacion: $("#ObservacionTareaSeguimiento").val(),
	    	filedoc:$("#ObservacionTareaSeguimiento").val(),
	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'GuardarSeguimientoTarea', 
	        method: "POST", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
	        	if(data==1){
	        		$('#mensajePendiente').html('');
					$('#mensajePendiente').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> Esta tarea tiene subtareas pendientes.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div`);
					$('#mensajePendiente').hide();
			        $('#mensajePendiente').prop('hidden',false);
			        $('#mensajePendiente').show(500);
	        	}else{
	        		window.location = "/Tareas";
	        	}	        	
	        	// var htl=`<i class="fa fa-trash"></i>`;
	        	$('#cargar').fadeIn(1000).html(data); 
	        	 
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	            	$('#cargar').fadeIn(1000).html(''); 
	        }
	    });
	// }
}

//PARA VALIDAR LOS INPUST QUE NO SEAN VACIOS
function validadorCampos(val){
	var resul=0;
	if($('#'+val).val() == '' || $('#'+val).val() == '0'|| $('#'+val).val() == 'mm/dd/aaaa'){
		$('#'+val).addClass('invalid');
	}else{
		$('#'+val).addClass('valid');
		resul=1;
	}
	return resul;
}

//VALIDAR LOS BORDES DE LOS INPUT DE POR LLENAR Y LLENADO
function borderInput(val){ 
	if($('#'+val).val() == '' || $('#'+val).val() == '0' ){	
		if($('#'+val).hasClass('valid')){
		 $('#'+val).removeClass('valid');
		}
		$('#'+val).addClass('invalid');
	}else{
		if($('#'+val).hasClass('valid')){
		 $('#'+val).removeClass('valid');
		}else if($('#'+val).hasClass('invalid')){
		 $('#'+val).removeClass('invalid');
		}
	}
}

//ELIMINAR LA CLASE DE LOS INPUTS
function eliminarclaseInput(val){
	if($('#'+val).hasClass('valid')){
	 $('#'+val).removeClass('valid');
	}else if($('#'+val).hasClass('invalid')){
	 $('#'+val).removeClass('invalid');
	}
}

//LIMPIAR LOS CAMPOS DEL FORMULARIO DE REGISTRO DE  TAREAS
function limpiarCampos(){
	$('#Nombretarea').val('');
	$("#descripcionTarea").val('');
	$("#tipoTarea").val('0');
	$("#FechaInicioTarea").val('');
	$("#HoraInicioTarea").val('');
	$("#FechaLimiteTarea").val('');
	$("#HoraLimiteTarea").html('');
	$("#ResponsablesTask").val('');
	$("#ParticipantesTask").val('');
	$('#ObservadoresTask').val('');
	eliminarclaseInput('Nombretarea');
	eliminarclaseInput('descripcionTarea');
	eliminarclaseInput('tipoTarea');
	eliminarclaseInput('FechaInicioTarea');
	eliminarclaseInput('HoraInicioTarea');
	eliminarclaseInput('FechaLimiteTarea');
	eliminarclaseInput('HoraLimiteTarea');
	eliminarclaseInput('ResponsablesTask');
	eliminarclaseInput('ParticipantesTask');
	eliminarclaseInput('ObservadoresTask');
}

//SELECT MULTIPLE DE RESPONSABLES
function ResponsableTask(){
    $('#listaResponsable').html('');
    //TRAE SOLO EL TEXTO DE UN SELECT MULTIPLE
	var selectTextResponsables = $("#ResponsablesTask option:selected").map(function () {
                    return $(this).text();
    });
	//RECORRE EL SELECT MULTIPLE
   $.each(selectTextResponsables, function(i, item) { 
      $('#listaResponsable').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item}
                            </li>`);
    });   
}

//SELECT MULTIPLE DE PARTICIPANTES
function ParticipantesTask(){
    $('#listaParticipantes').html('');
      //TRAE SOLO EL TEXTO DE UN SELECT MULTIPLE
	var selectTextParticpantes = $("#ParticipantesTask option:selected").map(function () {
                    return $(this).text();
    });
   $.each(selectTextParticpantes, function(i, item) { 
      $('#listaParticipantes').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item }
                            </li>`);
    });   
}

//SELECT MULTIPLE DE OBSERVADORES
function observadoresTask(){
  	$('#listaObservadores').html('');
    //TRAE SOLO EL TEXTO DE UN SELECT MULTIPLE
	var selectTextObservadores= $("#ObservadoresTask option:selected").map(function () {
    return $(this).text();
    });
   $.each(selectTextObservadores, function(i, item) { 
      $('#listaObservadores').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item }
                            </li>`);
    });   
}

//###################################################################################
//########## FIN GESTION TAREAS ###########################################
//###################################################################################




//###################################################################################
//########## OBETENER DATOS POR PARAMETROS###########################################
//###################################################################################

	//TODAS LAS TAREAS PARA EL ADMINISTRADOR O LA PERSONA QUE LAS CREA
	function TareasGenerales(estado){

		$('#SelectTipoTarPerTra').val('T');
		$('#SelecTipoUserTareas').val('CPM');
		$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>

		    </div>
		</div>`);
	    if(estado=='Proceso'){
	    	$('#Proceso').addClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }else if(estado=='Pendiente'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').addClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }else if(estado=='Terminada'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').addClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }
	    else if(estado=='Vencida'){
	    	$('#Proceso').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').addClass('activado');
	    }
	  
		$('#TablaTareas').html('');
	    $.get('TareasEstado/'+estado, function (data) {
	    	  llenarbucle(data,'0','collapse show','TablaTareas','');			 
		      	$('#cargar').fadeIn(1000).html(data); 
		});
	}

	function TareasCPM(estado){
			$('#TablaTareas').html('');
			    $.get('tareasCPM/'+estado, function (data) {
							$.each(data, function(i2, $valores) { 
						    	$('#TablaTareas').append(`<tr  id="accordion${$valores['Id_tarea']}"  tr_tareas">
					                                    <td title="Abrir Tarea" > <i   class=" fa fa-sticky-note "></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
					                                     <td><b>${$valores['FechaFin']}</td>
	                                    				 <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>   
					                                    <td id='${$valores['Id_tarea']+'25'}'>   
					                                    </td>
					                                    <td id='${$valores['Id_tarea']+'50'}'></td>
					                                    <td id='${$valores['Id_tarea']+'75'}'></td>
					                                    <td >${$valores['tipo_tareas']['0']['Descripcion']}</td>
					                                </tr>`);
							    $.each($valores['responsables'], function(i, $vREs) { 
							      $('#'+$valores['Id_tarea']+'25').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vREs['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']}</a> <br><br>`);
							    });
							    $.each($valores['participantes'], function(i, $vPAR) { 
							      $('#'+$valores['Id_tarea']+'50').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vPAR['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']}</a> <br><br>`);
							    });
							    $.each($valores['observadores'], function(i, $vOBSE) { 
							      $('#'+$valores['Id_tarea']+'75').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vOBSE['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vOBSE['usuario']['Nombre']} ${$vOBSE['usuario']['Apellido']}</a> <br><br>`);
							    });			
						 	});
						}); 
				      	$('#cargar').fadeIn(1000).html(''); 
		   	
	}

	//EXTRAE TODAS LAS TAREAS POR USUARIO EL TIPO (RESPONSABLE OBSERVADOR PARTICPANTE) Y EL ESTADO( PENDIENTE,TERMINADA,VENCIDA)
	function TareasPorUsuario(estado,TipoUser,IdUsuario){
		    $('#btneditar').html('');
			$('#SelectTipoTarPerTra').prop('disabled',true);
			$('#SelectTipoTarPerTra').val("T");
			$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
			    <div class="loader"> 
			        <svg class="circular" viewBox="25 25 50 50">
			            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
			        </svg>

			    </div>
			</div>`);
			if($('#Proceso').hasClass('activado')){
				estado='Proceso';
			}else if($('#Pendiente').hasClass('activado')){
				estado='Pendiente';
			}else if($('#Terminada').hasClass('activado')){
				estado='Terminada';
			}else if($('#Vencida').hasClass('activado')){
				estado='Vencida';
			}
			if(TipoUser=="CPM"){
				TareasTipo('T',estado);
				$('#SelectTipoTarPerTra').prop('disabled',false);
				return;
			}
			// console.log(estado);
			$('#TablaTareas').html('');
			    $.get(TipoUser+'/'+IdUsuario+'/'+estado, function (data) {
					$.each(data, function(i2, $valore) { 
							$.each($valore, function(i2, $valores) { 
						    	$('#TablaTareas').append(`<tr  id="accordion${$valores['Id_tarea']}"  tr_tareas">
					                                    <td title="Abrir Tarea" > <i   class=" fa fa-sticky-note "></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
					                                     <td><b>${$valores['FechaFin']}</td>
	                                    				 <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>   
					                                    <td id='${$valores['Id_tarea']+'25'}'>   
					                                    </td>
					                                    <td id='${$valores['Id_tarea']+'50'}'></td>
					                                    <td id='${$valores['Id_tarea']+'75'}'></td>
					                                    <td >${$valores['tipo_tareas']['0']['Descripcion']}</td>
					                                </tr>`);
							    $.each($valores['responsables'], function(i, $vREs) { 
							      $('#'+$valores['Id_tarea']+'25').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vREs['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']}</a> <br><br>`);
							    });
							    $.each($valores['participantes'], function(i, $vPAR) { 
							      $('#'+$valores['Id_tarea']+'50').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vPAR['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']}</a> <br><br>`);
							    });
							    $.each($valores['observadores'], function(i, $vOBSE) { 
							      $('#'+$valores['Id_tarea']+'75').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vOBSE['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vOBSE['usuario']['Nombre']} ${$vOBSE['usuario']['Apellido']}</a> <br><br>`);
							    });		
						 	});
						}); 
				      	$('#cargar').fadeIn(1000).html(''); 
		   		 });
	}

	//CAMBIAR ICONO DEL BOTON CUANDO ES ARBOL
	function CambioIconoBoton(boton){
		if($(boton).hasClass('fa-plus')){
			$(boton).removeClass('fa-plus');
			$(boton).addClass('fa-minus');
		}else{
			$(boton).removeClass('fa-minus');
			$(boton).addClass('fa-plus');
		}
	}

	//PARA LLENAR LA TABLA DE LAS TAREAS
	function llenarbucle(data,sangria,col,idtabla,textoid){
		var signo;
		if($('#Proceso').hasClass('activado')){
				estado='Proceso';
			}else if($('#Pendiente').hasClass('activado')){
				estado='Pendiente';
			}else if($('#Terminada').hasClass('activado')){
				estado='Terminada';
			}else if($('#Vencida').hasClass('activado')){
				estado='Vencida';
			}
		// var progreso=100;
	    $.each(data, function(i1, $valores) { 
	    	//condicionar si es nulo subtareas     	
	    	if($valores['sub_tareas'].length!=0){

	    		signo='fa fa-plus';

	    	}else{
	    		signo='fa fa-sticky-note';

	    	}
		
	    	if($valores['Estado_Tarea'] == estado){
		    $('#'+idtabla).append(`<tr  id="accordion${$valores['tareasIdTareas']}${textoid}" class="${col} tr_tareas">
	                                    <td title="Abrir Tarea"> <i  data-toggle="collapse" data-target="#accordion${$valores['Id_tarea']}${textoid}" onclick="CambioIconoBoton(this)" class="clickable collapse-row collapsed ${signo} " style="text-indent: ${sangria+'cm'}" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
	                                     <td ><b>${$valores['FechaFin']}</td>
	                                    <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>
	                                    <td id='${$valores['Id_tarea']+'25'+textoid}'>   
	                                    </td>
	                                    <td id='${$valores['Id_tarea']+'50'+textoid}'></td>
	                                    <td id='${$valores['Id_tarea']+'75'+textoid}'></td>
	                                    <td >${$valores['tipo_tareas']['0']['Descripcion']}</td>
	                                </tr>`);

		    $.each($valores['responsables'], function(i, $vREs) { 
		      $('#'+$valores['Id_tarea']+'25'+textoid).append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vREs['usuario']['Id_Usuario']})"><i class="fa fa-user"></i>  ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']}</a> <br><br>`);
		    });
		    $.each($valores['participantes'], function(i, $vPAR) { 
		      $('#'+$valores['Id_tarea']+'50'+textoid).append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vPAR['usuario']['Id_Usuario']})"><i class="fa fa-user"></i>  ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']}</a> <br><br>`);
		    });
		    $.each($valores['observadores'], function(i, $vOBSE) { 
		      $('#'+$valores['Id_tarea']+'75'+textoid).append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vOBSE['usuario']['Id_Usuario']})"><i class="fa fa-user"></i>  ${$vOBSE['usuario']['Nombre']} ${$vOBSE['usuario']['Apellido']}</a> <br><br>`);
		    });
		    llenarbucle($valores['sub_tareas'],(parseFloat(sangria)+0.5),'collapse',idtabla,textoid);	
		    }	
		}); 
		progreso=0;
	    sangria=parseFloat(sangria)-0.5;
	}

	//PARA OBETENER LAS TAREAS POR EL TIPO (PERSONAL O LABORAL)
	function TareasTipo(tipo,estado){
		$('#SelecTipoUserTareas').val('CPM');
		$('#SelectTipoTarPerTra').val('T');
		$('#SelectTipoTarPerTra').prop('disabled',false);
		$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>
		    </div>
		</div>`);
		if(estado=='filtro' && ($('#Terminada').hasClass('activado') || $('#Vencida').hasClass('activado')) ){
			if($('#Proceso').hasClass('activado')){
				estado='Proceso';
			}else if($('#Pendiente').hasClass('activado')){
				estado='Pendiente';
			}else if($('#Terminada').hasClass('activado')){
				estado='Terminada';
			}else if($('#Vencida').hasClass('activado')){
				estado='Vencida';
			}

			if(tipo =='T'){
				TareasCPM(estado);
				return;
			}

		  $('#TablaTareas').html('');
		    $.get('TareasPorTipo/'+estado+'/'+tipo, function (data) {
		    	 $('#TablaTareas').html('');
			
							$.each(data, function(i2, $valores) { 
						    	$('#TablaTareas').append(`<tr  id="accordion${$valores['Id_tarea']}"  tr_tareas">
					                                    <td title="Abrir Tarea" > <i   class=" fa fa-sticky-note "></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
					                                     <td><b>${$valores['FechaFin']}</td>
					                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
					                                    <td id='${$valores['Id_tarea']+'25'}'>   
					                                    </td>
					                                    <td id='${$valores['Id_tarea']+'50'}'></td>
					                                    <td id='${$valores['Id_tarea']+'75'}'></td>
					                                    <td >${$valores['tipo_tareas']['0']['Descripcion']}</td>
					                                </tr>`);
							    $.each($valores['responsables'], function(i, $vREs) { 
							      $('#'+$valores['Id_tarea']+'25').append(`<i class="fa fa-user"></i>  ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']} <br><br>`);
							    });
							    $.each($valores['participantes'], function(i, $vPAR) { 
							      $('#'+$valores['Id_tarea']+'50').append(`<i class="fa fa-user"></i>  ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']} <br><br>`);
							    });
							    $.each($valores['observadores'], function(i, $vOBSE) { 
							      $('#'+$valores['Id_tarea']+'75').append(`<i class="fa fa-user"></i>  ${$vOBSE['usuario']['Nombre']} ${$vOBSE['usuario']['Apellido']} <br><br>`);
							    });		
						 	});
						 
				      	$('#cargar').fadeIn(1000).html(''); 
	   		});
	   		return;
		}

		if(estado=='filtro' && $('#Pendiente').hasClass('activado')){
			if(tipo=='T'){
				TareasGenerales('Pendiente');
				return;
			}
		}
		if(estado=='Pendiente'){
			
			TareasGenerales(estado);
			return;
			
		}
		if(tipo=='T' && (estado=='Terminada' || estado=='Vencida') ){
			 if(estado=='Proceso'){
		    	$('#Proceso').addClass('activado');
		    	$('#Pendiente').removeClass('activado');
		    	$('#Terminada').removeClass('activado');
		    	$('#Vencida').removeClass('activado');
		    }else if(estado=='Pendiente'){
		    	$('#Proceso').removeClass('activado');
		    	$('#Pendiente').addClass('activado');
		    	$('#Terminada').removeClass('activado');
		    	$('#Vencida').removeClass('activado');
		    }else if(estado=='Terminada'){
		    	$('#Proceso').removeClass('activado');
		    	$('#Pendiente').removeClass('activado');
		    	$('#Terminada').addClass('activado');
		    	$('#Vencida').removeClass('activado');
		    }
		    else if(estado=='Vencida'){
		    	$('#Proceso').removeClass('activado');
		    	$('#Pendiente').removeClass('activado');
		    	$('#Terminada').removeClass('activado');
		    	$('#Vencida').addClass('activado');
		    }
			TareasCPM(estado);
		}else{
					
			if($('#Proceso').hasClass('activado')){
				estado='Proceso';
			}else if($('#Pendiente').hasClass('activado')){
				estado='Pendiente';
			}else if($('#Terminada').hasClass('activado')){
				estado='Terminada';
			}else if($('#Vencida').hasClass('activado')){
				estado='Vencida';
			}

		  
		    $.get('TareasPorTipoPendiente/'+estado+'/'+tipo, function (data) {
		    	
		    	
			  $('#TablaTareas').html('');
							llenarbucle(data,'0','collapse show','TablaTareas','');	
				      	$('#cargar').fadeIn(1000).html(''); 
	   		});
		
		}
	}

//###################################################################################
//########## FIN OBETENER DATOS POR PARAMETROS###########################################
//###################################################################################

function EjecucionListaobservaciones(valor){
 if(valor == 1){
 	$("#ModalTareasSeguimiento").modal("show");
		$( document ).ready(function() {
		    //console.log("ejecutandore");
		    window.setInterval(listaObservaciones,5000);
		      
		});
	}else{

	}
}

//PARA CERRAR EL TIEMPO DE EJECUCION DE LA LISTA DE OBSERVACIONES
	function cerrarIntervalo(){
		window.clearInterval(intervalId);
	}

 	var intervalId; //PARA CONTROLAR EL TIMEPO DE EJECUCION DE LA LISTA DE OBSERVACIONES
	
	//PARA EL MODAL DEL SEGUIMIENTO DE LA TAREA
	
	function ModalTareas(Id_tarea){
		$('#cajacomentario').html('');
		$('#EstadoObservacion').html('');
		$('#listaEvidencias').html('');
		$('#mensajefechas').html('');
		
		limpiarModalTareas();
		$("#ModalTareasSeguimiento").modal("show");
		$( document ).ready(function() {
		    //console.log("ejecutandore");
	
		     intervalId=window.setInterval(listaObservaciones,5000);;
		      
		});

		$('#cargatareas').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>

		    </div>
		</div>`);

	    $.get('Tareas/'+Id_tarea, function (data) {
	    	$.each(data, function(i,item){
		    	$('#TituloTareaSeguimiento').html("<i class='fa fa-sticky-note'></i>  "+  item['Nombre']);
		    
		    	$('#idTar').val(item['Id_tarea']);
		    	$('#descripcionTareaSeguimiento').html(item['Descripcion']);
		    	$('#FechaInicioTareaSeguimiento').html(item['FechaInicio']+' '+item['Hora_Inicio']);
		    	$('#FechaLimiteTareaSeguimiento').html(item['FechaFin']+' '+item['Hora_Fin']);
		    	$.each(item['responsables'], function(i1,item1){
		    	   $('#ResponsablesTaskSeguimiento').append(`<i class="fa fa-user"></i>  ${item1['usuario']['Nombre']} ${item1['usuario']['Apellido']} <br>`);
		    	});
		    	$.each(item['participantes'], function(i2,item2){
		    	   $('#ParticipantesTaskSeguimiento').append(`<i class="fa fa-user"></i>  ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']} <br>`);
		    	});
		    	$.each(item['observadores'], function(i3,item3){
		    	   $('#ObservadoresTaskSeguimiento').append(`<i class="fa fa-user"></i>  ${item3['usuario']['Nombre']} ${item3['usuario']['Apellido']} <br>`);
		    	});
		    	llenarbucle(item['sub_tareas'],'0','collapse show','tablaTareaSeguimiento','Edit');	   	   
	    	

			   	if($('#SelecTipoUserTareas').val()=="CPM"){
					var btneditar=` <a  class="dropdown-item" href="javascript:void(0);" onclick="TareasEditar()"><i class="fa fa-pencil-square-o"></i>  Editar Tarea</a>`;
					$('#PanelObservacion').html('');
					$('#PanelEvidencias').html('');	
					$('#botoneSeguimiento').html('');
					$('#EstadoObservacion').html('');
					$('#botoneSeguimiento').append(`<div class="row">
		                            <div class="col-md-6">
		                                <div class="btn-group">
		                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                    Más
		                                  </button>
		                                  <div class="dropdown-menu">
		                                    <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
		                                    <div id="btneditar">
		                                    ${btneditar}
		                                   </div>
		                                  </div>
		                                </div>
		                            </div>
		                        </div> `);
					document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;
					if($('#Terminada').hasClass('activado') || $('#Vencida').hasClass('activado') ){
						$('#PanelObservacion').html('');
						$('#PanelEvidencias').html('');	
						$('#botoneSeguimiento').html('');
						$('#EstadoObservacion').html('');
					}
				}else if($('#SelecTipoUserTareas').val()=="MisTareasResponsables"){
					$('#EstadoObservacion').html('');
					$('#PanelObservacion').html('');
					$('#PanelObservacion').append(`
		                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
		                                    <textarea class="form-control input-default" id="ObservacionTareaSeguimiento"></textarea><br>
		                                    <div id="btnRegistrarObservacion"><button onclick="RegistrarObservacion()" type="button" class="btn btn-success btn-sm">Registrar</button></div>
		                                `);
					$('#PanelEvidencias').html('');
					$('#PanelEvidencias').append(`<label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
						<input type="text" class="form-control input-default" id="DescripcionEvidencia" placeholder="Descripción"><br>
						<input  type="file" class="form-control input-default" id="filedoc"><br>
				        <button onclick="RegistrarEvidencias()" type="button" class="btn btn-success btn-sm">Registrar</button>`);
					$('#botoneSeguimiento').html('');
					$('#botoneSeguimiento').append(`<div class="row">
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
		                        </div> `);
					document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;

					if($('#Terminada').hasClass('activado')){
						$('#PanelObservacion').html('');
						$('#PanelEvidencias').html('');	
						$('#botoneSeguimiento').html('');
					}
				}else if($('#SelecTipoUserTareas').val()=="MisTareasParticipantes"){
					$('#EstadoObservacion').html('');
					$('#PanelObservacion').html('');
					$('#PanelObservacion').append(`
		                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
		                                    <textarea class="form-control input-default" id="ObservacionTareaSeguimiento"></textarea><br>
		                                    <div id="btnRegistrarObservacion"><button onclick="RegistrarObservacion()" type="button" class="btn btn-success btn-sm">Registrar</button></div>
		                                `);
					$('#PanelEvidencias').html('');
					$('#PanelEvidencias').append(`<label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
						<input type="text" class="form-control input-default" id="DescripcionEvidencia" placeholder="Descripción"><br>
						<input  type="file" class="form-control input-default" id="filedoc"><br>
				        <button onclick="RegistrarEvidencias()" type="button" class="btn btn-success btn-sm">Registrar</button>`);
					$('#botoneSeguimiento').html('');
					$('#botoneSeguimiento').append(`<div class="row">
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
		                        </div> `);
					document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;

				}else if($('#SelecTipoUserTareas').val()=="MisTareasObservadores"){
					$('#PanelObservacion').html('');
					$('#PanelEvidencias').html('');
					$('#botoneSeguimiento').html('');
					$('#EstadoObservacion').html('');
					 $('#EstadoObservacion').append(`<div class="row"> 
					 	<div class="col-md-12 ">   
					      <div class="alert alert-info" role="alert">
					        <div class="row vertical-align centerDiv">
					          <div class="col-lg-1 text-center">
					            <i class="fa fa-info fa-2x"></i> 
					          </div>
					          <div class="col-lg-11 centerDiv">
					           <strong> Esta tarea se encuentra en estado&nbsp${item['Estado_Tarea']}.</strong>
					          </div>
					        </div>
					      </div>      
		   				</div>
		 				 </div> `)
					if($('#Terminada').hasClass('activado')){
						$('#PanelObservacion').html('');
						$('#PanelEvidencias').html('');	
						$('#botoneSeguimiento').html('');
						$('#EstadoObservacion').html('');
					}
				}else{
					var btneditar=` <a  class="dropdown-item" href="javascript:void(0);" onclick="TareasEditar()"><i class="fa fa-pencil-square-o"></i>  Editar Tarea</a>`;
					$('#botoneSeguimiento').html('');
					$('#botoneSeguimiento').append(`<div class="row">
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
		                                    ${btneditar}
		                                   </div>
		                                  </div>
		                                </div>
		                            </div>
		                        </div> `);
					document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;
						if($('#Terminada').hasClass('activado') || $('#Vencida').hasClass('activado')){
						$('#botoneSeguimiento').html('');
						// $('#botoneSeguimiento').append(`<div class="row">
		    //                         <div class="col-md-6">
		    //                             <div class="btn-group">
		    //                               <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    //                                 Más
		    //                               </button>
		    //                               <div class="dropdown-menu">
		     
		    //                                 <div id="btneditar">
		    //                                 ${btneditar}
		    //                                </div>
		    //                               </div>
		    //                             </div>
		    //                         </div>
		    //                     </div> `);
						$('#PanelObservacion').html('');
						$('#PanelEvidencias').html('');	
					
						$('#EstadoObservacion').html('');
					}
				}

				if(item['tipo_tareas']['0']['Descripcion']=="Personal" &&  $('#Pendiente').hasClass('activado')){

					$('#botoneSeguimiento').html('');
					$('#botoneSeguimiento').append(`<div class="row">
		                            <div class="col-md-6">
		                                <button onclick="TerminarTarea()" class="btn btn-success btn-block">Entregar Tarea</button>
		                            </div>`);
		         }

	   	    	listaObservaciones();
	   	    	ListaEvidencia();
	   	     	$('#cargatareas').fadeIn(1000).html(data); 
	   		});
		});

	}

	//LIMPIAR MODAL DE TAREAS SEGUIMIENTO
	function limpiarModalTareas(){
		$('#divEvidenciaSeguimiento').html('');
		$('#divObservacionSeguimiento').html('');
		$('#TituloTareaSeguimiento').html('');
		$('#descripcionTareaSeguimiento').html('');
		// $('#FechaInicioTareaSeguimiento').prop('value', '2019/08/10');
		// $('#HoraInicioTareaSeguimiento').html('');
		// $('#FechaLimiteTareaSeguimiento').html('');
		// $('#HoraLimiteTareaSeguimiento').html('');
		$('#ResponsablesTaskSeguimiento').html('');
		$('#ParticipantesTaskSeguimiento').html('');
		$('#ObservadoresTaskSeguimiento').html('');
		$('#tablaTareaSeguimiento').html('');

	}

	//LIMPIAR MODAL DE TAREAS CERAR NUEVA
	function limpiarModalTareasCrear(){
	$("#ResponsablesTask option:selected").attr("selected",false);
	$("#ParticipantesTask option:selected").attr("selected",false);
	$("#ObservadoresTask option:selected").attr("selected",false);
	$("#ResponsablesTask").val('');
	$("#ParticipantesTask").val('');
	$("#ObservadoresTask").val('');
		 $.get('HoraFechaSistema', function (data) {

			$('#FechaInicioTarea').val(data['Fecha']);
			$('#HoraInicioTarea').val(data['Hora']);
			$('#FechaLimiteTarea').val(data['Fecha']);
			$('#HoraLimiteTarea').val(data['Hora']);
		 });
		$('#Nombretarea').val('');
		$('#tipoTarea').val('5');
		$('#tipoTarea').prop('disabled',false);
		$('#descripcionTarea').val('');
		$('#listaResponsable').html('');
		$('#listaObservadores').html('');
		$('#listaParticipantes').html('');
		// $('#ResponsablesTask').attr('selected',false);
		// $('#ParticipantesTask').val('0');
		// $('#ObservadoresTask').val('0');
	}
	function TareasEditar(){
		limpiarModalTareasCrear();
		$("#ModalTareasSeguimiento").modal("hide");
		$("#ModalCrearTareas").modal("show");
		 $.get('Tareas/'+$('#idTar').val(), function (data) {
	    	$.each(data, function(i,item){
		    	$('#TituloTareaCrear').html("<i class='fa fa-bookmark'></i>  "+  'Modificar Tareas');
		    	$('#Nombretarea').val(item['Nombre']);
		    	$('#tipoTarea').val(item['Id_Tipo_Tarea']);
		    	$('#TaskID').val($('#idTar').val());
		    	$('#descripcionTarea').val(item['Descripcion']);
		  		$('#FechaInicioTarea').val(item['FechaInicio']);
		  		$('#HoraInicioTarea').val(item['Hora_Inicio']);
		     	$('#FechaLimiteTarea').val(item['FechaFin']);	 
		     	$('#HoraLimiteTarea').val(item['Hora_Fin']);	  
		    	$.each(item['responsables'], function(i1,item1){
		    		 $("#ResponsablesTask option[value="+ item1['Id_Usuario'] +"]").attr("selected",true);
		    		 $('#listaResponsable').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item1['usuario']['Nombre']+' '+item1['usuario']['Apellido'] }
                            </li>`);
		    	});
		    	$.each(item['participantes'], function(i2,item2){
		    		//PARA SEGUN EL VALOR SE LE APLICA EL SELECT 
		    		$("#ParticipantesTask option[value="+ item2['Id_Usuario'] +"]").attr("selected",true);
		    		$('#listaParticipantes').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item2['usuario']['Nombre']+' '+item2['usuario']['Apellido'] }
                            </li>`);
		    	});
		    	$.each(item['observadores'], function(i3,item3){
		    		 $("#ObservadoresTask option[value="+ item3['Id_Usuario'] +"]").attr("selected",true);
		    		 $('#listaObservadores').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item3['usuario']['Nombre']+' '+item3['usuario']['Apellido'] }
                            </li>`);
		    	});
		  //   	llenarbucle(item['sub_tareas'],'0','collapse show','tablaTareaSeguimiento','Edit');	   	   
	    	});
	    	$('#FooterCrearTarea').html('');
	    	$('#FooterCrearTarea').append(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="ActualizarTarea()" class="btn btn-primary">Aceptar </button>`);
	   	    $('#cargatareas').fadeIn(1000).html(data); 
		});

	}

	function ModalCrearTareas(){
		limpiarModalTareasCrear();
		$('#TituloTareaCrear').html("<i class='fa fa-bookmark'></i>  "+  'Nueva Tarea');
		$('#FooterCrearTarea').html('');
	    	$('#FooterCrearTarea').append(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button>`);
		$("#ModalCrearTareas").modal("show");

	}

	//PARA GAUARDAS LAS OBSERVACIONES O COMENTARIOS
	function RegistrarObservacion(){
		$('#btnRegistrarObservacion').html(`<button type="button" disabled class="btn btn-success btn-sm"><i class="fa fa-spinner"></i>   Registrando</button>`); 
		 var FrmData = { 
	    	idtarea: $("#idTar").val(),
	    	Observacion: $("#ObservacionTareaSeguimiento").val(),
	    	tipo:'C',
	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Observacion', 
	        method: "POST", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {

	        	$('#btnRegistrarObservacion').html(`<button type="button" onclick="RegistrarObservacion()" class="btn btn-success btn-sm"><i class="fa fa-save"></i>   Registrar</button>`); 
	      		 $("#ObservacionTareaSeguimiento").val('');
	      		 listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	}

	//PARA GAUARDAS LAS EVIDENCIAS
	function RegistrarEvidencias(){

		 var FrmData = { 
	    	Id_Tarea: $("#idTar").val(),
	    	archivo: $('#filedoc').val(),
	    	Descripcion: $('#DescripcionEvidencia').val(),
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Documentos', 
	        method: "POST", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
	        	ListaEvidencia();

	        	// $('#btnRegistrarObservacion').html(`<button type="button" onclick="RegistrarObservacion()" class="btn btn-success btn-sm"><i class="fa fa-save"></i>   Registrar</button>`); 
	      		 // $("#ObservacionTareaSeguimiento").val('');
	      		 // listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	}

	//PARA LISTAR LAS EVIDENCIAS
	function ListaEvidencia(){
		$.get('Documentos/'+$("#idTar").val(), function (data) {
				$('#listaEvidencias').html('');
		 	 	$.each(data, function(i,$valores){
		 	 		$('#listaEvidencias').append(`<tr>
	                                    <td> ${$valores['Descripcion']}</td>
	                                    <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>
	                                    <td>${$valores['Fecha']}</td>
	                                    <td><a target="_blank" href="/Documento/${$valores['Ruta']}" type="button" class="btn btn-sm input-default btn-primary"><i class="fa fa-eye"></i>  Ver</td>
	                                  
	                                </tr>`);

		 	 	});
		 });
		

	}
	


	//PARA LISTAR LAS OBSERVACIONES O COMENTARIOS
	function listaObservaciones(){
		 $.get('Observacion/'+$('#idTar').val(), function (data) {

		 	if(data.length != 0){
		 		llenarComentarios(data);
		 	}
		 	
		 });
	}


	//PARA LLENAR LOS COMENTARIOS EN EL CARD
	function llenarComentarios(data){
		

			$('#cajacomentario').html('');
		 	$.each(data, function(i,item){
					$('#'+item['Id_Observacion']+'s').html('');
		 			$('#cajacomentario').append(`<div class="card">
                                        <div class="card-body">
	                                        <div class="row">
	                                         	<div class="col-md-6">                                         		
	                                        		<img class="imgRedonda" src="images/user/1.png">  ${item['usuario']['Nombre']} ${item['usuario']['Apellido']}
	                                        	</div>   
	                                        	<div class="col-md-6 centerDiv">
	                                        		${item['Fecha']}
	                                        	</div>
	                                        </div>
                                        	<hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
                                        	<div class="row">
	                                         	<div class="col-md-12">  
                            					${item['Descripcion']}
                            					</div>
                            				</div>
                            				<br>
                            				<div class="row">
	                                         	<div class="col-md-12" align="right">  
	                                         	<div id="${item['Id_Observacion']}btnEnviarComentario">
                            						<button type="button" onclick="ResponderComentario('${item['Id_Observacion']}')" class="btn btn-outline-dark btn-sm"><i class="fa fa-share"></i>  Responder</button>
                            					</div>
                            					</div>
                            				</div>
                            				<br>
                            				<div id="${item['Id_Observacion']+'c'}"></div>
                            				<div id="${item['Id_Observacion']+'s'}"></div>
                            				
                                         </div>
                                    </div>`);

				   	$.each(item['sub_observaciones'], function(i2,item2){
						$('#'+item['Id_Observacion']+'s').append(`<div class="card">
					                                        <div class="card-body">
						                                        <div class="row">
						                                         	<div class="col-md-6">                                         		
						                                        		<img class="imgRedonda" src="images/user/1.png">  ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']}
						                                        	</div>   
						                                        	<div class="col-md-6 centerDiv">
						                                        		${item2['Fecha']}
						                                        	</div>
						                                        </div>
					                                        	<hr style="height: 1px; margin-top: 0rem;margin-bottom: 1rem">
					                                        	<div class="row">
						                                         	<div class="col-md-12">  
					                            					${item2['Descripcion']}
					                            					</div>
					                            				</div>
					                            				
					                            				<br>
					                            		
					                            				
					                                         </div>
					                                    </div>`);
				   	});
		 	});			 		 	

	}

	//BOTON REPOSNDER COMENTARIO
	function  ResponderComentario(id){
		cerrarIntervalo();
		$('#'+id+'btnEnviarComentario').html(`<button type="button" onclick="CerrarComentario(${id})" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>  Cerrar</button>
		`);
		$('#'+id+'c').html(`  <textarea class="form-control input-default" id="ObservacionRespuesta"></textarea><br>
                                <div id="btnResponderObservacion"><button onclick="RespuestaObservacion(${id})" type="button" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button></div>`);
	}

	//BOTON CERRAR COMENTARIO
	function  CerrarComentario(id){
		intervalId=window.setInterval(listaObservaciones,5000);
		$('#'+id+'btnEnviarComentario').html(`<button type="button" onclick="ResponderComentario(${id})" class="btn btn-outline-dark btn-sm"><i class="fa fa-share"></i>  Responder</button>
		`);
		$('#'+id+'c').html('');
	}


	//GUARDAR RESPUESTA COMENTARIO
	function RespuestaObservacion(Id_Observacion){
		intervalId=window.setInterval(listaObservaciones,5000);

		$('#btnResponderObservacion').html(`<button type="button" disabled class="btn btn-success btn-sm"><i class="fa fa-spinner"></i>   Enviando</button>`); 
		 var FrmData = { 
	    	idtarea: $("#idTar").val(),
	    	Observacion: $("#ObservacionRespuesta").val(),
	    	Id_Observacion: Id_Observacion,
	    	tipo: 'S',

	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Observacion', 
	        method: "POST", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {

	        	$('#btnResponderObservacion').html(`<button type="button" onclick="RespuestaObservacion(${Id_Observacion})" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button>`); 
	      		 $('#'+Id_Observacion+'c').html('');
	      		 listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	}

//PARA MOSTRAR LOS CAMPOS CUANDO LA TAREA ES PERSONAL
function CamposPersonales(){
	if($('select[id="tipoTarea"] option:selected').text() == 'Personal'){
	$('#Integrantes').addClass('Visibility');

	}else{
		$('#Integrantes').removeClass('Visibility');

	}

}



$(function(){
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            //Obtengo el fichero que va a ser subido
    var dato_archivo = $('#archivo1').prop("files")[0];
    //Creo un dato de formulario para pasarlo en el ajax
    var form_data = new FormData();
    //Añado los datos del fichero que voy a subir
    //En el lado del servidor puede obtener el archivo a traves de $_FILES["file"]
    form_data.append("file", dato_archivo);
    //Realizo el ajax
	    
	   	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
         $.ajax({
	        url: 'Documentos', 
	        method: "POST", 
	        data: form_data,
	     
	        success: function (data) 
	        {

	        	$("#mensaje").html("Respuesta: " + data);
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
});
       
    });
   