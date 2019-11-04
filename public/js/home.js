


function home(){

	$.get('TotalTareasResponsables', function (res) {

		$('#TaskLaborales').html(res['Laboral']);
		$('#TAskPersonales').html(res['Personal']);
			 var graficogeneral ={
					type:"doughnut",//seleccionamos el tipo de grafico, en este caso es un grafico estilo pie, en esta parte podemos cambiar el tipo de grafico por el que deseamos
					data:{
					  datasets:[{
					    data:[res['Total_Pendiente'],res['Total_Terminada'],res['Total_Vencida']],
					    backgroundColor: [//seleccionamos el color de fondo para cada dato que le enviamos
					      "#04B404","#FFBF00",  "#FF0000",
					     ],
					  }],
					  labels: [//añadimos las etiquetas correspondientes a la data
					    "Pendientes",  "Terminadas", "Vencidas",  
					     ]
					},
					options:{//le pasamos como opcion adicional que sea responsivo
					  responsive: true,
					}
				}


				var grafico_general = document.getElementById('graficogeneral').getContext('2d');//seleccionamos el canvas
				// var grafico_efectividad = document.getElementById('graficoefectividad').getContext('2d');//seleccionamos el canvas
				window.pie = new Chart(grafico_general,graficogeneral);//le pasamos el grafico y la data para representarlo
				// window.pie = new Chart(grafico_efectividad,graficogeneral);//le pasamos el grafico y la data para representarlo
		// 
	});
	

}
$( document ).ready(function() {
	home();
	// google.charts.load('current', {'packages':['corechart']});
 //      google.charts.setOnLoadCallback(drawChart);
 //   drawChart();
 	google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(Efectividad);
      Efectividad();
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

function Efectividad() {
	$.get('TotalTareasResponsables', function (res) {

        var data = google.visualization.arrayToDataTable([
          ['Tareas_Responsables', 'Mis Tareas'],
          ['Efectividad',     res['Efectividad']],
    
        ]);

        var options = {
          width: 225, height: 500,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        // setInterval(function() {
        //   data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
        //   chart.draw(data, options);
        // }, 13000);
        // setInterval(function() {
        //   data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
        //   chart.draw(data, options);
        // }, 5000);
        // setInterval(function() {
        //   data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
        //   chart.draw(data, options);
        // }, 26000);
      });
  }