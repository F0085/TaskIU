<?php
  session_start(); 
    
?>

<?php $__env->startSection('contenido'); ?>

<!-- PARA EL DATEPICKER -->
<!-- <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
 <link href="./plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet"> -->
<!-- <script type="text/javascript">
     $('.selectpicker').selectpicker({
    style: 'btn-default'
  });
</script> -->

<div id="cargar"></div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-plus-square"></i> Nueva Tarea</h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="" style="color: black"><b>Tarea</b></label>
                            <input onkeyup="borderInput('Nombretarea')" type="text" class="form-control input-default"  placeholder="Ingrese nombre de la tarea" id="Nombretarea" name="Nombretarea" required>
                        </div>                    
                    </div>
                    <div class="col-md-3">
                            <label for="" style="color: black"><b>Tipo</b></label>
                            <select onchange="borderInput('tipoTarea')" class="form-control input-default" name="tipoTarea" id="tipoTarea">
                                <option value="1">Tarea</option>
                                <option value="2">Proyecto</option>
                                <option value="3">Reunión</option>
                            </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" style="color: black"><b>Descripción</b></label>
                        <textarea onkeyup="borderInput('descripcionTarea')" class="form-control input-default" id="descripcionTarea" rows="3" placeholder="Descripción de la tarea a realizar"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Fecha Inicio</b></label>
                        <input  value="<?php echo date("Y-m-d");?>"  onkeyup="borderInput('FechaInicioTarea')"  type="date" class="form-control input-default" id="FechaInicioTarea"> 
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Hora Inicio</b></label>
                        <input value="<?php echo date('h:i');?>" onkeyup="borderInput('HoraInicioTarea')"  type="time" class="form-control input-default" id="HoraInicioTarea"> 
                    </div>
                </div>

                          
                <div class="row">
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Fecha Límite</b></label>
                        <input value="<?php echo date("Y-m-d");?>" onkeyup="borderInput('FechaLimiteTarea')"   type="date" class="form-control input-default" id="FechaLimiteTarea"> 
                    </div>
                    <div class="col-md-6">
                        <label for="" style="color: black"><b>Hora Límite</b></label>
                        <input value="<?php echo date('h:i');?>" onkeyup="borderInput('HoraLimiteTarea')"  type="time" class="form-control input-default" id="HoraLimiteTarea"> 
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                       <label for="" style="color: black"><b>Responsables</b></label>
                       <br>
                        <select onchange="ResponsableTask()" id="ResponsablesTask" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Responsables</b> '
                                multiple="multiple">
                                <?php if(isset($Usuarios)): ?>
                                <?php $__currentLoopData = $Usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($v['Id_Usuario']); ?>" ><?php echo e($v['Nombre']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                        </select>
                       <br>
                       <ul id="listaResponsable" class="list-group scroll">
                        </ul>
                    </div>
                    <div class="col-md-4">
                       <label for="" style="color: black"><b>Participantes</b></label>
                       <br>
                       <select onchange="ParticipantesTask()" id="ParticipantesTask" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Participantes</b> '
                                multiple="multiple">
                                <?php if(isset($Usuarios)): ?>
                                <?php $__currentLoopData = $Usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($v['Id_Usuario']); ?>"><?php echo e($v['Nombre']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                        </select>
                       <br>
                       <ul class="list-group scroll"  id="listaParticipantes"></ul>
                    </div>
                    <div class="col-md-4">
                       <label for="" style="color: black"><b>Observadores</b></label>
                       <br>
                       <select onchange="observadoresTask()" id="ObservadoresTask" class="selectpicker show-menu-arrow" 
                                data-style="form-control" 
                                data-live-search="true" 
                                title='<i style="color:blue" class="fa fa-plus" style="font-weight: bold"></i> <b style="color:blue"> Agregar Observadores</b> '
                                multiple="multiple">
                                <?php if(isset($Usuarios)): ?>
                                <?php $__currentLoopData = $Usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($v['Id_Usuario']); ?>"><?php echo e($v['Nombre']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                        </select>
                       <br>
                       <ul class="list-group scroll" id="listaObservadores"></ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <nav class="stroke">
            <div class="row">
                <div class="col-md-10">
                    <ul>
                      <li ><a class="activado" id="Pendiente" data-value='Proceso'  href="javascript:void(0);"  onClick="proceso('Pendiente');" >Pendientes</a></li>
                      <li ><a  id="Proceso" data-value='Proceso' href="javascript:void(0);"  onClick="proceso('Proceso');" >Proceso</a></li>
                      <li><a id="Terminada" href="javascript:void(0);" onClick="proceso('Terminada');">Terminadas</a></li>
                      <li><a id="Vencida" href="javascript:void(0);" onClick="proceso('Vencida');">Vencidas</a></li>
                    </ul>
                </div>
                <div class="col-md-2 centerDiv" >
                   <button style="background-color: #312d79; color: white"   data-toggle="modal" data-target=".bd-example-modal-lg" type="button" class="btn" > <i class="fa fa-plus-square"></i>  Nueva tarea</button>
                </div>
            </div>
        </nav>
        <div id="ho"></div>         
    </div>
