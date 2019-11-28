function home(){

	// $.get('TotalTareasResponsables', function (res) {
	// 			$('#TaskLaborales').html(res['Laboral']);
	// 			$('#TAskPersonales').html(res['Personal']);
	// 			$('#ReunionesResponsable').html(res['ReunionResponsable']);
	// 			$('#ReunionesParticipante').html(res['ReunionParticipante']);

				
	// });
	

}
$( document ).ready(function() {
	home();
	// google.charts.load('current', {'packages':['corechart']});
 //      google.charts.setOnLoadCallback(drawChart);
 //   drawChart();
 	  // google.charts.load('current', {'packages':['gauge']});
    //   google.charts.setOnLoadCallback(Efectividad);
      // Efectividad();
});

// function drawChart(){

// 	$.get('TotalTareasResponsables', function (res) {
// 			 console.log(res['Total_Pendiente']);
// 			 var pendiente=res['Total_Pendiente']
//         var data = google.visualization.arrayToDataTable([
//           ['Tareas_Responsables', 'Mis Tareas'],
//           ['Pendientes',     res['Total_Pendiente']],
//           ['Terminadas',      res['Total_Terminada']],
//           ['Vencidas',  res['Total_Vencida']]
//         ]);

//         var options = {
//           title: 'Mi Estadística',
//           // backgroundColor: { fill:'transparent'},
//            // height: 500,
//            //  width: 900,
//         };

//         var chart = new google.visualization.PieChart(document.getElementById('piechart'));

//         chart.draw(data, options);

//         function resizeHandler () {
//             chart.draw(data, options);
//         }
//         if (window.addEventListener) {
//             window.addEventListener('resize', resizeHandler, false);
//         }
//         else if (window.attachEvent) {
//             window.attachEvent('onresize', resizeHandler);
//         }
		
// 	});

	

// 	}

  $(window).resize(function() {
    window.ResponsableLaboral.redraw();
    window.ResponsablePersonal.redraw();
    window.EfectividadPersonal.redraw();
    window.EfectividadLaboral.redraw();
    window.EfectividadMeses.redraw();
    window.EfectividadPMeses.redraw();

    
  });

function EfectividadMeses(anio,mes) {
	$('#Efectividad').html('');
	$('#anioEfectividad').val();
	if($('#anioEfectividad').val() != ''){
		anio=$('#anioEfectividad').val();
	}else{
		anio=0;
	}
	if($('#MesEfectividad').val() != ''){
		mes=$('#MesEfectividad').val();
	}else{
		mes=0;
	}
	$.get('EfectividadPorMeses/'+anio+'/'+mes, function (res) {

			if(res!=0){
				$("#Efectividad").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['Efectividad']
		        });
				// window.EfectividadMeses=Morris.Donut({

			 // 		  colors: ["#00a65a"],
				// 	  element: 'Efectividad',
				// 	  data: [
				// 	    {label: "Efectividad", value: res['Efectividad']}
				// 	  ],
				// 	  formatter: function (x) { return x + "%"}

				// });
			}else{
				$('#Efectividad').html(`<br><br>No hay tareas en esta fecha`);
			}
    });
}

function EfectividadMesesPersonales(anio,mes) {
	$('#EfectividadP').html('');
	$('#anioEfectividadP').val();
	if($('#anioEfectividadP').val() != ''){
		anio=$('#anioEfectividadP').val();
	}else{
		anio=0;
	}
	if($('#MesEfectividadP').val() != ''){
		mes=$('#MesEfectividadP').val();
	}else{
		mes=0;
	}
	$.get('EfectividadPorMesesPersonales/'+anio+'/'+mes, function (res) {
			if(res!=0){

				$("#EfectividadP").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['Efectividad']
		        });
				// window.EfectividadPMeses=Morris.Donut({

			 // 		  colors: ["#00a65a"],
				// 	  element: 'EfectividadP',
				// 	  data: [
				// 	    {label: "Efectividad", value: res['Efectividad']}
				// 	  ],
				// 	  formatter: function (x) { return x + "%"}

				// });
			}else{
				$('#EfectividadP').html(`<br><br>No hay tareas en esta fecha`);
			}
    });
}

