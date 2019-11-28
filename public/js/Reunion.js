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
	    	FechaIn: $("#FechaReunion").val(),
	    	HoraIn: $("#HoraReunion").val(),
	    	ResponsablesReunion: $("#ResponsablesReunion").val(),
	    	ParticipantesReunion: $("#ParticipantesReunion").val(),
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
		        	
		        if(data['FIN']=='1' ){
			    $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });
			    $.ajax({
			        url: 'Reunion', 
			        method: "POST", 
			        data: FrmData,
			        dataType: 'json',
			        success: function (data) 
			        {
			        	$('#cargar').fadeIn(1000).html(''); 
			        	window.location = "/Reunion";
			        },
			        error: function () { 
			        	$('#cargar').fadeIn(1000).html(''); 
			            alertify.error(" Ocurrió un error, contactese con el Administrador.")
			        }
			    });
	        	}else{
	        		$('#cargar').fadeIn(1000).html('');
	        		$('#mensajefechas').html('');
					$('#mensajefechas').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> Verifique que las fechas y horas esten ingresadas correctamente (Fecha Inicio y Hora Inicio no pueden ser menor a la actual).
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
//EDITAR REUNION SOLO PARA EL ADMINISTRADOR Y EL QUE LA CREA
	function ReunionEditar(){
		// limpiarModalTareasCrear();
		$("#ModalReunionSeguimiento").modal("hide");
		$("#ModalCrearReunion").modal("show");
		 $.get('Reunion/'+$('#idReun').val(), function (data) {
	    	$.each(data, function(i,item){
		    	$('#tituloreunion').html("<i class='fa fa-bookmark'></i>  "+  'Modificar Reunión');
		    	$('#temaReunion').val(item['Tema']);
		    	$('#lugarReunion').val(item['Lugar']);
		    	$('#ordendeldiaReunion').val(item['Orden_del_Dia']);
		    	$('#FechaReunion').val(item['FechadeReunion']);
		  		$('#HoraReunion').val(item['HoraReunion']);
		    	$.each(item['responsables'], function(i1,item1){
		    		 $("#ResponsablesReunion option[value="+ item1['Id_Usuario'] +"]").attr("selected",true);
		    		 $('#listaResponsable').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item1['usuario']['Nombre']+' '+item1['usuario']['Apellido'] }
                            </li>`);
		    	});
		    	$.each(item['participantes'], function(i2,item2){
		    		console.log(item2['Id_Usuario']);
		    		//PARA SEGUN EL VALOR SE LE APLICA EL SELECT 
		    		$("#ParticipantesReunion option[value="+ item2['Id_Usuario'] +"]").attr("selected",true);
		    		$('#listaParticipantes').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item2['usuario']['Nombre']+' '+item2['usuario']['Apellido'] }
                            </li>`);
		    	});	   	   
	    	});
	    	$('#footerCrearReunion').html('');
	    	$('#footerCrearReunion').append(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="ActualizarReunion()" class="btn btn-primary">Aceptar </button>`);
	   	    // $('#cargatareas').fadeIn(1000).html(data); 
		});

	}

function ConfirmarTerminarReunion(){
	$('#id_modal_conf').modal("show");
}

//ACTUALIZAR REUNION
function TerminarReunion(){
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
	    	Conclusion: $("#ConclusionReunionSeguimiento").val(),
	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Reunion'+'/'+$('#idReun').val(), 
	        method: "PUT", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
	        	$('#cargar').fadeIn(1000).html(data); 
	        	window.location = "/Reunion";
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	}
}

//TODAS LAS REUNIONES PARA EL ADMINISTRADOR O LA PERSONA QUE LAS CREA
	function ReunionPorUsuario(estado){
		$('#SelecTipoUserReunion').val('CPM');
		$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>

		    </div>
		</div>`);
		if(estado=='Pendiente'){
	    	$('#Suspendida').removeClass('activado');
	    	$('#Pendiente').addClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }else if(estado=='Terminada'){
	    	$('#Suspendida').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').addClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }
	    else if(estado=='Vencida'){
	    	$('#Suspendida').removeClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').addClass('activado');
	    }
	     else if(estado=='Suspendida'){
	    	$('#Suspendida').addClass('activado');
	    	$('#Pendiente').removeClass('activado');
	    	$('#Terminada').removeClass('activado');
	    	$('#Vencida').removeClass('activado');
	    }
		$('#TablaReuniones').html('');
	    $.get('ReunionPorEstado_User/'+estado, function (data) {
	    	
	    	  llenarTabla(data,estado);			 
		      	
			 });
	}


	function llenarTabla(data,estado){
				var signo;
	
		// var progreso=100;
	    $.each(data, function(i1, $valores) { 
	    	var vencida;
	    	if(estado=='Terminada'){
	    	
	    		

	    	
		    $('#TablaReuniones').append(`<tr>
	                                    <td > <i class="fa fa-bullhorn" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalReunion(${$valores['Id_Reunion']})">${$valores['Tema']}</a></td>

	                                     <td><b>${$valores['Lugar']}</td>
	                                     <td><b>${$valores['FechadeReunion']} / ${$valores['HoraReunion']}</td>
	                                     <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>   
	                                    <td id='${$valores['Id_Reunion']+'Responsable'}'>   
	                                    </td>
	                                    <td id='${$valores['Id_Reunion']+'Participantes'}'></td>
	                                    <td>${$valores['FechaCreacion']}</td>
	                                    <td><span class="badge badge-success" style="font-size:12px	" >Terminada</span></td>

	                                </tr>`);

	    	}else if(estado=='Suspendida'){

		   		 $('#TablaReuniones').append(`<tr>
	                                    <td > <i class="fa fa-bullhorn" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalReunion(${$valores['Id_Reunion']})">${$valores['Tema']}</a></td>

	                                     <td><b>${$valores['Lugar']}</td>
	                                     <td><b>${$valores['FechadeReunion']} / ${$valores['HoraReunion']}</td>
	                                     <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>   
	                                    <td id='${$valores['Id_Reunion']+'Responsable'}'>   
	                                    </td>
	                                    <td id='${$valores['Id_Reunion']+'Participantes'}'></td>
	                                    <td>${$valores['FechaCreacion']}</td>
	                                    <td><span class="badge badge-primary" style="font-size:12px	" >Suspendida</span></td>

	                                </tr>`);

	    	}
	    	else{
	 


	    	 
	    	
	    	if($valores['0']='1'){
	    		var Vencida='Vencida';
	    	}else{
	    		var Vencida='Pendiente';
	    	}
	    	

	    	
		    $('#TablaReuniones').append(`<tr>
	                                    <td > <i class="fa fa-bullhorn" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalReunion(${$valores['Id_Reunion']})">${$valores['Tema']}</a></td>

	                                     <td><b>${$valores['Lugar']}</td>
	                                     <td><b>${$valores['FechadeReunion']} / ${$valores['HoraReunion']}</td>
	                                     <td><a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$valores['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</a></td>   
	                                    <td id='${$valores['Id_Reunion']+'Responsable'}'>   
	                                    </td>
	                                    <td id='${$valores['Id_Reunion']+'Participantes'}'></td>
	                                    <td>${$valores['FechaCreacion']}</td>
	                                    <td><span style="font-size:12px	" class="badge badge-danger">${Vencida}</span></td>

	                                </tr>`);
		    
	    	}
		    $.each($valores['responsables'], function(i, $vREs) { 
		      $('#'+$valores['Id_Reunion']+'Responsable').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vREs['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vREs['usuario']['Nombre']} ${$vREs['usuario']['Apellido']}</a> <br><br>`);
		    });
		    $.each($valores['participantes'], function(i, $vPAR) { 
		      $('#'+$valores['Id_Reunion']+'Participantes').append(`<a title="Ver Perfil" style="font-size:12px"  href="javascript:void(0);" onclick="ModalPerfilUsuario(${$vPAR['usuario']['Id_Usuario']})"><i class="fa fa-user"></i> ${$vPAR['usuario']['Nombre']} ${$vPAR['usuario']['Apellido']}</a><br><br>`);
		    });	

		}); 
		$('#cargar').fadeIn(1000).html(data); 
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
		if($('#Suspendida').hasClass('activado')){
			estado='Suspendida';
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
		    	$('#TablaReuniones').html('');
				$.each(data, function(i1, $valore) { 
						llenarTabla($valore,estado);
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
      $('#listaParticipantes').append(`<li class="list-group-item"><img class="imgRedonda" src="images/user/1.png">  ${item}
                            </li>`);
    });   
}

//LIMPIAR MODAL DE REUNIONES CERAR NUEVA
	function limpiarModalReunionCrear(){
	$("#ResponsablesReunion option:selected").attr("selected",false);
	$("#ParticipantesReunion option:selected").attr("selected",false);
	$("#ResponsablesReunion").val('');
	$("#ParticipantesReunion").val('');
	 $.get('HoraFechaSistema', function (data) {
		$('#FechaReunion').val(data['Fecha']);
		$('#HoraReunion').val(data['Hora']);
	 });
	$('#temaReunion').val('');
	$('#lugarReunion').val('');
	$('#ordendeldiaReunion').val('');
	$('#listaResponsable').html('');
	$('#listaParticipantes').html('');
	}

	function ModalCrearReunion(){
		$("#ModalCrearReunion").modal("show");
		limpiarModalReunionCrear();
		Usuarios();
	}

	function Usuarios(){
		$('#ResponsablesReunion').text('');
		 $.get('Usuarios', function (data) {
			 $.each(data, function(i, $item) { 
                $('#ResponsablesReunion').append(`<option value="${$item['Id_Usuario']}" >${$item['Nombre']} ${$item['Apellido']}</option>`);
                $('#ParticipantesReunion').append(`<option value="${$item['Id_Usuario']}" >${$item['Nombre']} ${$item['Apellido']}</option>`);
   				
   			 });
		 });
	}



//PARA EL MODAL DEL SEGUIMIENTO DE LA REUNION
	function ModalReunion(Id_reunion){
		 limpiarModalReunionCrear();
		 $( document ).ready(function() {	
		     intervalId=window.setInterval(listaObservaciones,5000);;
		      
		});
		$('#mensajefechas').html('');
		$("#ModalReunionSeguimiento").modal("show");
		$('#cargatareas').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>

		    </div>
		</div>`);
		$('#ParticipantesReunionSeguimiento').html('');
		$('#ConclusionReunionSeguimiento').html('');
		$('#OrdendelDia').html('');
		$('#ResponsablesReunionSeguimiento').html('');
	    $.get('Reunion/'+Id_reunion, function (data) {
	    	$.each(data, function(i,item){
		    	$('#TituloReunionSeguimiento').html("<i class='fa fa-sticky-note'></i>  "+  item['Tema']);
		    	$('#idReun').val(item['Id_Reunion']);
		    	$('#FechaReunionSeguimiento').html(item['FechadeReunion']+'-'+item['HoraReunion']);
		    	$('#OrdendelDia').text(item['Orden_del_Dia']);
		    	$.each(item['responsables'], function(i1,item1){
		    	   $('#ResponsablesReunionSeguimiento').append(` <i class="fa fa-user"></i>  ${item1['usuario']['Nombre']} ${item1['usuario']['Apellido']} <br>`);
		    	});
		    	$('#ParticipantesReunionSeguimiento').html('');
		    	$.each(item['participantes'], function(i2,item2){
		
					    	if(item2['asistencia']=='1'){
				    			var estado='checked';
				    		}else{
				    			var estado='';
				    		}
				    		if(item2['motivo']!=null){
				    			var motivo=item2['motivo'];
				    		}else{
				    			var motivo='';
				    		}
				    		if($('#SelecTipoUserReunion').val()=="MisReunionesResponsables"){
								$('#ParticipantesReunionSeguimiento').append(`<tr >
                                    <td > <i   class=" fa fa-user"></i> ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']} </td>
                                     <td  centerDiv><div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input id="inputCheck"  onclick="onToggle(${item['Id_Reunion']},${item2['usuario']['Id_Usuario']})" id="${item2['usuario']['Id_Usuario']+'AsistenciaChek'}" type="checkbox" class="form-check-input " ${estado}  value=""></label>
                                    </div></td>
                                </tr>`);
                            if($('#Terminada').hasClass('activado')){
							 $('#inputCheck').prop('disabled',true);
						    }
							}else{
								$('#ParticipantesReunionSeguimiento').append(`<tr >
                                    <td > <i   class=" fa fa-user"></i> ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']} </td>
                                     <td  centerDiv><div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                        <input id="inputCheck" disabled type="checkbox" class="form-check-input " ${estado}  value=""></label>
                                    </div>
                                    <td>${motivo}</td>
                                    </td>
                          
                                </tr>`);
                            if($('#Terminada').hasClass('activado')){
							 $('#inputCheck').prop('disabled',true);
						    }
							}
		    	});	  
		    	//SI SELECCIONA LAS REUNIONES QUE SON CREADAS POR MI
			   	if($('#SelecTipoUserReunion').val()=="CPM"){
					var btneditar=` <a  class="dropdown-item" href="javascript:void(0);" onclick="ReunionEditar()"><i class="fa fa-pencil-square-o"></i>  Editar Reunión</a>`;
					$('#PanelObservacion').html('');
					$('#PanelEvidencias').html('');	
					$('#botoneSeguimiento').html('');
					$('#EstadoObservacionReunion').html('');
					$('#PanelConclusiones').html('');
					$.get('validarinicioTarea/'+item['FechadeReunion']+'/'+item['HoraReunion'], function (data) {
						if(data['Inicia']=='1'){
								$('#botoneSeguimiento').html('');
								$('#PanelObservacion').html('');
								$('#botoneSeguimiento').append(`<div class="row">
				                            <div class="col-md-6">
				                                <div class="btn-group">
				                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                                    Más
				                                  </button>
				                                  <div class="dropdown-menu">
				                                    <div id="btneditar">
				                                    ${btneditar}
				                                   </div>
				                                  </div>
				                                </div>
				                            </div>
				                        </div> `);
								// $('#PanelObservacion').append(`
		      //                               <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
		      //                               <textarea class="form-control input-default" id="ObservacionReunionSeguimiento"></textarea><br>
		      //                               <div id="btnRegistrarObservacionReunion"><button onclick="RegistrarObservacionReunion()" type="button" class="btn btn-success btn-sm">Registrar</button></div>
		      //               	`);
		       
							  	// document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}','${item['FechaFin']}','${item['Hora_Fin']}')`) ;								
						}else{
							$('#EstadoObservacionReunion').html('');
							$('#EstadoObservacionReunion').append(`<div class="row"> 
							 	<div class="col-md-12 ">   
							      <div class="alert alert-info" role="alert">
							        <div class="row vertical-align centerDiv">
							          <div class="col-lg-1 text-center">
							            <i class="fa fa-info fa-2x"></i> 
							          </div>
							          <div class="col-lg-11 centerDiv">
							           <strong> ESTA REUNIÓN AÚN NO INICIA.</strong>
							          </div>
							        </div>
							      </div>      
				   				</div>
				 				 </div> `);
							$('#PanelObservacion').html('');
							$('#PanelEvidencias').html('');
							$('#botoneSeguimiento').html('');
							$('#botoneSeguimiento').append(`<div class="row">
			                            <div class="col-md-6">
			                                <div class="btn-group">
			                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                                    Más
			                                  </button>
			                                  <div class="dropdown-menu">
			                                    <div id="btneditar">
			                                    ${btneditar}
			                                   </div>
			                                  </div>
			                                </div>
			                            </div>
			                        </div> `);
						  // document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}','${item['FechaFin']}','${item['Hora_Fin']}')`) ;
						}
						if($('#Terminada').hasClass('activado')){
							$('#inputCheck').prop('disabled',true);
							$('#botoneSeguimiento').html('');
							$('#botoneSeguimiento').append(`<div class="row">
												<a style="font-size: 12px" href="GenerarReporteReunion/${item['Id_Reunion']}" class="btn btn-success "><span class="fa fa-download"></span> Descargar Reporte</a
			                            <
			                        </div> `);
							$('#PanelObservacion').html('');
							$('#EstadoObservacion').html('');
							$('#PanelConclusiones').html('');
		                    $('#PanelConclusiones').append(`<label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Conclusión:</b></label>
                                    <textarea readonly rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento">${item['Conclusion']}</textarea><br>`);
						}else if($('#Vencida').hasClass('activado')){
							$('#botoneSeguimiento').html('');
							$('#PanelObservacion').html('');
							$('#EstadoObservacion').html('');
							$('#PanelConclusiones').html('');
						}
						
						// //SI EL TAG ES TERMINADA O VENCIDA OCULATAMOS BOTON ENTREGAR 
						// if($('#Terminada').hasClass('activado') || $('#Vencida').hasClass('activado')){
						// 	$('#botoneSeguimiento').html('');
						// 	$('#EstadoObservacionReunion').html('');
						// 	$('#PanelObservacion').html('');
						// 	$('#PanelEvidencias').html('');
						// }
					});		
				}else if($('#SelecTipoUserReunion').val()=="MisReunionesResponsables"){
					$('#EstadoObservacionReunion').html('');
					$('#PanelObservacion').html('');
					$('#botoneSeguimiento').html('');
					$('#PanelEvidencias').html('');
					$('#PanelConclusiones').html('');
					$.get('validarinicioTarea/'+item['FechadeReunion']+'/'+item['HoraReunion'], function (data) {
						
						if(data['Inicia']=='1'){

							$('#PanelObservacion').append(`
		                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
		                                    <textarea class="form-control input-default" id="ObservacionReunionSeguimiento"></textarea><br>
		                                    <div id="btnRegistrarObservacionReunion"><button onclick="RegistrarObservacionReunion()" type="button" class="btn btn-success btn-sm">
		                                    <i class="fa fa-save"></i>  Registrar</button></div>
		                    `);
		                    	$('#PanelConclusiones').html('');
		                    	$('#PanelConclusiones').append(`<label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Conclusión:</b></label>
                                    <textarea rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento"></textarea><br>`);
		                    		                 
							// $('#PanelEvidencias').append(`<label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
							// 	<input type="text" class="form-control input-default" id="DescripcionEvidencia" placeholder="Descripción"><br>
							// 	<input  type="file" class="form-control input-default" id="filedoc"><br>
						 //        <button onclick="RegistrarEvidencias()" type="button" class="btn btn-success btn-sm">Registrar</button>`);
							$('#botoneSeguimiento').append(`<div class="row">
		                            <div class="col-md-6">
		                                <button onclick="ConfirmarTerminarReunion()" class="btn btn-success btn-block"><i class="fa fa-paper-plane-o"></i>   Terminar Reunión</button>
		                            </div>
		                            <div class="col-md-6">
		                                <div class="btn-group">
		                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                    Más
		                                  </button>
		                                  <div class="dropdown-menu">
		                                    <a id="SuspenderReunion" class="dropdown-item"  href="javascript:void(0);" ><i style="color:red" class="fa fa-pause"></i>  Suspender</a>
		                                  </div>
		                                </div>
		                            </div>
		                        </div> `);
						// document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}','${item['FechaFin']}','${item['Hora_Fin']}')`) ;
						document.getElementById('SuspenderReunion').setAttribute('onclick',`SuspenderReunion()`) ;
						
						}else{
							$('#EstadoObservacionReunion').html('');
							$('#EstadoObservacionReunion').append(`<div class="row"> 
							 	<div class="col-md-12 ">   
							      <div class="alert alert-info" role="alert">
							        <div class="row vertical-align centerDiv">
							          <div class="col-lg-1 text-center">
							            <i class="fa fa-info fa-2x"></i> 
							          </div>
							          <div class="col-lg-11 centerDiv">
							           <strong> ESTA REUNIÓN AÚN NO INICIA.</strong>
							          </div>
							        </div>
							      </div>      
				   				</div>
				 				 </div> `)
							$('#PanelObservacion').html('');
							$('#botoneSeguimiento').html('');
							$('#PanelEvidencias').html('');
							$('#PanelConclusiones').html('');
						}

						if($('#Terminada').hasClass('activado')){
							$('#inputCheck').prop('disabled',true);
							$('#botoneSeguimiento').html('');
							$('#botoneSeguimiento').append(`<div class="row">
												<a style="font-size: 12px" href="GenerarReporteReunion/${item['Id_Reunion']}" class="btn btn-success "><span class="fa fa-download"></span> Descargar Reporte</a
			                            <
			                        </div> `);
							$('#PanelObservacion').html('');
							$('#PanelEvidencias').html('');						
							$('#EstadoObservacion').html('');
							$('#PanelConclusiones').html('');
		                    $('#PanelConclusiones').append(`<label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Conclusión:</b></label>
                                    <textarea readonly rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento">${item['Conclusion']}</textarea><br>`);
						}else if($('#Vencida').hasClass('activado')){
							$('#botoneSeguimiento').html('');
							$('#PanelObservacion').html('');
							$('#EstadoObservacion').html('');
							$('#PanelConclusiones').html('');
						}
					

					});

				}else if($('#SelecTipoUserReunion').val()=="MisReunionesParticipantes"){
					$('#EstadoObservacionReunion').html('');
					$('#PanelObservacion').html('');
					$('#botoneSeguimiento').html('');
					$('#botoneSeguimiento').append(`<div class="row">
												<a style="font-size: 12px" href="GenerarReporteReunion/${item['Id_Reunion']}" class="btn btn-success "><span class="fa fa-download"></span> Descargar Reporte</a
			                            <
			                        </div> `);
					$('#PanelEvidencias').html('');
					$('#PanelConclusiones').html('');
					$.get('validarinicioTarea/'+item['FechadeReunion']+'/'+item['HoraReunion'], function (data) {
						if(data['Inicia']=='1'){
							$('#PanelObservacion').append(`
				                                    <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
				                                    <textarea class="form-control input-default" id="ObservacionReunionSeguimiento"></textarea><br>
				                                    <div id="btnRegistrarObservacionReunion"><button onclick="RegistrarObservacionReunion()" type="button" class="btn btn-success btn-sm"><i class="fa fa-save"></i>  Registrar</button></div>
				                                `);
							// $('#PanelEvidencias').html('');
							// $('#PanelEvidencias').append(`<label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
							// 	<input type="text" class="form-control input-default" id="DescripcionEvidencia" placeholder="Descripción"><br>
							// 	<input  type="file" class="form-control input-default" id="filedoc"><br>
						 //        <button onclick="RegistrarEvidencias()" type="button" class="btn btn-success btn-sm">Registrar</button>`);
							// $('#botoneSeguimiento').html('');
							// $('#botoneSeguimiento').append(`<div class="row">
				   //                          <div class="col-md-6">
				   //                              <div class="btn-group">
				   //                                <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   //                                  Más
				   //                                </button>
				   //                                <div class="dropdown-menu">
				   //                                  <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
				   //                                  <div id="btneditar">
				   //                                 </div>
				   //                                </div>
				   //                              </div>
				   //                          </div>
				   //                      </div> `);
							// document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}','${item['FechaFin']}','${item['Hora_Fin']}')`) ;
						}else{
							$('#EstadoObservacion').html('');
							$('#EstadoObservacionReunion').append(`<div class="row"> 
							 	<div class="col-md-12 ">   
							      <div class="alert alert-info" role="alert">
							        <div class="row vertical-align centerDiv">
							          <div class="col-lg-1 text-center">
							            <i class="fa fa-info fa-2x"></i> 
							          </div>
							          <div class="col-lg-11 centerDiv">
							           <strong> ESTA REUNIÓN AÚN NO INICIA.</strong>
							          </div>
							        </div>
							      </div>      
				   				</div>
				 				 </div> `)
							$('#PanelObservacion').html('');
							$('#botoneSeguimiento').html('');
							$('#PanelEvidencias').html('');
							$('#PanelConclusiones').html('');
						}
						if($('#Terminada').hasClass('activado')){
								$('#inputCheck').prop('disabled',true);
							$('#botoneSeguimiento').html('');
							$('#botoneSeguimiento').append(`<div class="row">
												<a style="font-size: 12px" href="GenerarReporteReunion/${item['Id_Reunion']}" class="btn btn-success "><span class="fa fa-download"></span> Descargar Reporte</a
			                            <
			                        </div> `);
							$('#PanelObservacion').html('');
							$('#EstadoObservacion').html('');
							$('#PanelConclusiones').html('');
		                    $('#PanelConclusiones').append(`<label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Conclusión:</b></label>
                                    <textarea readonly rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento">${item['Conclusion']}</textarea><br>`);
						}else if($('#Vencida').hasClass('activado')){
							$('#botoneSeguimiento').html('');
							$('#PanelObservacion').html('');
							$('#EstadoObservacion').html('');
							$('#PanelConclusiones').html('');
						}
					});

				}else{
					$('#botoneSeguimiento').html('');
						$('#PanelObservacion').html('');
						$('#PanelEvidencias').html('');						
						$('#EstadoObservacionReunion').html('');
						$('#PanelConclusiones').html('');
					if($('#Terminada').hasClass('activado') || $('#Vencida').hasClass('activado') ){
						var btneditar=` <a  class="dropdown-item" href="javascript:void(0);" onclick="TareasEditar()"><i class="fa fa-pencil-square-o"></i>  Editar Tarea</a>`;
						$('#botoneSeguimiento').html('');
						$('#botoneSeguimiento').append(`<div class="row">
			    
			                            <div class="col-md-6">
			                                <div class="btn-group">
			                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                                    Más
			                                  </button>
			                                  <div class="dropdown-menu">
			                                    <div id="btneditar">
			                                    ${btneditar}
			                                   </div>
			                                  </div>
			                                </div>
			                            </div>
			                        </div> `);
					}else{
						var btneditar=` <a  class="dropdown-item" href="javascript:void(0);" onclick="TareasEditar()"><i class="fa fa-pencil-square-o"></i>  Editar Tarea</a>`;
						$('#botoneSeguimiento').html('');
						$('#botoneSeguimiento').append(`<div class="row">
			    
			                            <div class="col-md-6">
			                                <div class="btn-group">
			                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                                    Más
			                                  </button>
			                                  <div class="dropdown-menu">
			                                    <div id="btneditar">
			                                    ${btneditar}
			                                   </div>
			                                  </div>
			                                </div>
			                            </div>
			                        </div> `);
						// document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}','${item['FechaFin']}','${item['Hora_Fin']}')`) ;

					}
				}

				// if($('#Terminada').hasClass('activado')) {
				// 	$('#PanelConclusiones').html('');
				// 		$('#PanelConclusiones').append(`<label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Conclusión:</b></label>
    //                                 <textarea readonly  rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento">${data['0']['Conclusion']}</textarea><br>`);

				// 		// $('#DivFechaEntregaTarea').html('');
				// 		// $('#DivFechaEntregaTarea').append(`<div class="col-md-12">
    //   //                                       <div class="row">
    //   //                                           <div class="col-md-5">
    //   //                                               <p style="color: black; font-size: 13px"><b>Fecha Entrega:</b></p>
    //   //                                           </div>
    //   //                                           <div class="col-md-7">
    //   //                                               <p style="color: black; font-size: 13px" class="badge badge-success" id="FechaEntregaTareaSeguimiento">${item['FechaEntrega']}</p>
    //   //                                           </div>
    //   //                                       </div>
    //   //                                   </div>`);
				// 			$('#botoneSeguimiento').html('');
				// }





	   		 	listaObservaciones();
	   	     	$('#cargatareas').fadeIn(1000).html(data); 


	   		});

		});

	}

