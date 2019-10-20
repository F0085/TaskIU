
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

		        },
		        error: function () {     
		        	$('#cargar').fadeIn(1000).html(''); 
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{

		    $('#mensajeArea').html('');
			$('#mensajeArea').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			$('#mensajeArea').hide();
	        $('#mensajeArea').prop('hidden',false);
	        $('#mensajeArea').show(500);


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
    	CancelarActualizacionArea();
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
	$("#mensajeArea").html("");
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
	        	$('#cargar').fadeIn(1000).html('');  
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
	        	$('#cargar').fadeIn(1000).html('');   
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}

//REGISTRO DE SUBAREAS 
function RegistrarSubArea(){ 
	if($('#AreaSubArea').val()!=0 && $('#SubAreaInp').val() != '' ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

		    var FrmData = { 
		    	Descripcion: $("#SubAreaInp").val(),
		    	Id_Area: $("#AreaSubArea").val()

		    }
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'SubArea', // Url que se envia para la solicitud esta en el web php es la ruta
		        method: "POST", 

		        data: FrmData,
		        dataType: 'json',
		                       // Tipo de solicitud que se enviará, llamado como método
		        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		        {
		        	ListaSubArea();
		        	// ListaAreaRoles('F');
		        	$('#cargar').fadeIn(1000).html(data); 
		        	alertify.success("Registro exitoso!")
		        	 CancelarActualizacionSubArea();	        	

		        },
		        error: function () {  
		            $('#cargar').fadeIn(1000).html('');    
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{

		    $('#mensajeSubArea').html('');
			$('#mensajeSubArea').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			$('#mensajeSubArea').hide();
	        $('#mensajeSubArea').prop('hidden',false);
	        $('#mensajeSubArea').show(500);


		}

} 

//LISTAR SUBAREAS
function ListaSubArea(){
    $.get('AreaSubArea', function (data) {
        $("#table_SubArea").html("");
        $.each(data, function(i, item) { //recorre el data 
            	$("#table_SubArea").append(` <tr align="center">
                    <td> ${item['Area']}</td>
                    <td> ${item['SubArea']}</td>
                    <td><button onclick="EditarSubArea(${item['Id_Sub_Area']})"  type="button" class=" btn btn-info btn-sm">  <span class="ti-pencil-alt"></span></button> <button onclick="EliminarSubArea(${item['Id_Sub_Area']})"  type="button" class="btn btn-danger btn-sm" >  <span class="icon-trash"></span></button></td>
                 </tr>`);
        });      
    });
}

//MUESTRA LOS CAMPOS A EDITAR DE LAS SUBAREAS
function EditarSubArea(id){
    $.get('SubArea/'+id+'/edit', function (data) {	
    	//CancelarActualizacionArea();
    	$("#inputIdSubArea").html('');
    	$("#inputIdSubArea").append(` <input hidden readonly type="text" id="IdSubAr" name="IdSubAr" value="${data['Id_Sub_Area']}" >`);
        $("#AreaSubArea").val(data['Id_Area']);
        $("#IngresarSubArea").html("");
        $("#SubAreaInp").val(data['Descripcion']);
        $("#IngresarSubArea").append(`<button onclick="ActualizarSubArea()" type="button" class="btn btn-warning btn-block">Actualizar </button> <button onclick="CancelarActualizacionSubArea()" type="button" class="btn btn-primary btn-block">Cancelar </button>`);
    	// $('#cargar').fadeIn(1000).html(data); 
    });
}


//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionSubArea(){
	$('#mensajeSubArea').html('');
	$("#AreaSubArea").val("0");
	$("#SubAreaInp").val("");
	$("#IngresarSubArea").html('');
	$("#inputIdSubArea").html("");
	$("#IngresarSubArea").append(`<button onclick="RegistrarSubArea()" type="button" class="btn btn-primary btn-block">Ingresar </button> `);

}

//ACTUALIZACION DE SUBAREAS 
function ActualizarSubArea(){ 
	if($('#AreaSubArea').val()!=0 && $('#SubAreaInp').val() != '' ){
	   $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
	        <div class="loader"> 
	            <svg class="circular" viewBox="25 25 50 50">
	                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
	            </svg>Espere...

	        </div>
	    </div>`);

		    var FrmData = { 
		    	Descripcion: $("#SubAreaInp").val(),
		    	Id_Area: $("#AreaSubArea").val()
		    }


		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url: 'SubArea/'+$("#IdSubAr").val(), // Url que se envia para la solicitud esta en el web php es la ruta
		        method: "PUT", 

		        data: FrmData,
		        dataType: 'json',
		                       // Tipo de solicitud que se enviará, llamado como método
		        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		        {
		        	ListaSubArea();
		        	// ListaAreaRoles('F');
		        	$('#cargar').fadeIn(1000).html(data); 
		        	alertify.success("Registro Actualizado!")
		        	 CancelarActualizacionSubArea();	        	

		        },
		        error: function () {   
		        $('#cargar').fadeIn(1000).html('');   
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{

		    $('#mensajeSubArea').html('');
			$('#mensajeSubArea').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			$('#mensajeSubArea').hide();
	        $('#mensajeSubArea').prop('hidden',false);
	        $('#mensajeSubArea').show(500);


		}

} 

function EliminarSubArea($id){
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
	        url: 'SubArea/'+$id, // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "DELETE", 
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
		        	ListaSubArea();
		        	$('#cargar').fadeIn(1000).html(data); 
		        	alertify.success("Registro Eliminado!")
		        	CancelarActualizacionSubArea();	
	        	
	        },
	        error: function () {  
	        	$('#cargar').fadeIn(1000).html('');   
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}


//MUESTRA EL CAMPO A EDITAR DEL ROL
function EditarRol(id){
    $.get('Roles/'+id+'/edit', function (data) {

    	$.each(data, function(i, item) {
    		AreaSubARol(item['Id_Area'],item['Id_Sub_Area']);
	    	$("#inputIdRol").html('');
	    	$("#inputIdRol").append(` <input hidden readonly type="text" id="IdRol" name="IdRol" value="${item['Id_Roles']}" >`);
	        $("#IngresarRol").html('');
	        $("#AreaROL").val(item['Id_Area']);
	        $("#SubArea_A_ROL").val(item['Id_Sub_Area']);
	        $("#ROL_A_ROL").val(item['Rol']);
	        $("#IngresarRol").append(`<button onclick="ActualizarRol()" type="button" class="btn btn-warning btn-block">Actualizar </button> <button onclick="CancelarActualizacionRol()" type="button" class="btn btn-primary btn-block">Cancelar </button>`);
		 });
    });

}

//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionRol(){
	$('#inputIdRol').html('');
	$("#IngresarRol").html("");
	$("#AreaROL").val("0");
	$("#SubArea_A_ROL").val('0');
	$("#SubArea_A_ROL").prop('disabled',true);
	$("#ROL_A_ROL").val("");
	$("#IngresarRol").append(`<button onclick="RegistrarRol()" type="button" class="btn btn-primary btn-block">Ingresar </button> `);

}

function IngresarRol(){
	if($('#SubArea_A_ROL').val()!=0 && $('#ROL_A_ROL').val() != '' ){
	  $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);
	 var FrmData = { 
	    	Descripcion: $("#ROL_A_ROL").val(),
	    	Id_Sub_Area: $("#SubArea_A_ROL").val()
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
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	ListarRol();
	        	// ListaAreaRoles('F');
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro exitoso!")
	        	CancelarActualizacionRol();
	        
	        },
	        error: function () {   
	        $('#cargar').fadeIn(1000).html('');   
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 
	}else{
			$('#mensajeRol').html('');
			$('#mensajeRol').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			$('#mensajeRol').hide();
	        $('#mensajeRol').prop('hidden',false);
	        $('#mensajeRol').show(500);

	}

}

function ListarRol(){
	 $.get('Roles', function (data) {
        $("#table_Roles").html("");
        $.each(data, function(i, item) { //recorre el data 
            	$("#table_Roles").append(` <tr align="center">
                    <td> ${item['Area']}</td>
                    <td> ${item['Sub_Area']}</td>
                    <td> ${item['Rol']}</td>
                    <td><button onclick="EditarRol(${item['Id_Roles']})"  type="button" class=" btn btn-info btn-sm">  <span class="ti-pencil-alt"></span></button> <button onclick="EliminarRol(${item['Id_Roles']})"  type="button" class="btn btn-danger btn-sm" >  <span class="icon-trash"></span></button></td>
                 </tr>`);
        });      
    });
}

function ActualizarRol(){
	if($('#SubArea_A_ROL').val()!=0 && $('#ROL_A_ROL').val() != '' ){
	  $('#cargar').append(`<div id="preloader" style="background: #ffffff00">
        <div class="loader"> 
            <svg class="circular" viewBox="25 25 50 50">
                <circle   class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>Espere...

        </div>
    </div>`);
	 var FrmData = { 
	    	Descripcion: $("#ROL_A_ROL").val(),
	    	Id_Sub_Area: $("#SubArea_A_ROL").val()
	    }


	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url: 'Roles/'+$('#IdRol').val(), // Url que se envia para la solicitud esta en el web php es la ruta
	        method: "PUT", 
	        data: FrmData,
	                       // Tipo de solicitud que se enviará, llamado como método
	        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
	        {
	        	ListarRol();
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Actualizado!")
	        	CancelarActualizacionRol();
	        
	        },
	        error: function () {   
	        $('#cargar').fadeIn(1000).html('');   
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 
	}else{
			$('#mensajeRol').html('');
			$('#mensajeRol').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			$('#mensajeRol').hide();
	        $('#mensajeRol').prop('hidden',false);
	        $('#mensajeRol').show(500);

	}

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
	        	// ListaRoles();
	        	ListarRol();
	        	$('#cargar').fadeIn(1000).html(data); 
	        	alertify.success("Registro Eliminado!")
	        	CancelarActualizacionRol();
	        	
	        },
	        error: function () { 
	        $('#cargar').fadeIn(1000).html('');     
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}

//PARA VALIDAR LOS INPUST QUE NO SEAN VACIOS
function validadorCampos(val){
	var resul=0;
	if($('#'+val).val() == '' || $('#'+val).val() == '0' ){
		$('#'+val).removeClass('valid');
		$('#'+val).addClass('invalid');
		
	}else{
		$('#'+val).removeClass('invalid');
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
		 $('#'+val).addClass('invalid');
		}else if($('#'+val).hasClass('invalid')){
		 $('#'+val).removeClass('invalid');
		 $('#'+val).addClass('valid');

		}
		
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

//LIMPIAR LOS CAMPOS DEL FORMULARIO DE REGISTRO DE USUARIOS
function limpiarCampos(){
	$('#MensajeAlerta').html('');
	$("#nombre").val('');
	$("#apellido").val('');
	$("#cedula").val('');
	$("#direccion").val('');
	$("#tipoUser").val('0');
	$("#Celular").val('');
	$("#Sexo").val('0');
	$("#email").val('');
	$("#Rol").html('');
	$("#Rol").append(`<option selected value="0">Seleccion Rol...</option>`);
	$("#Rol").prop('disabled',true);
	$("#password").val('');
	$("#passwordConfir").val('');
	$("#Area").val('0');
	$("#SubArea").append(`<option selected value="0">Seleccion Rol...</option>`);
	$('#MensajeAlerta').val('');
	eliminarclaseInput('nombre');
	eliminarclaseInput('apellido');
	eliminarclaseInput('cedula');
	eliminarclaseInput('direccion');
	eliminarclaseInput('tipoUser');
	eliminarclaseInput('Celular');
	eliminarclaseInput('Sexo');
	eliminarclaseInput('email');
	eliminarclaseInput('Rol');
	eliminarclaseInput('password');
	eliminarclaseInput('passwordConfir');
	eliminarclaseInput('Area');
	eliminarclaseInput('SubArea');
}


function RegistrarUsuario(val){ 
	var Vnombre= validadorCampos('nombre'); 
	var Vapellido= validadorCampos('apellido');
	var Vcedula= validadorCampos('cedula');
	var Vdireccion=validadorCampos('direccion');
	var VCelular=validadorCampos('Celular');
	var VSexo = validadorCampos('Celular');
	var Vemail =validadorCampos('email');
	var VRol =validadorCampos('Rol');
	var VtipoUser =validadorCampos('tipoUser');
	var Varea =validadorCampos('Area');
	var VSubarea =validadorCampos('SubArea');
	var Vsexo =validadorCampos('Sexo');
	var Vpassword = validadorCampos('password');
	var Vpasswordconfirm = validadorCampos('passwordConfir');

	if(VSubarea ==1 && Vnombre==1 && Vapellido==1 && Vcedula==1  && Vdireccion==1  && VCelular==1  && VSexo==1 && Vemail==1 && VRol==1 && Vpassword==1 && Varea==1 && Vpasswordconfirm==1 && VtipoUser==1 && VRol==1 && Varea==1 && Vsexo==1){
	  if($("#password").val()== $("#passwordConfir").val()){
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
		        Id_Area: $("#Area").val()
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
		        	console.log(data);
		        if(data!=1){
			        if(val=='A'){
			        	 ListaUsuarios();
			        	 limpiarCampos();
			        	$('#cargar').fadeIn(1000).html(data); 
			        	alertify.success("Registro exitoso!")
			        }else if (val=='Z'){

			        	$('#contenidoRegister').html('');
			        	$('#MensajeAlerta').html('');
    					$('#MensajeAlerta').append(`<div align="center" style="font-size:16px " class="alert alert-info alert-dismissible fade show" role="alert">
						  <strong>Atención!</strong> USUARIO REGISTRADO CORRECTAMENTE POR FAVOR <a href="/login"><b><u> INICIAR SESIÓN.</u> </a>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div`);
					    $('#cargar').fadeIn(1000).html(''); 

						
			        	// window.location = "/login";

			        }
		        }else{
		        	$('#cargar').fadeIn(1000).html(''); 
		        	$('#MensajeAlerta').html('');
					$('#MensajeAlerta').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Atención!</strong> El Usuario ya se encuentra registrado.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div`);
					// if($('#cedula').hasClass('valid')){
					//  $('#cedula').removeClass('valid');
					//  $('#cedula').addClass('invalid');
					// }
					if($('#email').hasClass('valid')){
					 $('#email').removeClass('valid');
					 $('#email').addClass('invalid');
					}
		        }
		        },
		        error: function () {   
		        	$('#cargar').fadeIn(1000).html('');   
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    });
		  }else{
		  	$('#MensajeAlerta').html('');
			$('#MensajeAlerta').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Las contraseñas no coinciden.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			if($('#password').hasClass('valid')){
			 $('#password').removeClass('valid');
			 $('#password').addClass('invalid');
			}
			if($('#passwordConfir').hasClass('valid')){
			 $('#passwordConfir').removeClass('valid');
			 $('#passwordConfir').addClass('invalid');
			}
				
			
		  } 
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
                    <td> ${item['TipoUsuario']}</td>
                    <td> ${item['email']}</td>
                    <td><button onclick="EditarUsuarios(${item['Id_Usuario']})"  type="button" class=" btn btn-info btn-sm">  <span class="ti-pencil-alt"></span></button> <button disabled onclick="EliminarRol(${item['Id_Usuario']})"  type="button" class="btn btn-danger btn-sm" >  <span class="icon-trash"></span></button></td>
                 </tr>`);
        });      
    });
}

//MUESTRA EL CAMPO A EDITAR DEL USUARIO
function EditarUsuarios(id){
	 limpiarCampos();
    $.get('Usuarios/'+id+'/edit', function (data) {
    	// RolesArea(data['Id_Area'],data['Id_Roles']);
    	AreaSubARegisUser(data['Id_Area'],data['Id_Sub_Area'])
    	SubAreaRoles(data['Id_Sub_Area'],data['Id_Roles']);
    	$("#inputIUS").html('');
    	$("#inputIUS").append(` <input hidden readonly type="text" id="IdUS" name="IdUS" value="${data['Id_Usuario']}" >`);
        $("#password").prop("hidden",true);
        $("#passwordConfir").prop("hidden",true);
        $("#passwordLabel").prop("hidden",true);
    	$("#passwordConfirLabel").prop("hidden",true);
        $("#IngresarUser").html('');
        $("#nombre").val(data['Nombre']);
        $("#apellido").val(data['Apellido']);
        $("#cedula").val(data['Cedula']);
        $("#Celular").val(data['Celular']);
        $("#direccion").val(data['Direccion']);
        $("#tipoUser").val(data['Id_Tipo_Usuario']);
        $("#Area").val(data['Id_Area']);
        // $("#SubArea").val(data['SubArea']);
        $("#Sexo").val(data['Sexo']);
        // $("#Rol").val(data['Id_Roles']);
        $("#email").val(data['email']);
        $("#IngresarUser").append(`<div class="form-check mb-3">
                                    <label class="form-check-label">
                                    <input onclick="onToggle()" type="checkbox" id="ActClaveCHE" class="form-check-input" value="">Actualizar Contraseña</label>
                                        </div> <div class="row"> <div class="col-md-6"> <button onclick="ActualizarUsuario()" type="button" class="btn btn-warning btn-block">Actualizar </button></div> <div class="col-md-6"><button onclick="CancelarActualizacionUser()" type="button" class="btn btn-primary btn-block">Cancelar </button></div></div>`);
    	// $('#cargar').fadeIn(1000).html(data); 
    });

}


//CANCELA LA ACTUALIZACIÓN
function CancelarActualizacionUser(){
	limpiarCampos();
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
	    	Id_Area:$("#Area").val(),
	    	Id_Rol:$("#Rol").val(),
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
	        	$('#cargar').fadeIn(1000).html(''); 
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

// SE CARGA EL COMBO DE LOS ROLES DE ACUERDO AL AREA
function RolesArea(idAr,rol) {
	if(rol== 0){
	borderInput('Area');
	}
	if(idAr!= 0){
		$("#Rol").html('');
	     $.get('RolesAreaID/'+idAr, function (data) {
	     	$("#Rol").prop("disabled",false);
	     	$("#Rol").append(`<option value="0">Seleccione el Rol</option>`);
	     	$.each(data, function(i, item) { //recorre el data  
	     		if(item['Id_Roles']==rol){
	    			$("#Rol").append(`<option selected value="${item['Id_Roles']}">${item['Rol']}</option>`);
	    		}else{
	    			$("#Rol").append(`<option value="${item['Id_Roles']}">${item['Rol']}</option>`);

	    		}
	        });  	    
	    });
    }else{
    	$("#Rol").html('');
		$("#Rol").prop("disabled",true);
	    $("#Rol").append(`<option value="0">Seleccione el Rol</option>`);
	    if($('#'+val).hasClass('valid')){
		 $('#'+val).removeClass('valid');
		}else if($('#'+val).hasClass('invalid')){
		 $('#'+val).removeClass('invalid');
		}
    }
}



function RegistrarAreaRol(){ 

	if($('#AreaROL').val()!='0' && $("#ROL_A").val()!='0' ){
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
		        	
		        	CancelarActualizacionAreaRol();
		        
		        	// CancelarActualizacionRol();	        	

		        },
		        error: function () {     
		        	$('#cargar').fadeIn(1000).html(''); 
		            alertify.error("Ocurrió un error, contactese con el Administrador.")
		        }
		    }); 
		}else{
	    	$('#mensajeAreaRol').html('');
			$('#mensajeAreaRol').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong>Atención!</strong> Faltan campos por llenar.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div`);
			$('#mensajeAreaRol').hide();
	        $('#mensajeAreaRol').prop('hidden',false);
	        $('#mensajeAreaRol').show(500);

		}

} 


