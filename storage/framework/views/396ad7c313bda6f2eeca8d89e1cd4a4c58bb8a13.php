<!--  -->

	
<?php $__env->startSection('contenido'); ?>
<div class="col-lg-12 es">
    <div class="card">
        <div class="card-body">
        	<div class="row">
        		<div class="col-md-12">
        			<h4><b><span class="fa fa-sticky-note"></span>  REPORTE DE TAREAS</b></h4><br>
        			<select onchange="FiltrarReporte(this.value)" class="form-control input-default">
        				<option value="Terminada">Terminadas</option>
        				<option value="Pendiente">Pendientes</option>
        				<option value="Vencida">Vencidas</option>
        			</select>
        			<br>
			        	 <div class="table-responsive" style="font-size: 12px; overflow:scroll; height:500px; width:100%">
			                <table class="table  header-border table-hover sortable">
			                    <thead>
			                        <tr style="color: black" align="center" >
			               <!--              <th scope="col">#</th> -->
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Nombre</th>
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Fecha Creación</th>
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Tipo</th>
			                            <th style="cursor: pointer;" title="Ordenar" scope="col">Acción</th>

			                        </tr>
			                    </thead>
			                    <tbody id="TablaTareasReporte">
			                    	<?php if(isset($Tareas)): ?>
				                    	<?php $__currentLoopData = $Tareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                    	<tr>
				                    		<td><?php echo e($val['Nombre']); ?></td>
				                    		<td align="center"><?php echo e($val['FechaCreacion']); ?></td>
				                    		<td align="center">Laboral</td>
				                    		<td align="center" ><a style="font-size: 12px" href="GenerarReporte/<?php echo e($val['Id_tarea']); ?>" class="btn btn-success btn-sm"><span class="fa fa-download"></span> Descargar Reporte</a></td>
				                    	</tr>
				                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                    	<?php endif; ?>

			                    </tbody>
			                </table>

			                
			            </div>
        		</div>
        	</div>
        </div>
    </div>
</div>
	
 <script type="text/javascript" src="<?php echo e(asset('js/sorttable.js')); ?>"></script>		
 <script type="text/javascript" src="<?php echo e(asset('js/Reporte.js')); ?>"></script>	


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/Reportes/ReporteTarea.blade.php ENDPATH**/ ?>