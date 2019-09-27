<?php $__env->startSection('contenido'); ?>
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

			var items1 = [
				new primitives.orgdiagram.ItemConfig({
					id: 0,
					parent: null,
					title: "Scott Aasrud",
					description: "VP, Public Sector",
					image: "/images/UserORG.jpg"
				}),
				new primitives.orgdiagram.ItemConfig({
					id: 1,
					parent: 0,
					title: "Ted Lucas",
					description: "VP, Human Resources",
					image: "/BasicPrimitives/photos/b.png"
				}),
				new primitives.orgdiagram.ItemConfig({
					id: 2,
					parent: 0,
					title: "Fritz Stuger",
					description: "Business Solutions, US",
					image: "/BasicPrimitives/photos/c.png"
				})
			];

			 var newItem = {
      id: 9,
      parent: 2,
      title: "New Title",
      description: "New Description",
      image: "/photos/z.png"
    };


       
      items: [items1, newItem];
   
 

			options.items = items;
			options.cursorItem = 0;
			options.hasSelectorCheckbox = primitives.common.Enabled.True;

			control = primitives.orgdiagram.Control(document.getElementById("basicdiagram"), options);
		});

	</script>
</head>
<body>
	<div id="basicdiagram" style="width: 640px; height: 480px; border-style: dotted; border-width: 1px;"></div>
</body>
</html>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/pruebaDiagrama.blade.php ENDPATH**/ ?>