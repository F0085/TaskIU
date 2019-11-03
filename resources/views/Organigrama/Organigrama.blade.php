@extends('layouts.app')

@section('contenido')
<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>First organization diagram</title>

	
	<script type="text/javascript" src="/BasicPrimitives/min/primitives.min.js?5100"></script>
	<link href="/BasicPrimitives/min/primitives.latest.css?5100" media="screen" rel="stylesheet" type="text/css" />

	<script type='text/javascript'>
		var control;
		var timer = null;

		document.addEventListener('DOMContentLoaded', function () {
			var options = new primitives.orgdiagram.Config();

			var items = [
				new primitives.orgdiagram.ItemConfig({
					id: 0,
					parent: null,
					title: "CLÍNICA",
					description: "CARDIOCENTRO MANTA",
					// groupTitle: "Espam",
					// image: "/images/UserORG.jpg",
					itemTitleColor: primitives.common.Colors.Blue,
					groupTitleColor: primitives.common.Colors.LightGray
				})
			]; //groupTitle: "SubAdviser",
			$.get('DibujarOrganigrama', function (data) { 
				// console.log(data);
	       	 	$.each(data, function(i, item) {
	       	 		items.push(new primitives.orgdiagram.ItemConfig({
					id: item['Id_Area'],
					parent: 0,
					// title: `<i class="fa fa-user"></i>`,
					description: item['Descripcion'],
					groupTitle: "Area",
					itemTitleColor: primitives.common.Colors.Blue,
					groupTitleColor: primitives.common.Colors.LightGray

					}));
					$.each(item['sub_area'], function(i1, item1) {
		       	 		items.push(new primitives.orgdiagram.ItemConfig({
						id: item1['Id_Sub_Area'],
						parent: item['Id_Area'],
						// title: `<i class="fa fa-user"></i>`,
						description: item1['Descripcion'],
						groupTitle: "SubArea",
						itemTitleColor: primitives.common.Colors.Blue,
						groupTitleColor: primitives.common.Colors.LightGray

						}));
						$.each(item1['roles'], function(i2, item2) {
			       	 		items.push(new primitives.orgdiagram.ItemConfig({
							id: item2['Id_Roles'],
							parent: item1['Id_Sub_Area'],
							// title: `<i class="fa fa-user"></i>`,
							description: item2['Descripcion'],
							groupTitle: "Rol",
							itemTitleColor: primitives.common.Colors.Blue,
							groupTitleColor: primitives.common.Colors.LightGray

							}));

							$.each(item2['usuario_roles'], function(i3, item3) {
			       	 		items.push(new primitives.orgdiagram.ItemConfig({
							id: item3['Id_Usuario'],
							parent: item2['Id_Roles'],
							title:item3['usuarios']['Nombre']+' '+ item3['usuarios']['Apellido'],
							description: '<a href="hola">aquida </a>'+ item3['usuarios']['email']+' '+ item3['usuarios']['Direccion']+' '+ item3['usuarios']['Celular'],
							groupTitle: "Usuarios",
							// image: "/images/UserORG.jpg",
							itemTitleColor: primitives.common.Colors.Orange,
							groupTitleColor: primitives.common.Colors.LightGray

							}));
	       	 			});
	       	 			});
	       	 		});
	       	 	});
       		 });
			// var id = 1;
		// 	for (var index = 0; index < 2; index++) {
		// 		items.push(new primitives.orgdiagram.ItemConfig({
		// 			id: ++id,
		// 			parent: 0,
		// 			title: id.toString() + " Title",
		// 			description: id.toString() + " Description",
		// 			groupTitle: "Subdirección",
		// 			itemTitleColor: primitives.common.Colors.Blue,
		// 			groupTitleColor: primitives.common.Colors.LightGray
		// 		})); //groupTitle: "SubAdviser",
		// 		// continue;
		// 		var idpadre=id;

		// 		for (var index2 = 0; index2 < 2; index2++) {
		// 		items.push(new primitives.orgdiagram.ItemConfig({
		// 			id: ++id,
		// 			parent: idpadre,
		// 			title: id.toString() + " Title",
		// 			description: id.toString() + " Description",
		// 			groupTitle: "Areas",
		// 			itemTitleColor: primitives.common.Colors.Blue,
		// 			groupTitleColor: primitives.common.Colors.LightGray
		// 		})); //groupTitle: "SubAdviser",

		// 		var id2=id;
				

		// 	}
		// }




       
    
   
 

			options.items = items;
			options.cursorItem = 0;
			options.hasSelectorCheckbox = primitives.common.Enabled.True;

			control = primitives.orgdiagram.Control(document.getElementById("basicdiagram"), options);
		});

	</script>
</head>
<body>
	<div class="row">
		<div class="col-md-12">
				<div id="basicdiagram" style="width: 1150px; height: 500px; "></div>

		</div>
	</div>
</body>
</html>
@endsection

