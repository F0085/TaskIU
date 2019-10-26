<div  class="modal fade ModalCrearTareas" id="ModalCrearTareas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 id="TituloTareaCrear" class="modal-title"><i class='fa fa-bookmark'></i> Nueva Tarea</h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="TaskID" hidden="true">
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
                                <option value="5">Laboral</option>
                                <option value="4">Personal</option>
                                <option value="2">Proyecto</option>
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
                                 <option value="<?php echo e($v['Id_Usuario']); ?>" ><?php echo e($v['Nombre']); ?> <?php echo e($v['Apellido']); ?></option>
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
                                 <option value="<?php echo e($v['Id_Usuario']); ?>"><?php echo e($v['Nombre']); ?> <?php echo e($v['Apellido']); ?></option>
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
                                 <option value="<?php echo e($v['Id_Usuario']); ?>"><?php echo e($v['Nombre']); ?> <?php echo e($v['Apellido']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                        </select>
                       <br>
                       <ul class="list-group scroll" id="listaObservadores"></ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer" id="FooterCrearTarea">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="GuardarTarea()" class="btn btn-primary">Aceptar </button>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionTareas/ModalCrearTareas.blade.php ENDPATH**/ ?>