function FiltroGeneral(IdUsuario,anio,mes) {

	$('#TotalRespon').html('');
	$('#TotalResponP').html('');
	$('#Efectividad').html('');
	$('#EfectividadP').html('');

	if($('#anioAdmin').val() != ''){
		anio=$('#anioAdmin').val();
	}else{
		anio=0;
	}
	if($('#MesAdmin').val() != ''){
		mes=$('#MesAdmin').val();
	}else{
		mes=0;
	}

	if($('#FiltroUsuario').val() != ''){
		 		$('#divMesAdmin').prop('hidden',false);
 		$('#divAnioAdmin').prop('hidden',false);
		IdUsuario=$('#FiltroUsuario').val();
		if(anio == 0 || mes== 0){
			TotalPorUsuario(IdUsuario);
			return;
		}
	}else{
		IdUsuario=0;
		TotalEstadoEmpresa();
 		$('#TituloSituacion').html(`<b>SITUACIÓN ACTUAL DE LA EMPRESA`);
 		
 		$('#divMesAdmin').prop('hidden',true);
 		$('#divAnioAdmin').prop('hidden',true);


 		return;

	}


	$.get('TotalTareasResponsablesLaboralAdmin/'+IdUsuario+'/'+anio+'/'+mes, function (res) {
 	
			if(res!=0){
			 //TOTAL RESPONSABLES PERSONALES
				window.ResponsableLaboral=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalRespon',
					  data: [
					    {label: "Pendientes", value: res['Total_Pendiente']},
					    {label: "Terminadas", value: res['Total_Terminada']},
					    {label: "Vencidas", value: res['Total_Vencida']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
			}else{
				$('#TotalRespon').html(`<br><br>No hay tareas en esta fecha`);
			}
    });
    $.get('EfectividadLaboral/'+IdUsuario+'/'+anio+'/'+mes, function (res) {

			if(res!=0){
				$("#Efectividad").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['Efectividad']
		        });
			}else{
				$('#Efectividad').html(`<br><br>No hay tareas en esta fecha`);
			}
    });
    $.get('TotalTareasResponsablesPersonalAdmin/'+IdUsuario+'/'+anio+'/'+mes, function (resP) {
      
			if(resP!=0){
			 //TOTAL RESPONSABLES PERSONALES
				window.ResponsableLaboral=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalResponP',
					  data: [
					    {label: "Pendientes", value: resP['Total_Pendiente']},
					    {label: "Terminadas", value: resP['Total_Terminada']},
					    {label: "Vencidas", value: resP['Total_Vencida']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
			}else{
				$('#TotalResponP').html(`<br><br>No hay tareas en esta fecha`);
			}
    });
    $.get('EfectividadPersonal/'+IdUsuario+'/'+anio+'/'+mes, function (res) {

			if(res!=0){
				$("#EfectividadP").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['Efectividad']
		        });
			}else{
				$('#EfectividadP').html(`<br><br>No hay tareas en esta fecha`);
			}
    })


}

