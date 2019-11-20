
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style type="text/css">
table {
   width: 100%;
  /* border: 1px solid #000;*/
}
th, td {
   width: 25%;
   text-align: left;
   vertical-align: top;
/*   border: 5px solid #000;
   border-collapse: collapse;*/
   padding: 0.3em;
}
    </style>

<!--         <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>
<body>

	<div class="table-responsive" style="font-size: 12px;">
        <div class="row">
            <div align="center" class="col-md-12"style="border: solid 1px #000000;">
                <h3><?php if(isset($tarea)): ?><?php echo e($tarea['Nombre']); ?><?php endif; ?></h3>
            </div>
             <div class="col-md-12"style="border: solid 1px #000000;">
                <p style="padding-left:5px;"><b>Descripción:</b>  <?php echo e($tarea['Descripcion']); ?></p>
                <p style="padding-left:5px;"><b>Fecha de Creación:</b>  <?php echo e($tarea['FechaCreacion']); ?></p>
                <p style="padding-left:5px;"><b>Fecha de Inicio:</b>  <?php echo e($tarea['FechaInicio']); ?></p>
                <p style="padding-left:5px;"><b>Fecha límite:</b>  <?php echo e($tarea['FechaFin']); ?></p>
                <p style="padding-left:5px;"><b>Entregada el:</b>  <?php echo e($tarea['FechaEntrega']); ?></p>
                 <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>RESPONSABLES:</b></p>
                <?php $__currentLoopData = $tarea['responsables']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="padding-left:5px;"><ul><li><?php echo e($vres['usuario']['Nombre']); ?> <?php echo e($vres['usuario']['Apellido']); ?></li></ul> </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>PARTICIPANTES:</b></p>
                <?php $__currentLoopData = $tarea['participantes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="padding-left:5px;"><ul><li><?php echo e($vPar['usuario']['Nombre']); ?> <?php echo e($vPar['usuario']['Apellido']); ?></li></ul> </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>OBSERVADORES:</b></p>
                <?php $__currentLoopData = $tarea['observadores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vObs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="padding-left:5px;"><ul><li><?php echo e($vObs['usuario']['Nombre']); ?> <?php echo e($vObs['usuario']['Apellido']); ?></li></ul> </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>LISTA DE OBSERVACIONES:</b></p>
                
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>LISTA DE EVIDENCIAS:</b></p>

                <table style="padding-left:5px;" >
                    <thead >
                        <tr  >
                            <th >Nombre</th>
                            <th >Usuario</th>
                            <th >Fecha</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $__currentLoopData = $tarea['documento']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vDoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="color:blue"><u><?php echo e($vDoc['Descripcion']); ?></u></td>
                            <td><?php echo e($vDoc['usuario']['Nombre']); ?> <?php echo e($vDoc['usuario']['Apellido']); ?></td>
                            <td><?php echo e($vDoc['Fecha']); ?></td>
                        </tr>
                          
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>SUBTAREAS:</b></p>

                <table style="padding-left:5px;" >
                    <thead >
                        <tr  >
                            <th >Nombre</th>
                            <th >Fecha Creación</th>
                            <th >Fecha Inicio</th>
                            <th >Fecha Límite</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php $__currentLoopData = $tarea['reporte_sub_tareas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vSubT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="color:blue"><u><?php echo e($vSubT['Nombre']); ?></u></td>
                            <td><?php echo e($vSubT['FechaCreacion']); ?></td>
                            <td><?php echo e($vSubT['FechaInicio']); ?></td>
                            <td><?php echo e($vSubT['FechaFin']); ?></td>
                        </tr>
                          
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>

<!--                 <p style="padding-left:5px;"><b>Fecha de Creación:</b>  <?php echo e($tarea['FechaCreacion']); ?></p>
                <p style="padding-left:5px;"><b>Fecha de Inicio:</b>  <?php echo e($tarea['FechaInicio']); ?></p>
                <p style="padding-left:5px;"><b>Fecha límite:</b>  <?php echo e($tarea['FechaFin']); ?></p>
                <p style="padding-left:5px;"><b>Entregada el:</b>  <?php echo e($tarea['FechaEntrega']); ?></p> -->
            </div>

        </div>
                <!-- table class="table " style="border: solid 1px #000000; " id="myTable">
                    <thead>
                        <tr style="color: black">
                            <th  style="cursor: pointer;" title="Ordenar" scope="col" colspan="4"><?php if(isset($tarea)): ?><?php echo e($tarea['Nombre']); ?><?php endif; ?></th>
              <th style="cursor: pointer;" title="Ordenar" scope="col">Fecha Límite</th>
                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Creado Por</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Responsables</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Participantes</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Observadores</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col" rowspan="2">Tipo</th>
                        </tr>
                    </thead>
                    <tbody id="TablaTareas">
                    </tbody>
                </table> -->
    </div>
    <br>
    <br>
    <br>

      
</body>
</html><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/Reportes/Documento.blade.php ENDPATH**/ ?>