//MUESTRA EL CAMPO A EDITAR DEL ROL
function EditarAreaRol(id){


    $.get('AreasRoles/'+id+'/edit', function (data) {
    	CancelarActualizacionAreaRol();
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
	 $('#mensajeAreaRol').html('');
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
	  			CancelarActualizacionAreaRol();
	        	
	        	
	        
	        },
	        error: function () {  
	            $('#cargar').fadeIn(1000).html('');    
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

    $.get('AreasRoles', function (data) {    	
        $("#table_Area_Rol").html("");
	        $.each(data, function(i, item) { //recorre el data 
	            	$("#table_Area_Rol").append(` <tr align="center">
	                    <td>${item['Area']}</td>
	                    <td>${item['Sub_Area']}</td>
	                    <td>${item['Rol']}</td>
	                    <td align="center">
                            <div class="col-md-12">
                                 <div  style="padding-top: 3px">
	                                <button  type="button" class=" btn btn-info btn-sm" onclick="EditarAreaRol('${item['Id_Roles']}')">  <span class="ti-pencil-alt"></span></button>  
	                                <button  type="button" class=" btn btn-danger btn-sm" onclick="EliminarAreaRoles('${item['Id_Roles']}')">  <span class="icon-trash"></span></button>
                                </div>
                            </div>
	                    </td>
	                 </tr>`);
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
	            $('#cargar').fadeIn(1000).html('');   
	            alertify.error("Ocurrió un error, contactese con el Administrador.")
	        }
	    }); 

}



// SE CARGA EL COMBO DE LAS SUBAREAS DE ACUERDO AL AREA
function AreaSubARol(idAr,idsubArea) {
		$("#SubArea_A_ROL").html('');
		$("#SubArea_A_ROL").append(`<option selected">Cargando....</option>`);
	     $.get('SubAreaPorArea/'+idAr, function (data) {
	     	$("#SubArea_A_ROL").html('');
	     	$("#SubArea_A_ROL").prop("disabled",false);
	     	$("#SubArea_A_ROL").append(`<option value="0">Seleccione el Rol</option>`);
	     	$.each(data, function(i, item) { //recorre el data  
	     		if(idsubArea == item['Id_Sub_Area']){
	    			$("#SubArea_A_ROL").append(`<option selected value="${item['Id_Sub_Area']}">${item['Descripcion']}</option>`);
	    		}else{
	    			$("#SubArea_A_ROL").append(`<option value="${item['Id_Sub_Area']}">${item['Descripcion']}</option>`);	    		}
	        });  	    
	    });
}

// SE CARGA EL COMBO DE LAS SUBAREAS DE ACUERDO AL AREA
function AreaSubARegisUser(idAr,idsubArea) {
		$("#SubArea").html('');
		$("#SubArea").append(`<option selected">Cargando....</option>`);
	     $.get('SubAreaPorArea/'+idAr, function (data) {
	     	$("#SubArea").html('');
	     	$("#SubArea").prop("disabled",false);
	     	$("#SubArea").append(`<option value="0">Seleccione el Rol</option>`);
	     	$.each(data, function(i, item) { //recorre el data  
	     		if(idsubArea == item['Id_Sub_Area']){
	    			$("#SubArea").append(`<option selected value="${item['Id_Sub_Area']}">${item['Descripcion']}</option>`);
	    		}else{
	    			$("#SubArea").append(`<option value="${item['Id_Sub_Area']}">${item['Descripcion']}</option>`);	    		}
	        });  	    
	    });
}

// SE CARGA EL COMBO DE LAS SUBAREAS DE ACUERDO AL AREA
function SubAreaRoles(idsubArea,rol) {
	$("#Rol").html('');
	$("#Rol").append(`<option selected">Cargando....</option>`);
    borderInput('SubArea');
	 $.get('RolesPorSubArea/'+idsubArea, function (data) {
	 	$("#Rol").html('');
	 	$("#Rol").prop("disabled",false);
	 	$("#Rol").append(`<option value="0">Seleccione el Rol</option>`);
	 	$.each(data, function(i, item) { //recorre el data  
	 		if(rol == item['Id_Roles']){
				$("#Rol").append(`<option selected value="${item['Id_Roles']}">${item['Descripcion']}</option>`);
			}else{
				$("#Rol").append(`<option value="${item['Id_Roles']}">${item['Descripcion']}</option>`);	    		}
	    });  	    
	});
}

function ObtenerUsuariosPreparar(){
	$.get('PrepararUsuario/'+$("#cedula").val(), function (data) {
		console.log(data);
	 	$("#nombre").html('');
	 	$("#nombre").prop("disabled",false);
	    $("#apellido").html('');
	 	$("#apellido").prop("disabled",false);
	 	  
	 		$("#nombre").val(data['Nombre']);
	 		$("#apellido").val(data['Apellido']);
	 	    
	});

}



