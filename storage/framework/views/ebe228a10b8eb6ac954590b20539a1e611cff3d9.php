<?php $__env->startSection('contenido'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Titulo</title>
<!-- 	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'> -->

	<!-- Estilos para el organigrama -->
	<link rel='stylesheet' type='text/css' href="<?php echo e(asset('css/organigrama.css')); ?>">
</head>
<body>


<div id='myModal' class='modal fade in' tabindex='-1' role='dialog'>
	<div class='modal-dialog' role='document'>
		<div class="modal-content">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Modal</h4>
					<button class="close"></button>
				</div>
				<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
				<div class="panel-footer">
					<button type="button" class="btn btn-default" data-dismiss='modal'>Close</button>
					<button type="button" class='btn btn-primary'>Aceptar</button>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- Div contenedor del organigrama -->
<div id='organigrama'>
</div>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 -->
<!-- Carga de datos de ejemplo -->
<script type='text/javascript' src="<?php echo e(asset('js/data.js')); ?>"></script>
<!-- Libreria para la creación del organigrama -->
<script type='text/javascript' src="<?php echo e(asset('js/organigrama.js')); ?>"></script>

<script type='text/javascript'>
	(function(){
		// Carga de datos para el organigrama
		organigrama.data = data;
		// creación del organigrama, se le manda el id del contenedor
		organigrama.create('organigrama');
		// Agregamos los eventos para los botones
		organigrama.eventAdd(EventoAdd);
		organigrama.eventEdit(EventoEdit);

		function EventoAdd(id){
			$('#myModal').modal('show');
		}

		function EventoEdit(id){
			$('#myModal').modal('show');
		}
		$('#myModal').modal({
		  keyboard: false,
		  backdrop: "static",
		  show: false
		})
	})();
</script>

</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/Organigrama.blade.php ENDPATH**/ ?>