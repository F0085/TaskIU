<?php
  session_start(); 
    
?>

<?php $__env->startSection('contenido'); ?>
<div id="cargar"></div>


<?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
    <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>

    <script type="text/javascript">
        $( document ).ready(function() {
            ReunionAdmin('Pendiente');
        });
    </script>
    <?php else: ?>
        <script type="text/javascript">
        $( document ).ready(function() {
              ReunionPorUsuario('Pendiente');
        });
       </script>

    <?php endif; ?>
    <?php if(session()->has('IdTtar_Reu')): ?>
    <?php if(session('tipoRol')=='Responsable'): ?>
    <script type="text/javascript">
       $( document ).ready(function() {
         $('#SelecTipoUserReunion').val('MisReunionesResponsables');
          // $('#TablaTareas').html('');
            ReunionesPorRol('MisReunionesResponsables');
          ModalReunion('<?php echo e(session('IdTtar_Reu')); ?>');

         });
    </script>
    <?php endif; ?>
    <?php if(session('tipoRol')=='Participante'): ?>
    <script type="text/javascript">
       $( document ).ready(function() {
         $('#SelecTipoUserReunion').val('MisReunionesParticipantes');
          // $('#TablaTareas').html('');
          ReunionesPorRol('MisReunionesParticipantes');
          ModalReunion('<?php echo e(session('IdTtar_Reu')); ?>');


         });
    </script>
    <?php endif; ?>
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
                                    onClick="   ReunionAdmin('Pendiente');"
                                <?php else: ?>
                                    onClick="   ReunionPorUsuario('Pendiente');"
                                <?php endif; ?>
                            <?php endif; ?>>Pendientes</a>
                        </li>
                         <li><a id="Terminada" href="javascript:void(0);"
                            <?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
                                <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>
                                    onClick="   ReunionAdmin('Terminada');"
                                <?php else: ?>
                                    onClick="   ReunionPorUsuario('Terminada');"
                                <?php endif; ?>
                            <?php endif; ?>>Terminadas</a>
                        </li>
                        <li><a id="Suspendida" href="javascript:void(0);"
                            <?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
                                <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>
                                    onClick="   ReunionAdmin('Suspendida');"
                                <?php else: ?>
                                    onClick="   ReunionPorUsuario('Suspendida');"
                                <?php endif; ?>
                            <?php endif; ?>>Suspendidas</a>
                        </li>
                        <!-- <li><a id="Vencida" href="javascript:void(0);"
                            <?php if(isset($_SESSION['Id_tipo_Usuarios'])): ?>
                                <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>
                                    onClick="   ReunionPorUsuario('Vencida');"
                                <?php else: ?>
                                    onClick="   ReunionPorUsuario('Vencida');"
                                <?php endif; ?>
                            <?php endif; ?>>Vencidas</a>
                        </li> -->
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
            <input id="EstadoObservacion" hidden="true">            
            <div class="row">
                <div class="col-md-6">
                       <h1 class="card-title" style="padding-top: 20px"><b>LISTA DE REUNIONES</b></h1>
                </div>
                <div class="col-md-6" id="PanelAdminRol">
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
            <div class="table-responsive" style="font-size: 12px; overflow:scroll; height:500px; width:100%">
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
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="TablaReuniones">
                    </tbody>
                </table>

<!--                 <nav aria-label="Page navigation example">
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
                </nav> -->
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('GestionReunion.ModalReunionSeguimiento', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('GestionReunion.ModalCrearReunion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <div class="modal fade" id="id_modal_conf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-question-circle"></span>  Confirmación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro de terminar la reunión, una vez terminada no podrá editarla?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="TerminarReunion()" >Si</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
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