function SuspenderReunion(){
	var FrmData = { 
	    	Suspender: 'Suspender',
	}
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Reunion'+'/'+$('#idReun').val(), 
	        method: "PUT", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {
		        	window.location = "/Reunion";
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });

}

//ACTUALIZAR REUNION
function ActualizarReunion(){
	var Vtema= validadorCampos('temaReunion'); 
	var Vlugar= validadorCampos('lugarReunion');
	var VOrden= validadorCampos('ordendeldiaReunion'); 
	if(Vtema==1 && Vlugar==1 && VOrden==1 ){ // && Vfinicio==1  && Vhinicio==1  && Vffin==1 && Vhfin==1 && Vresponsables==1 && Vparticipantes==1 && Vobsevadores==1 ){
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
	    	FechaIn: $("#FechaReunion").val(),
	    	HoraIn: $("#HoraReunion").val(),
	    	ResponsablesReunion: $("#ResponsablesReunion").val(),
	    	ParticipantesReunion: $("#ParticipantesReunion").val(),
	    }
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'ModificarReunion'+'/'+$('#idReun').val(), 
	        method: "PUT", 
	        data: FrmData,
	        dataType: 'json',
	        success: function (data) 
	        {

	        	console.log(data);

	    //     	if(data=='0'){
	    //     		$('#mensajefechas').html('');
					// $('#mensajefechas').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
					// 					  <strong>Atención!</strong> Verifique que las fechas y horas esten ingresadas correctamente.<br>
					// 					  <strong>*<strong>  Fecha y hora de inicio deben ser mayor o igual a la fecha de creación de la tarea<br>
					// 					  <strong>*<strong> Fecha y hora límite deben ser mayor o igual a la fecha de inicio<br>
					// 					  <strong>*<strong> En caso de ser Subtarea la Fecha límite debe ser menor a la fecha límite de la tarea principal y la fecha de inicio debe ser mayor o igual a la fecha de inicio de la tarea principal
					// 					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					    <span aria-hidden="true">&times;</span>
					// 					  </button>
					// 					</div`);
					// $('#mensajefechas').hide();
			  //       $('#mensajefechas').prop('hidden',false);
			  //       $('#mensajefechas').show(500);
			  //       $('#cargar').fadeIn(1000).html(data);
	    //     	}else{
		        	$('#cargar').fadeIn(1000).html(data); 
		        	window.location = "/Reunion";
	    //     	}
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	// }else{
//      		$('#cargar').fadeIn(1000).html('');
//      		$('#mensajefechas').html('');
	// 	$('#mensajefechas').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
	// 						  <strong>Atención!</strong> Verifique que las fechas y horas esten ingresadas correctamente (Fecha Inicio y Hora Inicio no pueden ser menor a la actual, Fecha Límite y Hora Límite no pueden ser menor a las de inicio).
	// 						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 						    <span aria-hidden="true">&times;</span>
	// 						  </button>
	// 						</div`);
	// 	$('#mensajefechas').hide();
 //        $('#mensajefechas').prop('hidden',false);
 //        $('#mensajefechas').show(500);
//     		}

	}
}

	//PARA EL CHECKBOX DE ACTUALIZAR CONTRASEÑA
  function onToggle(IdReunion,Id_Usuario) {
    // check if checkbox is checked
    if( $('#'+Id_Usuario+'AsistenciaChek').prop('checked') ) {
    var FrmData = { 
	    	asistencia: '1',
	    }

    } else {
    	var FrmData = { 
	    	asistencia: '2',
	    }
    }
 


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});
    $.ajax({
        url: 'Asistencia/'+IdReunion+'/'+Id_Usuario, 
        method: "PUT", 
        data: FrmData,
        dataType: 'json',
        success: function (data) 
        {
        	
        },
        error: function () { 
            alertify.error(" Ocurrió un error, contactese con el Administrador.")
        }
	});


  }


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

  	//PARA GAUARDAS LAS OBSERVACIONES O COMENTARIOS
	function RegistrarObservacionReunion(){
		if($('#ObservacionReunionSeguimiento').val()==''){
				borderInput('ObservacionReunionSeguimiento');
			}else{
			
			$('#btnRegistrarObservacionReunion').html(`<button type="button" disabled class="btn btn-success btn-sm"><i class="fa fa-spinner"></i>   Registrando</button>`); 
			 var FrmData = { 
		    	IdReunion: $("#idReun").val(),
		    	Observacion: $("#ObservacionReunionSeguimiento").val(),
		    	tipo:'C',
		    }
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'ObservacionesReuniones', 
		        method: "POST", 
		        data: FrmData,
		        dataType: 'json',
		        success: function (data) 
		        {
		        	eliminarclaseInput('ObservacionReunionSeguimiento');
		        	$('#btnRegistrarObservacionReunion').html(`<button type="button" onclick="RegistrarObservacionReunion()" class="btn btn-success btn-sm"><i class="fa fa-save"></i>   Registrar</button>`); 
		      		$("#ObservacionReunionSeguimiento").val('');
		      		listaObservaciones();
		        },
		        error: function () { 
		            alertify.error(" Ocurrió un error, contactese con el Administrador.")
		        }
		    });
		}
	}

		//BOTON REPOSNDER COMENTARIO
	function  ResponderComentario(id){
			cerrarIntervalo();
			;
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
		if($("#ObservacionRespuesta").val()==''){
		 	borderInput('ObservacionRespuesta');
		 }else{
			$('#btnResponderObservacion').html(`<button type="button" disabled class="btn btn-success btn-sm"><i class="fa fa-spinner"></i>   Enviando</button>`); 
			 var FrmData = { 
		    	IdReunion: $("#idReun").val(),
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
		        url: 'ObservacionesReuniones', 
		        method: "POST", 
		        data: FrmData,
		        dataType: 'json',
		        success: function (data) 
		        {
		        	eliminarclaseInput('ObservacionRespuesta');
		        	$('#btnResponderObservacion').html(`<button type="button" onclick="RespuestaObservacion(${Id_Observacion})" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button>`); 
		      		$('#'+Id_Observacion+'c').html('');
		      		listaObservaciones();
		        },
		        error: function () { 
		            alertify.error(" Ocurrió un error, contactese con el Administrador.")
		        }
		    });
		}
	}
	 	var intervalId; 
	//PARA CERRAR EL TIEMPO DE EJECUCION DE LA LISTA DE OBSERVACIONES
	function cerrarIntervalo(){
		window.clearInterval(intervalId);
	}




  	//PARA LLENAR LOS COMENTARIOS EN EL CARD
	function llenarComentarios(data){
			$('#cajacomentarioReunion').html('');
		 	$.each(data, function(i,item){
					$('#'+item['Id_observacion_reunion']+'s').html('');
		 			$('#cajacomentarioReunion').append(`<div class="card">
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
	                                         	<div id="${item['Id_observacion_reunion']}btnEnviarComentario">
                            						<button type="button" onclick="ResponderComentario('${item['Id_observacion_reunion']}')" class="btn btn-outline-dark btn-sm"><i class="fa fa-share"></i>  Responder</button>
                            					</div>
                            					</div>
                            				</div>
                            				<br>
                            				<div id="${item['Id_observacion_reunion']+'c'}"></div>
                            				<div id="${item['Id_observacion_reunion']+'s'}"></div>
                            				
                                         </div>
                                    </div>`);
		 			if($('#Terminada').hasClass('activado') || $('#Vencida').hasClass('activado')){
						$('#'+item['Id_observacion_reunion']+'btnEnviarComentario').html('');
					}

				   	$.each(item['sub_observaciones'], function(i2,item2){
						$('#'+item['Id_observacion_reunion']+'s').append(`<div class="card">
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


	//PARA LISTAR LAS OBSERVACIONES O COMENTARIOS
	function listaObservaciones(){
		 $.get('ObservacionesReuniones/'+$('#idReun').val(), function (data) {
	
		 	
		 	llenarComentarios(data);
		 	
		 });
	}