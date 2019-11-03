<?php
  session_start(); 
    
?>

<?php $__env->startSection('contenido'); ?>
<div id="cargar"></div>


<?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
    <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>

    <script type="text/javascript">
        $( document ).ready(function() {
            ReunionPorUsuario('Pendiente');
        });
    </script>
    <?php else: ?>
        <script type="text/javascript">
        $( document ).ready(function() {
              ReunionPorUsuario('Pendiente');
        });
       </script>

    <?php endif; ?>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12">
        <nav class="stroke">
            <div class="row">
 <div class="col-md-10 estilo">
                    <ul>
                      <li ><a class="activado" id="Pendiente"   href="javascript:void(0);" 
                        <?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
                            <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>
                                onClick="   ReunionPorUsuario('Pendiente');"
                            <?php else: ?>
                                onClick="   ReunionPorUsuario('Pendiente');"
                            <?php endif; ?>
                        <?php endif; ?>
                        >Pendientes</a></li>
                      <li><a id="Terminada" href="javascript:void(0);"
                        <?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
                            <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>
                                onClick="   ReunionPorUsuario('Terminada');"
                            <?php else: ?>
                                onClick="   ReunionPorUsuario('Terminada');"
                            <?php endif; ?>
                        <?php endif; ?> 
                        >Terminadas</a></li>
                    </ul>
                </div>
                <div class="col-md-2 centerDiv" >
                   <button style="background-color: #312d79; color: white"   onclick="ModalCrearReunion()" type="button" class="btn" > <i class="fa fa-plus-square"></i>  Nueva Reunión</button>
                </div>
            </div>
        </nav>   
    </div>
</div>
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body ">
            <ul>
            <div id="EstaTar" hidden="true"></div>
            <div class="row">
                <div class="col-md-6">
                       <h1 class="card-title" style="padding-top: 20px"><b>LISTA DE REUNIONES</b></h1>
                </div>
                <div class="col-md-6">
                     <?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>

                 <select id="SelecTipoUserReunion" onchange="ReunionesPorRol(this.value)" class="form-control input-default">
                    <option value="CPM">Creadas por mi</option>
                    <option value="MisReunionesResponsables">Responsable</option>
                    <option value="MisReunionesParticipantes">Participante</option> 
                 </select>
                 <?php endif; ?>
                </div>
            </div>
               <hr style=" background-color: red; height: 1px">

                <div class="contenedor">
                    <button style="cursor: pointer;" onclick="ModalCrearReunion();" class="botonF1">
                      <span>+</span>
                    </button>
                </div>
            <div class="table-responsive">
                <table class="table  header-border table-hover estilo " id="myTable">
                    <thead>
                        <tr style="color: black">
               <!--              <th scope="col">#</th> -->
                            <th scope="col">Tema</th>

                            <th scope="col">Lugar</th>
                            <th scope="col">Fecha/Hora</th>
                            <th scope="col">Creado Por</th>
                            <th scope="col">Responsables</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Emisión</th>
                        </tr>
                    </thead>
                    <tbody id="TablaReuniones">
                    </tbody>
                </table>

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
<?php echo $__env->make('GestionReunion.ModalReunionSeguimiento', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('GestionReunion.ModalCrearReunion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link href="<?php echo e(asset('css/MyStyle.css')); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo e(asset('js/nav.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/Reunion.js')); ?>"></script>
 


<!--     <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> -->
    <!-- Color Picker Plugin JavaScript
    <script src="./js/plugins-init/form-pickers-init.js"></script> -->

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionReunion/Reunion.blade.php ENDPATH**/ ?>