<?php $__env->startSection('content'); ?>
<style type="text/css">
table {
   width: 100%;
  /* border: 1px solid #000;*/
}
th, td {
  padding: 5px;
    border-top: 0px;
    border-right: 0px;
    border-bottom: 0px solid black;
    border-left: 0px;
}
    </style>
   


	<div class="table-responsive" style="font-size: 12px;">
        <div class="row">
            <div align="center" class="col-md-12"style="border: solid 1px #000000;">
                <h3><?php if(isset($reunion)): ?><?php echo e($reunion['Tema']); ?><?php endif; ?></h3>
            </div>
             <div class="col-md-12"style="border: solid 1px #000000;">
                 <p style="padding-left:5px;"><b>Orden del Día:</b>
                <textarea><?php echo e($reunion['Orden_del_Dia']); ?></textarea>
                              <p style="padding-left:5px;"><b>Fecha de Creación:</b>  <?php echo e($reunion['FechaCreacion']); ?></p>
                <p style="padding-left:5px;"><b>Fecha de Reunión:</b>  <?php echo e($reunion['FechadeReunion']); ?> <?php echo e($reunion['HoraReunion']); ?></p>
                <p style="padding-left:5px;"><b>Lugar:</b>  <?php echo e($reunion['Lugar']); ?> </p>
                <p style="padding-left:5px;"><b>Estado:</b>  <?php echo e($reunion['Estado']); ?></p>
                 <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>RESPONSABLES:</b></p>
                <?php $__currentLoopData = $reunion['responsables']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="padding-left:5px;"><ul><li><?php echo e($vres['usuario']['Nombre']); ?> <?php echo e($vres['usuario']['Apellido']); ?></li></ul> </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>PARTICIPANTES:</b></p>
                <?php $__currentLoopData = $reunion['participantes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="padding-left:5px;"><ul><li><?php echo e($vPar['usuario']['Nombre']); ?> <?php echo e($vPar['usuario']['Apellido']); ?></li></ul> </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>LISTA DE OBSERVACIONES:</b></p>
                <?php $__currentLoopData = $reunion['observacion']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vObse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p style="padding-left:5px;"><ul><li><b><?php echo e($vObse['usuario']['Nombre']); ?> <?php echo e($vObse['usuario']['Apellido']); ?> </b> (<?php echo e($vObse['Fecha']); ?>) <br><?php echo e($vObse['Descripcion']); ?> </li>
                    <?php $__currentLoopData = $vObse['sub_observaciones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vSub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p style="padding-left:5px;"><ul><li><b><?php echo e($vSub['usuario']['Nombre']); ?> <?php echo e($vSub['usuario']['Apellido']); ?></b> (<?php echo e($vSub['Fecha']); ?>) <br><?php echo e($vSub['Descripcion']); ?> </li></ul> </p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul> </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>Conclusión:</b></p>
                <p style="padding-left:5px;"><?php echo e($reunion['Conclusion']); ?> </p>

                
               


            </div>

        </div>
                
    </div>
    <br>
    <br>
    <br>

    <br><table style='page-break-after:always;'></br></table><br>   
    		<hr style=" border: solid 1px ">
    		<div class="row">
    			<div align="center" class="col-md-12">
    				<p><b>LISTA DE PARTICIPANTES</b></p>
    			</div>
    		 </div>
				<table >
                    <thead>
                        <tr   >
                            <th align="center" style="    border-top: 1px solid black;
										    border-right: 1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;" >Nombre y Apellidos</th>
                            <th align="center" style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;" >Asistencia</th>
                            <th align="center" style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;" >Firma</th>
                        </tr>
                    </thead>
                    <tbody  >
                        <?php $__currentLoopData = $reunion['participantes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;"><?php echo e($vPar['usuario']['Nombre']); ?> <?php echo e($vPar['usuario']['Apellido']); ?></td>
                            <td align="center" style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;"><?php if($vPar['asistencia']=='1'): ?> SI <?php elseif($vPar['asistencia']=='0'): ?> No <?php endif; ?></td>
                            <td style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;"></td>
                        </tr>
                          
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>



      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.ReporteReunion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/ReporteReunion/Reporte.blade.php ENDPATH**/ ?>