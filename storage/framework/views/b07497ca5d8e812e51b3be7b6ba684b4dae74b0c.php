<?php
  session_start(); 
    
?>

<?php $__env->startSection('contenido'); ?>
<div class="col-lg-12">

	    <div class="card">
	        <div class="card-body">
	            <div class="media align-items-center mb-4">
	                <img class="mr-3" src="images/avatar/11.png" width="80" height="80" alt="">
	                <div class="media-body">
	                    <h3 class="mb-0"><?php if(isset($_SESSION['nombre'])): ?><?php echo e($_SESSION['nombre']); ?> <?php echo e($_SESSION['apellido']); ?><?php endif; ?></h3>
	                    <p class="text-muted mb-0"><?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?> <?php if($_SESSION['Id_tipo_Usuarios'] == 1): ?> Empleado <?php elseif($_SESSION['Id_tipo_Usuarios'] == 2): ?> Administrador <?php endif; ?> <?php endif; ?></p>
	                </div>
	            </div>
	            
	            <div class="row mb-5">
	                <div class="col">
	                    <div class="card  text-left" style="padding-top: 20px">
	                    	<div class="col-lg-12">
	                        <span class="mb-1 text-primary"><!-- <i class="icon-user"></i> --></span>
	                        <p style="color: black"><b><i class="fa fa-address-card-o"></i>    Cédula:</b> <?php if(isset($_SESSION['cedula'])): ?><?php echo e($_SESSION['cedula']); ?><?php endif; ?> </p>
	                        <p style="color: black"><b><i class="fa fa-envelope"></i>    Email:</b> <?php if(isset($_SESSION['email'])): ?><?php echo e($_SESSION['email']); ?><?php endif; ?> </p>
	                        <p style="color: black"><b><i class="fa fa-phone"></i>    Celular:</b> <?php if(isset($_SESSION['celular'])): ?><?php echo e($_SESSION['celular']); ?><?php endif; ?> </p>
	                        <p style="color: black"><b><i class="fa  fa-map-marker"></i>    Dirección:</b> <?php if(isset($_SESSION['direccion'])): ?><?php echo e($_SESSION['direccion']); ?><?php endif; ?> </p>
	                        <p style="color: black"><b><i class="fa fa-venus-double"></i>    Sexo:</b> <?php if(isset($_SESSION['sexo'])): ?><?php if($_SESSION['sexo'] == "M"): ?> Masculino <?php else: ?> Femenino <?php endif; ?> <?php endif; ?> </p>
	                        </div>
	                    </div>
	                </div>
	                <div class="col">
	                    <div class="card  text-left" style="padding-top: 20px">
	                    	<div class="col-lg-12">
		                        <span class="mb-1 text-warning"></span>
		                         <p style="color: black"><b><i class="fa fa-birthday-cake"></i>    Cumpleaños:</b> </p>
		                        <p style="color: black"><b><i class="fa fa-child"></i>    Edad:</b>  </p>
		                        <p style="color: black"><b><i class="fa fa-ajust"></i>    Color Favorito:</b>  </p>
		                        <p style="color: black"><b><i class="fa  fa-utensils"></i>    Comida Favorita:</b> </p>
		                        <p style="color: black"><b><i class="fa fa-heart"></i>    Intereses:</b> </p>
	                   		 </div>
	                    </div>
	                </div>
	                <div class="col-12 text-center">
	                    <button class="btn btn-primary px-5">Editar Perfil</button>
	                </div>
	            </div>

	            <h4>About Me</h4>
	            <p class="text-muted">Hi, I'm Pikamy, has been the industry standard dummy text ever since the 1500s.</p>
	            <ul class="card-profile__info">
	                <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
	                <li><strong class="text-dark mr-4">Email</strong> <span>name@domain.com</span></li>
	            </ul>
	        </div>
	    </div>
	</div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/PerfilUsuario/Perfil.blade.php ENDPATH**/ ?>