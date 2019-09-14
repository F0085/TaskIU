<?php
  session_start(); 
    
?>

<?php $__env->startSection('contenido'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>


         <script src="<?php echo e(asset('js/orgchart.js')); ?>"></script>


     <style type="text/css">
       html, body{
  width: 100%;
  height: 100%;
  padding: 0;
  margin:0;
  overflow: hidden;
  font-family: Helvetica;
}
#tree{
  width:100%;
  height:100%;
}
     </style>
    
  </head>
  <body>

    <div style="width:100%; height:700px;" id="orgchart"/></div>

  <?php echo $__env->make('Organigrama.modalInforOrg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(asset('js/Organigrama.js')); ?>"></script>
    <script type="text/javascript">

        organigrama();

    </script>
   
  </body>



</html>



<?php $__env->stopSection(); ?>



 


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/Organigrama/Organigrama.blade.php ENDPATH**/ ?>