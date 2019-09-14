<?php
  session_start(); 
    
?>


<?php $__env->startSection('contenido'); ?>

<div class="row">
    <div class="col-md-12" style="padding-top: 200px">
       <center> <h1 style="color: black; font-family: Comic Sans MS, cursive, sans-serif;"><strong><strong style="color: #dd2323">BIENVENIDO <?php if(isset($_SESSION['nombre'])): ?><?php echo e($_SESSION['nombre']); ?><?php endif; ?></strong> A <strong style="color: blue">CARDIOCENTRO</strong> MANTA</strong></h1></center>    
      <!--  <center><img  width="100%" src="images/clinica.png"></center> -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/home.blade.php ENDPATH**/ ?>