function NotificarTareas(){

	$('#CuerpoNotificaciones').html('');
	$.get('Notificaciones', function (data) {
		
		$.each(data, function(i, item) { 
			console.log(item);
			if(item['VistaWeb']==0){
				if(item['tipo']=='Tarea'){var ruta='/Task'; var notifyHead='Tarea'; var img="/images/task.png";}else if(item['tipo']=='Reunion'){var ruta='/ReunionN'; var notifyHead='Reunión';var img="/images/reunion.png";}
				$('#CuerpoNotificaciones').append(`<li class="notification-unread">
                                            <a href="${ruta}/${item['Id_Ttar_Reu']}/${item['tipoRol']}">
                                                <img class="float-left mr-3 avatar-img" src="${img}" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Invitación a ${notifyHead}</div>
                                                 
                                                    <div class="notification-text">${item['descripcion']}</div>
                                                </div>
                                            </a>
                                        </li>`);
			}

	});
		
	});
}
function ContarNotificarTareas(){
	$.get('ContarNotificaciones', function (data) {
			if(data==1){
				$('#cantidaNoti').html(data+' '+ 'Nueva notificación');
				$('#newMessage').html(data);
			}else{
				$('#cantidaNoti').html(data+' '+ 'Nuevas notificaciones');
				$('#newMessage').html(data);
			}

	
	});
}
var intervalId;
var inter;
	$( document ).ready(function() {	

		// if($('#claseshow').hasClass('show')){
		// 	cerrarIntervalo();
		// }else{
			  // AbrirIntervalo();
		// }
	window.setInterval(ContarNotificarTareas,5000);
		    
		      
	});

   // <div class="notification-timestamp">08 Hours ago</div>

   	function cerrarIntervalo(){
   					window.clearInterval(inter);
   		$('#claseshow').addClass('cerrar');

   		if($('#claseshow').hasClass('cerrar')){
   			console.log('CERRA');
			window.clearInterval(intervalId);
			$('#claseshow').removeClass('cerrar');
			inter=window.setInterval(comprobarclaseshow,5000);
		}else{
			intervalId=window.setInterval(NotificarTareas,5000);
		}
		//window.clearInterval(intervalId);
		
	}


	function AbrirIntervalo(){

		// if($('#claseshow').hasClass('cerrar')){
			window.clearInterval(intervalId);
			

			 
	 	// }
		// intervalId= window.setInterval(NotificarTareas,5000);
		// else{
		// 	 intervalId= window.setInterval(NotificarTareas,5000);
		// }
		// intervalId=window.setInterval(NotificarTareas,5000);
	}

	function comprobarclaseshow(){

		if($('#claseshow').hasClass('cerrar')){
			window.clearInterval(intervalId);
		}else{
			intervalId=window.setInterval(NotificarTareas,5000);
		}

	}


