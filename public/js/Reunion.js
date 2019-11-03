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
		        	
		        if(data['FIN']=='1' && data['HIN']=='1'){
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
	                                    <td > <i class="fa fa-bullhorn" ></i> <a style="font-size:12px"  href="javascript:void(0);" onclick="ModalReunion(${$valores['Id_Reunion']})">${$valores['Tema']}</a></td>

	                                     <td><b>${$valores['Lugar']}</td>
	                                     <td><b>${$valores['FechadeReunion']} / ${$valores['HoraReunion']}</td>
	                                    <td><i class="fa fa-user"></i> ${$valores['usuario']['Nombre']} ${$valores['usuario']['Apellido']}</td>
	                                    <td id='${$valores['Id_Reunion']+'Responsable'}'>   
	                                    </td>
	                                    <td id='${$valores['Id_Reunion']+'Participantes'}'></td>
	                                    <td>${$valores['FechaCreacion']}</td>

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
					$.each(data, function(i1, $valore) { 
							llenarTabla($valore);
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


		//$("#ResponsablesReunion option:selected").remove();
	//$("#ResponsablesReunion option:selected").prop("title",`jhgf`)
	$("#ResponsablesReunion").val('');
	$("#ParticipantesReunion").val('');
	//  $("#ParticipantesReunion option:selected").attr("selected",false)
	// if($("#ResponsablesReunion option:selected")){
	// 	 $("#ResponsablesReunion").attr("selected",false)
	// }

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
	}

	function Usuarios(){
		$('#ResponsablesReunion').text('');
		 $.get('Usuarios', function (data) {
			 $.each(selectTextParticpantes, function(i, item) { 
                $('#ResponsablesReunion').append(`<option value="${$item['Id_Usuario']}" >${$v['Nombre']} ${$item['Apellido']}</option>`);
                $('#ParticipantesReunion').append(`<option value="${$item['Id_Usuario']}" >${$v['Nombre']} ${$item['Apellido']}</option>`);
   				
   			 });
		 });
	}


		//PARA EL MODAL DEL SEGUIMIENTO DE LA REUNION
	function ModalReunion(Id_reunion){
		// limpiarModalTareas();
		$("#ModalReunionSeguimiento").modal("show");
		$('#cargatareas').append(`<div id="preloader" style="background: #ffffff00">
		    <div class="loader"> 
		        <svg class="circular" viewBox="25 25 50 50">
		            <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		        </svg>

		    </div>
		</div>`);
		$('#ParticipantesReunionSeguimiento').html('');
		$('#ParticipantesReunionSeguimiento').html('');
		$('#TituloReunionSeguimiento').html('');
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
		    	$.each(item['participantes'], function(i2,item2){
					    	if(item2['asistencia']=='1'){
				    			var estado='checked';
				    		}else{
				    			var estado='';
				    		}
				    		if($('#SelecTipoUserReunion').val()=="CPM"   ){
				    			
				    			$('#PanelObservacion').html('');

				    		}else{
				    				$('#PanelObservacion').html('');
				    			$('#PanelObservacion').append(` <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Comentario:</b></label>
                                    <textarea class="form-control input-default" id="ObservacionReunionSeguimiento"></textarea><br>
                                    <div id="btnRegistrarObservacionReunion"><button onclick="RegistrarObservacionReunion()" type="button" class="btn btn-success btn-sm"><i class="fa fa-save"></i>  Registrar</button></div>`);
				    		}
				    		if($('#SelecTipoUserReunion').val()=="MisReunionesResponsables"   ){
							$('#ParticipantesReunionSeguimiento').append(`<tr >
					                                    <td > <i   class=" fa fa-user"></i> ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']} </td>
					                                     <td  centerDiv><div class="form-check form-check-inline">
			                                                <label class="form-check-label">
			                                                <input onclick="onToggle(${item['Id_Reunion']},${item2['usuario']['Id_Usuario']})" id="${item2['usuario']['Id_Usuario']+'AsistenciaChek'}" type="checkbox" class="form-check-input " ${estado}  value=""></label>
			                                            </div></td>
					                          
					                                </tr>`);
							$('#PanelConclusiones').html('');
							$('#botoneSeguimiento').html('');
							$('#PanelConclusiones').append(`<label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Conclusión:</b></label>
                                    <textarea rows="10" class="form-control input-default" id="ConclusionReunionSeguimiento"></textarea><br>`)
							$('#botoneSeguimiento').append(`<div class="row">
									                            <div class="col-md-6">
									                                <button onclick="TerminarTarea()" class="btn btn-success btn-block">Entregar Tarea</button>
									                            </div>
									                            <div class="col-md-6">
									                                <div class="btn-group">
									                                  <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									                                    Más
									                                  </button>

									                                </div>
									                            </div>
									                        </div> `);
							}else{
								$('#ParticipantesReunionSeguimiento').append(`<tr >
					                                    <td > <i   class=" fa fa-user"></i> ${item2['usuario']['Nombre']} ${item2['usuario']['Apellido']} </td>
					                                     <td  centerDiv><div class="form-check form-check-inline">
			                                                <label class="form-check-label">
		                                                    <input disabled type="checkbox" class="form-check-input " ${estado}  value=""></label>
			                                            </div></td>
					                          
					                                </tr>`);
								$('#PanelConclusiones').html('');
								$('#botoneSeguimiento').html('');
								$('#botoneSeguimiento').html('');
							}

		    	});
		    		   
	    	

			 //   	if($('#SelecTipoUserTareas').val()=="CPM"){
				// 	var btneditar=` <a  class="dropdown-item" href="javascript:void(0);" onclick="TareasEditar()"><i class="fa fa-pencil-square-o"></i>  Editar Tarea</a>`;
				// 	$('#PanelObservacion').html('');
				// 	$('#PanelEvidencias').html('');	
				// 	$('#botoneSeguimiento').html('');
				// 	$('#EstadoObservacion').html('');
				// 	$('#botoneSeguimiento').append(`<div class="row">
		  //                           <div class="col-md-6">
		  //                               <div class="btn-group">
		  //                                 <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  //                                   Más
		  //                                 </button>
		  //                                 <div class="dropdown-menu">
		  //                                   <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
		  //                                   <div id="btneditar">
		  //                                   ${btneditar}
		  //                                  </div>
		  //                                 </div>
		  //                               </div>
		  //                           </div>
		  //                       </div> `);
				// 	document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;
				// 	if($('#Terminada').hasClass('activado')){
				// 		$('#PanelObservacion').html('');
				// 		$('#PanelEvidencias').html('');	
				// 		$('#botoneSeguimiento').html('');
				// 		$('#EstadoObservacion').html('');
				// 	}
				// }else if($('#SelecTipoUserTareas').val()=="MisTareasResponsables"){
				// 	$('#EstadoObservacion').html('');
				// 	$('#PanelObservacion').html('');
				// 	$('#PanelObservacion').append(`
		  //                                   <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
		  //                                   <textarea class="form-control input-default" id="ObservacionTareaSeguimiento"></textarea><br>
		  //                                   <div id="btnRegistrarObservacion"><button onclick="RegistrarObservacion()" type="button" class="btn btn-success btn-sm">Registrar</button></div>
		  //                               `);
				// 	$('#PanelEvidencias').html('');
				// 	$('#PanelEvidencias').append(`<label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
				// 			                                    <div class="form-group">
				// 	    <input  type="file" class="form-control-file" id="filedoc">
				// 	  </div>
		  //                                   <button onclick="RegistrarEvidencias()" type="button" class="btn btn-success btn-sm">Registrar</button>`);
				// 	$('#botoneSeguimiento').html('');
				// 	$('#botoneSeguimiento').append(`<div class="row">
		  //                           <div class="col-md-6">
		  //                               <button onclick="TerminarTarea()" class="btn btn-success btn-block">Entregar Tarea</button>
		  //                           </div>
		  //                           <div class="col-md-6">
		  //                               <div class="btn-group">
		  //                                 <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  //                                   Más
		  //                                 </button>
		  //                                 <div class="dropdown-menu">
		  //                                   <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
		  //                                   <div id="btneditar">
		  //                                  </div>
		  //                                 </div>
		  //                               </div>
		  //                           </div>
		  //                       </div> `);
				// 	document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;

				// 	if($('#Terminada').hasClass('activado')){
				// 		$('#PanelObservacion').html('');
				// 		$('#PanelEvidencias').html('');	
				// 		$('#botoneSeguimiento').html('');
				// 	}
				// }else if($('#SelecTipoUserTareas').val()=="MisTareasParticipantes"){
				// 	$('#EstadoObservacion').html('');
				// 	$('#PanelObservacion').html('');
				// 	$('#PanelObservacion').append(`
		  //                                   <label for="" style="color: black"><i class="fa fa-comment-o"></i>  <b>Ingrese Observación:</b></label>
		  //                                   <textarea class="form-control input-default" id="ObservacionTareaSeguimiento"></textarea><br>
		  //                                   <div id="btnRegistrarObservacion"><button onclick="RegistrarObservacion()" type="button" class="btn btn-success btn-sm">Registrar</button></div>
		  //                               `);
				// 	$('#PanelEvidencias').html('');
				// 	$('#PanelEvidencias').append(`<label for="" style="color: black"><i class="fa fa-paperclip"></i>  <b>Adjuntar Evidencia:</b></label>
		  //                                   <div class="custom-file">
		  //                                       <input type="file" class="custom-file-input">
		  //                                       <label class="custom-file-label">Escoger Archivo</label> 
		  //                                   </div><br><br>
		  //                                   <button type="button" class="btn btn-success btn-sm">Registrar</button>`);
				// 	$('#botoneSeguimiento').html('');
				// 	$('#botoneSeguimiento').append(`<div class="row">
		  //                           <div class="col-md-6">
		  //                               <div class="btn-group">
		  //                                 <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  //                                   Más
		  //                                 </button>
		  //                                 <div class="dropdown-menu">
		  //                                   <a id="CrearSubtareaModal" class="dropdown-item"  href="javascript:void(0);" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear Subtarea</a>
		  //                                   <div id="btneditar">
		  //                                  </div>
		  //                                 </div>
		  //                               </div>
		  //                           </div>
		  //                       </div> `);
				// 	document.getElementById('CrearSubtareaModal').setAttribute('onclick',`CrearSubtarea(${item['Id_tarea']},'${item['Nombre']}', '${item['Id_Tipo_Tarea']}')`) ;

				// }else if($('#SelecTipoUserTareas').val()=="MisTareasObservadores"){
				// 	$('#PanelObservacion').html('');
				// 	$('#PanelEvidencias').html('');
				// 	$('#botoneSeguimiento').html('');
				// 	$('#EstadoObservacion').html('');
				// 	 $('#EstadoObservacion').append(`<div class="row"> 
				// 	 	<div class="col-md-12 ">   
				// 	      <div class="alert alert-info" role="alert">
				// 	        <div class="row vertical-align centerDiv">
				// 	          <div class="col-lg-1 text-center">
				// 	            <i class="fa fa-info fa-2x"></i> 
				// 	          </div>
				// 	          <div class="col-lg-11 centerDiv">
				// 	           <strong> Esta tarea se encuentra en estado&nbsp${item['Estado_Tarea']}.</strong>
				// 	          </div>
				// 	        </div>
				// 	      </div>      
		  //  				</div>
		 	// 			 </div> `)
				// 	if($('#Terminada').hasClass('activado')){
				// 		$('#PanelObservacion').html('');
				// 		$('#PanelEvidencias').html('');	
				// 		$('#botoneSeguimiento').html('');
				// 		$('#EstadoObservacion').html('');
				// 	}
				// }

	   		 	listaObservaciones();
	   	     	$('#cargatareas').fadeIn(1000).html(data); 
	   		});
		});

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


  //COMENTARIOS

  	//PARA GAUARDAS LAS OBSERVACIONES O COMENTARIOS
	function RegistrarObservacionReunion(){


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

	        	$('#btnRegistrarObservacionReunion').html(`<button type="button" onclick="RegistrarObservacionReunion()" class="btn btn-success btn-sm"><i class="fa fa-save"></i>   Registrar</button>`); 
	      		 $("#ObservacionReunionSeguimiento").val('');
	      		 listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
	}

		//BOTON REPOSNDER COMENTARIO
	function  ResponderComentario(id){
		$('#'+id+'btnEnviarComentario').html(`<button type="button" onclick="CerrarComentario(${id})" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>  Cerrar</button>
		`);
		$('#'+id+'c').html(`  <textarea class="form-control input-default" id="ObservacionRespuesta"></textarea><br>
                                <div id="btnResponderObservacion"><button onclick="RespuestaObservacion(${id})" type="button" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button></div>`);
	}

	//BOTON CERRAR COMENTARIO
	function  CerrarComentario(id){
		$('#'+id+'btnEnviarComentario').html(`<button type="button" onclick="ResponderComentario(${id})" class="btn btn-outline-dark btn-sm"><i class="fa fa-share"></i>  Responder</button>
		`);
		$('#'+id+'c').html('');
	}


	//GUARDAR RESPUESTA COMENTARIO
	function RespuestaObservacion(Id_Observacion){
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

	        	$('#btnResponderObservacion').html(`<button type="button" onclick="RespuestaObservacion(${Id_Observacion})" class="btn btn-success btn-sm"><i class="fa fa-send"></i>  Enviar</button>`); 
	      		 $('#'+Id_Observacion+'c').html('');
	      		 listaObservaciones();
	        },
	        error: function () { 
	            alertify.error(" Ocurrió un error, contactese con el Administrador.")
	        }
	    });
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