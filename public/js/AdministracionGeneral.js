

function RegistrarArea(){ 
	if($('#Area').val()!=''){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

		    var FrmData = { 
		    	Descripcion: $("#Area").val(),

		    }


		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'Area', // Url que se envia para la solicitud esta en el web php es la ruta
		        method: "POST", 

		        data: FrmData,
		        dataType: 'json',
		                       // Tipo de solicitud que se enviará, llamado como método
		        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		        {
		        	ListaAreas();
		        	ListaAreaRoles('F');
		        	$('#cargar').fadeIn(1000).html(data); 
		        	alertify.success("Registro exitoso!")
		        	CancelarActualizacionArea();
		        		document.getElementById('Area').setAttribute('title','Campo Obligatorio');
		        		$('#Area').tooltip( 'hide' );
		        	

		        },
		        error: function () {     
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{
			document.getElementById('Area').setAttribute('title','Campo Obligatorio');
			//$('#Area').setAttribute('title','Campo nose  qeu');
			$('#Area').tooltip('show');

		}

} 
//}


//LISTA LAS AREAS
function ListaAreas(){
    $.get('Area', function (data) {
        $("#table_Area").html("");
        $.each(data, function(i, item) { //recorre el data 
            	$("#table_Area").append(` <tr align="center">
                    <td> ${item['Descripcion']}</td>
                    <td><button onclick="EditarArea(${item['Id_Area']})"  type="button" class=" btn btn-info btn-sm">  <span class="ti-pencil-alt"></span></button> <button onclick="EliminarArea(${item['Id_Area']})"  type="button" class="btn btn-danger btn-sm" >  <span class="icon-trash"></span></button></td>
                 </tr>`);
        });      
    });
}

//MUESTRA EL CAMPO A EDITAR DEL AREA
function EditarArea(id){
    $.get('Area/'+id+'/edit', function (data) {
    	$("#inputId").html('');
    	$("#inputId").append(` <input hidden readonly type="text" id="IdAr" name="IdAr" value="${data['Id_Area']}" >`);
        $("#Area").val("");
        $("#IngresarArea").html("");
        $("#Area").val(data['Descripcion']);
        $("#IngresarArea").append(`<button onclick="ActualizarArea()" type="button" class="btn btn-warning btn-block">Actualizar </button> <button onclick="CancelarActualizacionArea()" type="button" class="btn btn-primary btn-block">Cancelar </button>`);
    	// $('#cargar').fadeIn(1000).html(data); 
    });
}

//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionArea(){
	$("#Area").val("");
	$("#IngresarArea").html("");
	$("#IngresarArea").append(`<button onclick="RegistrarArea()" type="button" class="btn btn-primary btn-block">Ingresar </button> `);

}

function ActualizarArea(){
	  $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	 var FrmData = { 
	    	Descripcion: $("#Area").val(),
	    	idAreas: $("#IdAr").val(),
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Area/'+$("#IdAr").val(), // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "PUT", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	            ListaAreas();
	            ListaAreaRoles('F');
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Actualizado!");
	        	CancelarActualizacionArea();
	        
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}


function EliminarArea($id){
	$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Area/'+$id, // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "DELETE", 
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	ListaAreas();
	        	ListaAreaRoles('F');
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Eliminado!")
	        	CancelarActualizacionArea();
	        	
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}



function RegistrarRol(){ 

	if($('#Rol').val()!=''){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

		    var FrmData = { 
		    	descripcion: $("#Rol").val(),
	
		        nivel: $("#nivelRol").val(),

		    }


		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'Roles', // Url que se envia para la solicitud esta en el web php es la ruta
		        method: "POST", 
		        data: FrmData,
		        dataType: 'json',
		                       // Tipo de solicitud que se enviará, llamado como método
		        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		        {
		        	//ListaRoles();
		        	$('#cargar').fadeIn(1000).html(data); 
		        	ListaRoles();
		        	ListaAreaRoles('F');
		        	alertify.success("Registro exitoso!");	
		        	CancelarActualizacionRol();	        	

		        },
		        error: function () {     
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{
			document.getElementById('Rol').setAttribute('title','Campo Obligatorio');
			//$('#Area').setAttribute('title','Campo nose  qeu');
			$('#Rol').tooltip('show');

		}

} 


function ListaRoles(){
    $.get('Roles', function (data) {
        $("#table_Rol").html("");
        $.each(data, function(i, item) { //recorre el data 
            	$("#table_Rol").append(` <tr align="center">
                    <td> ${item['Descripcion']}</td>
                    <td> ${item['nivel']}</td>
                    <td><button onclick="EditarRol(${item['Id_Roles']})"  type="button" class=" btn btn-info btn-sm">  <span class="ti-pencil-alt"></span></button> <button onclick="EliminarRol(${item['Id_Roles']})"  type="button" class="btn btn-danger btn-sm" >  <span class="icon-trash"></span></button></td>
                 </tr>`);
        });      
    });
}


//MUESTRA EL CAMPO A EDITAR DEL ROL
function EditarRol(id){
    $.get('Roles/'+id+'/edit', function (data) {
    	$("#inputIdRol").html('');
    	$("#inputIdRol").append(` <input hidden readonly type="text" id="IdRol" name="IdRol" value="${data['Id_Roles']}" >`);
        $("#Rol").val("");
        $("#nivelRol").html("");
        $("#IngresarRol").html('');
	        $("#Rol").val(data['Descripcion']);
	        $("#nivelRol").val(data['nivel']);
	        $("#AreaRol").val(data['Id_Area']);
	        $("#IngresarRol").append(`<button onclick="ActualizarRol()" type="button" class="btn btn-warning btn-block">Actualizar </button> <button onclick="CancelarActualizacionRol()" type="button" class="btn btn-primary btn-block">Cancelar </button>`);
	    	// $('#cargar').fadeIn(1000).html(data); 
	    
    });

}

//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionRol(){
	$("#Rol").val("");
	$("#nivelRol").val("");
	$("#IngresarRol").html('');
	$("#AreaRol").val("");
	$("#IngresarRol").append(`<button onclick="RegistrarRol()" type="button" class="btn btn-primary btn-block">Ingresar </button> `);

}


function ActualizarRol(){
	  $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	 var FrmData = { 
	    	Descripcion: $("#Rol").val(),
	    	Nivel: $("#nivelRol").val(),
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Roles/'+$("#IdRol").val(), // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "PUT", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	ListaRoles();
	        	ListaAreaRoles('F');
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Actualizado!")
	        	CancelarActualizacionRol();
	        
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}



function EliminarRol($id){
	$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Roles/'+$id, // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "DELETE", 
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	ListaRoles();
	        	ListaAreaRoles('F');
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Eliminado!")
	        	CancelarActualizacionRol();
	        	
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}


function validadorCampos(val){
	var resul=0;


	if($('#'+val).val() == ''){
		$('#'+val).addClass('invalid');
		
	}else{
		$('#'+val).addClass('valid');
		resul=1;

	}
	return resul;
	

}

function RegistrarUsuario(val){ 
	var Vnombre= validadorCampos('nombre'); 
	var Vapellido= validadorCampos('apellido');
	var Vcedula= validadorCampos('cedula');
	var Vdireccion=validadorCampos('direccion');
	var VCelular=validadorCampos('Celular');
	var VSexo = validadorCampos('Celular');
	var Vemail =validadorCampos('email');
	// var VRol =validadorCampos('Rol');
	var Vpassword = validadorCampos('password');
	var Varea=validadorCampos('Varea');


	
	
	
	
	
	// validadorCampos('nombre');
	// validadorCampos('nombre');
	// validadorCampos('nombre');
	// validadorCampos('nombre');


	if(Vnombre==1 && Vapellido==1 && Vcedula==1  && Vdireccion==1  && VCelular==1  && VSexo==1 && Vemail==1 && VRol==1 && Vpassword==1 && Varea==1 ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

		    var FrmData = { 
		    	Nombres: $("#nombre").val(),
		    	Apellidos: $("#apellido").val(),
		    	Cedula: $("#cedula").val(),
		    	Direccion: $("#direccion").val(),
		    	TipoUser: $("#tipoUser").val(),
		    	Celular: $("#Celular").val(),
		    	Sexo: $("#Sexo").val(),
		    	Email: $("#email").val(),
		    	Rol: $("#Rol").val(),
		    	Clave: $("#password").val(),
		    }


		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'Usuarios', // Url que se envia para la solicitud esta en el web php es la ruta
		        method: "POST", 
		        data: FrmData,
		        dataType: 'json',
		                       // Tipo de solicitud que se enviará, llamado como método
		        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		        {
		        if(val=='A'){
		        	 ListaUsuarios();
		        	
		        	$('#cargar').fadeIn(1000).html(data); 
		        	alertify.success("Registro exitoso!")
		        }else if (val=='Z'){
		        	window.location = "/login";

		        }
		        	// CancelarActualizacionArea();
		        	// 	document.getElementById('Area').setAttribute('title','Campo Obligatorio');
		        	// 	$('#Area').tooltip( 'hide' ); 	
		        },
		        error: function () {     
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{
			$('#MensajeAlerta').html('');
			$('#MensajeAlerta').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
		}

} 



function ListaUsuarios(){
    $.get('Usuarios', function (data) {
        $("#table_Usuarios").html("");
        $.each(data, function(i, item) { //recorre el data 
            	$("#table_Usuarios").append(` <tr align="center">
                    <td> ${item['Nombre']} ${item['Apellido']}</td>
                    <td> ${item['Cedula']}</td>
                    <td> ${item['Direccion']}</td>
                    <td> ${item['Id_tipo_Usuarios']}</td>
                    <td> ${item['email']}</td>
                    <td><button onclick="EditarUsuarios(${item['Id_Usuario']})"  type="button" class=" btn btn-info btn-sm">  <span class="ti-pencil-alt"></span></button> <button disabled onclick="EliminarRol(${item['Id_Usuario']})"  type="button" class="btn btn-danger btn-sm" >  <span class="icon-trash"></span></button></td>
                 </tr>`);
        });      
    });
}

//MUESTRA EL CAMPO A EDITAR DEL USUARIO
function EditarUsuarios(id){
    $.get('Usuarios/'+id+'/edit', function (data) {
    	console.log(data);
    	$("#inputIUS").html('');
    	$("#inputIUS").append(` <input hidden readonly type="text" id="IdUS" name="IdUS" value="${data['Id_Usuario']}" >`);
        $("#nombre").val("");
        $("#apellido").val("");
        $("#direccion").val("");
        $("#cedula").val("");
         $("#Celular").val("");
        // $("#tipoUser").val("");
        $("#email").html("");
        $("#password").prop("hidden",true);
        $("#passwordConfir").prop("hidden",true);
        $("#passwordLabel").prop("hidden",true);
    	$("#passwordConfirLabel").prop("hidden",true);
        $("#IngresarUser").html('');
         $.each(data, function(i, item) { //recorre el data 
	        $("#nombre").val(item['Nombre']);
	        $("#apellido").val(item['Apellido']);
	        $("#cedula").val(item['Cedula']);
	        $("#Celular").val(item['Celular']);
	        $("#direccion").val(item['Direccion']);
	        $("#tipoUser").val(item['Id_Tipo_Usuario']);
	        $("#Area").val(item['Id_Area']);
	        $("#Rol").val(item['Id_Roles']);
	        $("#email").val(item['email']);
	        $("#IngresarUser").append(`<div class="form-check mb-3">
                                        <label class="form-check-label">
                                        <input onclick="onToggle()" type="checkbox" id="ActClaveCHE" class="form-check-input" value="">Actualizar Contraseña</label>
                                            </div> <div class="row"> <div class="col-md-6"> <button onclick="ActualizarUsuario()" type="button" class="btn btn-warning btn-block">Actualizar </button></div> <div class="col-md-6"><button onclick="CancelarActualizacionUser()" type="button" class="btn btn-primary btn-block">Cancelar </button></div></div>`);
	    	// $('#cargar').fadeIn(1000).html(data); 
	    
    		});
    });

}


//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionUser(){
	$("#nombre").val("");
    $("#apellido").val("");
    $("#direccion").val("");
    $("#cedula").val("");
    $("#email").val("");
    $("#tipoUser").val('1');
    $("#Celular").val('');
	$("#IngresarUser").html('');
	$("#password").prop("hidden",false);
    $("#passwordConfir").prop("hidden",false);
    $("#passwordLabel").prop("hidden",false);
    $("#passwordConfirLabel").prop("hidden",false);
	$("#IngresarUser").append(`<button onclick="RegistrarUsuario()" type="button" class="btn btn-primary btn-block">Ingresar </button> `);

}

function ActualizarUsuario(){
	  $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	 var FrmData = { 
			Nombres: $("#nombre").val(),
	    	Apellidos: $("#apellido").val(),
	    	Cedula: $("#cedula").val(),
	    	Direccion: $("#direccion").val(),
	    	TipoUser: $("#tipoUser").val(),
	    	Email: $("#email").val(),
	    	Clave: $("#password").val(),
	    	ActClaveCHE: $("#ActClaveCHE").val(),	
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Usuarios/'+$("#IdUS").val(), // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "PUT", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	ListaUsuarios();
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Actualizado!");
	        	CancelarActualizacionUser();
	        
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}

//PARA EL CHECKBOX DE ACTUALIZAR CONTRASEÑA
  function onToggle() {
    // check if checkbox is checked

    if (document.querySelector('#ActClaveCHE').checked) {
    	$("#ActClaveCHE").val("1");
    	$("#password").prop("hidden",false);
    	$("#passwordLabel").prop("hidden",false);
    	$("#passwordConfirLabel").prop("hidden",false);
   	 	$("#passwordConfir").prop("hidden",false);
    } else {
    	$("#ActClaveCHE").val("0");
        $("#password").prop("hidden",true);
   	    $("#passwordConfir").prop("hidden",true);
   	    $("#passwordLabel").prop("hidden",true);
    	$("#passwordConfirLabel").prop("hidden",true);
    }
  }


function RolesArea(idAr) {
	$("#Rol").html('');
     $.get('RolesAreaID/'+idAr, function (data) {
     	$("#Rol").prop("disabled",false);
     	$.each(data, function(i, item) { //recorre el data  
    		$("#Rol").append(`<option value="${item['Id_Roles']}">${item['Rol']}</option>`);
        });  


	    
    });
}



function RegistrarAreaRol(){ 

	if($('#AreaROL').val()!=''){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

		    var FrmData = { 
		    	IdArea: $("#AreaROL").val(),
	
		        IdRol: $("#ROL_A").val(),

		    }


		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'AreasRoles', // Url que se envia para la solicitud esta en el web php es la ruta
		        method: "POST", 
		        data: FrmData,
		        dataType: 'json',
		                       // Tipo de solicitud que se enviará, llamado como método
		        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		        { 
		        	$('#cargar').fadeIn(1000).html(data); 
		        	ListaAreaRoles('I');
		        	
		        	// ListaRoles();
		        
		        	// CancelarActualizacionRol();	        	

		        },
		        error: function () {     
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{
			document.getElementById('Rol').setAttribute('title','Campo Obligatorio');
			//$('#Area').setAttribute('title','Campo nose  qeu');
			$('#Rol').tooltip('show');

		}

} 


//MUESTRA EL CAMPO A EDITAR DEL ROL
function EditarAreaRol(id){

    $.get('AreasRoles/'+id+'/edit', function (data) {
    	$("#inputIdAreaRol").html('');
    	$("#inputIdAreaRol").append(` <input hidden readonly type="text" id="IdAreaRol" name="IdAreaRol" value="${data['Id_Area_Roles']}" >`);
        // $("#AreaROL").val("");
        // $("#ROL_A").html("");
        $("#IngresarAreaRol").html('');
	        $("#AreaROL").val(data['Id_Area']);
	        $("#ROL_A").val(data['Id_Roles']);
	        $("#IngresarAreaRol").append(`<button onclick="ActualizarAreaRol()" type="button" class="btn btn-warning btn-block">Actualizar </button> <button onclick="CancelarActualizacionAreaRol()" type="button" class="btn btn-primary btn-block">Cancelar </button>`);
	    	// $('#cargar').fadeIn(1000).html(data); 
	    
    });

}


//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionAreaRol(){
	 $("#IngresarAreaRol").html('');
	 $("#AreaROL").val('0');
	 $("#ROL_A").val('0');
	$("#IngresarAreaRol").append(`<button onclick="RegistrarAreaRol()" type="button" class="btn btn-primary btn-block">Ingresar </button> `);

}


function ActualizarAreaRol(){
	$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	 var FrmData = { 
		    	IdArea: $("#AreaROL").val(),
		        IdRol: $("#ROL_A").val(),
		      
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'AreasRoles/'+$("#IdAreaRol").val(), // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "PUT", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	  $('#cargar').fadeIn(1000).html(data); 
	  			ListaAreaRoles('A');
	        	
	        	
	        
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}


function ListaAreaRoles(tipoT){
//F= actualizar desde otras transacciones
	if(tipoT != 'F'){
		  $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);
		}

    $.get('DistintAreas', function (data1) {
    	$.get('AreasRoles', function (data) {
    	
        $("#table_Area_Rol").html("");
	        $.each(data1, function(i, item) { //recorre el data 
	            	$("#table_Area_Rol").append(` <tr align="center">
	                    <td id="${item['Id_Area']+'areas'}">${item['Area']}</td>
	                    <td id="${item['Id_Area']+'roles'}"> </td>
	                 </tr>`);

	            	$.each(data, function(i, item2) { //recorre el data 
	            		if(item['Area']==item2['Area'])            		//console.log(id);

	            		$("#"+item['Id_Area']+'roles').append(`<div  class="row">
	            		 <div style="padding-top: 10px"  class="col-md-7">
							<center>    ${item2['Rol']}</center></div>
                              <div class="col-md-5" style="padding-top: 3px">
                              <button  type="button" class=" btn btn-info btn-sm" onclick="EditarAreaRol(' ${item2['Id_area_roles']}')">  <span class="ti-pencil-alt"></span></button>  <button  type="button" class=" btn btn-danger btn-sm" onclick="EliminarAreaRoles('${item2['Id_area_roles']}')">  <span class="icon-trash"></span></button></div>
                               </div> `);
	       			 });

	        });    
	        $('#cargar').fadeIn(1000).html(data); 
	        CancelarActualizacionAreaRol();
	        if(tipoT=='A'){
	        	alertify.success("Registro Actualizado!")
	        }else if(tipoT=='I'){
	        	alertify.success("Registro Exitoso!")
	        }else if(tipoT=='E'){
	        	alertify.success("Registro Eliminado!")
	        }


	  });      	
    });
}


function EliminarAreaRoles($id){
	$('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'AreasRoles/'+$id, // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "DELETE", 
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	          $('#cargar').fadeIn(1000).html(data); 
	        	ListaAreaRoles('E');
	        
	        	// alertify.success("Registro Eliminado!")
	        	
	        },
	        error: function () {     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}