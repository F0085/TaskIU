<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ServicesOnlineChone</title>


   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
   
  </head>
  
  <body >
    <center style="padding-top: 200px">
    	<div class="row">
    		<div class="col-md-2"></div>
    		<div class="col-md-8">

	    		<div class="alert alert-success" role="alert" >
	    			<?php if(isset($Reunion)): ?>
				  	<h4 class="alert-heading">USTED HA CONFIRMADO SU ASISTENCIA A LA REUNIÓN</h4>
				  	<hr>
				 	<div class="row">
					  	<div class="col-md-6" align="right">
					  		<label><b>Tema:</b></label>
					  	</div>
					  	<div class="col-md-6" align="left">
					  		  <p class="mb-0"><?php echo e($Reunion['0']['Tema']); ?></p> 
					  	</div>
				  	</div>
				  	<div class="row">
					  	<div class="col-md-6" align="right">
					  		<label><b>Fecha:</b></label>
					  	</div>
					  	<div class="col-md-6" align="left">
					  		  <p class="mb-0"><?php echo e($Reunion['0']['FechadeReunion']); ?> <?php echo e($Reunion['0']['HoraReunion']); ?> </p> 
					  	</div>
				  	</div>
				  	<div class="row">
					  	<div class="col-md-6" align="right">
					  		<label><b>Lugar:</b></label>
					  	</div>
					  	<div class="col-md-6" align="left">
					  		  <p class="mb-0"><?php echo e($Reunion['0']['Lugar']); ?></p> 
					  	</div>
				  	</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<p class="mb-0">Para más información puede acceder al sistema web desde <a href="<?php echo e(url('/')); ?>">aquí</a></p> 
						</div>
			    		
			    	</div>
	<!-- 				  <label>Lugar:</label>
					  <p class="mb-0">Calceta</p> -->
					  <?php endif; ?>
				</div>

    		</div>
    		<div class="col-md-2"></div>

    	</div>



   
</center>
  </body>
</html><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/ConfirmarAsistencia/Confirmar.blade.php ENDPATH**/ ?>