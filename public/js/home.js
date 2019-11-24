function home(){

	$.get('TotalTareasResponsables', function (res) {
				$('#TaskLaborales').html(res['Laboral']);
				$('#TAskPersonales').html(res['Personal']);
				$('#ReunionesResponsable').html(res['ReunionResponsable']);
				$('#ReunionesParticipante').html(res['ReunionParticipante']);

				// $('#MesEfectividad').val(res['MesActual']);
				// $('#anioEfectividad').val(res['AnioActual']);
				
				//TOTAL RESPONSABLES LABORALES
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

				//TOTAL RESPONSABLES PERSONALES
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


				//EFECTIVIDAD LABORAL
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
				// window.EfectividadLaboral=Morris.Donut({
		 	// 	  colors: ["#00a65a"],
				//   element: 'Efectividad',
				//   data: [
				//     {label: "Efectividad", value: res['Efectividad']}
				//   ],
				//   formatter: function (x) { return x + "%"}

				// });
				//EFECTIVIAD PERSONAL
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
				// //EFECTIVIDAD PERSONAL
				// window.EfectividadPersonal=Morris.Donut({
		 	// 	  colors: ["#00a65a"],
				//   element: 'EfectividadP',
				//   data: [
				//     {label: "Efectividad", value: res['EfectividadP']}
				//   ],
				//   formatter: function (x) { return x + "%"}

				// });

			 // var graficogeneral ={
				// 	type:"doughnut",//seleccionamos el tipo de grafico, en este caso es un grafico estilo pie, en esta parte podemos cambiar el tipo de grafico por el que deseamos
				// 	data:{
				// 	  datasets:[{
				// 	    data:[res['Total_Pendiente'],res['Total_Terminada'],res['Total_Vencida']],
				// 	    backgroundColor: [//seleccionamos el color de fondo para cada dato que le enviamos
				// 	      "#04B404","#FFBF00",  "#FF0000",
				// 	     ],
				// 	  }],
				// 	  labels: [//añadimos las etiquetas correspondientes a la data
				// 	    "Pendientes",  "Terminadas", "Vencidas",  
				// 	     ]
				// 	},
				// 	options:{//le pasamos como opcion adicional que sea responsivo
				// 	  responsive: true,
				// 	}
				// }


				// var grafico_general = document.getElementById('graficogeneral').getContext('2d');//seleccionamos el canvas
				// // var grafico_efectividad = document.getElementById('graficoefectividad').getContext('2d');//seleccionamos el canvas
				// window.pie = new Chart(grafico_general,graficogeneral);//le pasamos el grafico y la data para representarlo
				// // window.pie = new Chart(grafico_efectividad,graficogeneral);//le pasamos el grafico y la data para representarlo
		// 
	});
	

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

function ResponsabilidadLaboral(anio,mes) {
	$('#TotalRespon').html('');
	if($('#anioResponsbleLaboral').val() != ''){
		anio=$('#anioResponsbleLaboral').val();
	}else{
		anio=0;
	}
	if($('#MesResponsableLaboral').val() != ''){
		mes=$('#MesResponsableLaboral').val();
	}else{
		mes=0;
	}
	$.get('TotalTareasResponsablesLaboral/'+anio+'/'+mes, function (res) {
 
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

        // $("#EfectividadP").circliful({
        //     animation: 1,
        //     animationStep: 1,
        //     target: 10,
        //     start: 2,
        //     showPercent: 1,
        //     backgroundColor: '#000',
        //     foregroundColor: '#A8C64A',
        //     fontColor: '#000',
        //     iconColor: '#000',
        //     icon: 'f0a0',
        //     iconSize: '40',
        //     iconPosition: 'middle',
        //     text: 'Efectividad',
        //     percent: 88
        // });
        
    });


