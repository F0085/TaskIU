<?php $__env->startSection('contenido'); ?>



<div id="cargar"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">GESTIÓN ADMINISTRATIVA</h4>
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#AreaP"><span><i class="fa fa-ravelry"></i>  Registro de Áreas</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SubAreas"><span><i class="fa fa-eercast"></i>  Registro de SubAreas</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#AreaRoles"><span><i class="fa fa-superpowers"></i>  Registro de Roles</span></a>
                    </li>
                </ul>
                <div class="tab-content tabcontent-border">
                <div class="tab-pane fade show active" id="AreaP" role="tabpanel">
                        <div class="p-t-15">
                            <div  class="row">
                                <div class="col-md-12" style="padding-top: 3%">             
                                    <div class="card" style="width: 100%; height: 100%">
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <div class="row">

   
                                                    <div class="col-md-5">
                                                        <h4 align="center">Ingreso de Área</h4>
                                                        <hr style=" background-color: red; height: 1px">
                                                  
                                                                <div id="mensajeArea"></div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-2" id="inputId"></div>
                                                                    <div class="col-md-8" style="padding-top: 20px">
                                                                         <input type="text" id="Area" name="Area" class="form-control input-default" placeholder="Nombre del área" required title="Ingrese el nombre del área a registrar" >
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                </div>
                                                                <div class=" form-group row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-8" id="IngresarArea" >
                                                                        <button onclick="RegistrarArea()" type="button" class="btn btn-primary btn-block ">Ingresar </button>

                                                                    </div> 
                                                                   <div class="col-md-2"></div> 
                                                                </div>
                                                
                                                    </div>
                                                    <div class="col-md-7" >
                                                        <h4 align="center">Áreas Registradas</h4>
                                                        <hr style=" background-color: red; height: 1px">
                                                            <div class="table-responsive" style="overflow:scroll; height:230px; width:100%;">
                                                                <table class="table table-bordered table-sm " style="color: black" >
                                                                    <thead>
                                                                        <tr align="center"  >
                                                                            <th >Área</th>
                                                                            <th>Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="table_Area">
                                                                        <?php if(isset($Areas)): ?>
                                                                            <?php $__currentLoopData = $Areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <tr align="center">
                                                                                    <td ><?php echo e($valor['Descripcion']); ?></td>
                                                                                    <td><button  type="button" class=" btn btn-info btn-sm" onclick="EditarArea('<?php echo e($valor['Id_Area']); ?>')">  <span class="ti-pencil-alt"></span></button>  <button  type="button" class=" btn btn-danger btn-sm" onclick="EliminarArea('<?php echo e($valor['Id_Area']); ?>')">  <span class="icon-trash"></span></button>
                                                                                    </td>
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
                                </div>
                            </div>
                        </div>
                </div>
                <div class="tab-pane fade" id="SubAreas" role="tabpanel">
                    <div class="p-t-15">
                             <div  class="row">
                                <div class="col-md-12" style="padding-top: 3%">             
                                    <div class="card" style="width: 100%; height: 100%">
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <h4 align="center">Registro de SubAreas</h4>
                                                        <hr style=" background-color: red; height: 1px">
                                                            <div hidden id="inputIdSubArea"></div>
                                                            <div id="mensajeSubArea"></div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12" style="padding-top: 20px">
                                                                        <label for="" style="color: black"><b>Área</b></label>
                                                                        <select name="AreaSubArea" id="AreaSubArea" class="form-control input-default">
                                                                            <option value="0">Seleccione el Área</option>
                                                                            <?php $__currentLoopData = $Areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($v['Id_Area']); ?>"><?php echo e($v['Descripcion']); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12" style="padding-top: 20px">
                                                                        <label for="" style="color: black"><b>SubArea</b></label>
                                                                         <input type="text" id="SubAreaInp" name="SubAreaInp" class="form-control input-default" placeholder="Ingrese la SubArea" required title="Ingrese el SubArea a registrar" >
                                                                    </div>
                                                                </div>
                                                                <div class=" form-group row">
                                                                    <div class="col-md-12" id="IngresarSubArea" >
                                                                        <button onclick="RegistrarSubArea()" type="button" class="btn btn-primary btn-block ">Ingresar </button>

                                                                    </div> 
                                                                </div>

                                                    </div>
                                                    <div class="col-md-7" >
                                                        <h4 align="center">SubAreas Resgistradas</h4>
                                                        <hr style=" background-color: red; height: 1px">
                                                            <div class="table-responsive" style="overflow:scroll; height:230px; width:100%;">
                                                                <table class="table table-bordered table-sm " style="color: black" >
                                                                    <thead>
                                                                        <tr align="center"  >
                                                                            <th >Área</th>
                                                                            <th>SubArea</th>
                                                                            <th>Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="table_SubArea">
                                                                        <?php if(isset($AreaSubArea)): ?>
                                                                            <?php $__currentLoopData = $AreaSubArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <tr align="center">
                                                                                    <td ><?php echo e($valor['Area']); ?></td>
                                                                                     <td ><?php echo e($valor['SubArea']); ?></td>
                                                                           
                                                                                    <td><button  type="button" class=" btn btn-info btn-sm" onclick="EditarSubArea('<?php echo e($valor['Id_Sub_Area']); ?>')">  <span class="ti-pencil-alt"></span></button>  <button  type="button" class=" btn btn-danger btn-sm" onclick="EliminarSubArea('<?php echo e($valor['Id_Sub_Area']); ?>')">  <span class="icon-trash"></span></button>
                                                                                    </td>
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
                                </div>
                            </div>
               
                    </div>
                </div>
                <div class="tab-pane fade" id="AreaRoles" role="tabpanel">
                    <div class="p-t-15">    
                        <div  class="row">
                            <div class="col-md-12" style="padding-top: 3%">             
                                <div class="card" style="width: 100%; height: 100%">
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4 align="center">Registro de Roles</h4>
                                                    <hr style=" background-color: red; height: 1px">
                                                        <div hidden id="inputIdRol"></div>
                                                        <div  id="mensajeRol"></div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12" style="padding-top: 20px">
                                                                    <label for="" style="color: black"><b>Área</b></label>
                                                                    <select onchange="AreaSubARol(this.value,'')" name="AreaROL" id="AreaROL" class="form-control input-default">
                                                                        <option value="0">Seleccione el Área</option>
                                                                        <?php $__currentLoopData = $Areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($v['Id_Area']); ?>"><?php echo e($v['Descripcion']); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                     <label for="" style="color: black"><b>SubArea</b></label>
                                                                    <select disabled="true" name="SubArea_A_ROL" id="SubArea_A_ROL" class="form-control input-default">
                                                                        <option value="0">Seleccione la SubArea</option>
                                                                        <?php $__currentLoopData = $SubArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($v['Id_Sub_Area']); ?>"><?php echo e($v['Descripcion']); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                               
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label for="" style="color: black"><b>Rol</b></label>
                                                                     <input type="text" name="ROL_A_ROL" id="ROL_A_ROL" class="input-default form-control" placeholder="Ingrese el Rol">
                                                                </div>
                                                            </div>
                                                            <div class=" form-group row">
                                                                <div class="col-md-12" id="IngresarRol" >
                                                                    <button onclick="IngresarRol()" type="button" class="btn btn-primary btn-block ">Ingresar </button>

                                                                </div> 
                                                            </div>
                                                </div>
                                                <div class="col-md-8" >
                                                    <h4 align="center">Roles Registrados</h4>
                                                    <hr style=" background-color: red; height: 1px">
                                                             <div class="table-responsive" style="overflow:scroll;  height:335px; width:100%;">
                                                                <table class="table table-bordered table-sm " style="color: black" >
                                                                    <thead>
                                                                        <tr align="center"  >
                                                                            <th >Área</th>
                                                                            <th>SubArea</th>
                                                                            <th>Rol</th>
                                                                            <th>Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="table_Roles" style="font-family: 'Arial'; font-weight: normal">
                                                                        <?php if(isset($ListaRoles)): ?>
                                                                            <?php $__currentLoopData = $ListaRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <tr align="center">
                                                                                    <td ><?php echo e($valor['Area']); ?></td>
                                                                                    <td ><?php echo e($valor['Sub_Area']); ?></td>
                                                                                    <td ><?php echo e($valor['Rol']); ?></td>
                                                                                    <td><button  type="button" class=" btn btn-info btn-sm" onclick="EditarRol('<?php echo e($valor['Id_Roles']); ?>')">  <span class="ti-pencil-alt"></span></button>  <button  type="button" class=" btn btn-danger btn-sm" onclick="EliminarRol('<?php echo e($valor['Id_Roles']); ?>')">  <span class="icon-trash"></span></button>
                                                                                    </td>
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
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
      <script src="<?php echo e(asset('js/AdministracionGeneral.js')); ?>"></script>
<!--       <script src="<?php echo e(asset('js/tablesorter.js')); ?>"></script> -->
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionAdministrativa/AdministracionGeneral.blade.php ENDPATH**/ ?>