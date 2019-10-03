

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
	        url: 'Tareas', 
	        method: "POST", 
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
function CrearSubtarea(Id_tarea,Nombretarea){
	$("#TaskID").val(Id_tarea);
	$("#TituloTareaCrear").html("<i class='fa fa-bookmark'></i>  "+ 'Nueva Subtarea de '+Nombretarea);
	$("#ModalTareasEditar").modal("hide");
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
	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'TareasPendientesPorTareas', 
	        method: "POST", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
	        	console.log(data);
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
	        		console.log('null');
	        	}
	        	
	        	// var htl=`<i class="fa fa-trash"></i>`;
	        	$('#cargar').fadeIn(1000).html(data); 
	        	// window.location = "/Tareas";
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

	//EXTRAE TODAS LAS TAREAS POR USUARIO EL TIPO (RESPONSABLE OBSERVADOR PARTICPANTE) Y EL ESTADO( PENDIENTE,TERMINADA,VENCIDA)
	function TareasPorUsuario(estado,TipoUser,IdUsuario){
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
			$('#TablaTareas').html('');
			    $.get(TipoUser+'/'+IdUsuario+'/'+estado, function (data) {
					$.each(data, function(i2, $valore) { 
							$.each($valore, function(i2, $valores) { 
						    	$('#TablaTareas').append(`<tr id="accordion${$valores['Id_tarea']}"  tr_tareas">
					                                    <td > <i  data-toggle="collapse" data-target="#accordion${$valores['Id_tarea']}" onclick="CambioIconoBoton(this)" class="clickable collapse-row collapsed fa fa-square-o "></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
					                                     <td><b>${$valores['FechaFin']}</td>
					                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
					                                    <td id='${$valores['Id_tarea']+'25'}'>   
					                                    </td>
					                                    <td id='${$valores['Id_tarea']+'50'}'></td>
					                                    <td id='${$valores['Id_tarea']+'75'}'></td>
					                                    <td><span class="label gradient-1 btn-rounded">100%</span>
					                                    </td>
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
		var progreso=100;
	    $.each(data, function(i1, $valores) { 
	    	//condicionar si es nulo subtareas     	
	    	if($valores['sub_tareas'].length!=0){

	    		signo='fa fa-plus';

	    	}else{
	    		signo='fa fa-square-o';

	    	}
		    $('#'+idtabla).append(`<tr id="accordion${$valores['tareasIdTareas']}${textoid}" class="${col} tr_tareas">
	                                    <td > <i  data-toggle="collapse" data-target="#accordion${$valores['Id_tarea']}${textoid}" onclick="CambioIconoBoton(this)" class="clickable collapse-row collapsed ${signo} " style="text-indent: ${sangria+'cm'}" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas(${$valores['Id_tarea']})">${$valores['Nombre']}</a></td>
	                                     <td><b>${$valores['FechaFin']}</td>
	                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
	                                    <td id='${$valores['Id_tarea']+'25'+textoid}'>   
	                                    </td>
	                                    <td id='${$valores['Id_tarea']+'50'+textoid}'></td>
	                                    <td id='${$valores['Id_tarea']+'75'+textoid}'></td>
	                                    <td><span class="label gradient-1 btn-rounded">${progreso}%</span>
	                                    </td>
	                                </tr>`);

		    $.each($valores['responsables'], function(i, $vREs) { 
		      $('#'+$valores['Id_tarea']+'25'+textoid).append(`<i class="fa fa-user"></i>  ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']} <br><br>`);
		    });
		    $.each($valores['participantes'], function(i, $vPAR) { 
		      $('#'+$valores['Id_tarea']+'50'+textoid).append(`<i class="fa fa-user"></i>  ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']} <br><br>`);
		    });
		    $.each($valores['observadores'], function(i, $vOBSE) { 
		      $('#'+$valores['Id_tarea']+'75'+textoid).append(`<i class="fa fa-user"></i>  ${$vOBSE['usuario']['Nombre']} ${$vOBSE['usuario']['Apellido']} <br><br>`);
		    });
		    llenarbucle($valores['sub_tareas'],(parseFloat(sangria)+0.5),'collapse',idtabla,textoid);		
		}); 
		progreso=0;
	    sangria=parseFloat(sangria)-0.5;
	}

	//PARA OBETENER LAS TAREAS POR EL TIPO (PERSONAL O LABORAL)
	function TareasTipo(tipo,estado){
		$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>
		    </div>
		</div>`);
		if(estado=='filtro'){
			if($('#Proceso').hasClass('activado')){
				estado='Proceso';
			}else if($('#Pendiente').hasClass('activado')){
				estado='Pendiente';
			}else if($('#Terminada').hasClass('activado')){
				estado='Terminada';
			}else if($('#Vencida').hasClass('activado')){
				estado='Vencida';
			}
		}
		if(tipo=='T'){
			TareasGenerales(estado);
		}else{
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
		    $.get('TareasPorTipo/'+estado+'/'+tipo, function (data) {
		    	  llenarbucle(data,'0','collapse show','TablaTareas','');
			      	$('#cargar').fadeIn(1000).html(data); 
	   		});
		}
	}

//###################################################################################
//########## FIN OBETENER DATOS POR PARAMETROS###########################################
//###################################################################################

	//PARA EL MODAL DEL SEGUIMIENTO DE LA TAREA
	function ModalTareas(Id_tarea){
		limpiarModalTareas();
		$("#ModalTareasEditar").modal("show");
		$('#cargatareas').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>

		    </div>
		</div>`);
	    $.get('Tareas/'+Id_tarea, function (data) {
	    	$.each(data, function(i,item){
		    	$('#TituloTareaEditar').html("<i class='fa fa-bookmark'></i>  "+  item['Nombre']);
		    	$('#tipoTareaEditar').val(item['Id_Tipo_Tarea']);
		    	$('#idTar').val(item['Id_tarea']);
		    	$('#descripcionTareaEditar').html(item['Descripcion']);
		    	$('#FechaInicioTareaEditar').html(item['FechaInicio']+' '+item['Hora_Inicio']);
		    	$('#FechaLimiteTareaEditar').html(item['FechaFin']+' '+item['Hora_Fin']);	   

		    	$.each(item['responsables'], function(i1,item1){
		    	   $('#ResponsablesTaskEditar').append(`<i class="fa fa-user"></i>  ${item1['usuario']['Nombre']} ${item1['usuario']['Apellido']} <br>`);
		    	});
		    	$.each(item['participantes'], function(i2,item2){
		    	   $('#ParticipantesTaskEditar').append(`<i class="fa fa-user"></i>  ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']} <br>`);
		    	});
		    	$.each(item['observadores'], function(i3,item3){
		    	   $('#ObservadoresTaskEditar').append(`<i class="fa fa-user"></i>  ${item3['usuario']['Nombre']} ${item3['usuario']['Apellido']} <br>`);
		    	});
				document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}')`) ;
		    	llenarbucle(item['sub_tareas'],'0','collapse show','tablaTareaEditar','Edit');	   	   
	    	});
	   	    $('#cargatareas').fadeIn(1000).html(data); 
		});
	}

	//LIMPIAR MODAL DE TAREAS CERAR NUEVA
	function limpiarModalTareas(){
		$('#TituloTareaEditar').html('');
		$('#descripcionTareaEditar').html('');
		$('#FechaInicioTareaEditar').html('');
		$('#HoraInicioTareaEditar').html('');
		$('#FechaLimiteTareaEditar').html('');
		$('#HoraLimiteTareaEditar').html('');
		$('#ResponsablesTaskEditar').html('');
		$('#ParticipantesTaskEditar').html('');
		$('#ObservadoresTaskEditar').html('');
		$('#tablaTareaEditar').html('');
	}