function ResponsabilidadPersonal(anio,mes) {
	$('#TotalResponP').html('');
	if($('#anioResponsblePersonal').val() != ''){
		anio=$('#anioResponsblePersonal').val();
	}else{
		anio=0;
	}
	if($('#MesResponsablePersonal').val() != ''){
		mes=$('#MesResponsablePersonal').val();
	}else{
		mes=0;
	}
	$.get('TotalTareasResponsablesPersonal/'+anio+'/'+mes, function (res) {
 
			if(res!=0){
							//TOTAL RESPONSABLES PERSONALES
				window.ResponsablePersonal=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalResponP',
					  data: [
					    {label: "Pendientes", value: res['Total_Pendiente']},
					    {label: "Terminadas", value: res['Total_Terminada']},
					    {label: "Vencidas", value: res['Total_Vencida']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
			}else{
				$('#TotalResponP').html(`<br><br>No hay tareas en esta fecha`);
			}
    });
}


$( document ).ready(function() { // 6,32 5,38 2,34
// 	Morris.Bar({
//   element: 'graph',
//   data: [
//     {x: 'Leoanrdo', y: 0},
//     {x: 'fsd', y: 1},
//     {x: '2fdsf', y: 2},
//     {x: 'sdf', y: 3},
//     {x: 'fsd', y: 4},
//     {x: 'fds', y: 5},
//     {x: '2012 Q3', y: 6},
//     {x: '2012 Q4', y: 7},
//     {x: '2013 Q1', y: 8}
//   ],
//   xkey: 'x',
//   ykeys: ['y'],
//   labels: ['Efectividad'],
//   units: '%',
//   barColors: function (row, series, type) {
//     if (type === 'bar') {
//       var red = Math.ceil(255 * row.y / this.ymax);
//       return 'rgb(' + red + ',0,0)';
//     }
//     else {
//       return '#000';
//     }
//   }
// });
	TotalEstadoEmpresa();    
    
        
});

 function TotalEstadoEmpresa(){
 	$('#TotalRespon').html('');
	$('#TotalResponP').html('');
	$('#Efectividad').html('');
	$('#EfectividadP').html('');
	if($('#anioAdmin').val() != ''){
		anio=$('#anioAdmin').val();
	}else{
		anio=0;
	}
	if($('#MesAdmin').val() != ''){
		mes=$('#MesAdmin').val();
	}else{
		mes=0;
	}
	if($('#FiltroUsuario').val() != ''){
		IdUsuario=$('#FiltroUsuario').val();
	}else{
		IdUsuario=0;
	}
	$.get('TotalEstadisticaAdmin', function (res) {
 	
			
			 //TOTAL RESPONSABLES PERSONALES
				window.ResponsableLaboral=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalRespon',
					  data: [
					    {label: "Pendientes", value: res['Total_Pendiente']},
					    {label: "Terminadas", value: res['Total_Terminada']},
					    {label: "Vencidas", value: res['Total_Vencida']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
				$("#Efectividad").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['Efectividad']
		        });
		        window.ResponsablePersonal=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalResponP',
					  data: [
					    {label: "Pendientes", value: res['Total_PendienteP']},
					    {label: "Terminadas", value: res['Total_TerminadaP']},
					    {label: "Vencidas", value: res['Total_VencidaP']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
				$("#EfectividadP").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['EfectividadP']
		        });
		
    });
    
 }

 function TotalPorUsuario(IdUsuario){
 	if($('#FiltroUsuario').val() !=''){
 	  $('#TituloSituacion').html(`<b>SITUACIÓN ACTUAL DE ${($('select[name="FiltroUsuario"] option:selected').text()).toUpperCase()}</b>`);
 	  $('#MesAdmin').prop('disabled',false);
 	  $('#anioAdmin').prop('disabled',false);
 	  $('#divMesAdmin').prop('hidden',false);
 	  $('#divAnioAdmin').prop('hidden',false);

 	}else{
 		 TotalEstadoEmpresa();
 		$('#TituloSituacion').html(`<b>SITUACIÓN ACTUAL DE LA EMPRESA`);
 		$('#MesAdmin').prop('disabled',true);
 		$('#anioAdmin').prop('disabled',true);
 		$('#divMesAdmin').prop('hidden',true);
 		$('#divAnioAdmin').prop('hidden',true);
 		return;
 	  
 	}
 	$('#TotalRespon').html('');
	$('#TotalResponP').html('');
	$('#Efectividad').html('');
	$('#EfectividadP').html('');
 	$.get('TotalEstadisticaUsuario/'+IdUsuario, function (res) {
 	
			
			 //TOTAL RESPONSABLES PERSONALES
				window.ResponsableLaboral=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalRespon',
					  data: [
					    {label: "Pendientes", value: res['Total_Pendiente']},
					    {label: "Terminadas", value: res['Total_Terminada']},
					    {label: "Vencidas", value: res['Total_Vencida']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
				$("#Efectividad").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['Efectividad']
		        });
		        window.ResponsablePersonal=Morris.Donut({
			 		  colors: ["#00a65a", "#f39c12", "#3c8dbc"],
					  element: 'TotalResponP',
					  data: [
					    {label: "Pendientes", value: res['Total_PendienteP']},
					    {label: "Terminadas", value: res['Total_TerminadaP']},
					    {label: "Vencidas", value: res['Total_VencidaP']}
					  ],
				  // formatter: function (x) { return x + "%"}
				});
				$("#EfectividadP").circliful({
		            animation: 1,
		            animationStep: 1,
		            target: 10,
		            start: 2,
		            showPercent: 1,
		            backgroundColor: '#000',
		            foregroundColor: '#A8C64A',
		            fontColor: '#000',
		            iconColor: '#000',
		            icon: 'f183',
		            iconSize: '40',
		            iconPosition: 'middle',
		            // text: 'Efectividad',
		            percent: res['EfectividadP']
		        });
		
    });

 }


