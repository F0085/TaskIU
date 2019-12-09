<!--  -->

	
<?php $__env->startSection('contenido'); ?>
<script src="<?php echo e(asset('js/googleChart.js')); ?>"></script>
<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/EstadisticaAdmin.js')); ?>"></script>

<script src="<?php echo e(asset('css/morris.css')); ?>"></script>
<script src="<?php echo e(asset('js/raphael-min.js')); ?>"></script>
<script src="<?php echo e(asset('js/morris.min.js')); ?>"></script>


 <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="css/jquery.circliful.css">
   
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
			<div class="row">
				    <div class="col-md-12" >

						<div class="container-fluid mt-3">
				                <div class="row">
				                    <div class="col-lg-4 col-sm-6">
				                        <div class="card gradient-1">
				                        	<a style="cursor: pointer" href="/Tareas">
					                            <div class="card-body">
					                                <h3 class="card-title text-white">Tareas Laborales</h3>
					                                <div class="d-inline-block">
					                                    <?php if(isset($TotalTareasAdmin)): ?><h2 class="text-white " id="TaskLaborales"><?php echo e($TotalTareasAdmin['Laboral']); ?></h2><?php endif; ?>
					                               <!--      <p class="text-white mb-0"><a href="/Tareas">Accede a Tareas</a></p> -->
					                                </div>
					                                <span class="float-right display-5 opacity-5"><i class="fa fa-sticky-note"></i></span>
					                            </div>
				                        	</a>
				                        </div>
				                    </div>
				                    <div class="col-lg-4 col-sm-6">
				                        <div class="card gradient-2">
				                        	<a style="cursor: pointer" href="/Tareas">
					                            <div class="card-body">
					                                <h3 class="card-title text-white" >Tareas Personales</h3>
					                                <div class="d-inline-block">
					                                    <?php if(isset($TotalTareasAdmin)): ?><h2 class="text-white" id="TAskPersonales"><?php echo e($TotalTareasAdmin['Personal']); ?></h2><?php endif; ?>
					                                    <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
					                                </div>
					                                <span class="float-right display-5 opacity-5"><i class="fa fa-pencil-square-o"></i></span>
					                            </div>
				                        	</a>
				                        </div>
				                    </div>
				                    <div class="col-lg-4 col-sm-6">
				                        <div class="card gradient-3">
				                        	<a style="cursor: pointer" href="/Reunion">
					                            <div class="card-body">
					                                <h3 style="font-size: 14px" class="card-title text-white"><b>Reuniones</b></h3>
					                                <div class="d-inline-block">
					                                    <?php if(isset($TotalTareasAdmin)): ?><h2 class="text-white" id="ReunionesResponsable"><?php echo e($TotalTareasAdmin['ReunionPendientes']); ?></h2><?php endif; ?>
					                                </div>
					                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
					                            </div>
					                        </a>
				                        </div>
				                    </div>
				                </div>
				      <!--  <center><img  width="100%" src="images/clinica.png"></center> -->
				    	</div>
					</div>
			</div>
			<!-- <hr style="border: solid 1px; "> -->
	<div class="col-lg-12">
			<div class="card">
				<div class="card-title" style="padding-top: 30px; color: black; padding-left: 15px">
					<b><span class="fa fa-user"></span>  FILTRAR POR USUARIO</b>
				</div>
					<div class="card-body" >
						<div class="row">
							<div class="col-md-12">
								<select id="FiltroUsuario" name="FiltroUsuario" onchange="FiltroGeneral(this.value,'','')" class="form-control input-default">
									<option value="">Seleccione el Usuario...</option>
									<?php if(isset($Usuarios)): ?>
										<?php $__currentLoopData = $Usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($val['Id_Usuario']); ?>"><?php echo e($val['Nombre']); ?> <?php echo e($val['Apellido']); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</select>
							</div>
						</div><br>
						<div class="row">
							<div id="divMesAdmin" hidden="true" class="col-md-6">
								<select style="height: 30%"   id="MesAdmin" onchange="FiltroGeneral('','',this.value)" class="form-control input-default">
									<option value="">Seleccione el Mes</option>
									<option value="1">Enero</option>
									<option value="2">Febrero</option>
									<option value="3">Marzo</option>
									<option value="4">Abril</option>
									<option value="5">Mayo</option>
									<option value="6">Junio</option>
									<option value="7">Julio</option>
									<option value="8">Agosto</option>
									<option value="9">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								</select>
							</div>
							<div  id="divAnioAdmin" hidden="true" class="col-md-6">
								<select style="height: 30%"  id="anioAdmin" onchange="FiltroGeneral('',this.value,'')"  class="form-control input-default">
									<option value="">Seleccione el Año</option>
									<option selected="true" value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
									<option value="2026">2026</option>
									<option value="2027">2027</option>
									<option value="2028">2028</option>
									<option value="2029">2029</option>
									<option value="2030">2030</option>
								</select>
							</div>
						</div>	
					
					</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h3 id="TituloSituacion" align="center"><b>SITUACIÓN ACTUAL DE LA EMPRESA</b></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="card" style="background-color: white;height: 82%">
						<div align="center" class="card-title" style="padding-top: 60px; color: black; padding-left: 15px">
							<b>RESPONSABILIDAD LABORAL</b>
						</div>
					
						<div class="card-body" style="padding-top: 0px">
							<div class="row">
								<!-- <div class="col-md-6">
									<select style="height: 30%"   id="MesResponsableLaboral" onchange="ResponsabilidadLaboral('',this.value)" class="form-control input-default">
										<option value="">Seleccione el Mes</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
								</div>
								<div class="col-md-6">
									<select style="height: 30%"  id="anioResponsbleLaboral" onchange="ResponsabilidadLaboral(this.value,'')"  class="form-control input-default">
										<option value="">Seleccione el Año</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										<option value="2026">2026</option>
										<option value="2027">2027</option>
										<option value="2028">2028</option>
										<option value="2029">2029</option>
										<option value="2030">2030</option>
									</select>
								</div> -->
							</div>	
							<center><div style="width: 50%;" align="center" id="TotalRespon" ></div></center>
						</div>

					</div>
				</div>
				<div class="col-lg-6">
					<div class="card" style="background-color: white; padding: 0px;height: 82%">
						<div align="center" class="card-title" style="padding-top: 60px; color: black; padding-left: 15px">
							<b>EFECTIVIDAD LABORAL</b>
						</div>
						<div class="card-body" style="padding-top: 0px">
							<div class="row">
								<!-- <div class="col-md-6">
									<select style="height: 30%" id="MesEfectividad" onchange="EfectividadMeses('',this.value)" class="form-control input-default">
										<option value="">Seleccione el Mes</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
								</div>
								<div class="col-md-6">
									<select  style="height: 30%" id="anioEfectividad" onchange="EfectividadMeses(this.value,'')"  class="form-control input-default">
										<option value="">Seleccione el Año</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										<option value="2026">2026</option>
										<option value="2027">2027</option>
										<option value="2028">2028</option>
										<option value="2029">2029</option>
										<option value="2030">2030</option>
									</select>
								</div> -->
							</div>
							
							<center><div style="width: 70%" align="center" id="Efectividad" ></div></center>
						</div>
					</div>
				</div>

		
			</div>

		<!-- 	<div class="row">
				<div class="col-lg-6">
					<div class="card" style="background-color: white;height: 82%">
						<div align="center" class="card-title" style="padding-top: 60px; color: black; padding-left: 15px">
							<b>RESPONSABILIDAD PERSONAL</b>
						</div>
					
						<div class="card-body" style="padding-top: 0px">
							<div class="row">
								<div class="col-md-6">
									<select style="height: 30%" id="MesResponsablePersonal" onchange="ResponsabilidadPersonal('',this.value)" class="form-control input-default">
										<option value="">Seleccione el Mes</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
								</div>
								<div class="col-md-6">
									<select style="height: 30%"  id="anioResponsblePersonal" onchange="ResponsabilidadPersonal(this.value,'')"  class="form-control input-default">
										<option value="">Seleccione el Año</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										<option value="2026">2026</option>
										<option value="2027">2027</option>
										<option value="2028">2028</option>
										<option value="2029">2029</option>
										<option value="2030">2030</option>
									</select>
								</div>
							</div>	
							<center><div style="width: 50%;" align="center" id="TotalResponP" ></div></center>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card" style="background-color: white; padding: 0px;height: 82%">
						<div align="center" class="card-title" style="padding-top: 60px; color: black; padding-left: 15px">
							<b>EFECTIVIDAD PERSONAL</b>
						</div>
						<div class="card-body" style="padding-top: 0px">
							<div class="row">
								
							</div>

							<center><div style="width: 70%" align="center" id="EfectividadP" ></div></center>
						</div>
					</div>
				</div>
			</div> -->


    	</div>	
  	</div>
 </div>
</div>
<!--  <div class="col-lg-12">
 	<div class="card">
 		<div align="center" class="card-title" style="padding-top: 30px; color: black; padding-left: 15px">
 			<h3><b>LOS 10 MEJORES EMPLEADOS</b></h3>
 		</div>
 		<div class="card-body">
 			<div id="graph"></div>
			<pre id="code" class="prettyprint linenums">
 		</div>
 	</div>
 </div> -->
 <!-- <h1>ESTO LO ESTOY PROGRAMANDO AUN</h1> -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionEstadistica/EstadisticaAdmin.blade.php ENDPATH**/ ?>