</div>
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <ul>

            <div class="row">
                <div class="col-md-2">
                       <h1 class="card-title" style="padding-top: 20px">LISTA DE TAREAS</h1>
                </div>
                <div class="col-md-8">
            
                </div>
                <div class="col-md-2">
                 <select class="form-control input-default">
                    <option>Todas</option>
                    <option>Trabajo</option>
                    <option>Personal</option>
                 </select>
                </div>
            </div>
               <hr style=" background-color: red; height: 1px">

                <div class="contenedor">
                    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="botonF1">
                      <span>+</span>
                    </button>
                </div>
            <div class="table-responsive">
                <table class="table  header-border table-hover  " id="myTable">
                    <thead>
                        <tr style="color: black">
               <!--              <th scope="col">#</th> -->
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha Lìmite</th>
                            <th scope="col">Creado Por</th>
                            <th scope="col">Responsables</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Observadores</th>
                            <th scope="col" rowspan="2">Progreso</th>
                        </tr>
                    </thead>
                    <tbody id="TablaTareas">
            
                            <?php $__currentLoopData = $Tareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $valores): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr>
     <!--                                <th>1</th> -->
                                    <td > <i  data-toggle="collapse" data-target="#accordion<?php echo e($i+1); ?>" class="clickable collapse-row collapsed fa fa-plus" ></i> <a style="font-size: 0.875rem"  data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0);">  <?php echo e($valores['Nombre']); ?> </a></td>
                                    <td><?php echo e($valores['FechaFin']); ?></td>
                                    <td><i class="fa fa-user"></i> <?php echo e($valores['usuario']['Nombre']); ?> <?php echo e($valores['usuario']['Apellido']); ?></td>
                                    <td id="respo"><?php $__currentLoopData = $valores['responsables']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vRes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <i class="fa fa-user"></i> <?php echo e($vRes['usuario']['Nombre']); ?> <?php echo e($vRes['usuario']['Apellido']); ?> <br><br> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php $__currentLoopData = $valores['participantes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <i class="fa fa-user"></i> <?php echo e($vPar['usuario']['Nombre']); ?> <?php echo e($vPar['usuario']['Apellido']); ?> <br><br> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                    <td><?php $__currentLoopData = $valores['observadores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vObse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <i class="fa fa-user"></i> <?php echo e($vObse['usuario']['Nombre']); ?> <?php echo e($vObse['usuario']['Apellido']); ?> <br><br> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
<!--                                     <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div> 
                                    </td> -->
                                    <td><span class="label gradient-1 btn-rounded">70%</span>
                                    </td>
                                </tr>

                      

                                <?php $__currentLoopData = $valores['sub_tareas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i2 => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                   <tr id="accordion<?php echo e($i+1); ?>" class="collapse" >
                                    <td > <i data-toggle="collapse"  data-target="#accordionSUB<?php echo e($i2+1); ?>" class="clickable collapse-row collapsed fa fa-plus" style="text-indent: 1cm" ></i> <a style="font-size: 0.875rem"  data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0);">   <?php echo e($val['Nombre']); ?></a></td>
                                    <td><?php echo e($val['FechaFin']); ?></td>
                                    <td><i class="fa fa-user"></i> <?php echo e($val['usuario']['Nombre']); ?> <?php echo e($val['usuario']['Apellido']); ?></td>
                                    <td id="respo"><?php $__currentLoopData = $val['responsables']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vRes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <i class="fa fa-user"></i> <?php echo e($vRes['usuario']['Nombre']); ?> <?php echo e($vRes['usuario']['Apellido']); ?> <br><br> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php $__currentLoopData = $val['participantes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <i class="fa fa-user"></i> <?php echo e($vPar['usuario']['Nombre']); ?> <?php echo e($vPar['usuario']['Apellido']); ?> <br><br> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                    <td><?php $__currentLoopData = $val['observadores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vObse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <i class="fa fa-user"></i> <?php echo e($vObse['usuario']['Nombre']); ?> <?php echo e($vObse['usuario']['Apellido']); ?> <br><br> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
<!--                                     <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                            </div>
                                        </div> 
                                    </td> -->
                                    <td><span class="label gradient-1 btn-rounded">70%</span>
                                    </td>
                                    </tr>

                                    <?php $__currentLoopData = $val['sub_tareas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i3 => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <tr  id="accordionSUB<?php echo e($i2+1); ?>" class="collapse">
                                            <td> <i  data-toggle="collapse" data-target="#accordionSUsB<?php echo e($i3+1); ?>" class="clickable collapse-row collapsed fa fa-plus" style="text-indent: 2cm" ></i> <a style="font-size: 0.875rem"  data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0);">   <?php echo e($vals['Nombre']); ?></a></td>
                                            <td><?php echo e($vals['FechaFin']); ?></td>
                                            <td><i class="fa fa-user"></i> <?php echo e($vals['usuario']['Nombre']); ?> <?php echo e($vals['usuario']['Apellido']); ?></td>
                                            <td id="respo"><?php $__currentLoopData = $vals['responsables']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vRes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <i class="fa fa-user"></i> <?php echo e($vals['usuario']['Nombre']); ?> <?php echo e($vRes['usuario']['Apellido']); ?> <br><br> 
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td><?php $__currentLoopData = $vals['participantes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <i class="fa fa-user"></i> <?php echo e($vPar['usuario']['Nombre']); ?> <?php echo e($vPar['usuario']['Apellido']); ?> <br><br> 
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                            <td><?php $__currentLoopData = $vals['observadores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vObse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <i class="fa fa-user"></i> <?php echo e($vObse['usuario']['Nombre']); ?> <?php echo e($vObse['usuario']['Apellido']); ?> <br><br> 
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
        <!--                                     <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div> 
                                            </td> -->
                                            <td><span class="label gradient-1 btn-rounded">70%</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      


                
                    </tbody>
                </table>
                <div id="#ESTE" class="collapse">HOLA</div>
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


    <link href="<?php echo e(asset('css/Mystyle.css')); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo e(asset('js/nav.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/tareas.js')); ?>"></script>
 


<!--     <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> -->
    <!-- Color Picker Plugin JavaScript
    <script src="./js/plugins-init/form-pickers-init.js"></script> -->

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionTareas/MisTareas.blade.php ENDPATH**/ ?>