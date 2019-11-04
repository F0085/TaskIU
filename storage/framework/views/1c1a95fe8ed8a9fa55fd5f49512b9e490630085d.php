<?php $__env->startSection('contenido'); ?>

	
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
							description:  item3['usuarios']['email'],
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
   
 

			options.items = items;
			options.cursorItem = 0;
			options.hasSelectorCheckbox = primitives.common.Enabled.True;

			control = primitives.orgdiagram.Control(document.getElementById("basicdiagram"), options);
		});

	</script>

	<div class="row">
		<div class="col-md-12">
				<div id="basicdiagram" style="width: 1150px; height: 500px; "></div>

		</div>
	</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/Organigrama/Organigrama.blade.php ENDPATH**/ ?>