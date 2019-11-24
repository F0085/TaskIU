function FiltrarReporte(estado){
	$('#TablaTareasReporte').html('');
	 $.get('ReportesEstado/'+estado, function (data) {
	 	// console.log(data);
	 	$.each(data, function(i,item){
	 		$('#TablaTareasReporte').append(`<tr>
				                    		<td>${item['Nombre']}</td>
				                    		<td align="center">${item['FechaCreacion']}</td>
				                    		<td align="center">Laboral</td>
				                    		<td align="center" ><a href="GenerarReporte/${item['Id_tarea']}" class="btn btn-success btn-sm"><span class="fa fa-download"></span> Descargar Reporte</a></td>
				                    	</tr>`)
	 	});

	  })
}