function GuardarReunion(){
	var Vtarea= validadorCampos('temaReunion'); 
	var Vdescripcion= validadorCampos('lugarReunion');
	var Vtipo= validadorCampos('ordendeldiaReunion'); 
	if(Vtarea==1 && Vdescripcion==1 && Vtipo==1 ){ // && Vfinicio==1  && Vhinicio==1  && Vffin==1 && Vhfin==1 && Vresponsables==1 && Vparticipantes==1 && Vobsevadores==1 ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);
	    var FrmData = { 
	    	Tema: $("#temaReunion").val(),
	    	Orden_del_Dia: $("#ordendeldiaReunion").val(),
	    	Lugar: $("#lugarReunion").val(),
	    	FechadeReunion: $("#FechaReunion").val(),
	    	HoraReunion: $("#HoraReunion").val(),
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
	        	
	        if(data['FIN']=='1' && data['HIN']=='1'){
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


//TODAS LAS REUNIONES PARA EL ADMINISTRADOR O LA PERSONA QUE LAS CREA
	function ReunionPorUsuario(estado){
		// $('#SelectTipoTarPerTra').val('T');
		// $('#SelecTipoUserTareas').val('CPM');
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
		$('#TablaReuniones').html('');
	    $.get('ReunionPorEstado_User/'+estado, function (data) {
	    	  llenarTabla(data);			 
		      	$('#cargar').fadeIn(1000).html(data); 
			 });
	}


	function llenarTabla(data){
		var signo;
		// var progreso=100;
	    $.each(data, function(i1, $valores) { 

		    $('#TablaReuniones').append(`<tr>
	                                    <td > <i class="fa fa-bullhorn" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas()">${$valores['Tema']}</a></td>
	                                     <td><b>${$valores['Orden_del_Dia']}</td>
	                                     <td><b>${$valores['Lugar']}</td>
	                                     <td><b>${$valores['FechadeReunion']} / ${$valores['HoraReunion']}</td>
	                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
	                                    <td id='${$valores['Id_Reunion']+'Responsable'}'>   
	                                    </td>
	                                    <td id='${$valores['Id_Reunion']+'Participantes'}'></td>
	                                </tr>`);

		    $.each($valores['responsables'], function(i, $vREs) { 
		      $('#'+$valores['Id_Reunion']+'Responsable').append(`<i class="fa fa-user"></i>  ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']} <br><br>`);
		    });
		    $.each($valores['participantes'], function(i, $vPAR) { 
		      $('#'+$valores['Id_Reunion']+'Participantes').append(`<i class="fa fa-user"></i>  ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']} <br><br>`);
		    });	
		}); 
	}


	//EXTRAE TODAS LAS REUNIONES POR USUARIO EL TIPO (RESPONSABLE  PARTICPANTE) Y EL ESTADO( PENDIENTE,TERMINADA)
	function ReunionesPorRol(TipoUser){
		    // $('#btneditar').html('');
		    var estado;
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
				ReunionPorUsuario(estado);
				return;
			}
			// console.log(estado);
			$('#TablaReuniones').html('');
			    $.get(TipoUser+'/'+estado, function (data) {
					$.each(data, function(i2, $valore) { 
							$.each($valore, function(i2, $valores) { 
						    	 $('#TablaReuniones').append(`<tr>
	                                    <td > <i class="fa fa-bullhorn" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalTareas()">${$valores['Tema']}</a></td>
	                                     <td><b>${$valores['Orden_del_Dia']}</td>
	                                     <td><b>${$valores['Lugar']}</td>
	                                     <td><b>${$valores['FechadeReunion']} / ${$valores['HoraReunion']}</td>
	                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
	                                    <td id='${$valores['Id_Reunion']+'Responsable'}'>   
	                                    </td>
	                                    <td id='${$valores['Id_Reunion']+'Participantes'}'></td>
	                                </tr>`);

								    $.each($valores['responsables'], function(i, $vREs) { 
								      $('#'+$valores['Id_Reunion']+'Responsable').append(`<i class="fa fa-user"></i>  ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']} <br><br>`);
								    });
								    $.each($valores['participantes'], function(i, $vPAR) { 
								      $('#'+$valores['Id_Reunion']+'Participantes').append(`<i class="fa fa-user"></i>  ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']} <br><br>`);
								    });	
						 	});
						}); 
				      	$('#cargar').fadeIn(1000).html(''); 
		   		 });
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


function validarfechas(){
	var FrmData = { 
	    	FechaIn: $("#FechaInicioTarea").val(),
	    	HoraIn: $("#HoraInicioTarea").val(),
	    	FechaFin: $("#FechaLimiteTarea").val(),
	    	HoraFin: $("#HoraLimiteTarea").val(),
	    	// FechaLimiteTarea: $("#ObservacionRespuesta").val(),
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
	        	console.log(data);

	        	// $('#btnResponderObservacion').html(`<button type="button" onclick="RespuestaObservacion(${Id_Observacion})" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button>`); 
	      		 // $('#'+Id_Observacion+'c').html('');
	      		 // listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
}


//SELECT MULTIPLE DE RESPONSABLES
function ResponsablesReunion(){
    $('#listaResponsable').html('');
    //TRAE SOLO EL TEXTO DE UN SELECT MULTIPLE
	var selectTextResponsables = $("#ResponsablesReunion option:selected").map(function () {
                    return $(this).text();
    });
	//RECORRE EL SELECT MULTIPLE
   $.each(selectTextResponsables, function(i, item) { 
      $('#listaResponsable').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item}
                            </li>`);
    });   
}

//SELECT MULTIPLE DE PARTICIPANTES
function ParticipantesReunion(){
    $('#listaParticipantes').html('');
      //TRAE SOLO EL TEXTO DE UN SELECT MULTIPLE
	var selectTextParticpantes = $("#ParticipantesReunion option:selected").map(function () {
                    return $(this).text();
    });
   $.each(selectTextParticpantes, function(i, item) { 
      $('#listaParticipantes').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item }
                            </li>`);
    });   
}