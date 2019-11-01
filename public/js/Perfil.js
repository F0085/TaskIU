//MOSTRAR VENTANA EDITAR PERFIL 
function VistaEditarPerfil(){
	$('#cardPefil').hide();
    $('#cardPefil').prop('hidden',true);
	$('#editPerfil').hide();
    $('#editPerfil').prop('hidden',false);
    $('#editPerfil').show(500);
    $('#bntEditarPerfil').html('');
    $('#bntEditarPerfil').append(`<button id="atcUser" onclick="ActualizarUsuario()" class="btn btn-warning px-5">Actualizar</button>
    							<button id="canUser" onclick="CancelarEditarPerfil()" class="btn btn-info px-5">Cancelar</button>`)
}
//CANCELAR EDITAR PERFIL
function CancelarEditarPerfil(){
	$('#cardPefil').hide();
    $('#cardPefil').prop('hidden',false);
    $('#cardPefil').show(500);
    $('#editPerfil').hide();
    $('#editPerfil').prop('hidden',true);
}

//ACTUALIZAR USUARIO
function ActualizarUsuario(){
	 	$('#atcUser').html(`<i class="fa fa-spinner"></i>   Espere....`);
	 	$('#atcUser').prop('disabled',true);
	 	$('#canUser').prop('disabled',true);
	 	var FrmData = { 
			Nombres: $("#NombrePerfil").val(),
	    	Apellidos: $("#ApellidoPerfil").val(),
	    	Cedula: $("#CedulaPerfil").val(),
	    	Direccion: $("#DireccionPerfil").val(),
	    	Celular: $("#CelularPerfil").val(),
	    	FechaNacimiento: $("#FechaNacimientoPerfil").val(),
	    	Instagram: $("#InstagramPerfil").val(),
	    	Facebook: $("#FacebookPerfil").val(),
	    	Twitter: $("#TwitterPerfil").val(),
	    	Intereses: $("#InteresesPerfil").val(),
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'ActPerfil/'+$("#IDus").val(), // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "PUT", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	

	        	window.location.href='/Perfil';
	        
	        },
	        error: function () {     

	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}

function Cambiarclave(){
	$('#Cambio_Contraseña_Modal').modal();
	$('#mensajeModalClave').html('');
	$('#passwordActaul').val('');
	$('#passwordCambio').val('');
	$('#password-confirmCambio').val('');

}

function CerrarSesion(){
    location.href = "/logout";
}

//ACTUALIZAR USUARIO
function ActualizarClave(){
	if($("#passwordCambio").val() == '' || $("#passwordActaul").val() == '' || $("#password-confirmCambio").val() == ''  ){
		$('#mensajeModalClave').html('');
		$('#mensajeModalClave').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Atención!</strong> Faltan campos por llenar.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div`);
		$('#mensajeModalClave').hide();
	    $('#mensajeModalClave').prop('hidden',false);
	    $('#mensajeModalClave').show(500);
	}else{
	 	var FrmData = { 
			Password: $("#passwordCambio").val(),
			PasswordAtc: $("#passwordActaul").val(),
			PasswordConfir: $("#password-confirmCambio").val(),

	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'CambiarClave/', // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "put", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	if(data ==0){
	        		$('#mensajeModalClave').html('');
					$('#mensajeModalClave').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> La contraseña actual no es la correcta.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div`);
					$('#mensajeModalClave').hide();
			        $('#mensajeModalClave').prop('hidden',false);
			        $('#mensajeModalClave').show(500);
	        	}else if(data ==1){
	        		
	        		$('#mensajeModalClave').html('');
					$('#mensajeModalClave').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> Las contraseñas no coinciden.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div`);
					$('#mensajeModalClave').hide();
			        $('#mensajeModalClave').prop('hidden',false);
			        $('#mensajeModalClave').show(500);

	        	}else {
	        	    $('#mensajeModalClave').html('');
					$('#mensajeModalClave').append(`<div class="alert alert-info alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> La contraseña se actualizó correctamente en unos segundos tu sesión se cerrará para ingresar con la nueva contraseña.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div`);
					$('#mensajeModalClave').hide();
			        $('#mensajeModalClave').prop('hidden',false);
			        $('#mensajeModalClave').show(500);
			        setTimeout("CerrarSesion()", 600);

	        	}
	        	

	        	// window.location.href='/Perfil';
	        
	        },
	        error: function () {     

	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 
	}
}

function ModalPerfilUsuario(IDus){
	$("#ModalPerfilUsuario").modal("show");
	$.get('Usuarios/'+IDus, function (data) {
		console.log(data['Nombre']);
		$('#NombreUserP').html(data['Nombre']+' '+data['Apellido']);
		$('#TipoUserP').html(data['TipoUsuario']);
		$('#CedulaUserP').html(`<b><i class="fa fa-address-card-o"></i>  Cédula:</b> ${data['Cedula']}`);
		$('#EmailUserP').html(`<b><i class="fa fa-envelope"></i>    Email:</b> ${data['email']}` );
		$('#CelularUserP').html(`<b><i class="fa fa-phone"></i>    Celular:</b> ${data['Celular']}`);
		$('#DireccionUserP').html(`<b><i class="fa  fa-map-marker"></i>    Dirección:</b>  ${data['Direccion']}`);
		$('#SexoUserP').html(`<b><i class="fa fa-venus-double"></i>    Sexo:</b>  ${data['Sexo']}`);
		// $('#EdadUserP').html(data['Nombre']+' '+data['Apellido']);
		// $('#InstagramUserP').html(data['Nombre']+' '+data['Apellido']);
		// $('#FacebookUserP').html(data['Nombre']+' '+data['Apellido']);
		// $('#TwitterUserP').html(data['Nombre']+' '+data['Apellido']);
		// $('#InteresesUserP').html(data['Nombre']+' '+data['Apellido']);
	});
}