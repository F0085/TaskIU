
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CARDIOCENTRO MANTA</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logocc.png">
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/Perfil.js')); ?>"></script>
       <script type="text/javascript" src="<?php echo e(asset('js/notificaciones.js')); ?>"></script>

    <!-- Custom Stylesheet -->
<!--     <link href="./plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet"> -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
      
  
    <style type="text/css">
         .content-body{
         min-height: 490px !important;
         }
    </style>
    <script>
        function TiempoActividad()
        {
            setTimeout("CerrarSesion()", 18000000);
        }
        function CerrarSesion(){
            location.href = "/logout";
        }
    </script>


</head>
<?php if(isset($_SESSION['id'])): ?>
<body  onload="TiempoActividad();NotificarTareas('<?php echo e($_SESSION['id']); ?>')" >
<?php else: ?>
<body  onload="TiempoActividad();">


<?php endif; ?>




    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div  id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="text-align: center">
           
                <a href="<?php echo e(asset('home')); ?>">
                    <b class="logo-abbr"><img src="<?php echo e(asset('images/logocc.png')); ?>" width="100%" alt=""> </b>
                    <span class="logo-compact"><img src="<?php echo e(asset('./images/logocc.png')); ?>" width="100%" alt=""></span>
                    <span class="brand-title">
                        <img src="<?php echo e(asset('images/logocardiocentro.png')); ?>" width="79%" alt="">
                    </span>
                </a>
            
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
   <!--              <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down   d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a <?php if(isset($_SESSION['id'])): ?> onclick="NotificarTareas('<?php echo e($_SESSION['id']); ?>');" <?php endif; ?>  href="javascript:void(0)" data-toggle="dropdown">
                                <i  class="mdi mdi-bell-outline"></i>
                                <span id="newMessage" class="badge gradient-1 badge-pill badge-primary"></span>
                            </a>
                            <div id="claseshow" class="drop-down animated fadeIn dropdown-menu ">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span id="cantidaNoti"  class=""></span>  
                                    
                                </div>
                                <div class="dropdown-content-body" style="overflow:scroll; height:350px; width:100%">
                                    <ul id="CuerpoNotificaciones">
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <!-- <img class="float-left mr-3 avatar-img" src="<?php echo e(asset('images/form-user.png')); ?>" alt=""> -->
             <!--                                    <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div> -->
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
   <!--                      <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2 badge-primary">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li> -->
        
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span><?php if(isset($_SESSION['nombre'])): ?><?php echo e($_SESSION['nombre']); ?> <?php echo e($_SESSION['apellido']); ?><?php endif; ?></span> <!--  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i> -->
                            </a>
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                             
                                <img src="<?php echo e(asset('images/user/1.png')); ?>" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">

                                    <ul>
                                        <?php if(isset($_SESSION['id'])): ?>
                                        <li>
                                            <a href="<?php echo e(url('Perfil')); ?>"><i class="icon-user"></i> <span>Perfil</span></a>
                                        </li>
                                        <li><a href="javascript:void(0)" onclick="Cambiarclave()" ><i class="icon-key"></i> <span>Cambiar Clave</span></a>
                                        <li><a href="<?php echo e(url('logout')); ?>" ><i class="icon-logout"></i> <span>Cerrar Sesión</span></a>
                                        <?php else: ?>
                                        <li><a href="<?php echo e(url('login')); ?>" ><i class="icon-key"></i> <span>Iniciar Sesión</span></a>
                                        <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
         <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">BIENVENIDO</li>

                    <li class="mega-menu mega-menu-sm">
                        <a href="<?php echo e(url('/Tareas')); ?>" class="" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-sticky-note"></i><span class="nav-text">Tareas</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a href="<?php echo e(url('/Reunion')); ?>" class="" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-bullhorn"></i><span class="nav-text">Reunión</span>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['id'])): ?>
                        <?php if($_SESSION['Id_tipo_Usuarios']=='2'): ?>                      
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Gestión Administrativa</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="<?php echo e(url('/Administracion')); ?>"><i class="ti-bag"></i>Administración General</a></li>
                                <li><a href="<?php echo e(url('/registro')); ?>"><i class="ti-user"></i>Registro de Usuarios</a></li>
                              <!--   <li><a href=""><i class="ti-lock"></i>Permisos de Usuarios</a></li> -->
                            </ul>
                        </li>
                        <li class="mega-menu mega-menu-sm">
                            <a href="<?php echo e(url('/EstadisticaAdmin')); ?>" class="" href="javascript:void()" aria-expanded="false">
                                <i class="fa fa-pie-chart"></i><span class="nav-text">Estadística</span>
                            </a>
                        </li>
                        <li class="mega-menu mega-menu-sm">
                            <a href="<?php echo e(url('/Reportes')); ?>" class="" href="javascript:void()" aria-expanded="false">
                                <i class="fa fa-file-text-o"></i><span class="nav-text">Reportes de Tareas</span>
                            </a>
                        </li>
                          <?php endif; ?>
                    <?php endif; ?>
                    <li class="mega-menu mega-menu-sm">
                        <a href="<?php echo e(url('/Organigrama')); ?>" class="" href="javascript:void()" aria-expanded="false">
                            <i class="ti-layers-alt menu-icon"></i><span class="nav-text">Organigrama Institucional</span>
                        </a>
                    </li>

                      <?php if(isset($_SESSION['id'])): ?>
                        <?php if($_SESSION['Id_tipo_Usuarios']=='1'): ?>  
                            <li class="mega-menu mega-menu-sm">
                                <a href="<?php echo e(url('/home')); ?>" class="" href="javascript:void()" aria-expanded="false">
                                    <i class="fa fa-pie-chart"></i><span class="nav-text">Estadística</span>
                                </a>
                            </li>
                         <?php endif; ?>
                    <?php endif; ?>
<!--                     <li class="nav-label">Apps</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Email</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./email-inbox.html">Inbox</a></li>
                            <li><a href="./email-read.html">Read</a></li>
                            <li><a href="./email-compose.html">Compose</a></li>
                        </ul>
                    </li> -->
                    <!-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Apps</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-calender.html">Calender</a></li>
                        </ul>
                    </li> -->
<!--                     <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i> <span class="nav-text">Charts</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./chart-flot.html">Flot</a></li>
                            <li><a href="./chart-morris.html">Morris</a></li>
                            <li><a href="./chart-chartjs.html">Chartjs</a></li>
                            <li><a href="./chart-chartist.html">Chartist</a></li>
                            <li><a href="./chart-sparkline.html">Sparkline</a></li>
                            <li><a href="./chart-peity.html">Peity</a></li>
                        </ul>
                    </li> -->
<!--                     <li class="nav-label">UI Components</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">UI Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-cards.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./uc-nestedable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                        </ul>
                    </li> -->
  <!--                   <li>
                        <a href="widgets.html" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Widget</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-label">Forms</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Forms</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./form-basic.html">Basic Form</a></li>
                            <li><a href="./form-validation.html">Form Validation</a></li>
                            <li><a href="./form-step.html">Step Form</a></li>
                            <li><a href="./form-editor.html">Editor</a></li>
                            <li><a href="./form-picker.html">Picker</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-label">Table</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i><span class="nav-text">Table</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./table-basic.html" aria-expanded="false">Basic Table</a></li>
                            <li><a href="./table-datatable.html" aria-expanded="false">Data Table</a></li>
                        </ul>
                    </li> -->

                    
                    <li class="nav-label">Configuración</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Cuenta</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php if(isset($_SESSION['id'])): ?>
                                <li> <a href="<?php echo e(url('Perfil')); ?>"><i class="icon-user"></i> <span>Perfil</span></a></li>
                                <li><a href="javascript:void(0)" onclick="Cambiarclave()" ><i class="icon-key"></i> <span>Cambiar Clave</span></a></li>
                                <li><a href="<?php echo e(url('logout')); ?>" ><i class="icon-logout"></i> <span>Cerrar Sesión</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
   
    <!-- Default theme -->


        <?php echo $__env->make('ModalCambiarClave', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   

        <div class="content-body stylefuente" >    <!-- style=" background-image: url('images/cardiocentro.jpg'); background-repeat: no-repeat; height: 100%; background-size: 100%"  > -->
        <br>
          <?php echo $__env->yieldContent('contenido'); ?> 
          <?php echo $__env->make('PerfilUsuario.ModalPerfil', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
<!--         <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="www.espam.edu.ec">ESPAM MFL</a> 2019</p>
            </div>
        </div> -->
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->


<!--     
    <script src="/plugins/jqueryui/js/jquery-ui.min.js"></script>
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="/js/plugins-init/fullcalendar-init.js"></script>



    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script> -->
 <!--    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script> -->
<!--     <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script> -->


         <script src="<?php echo e(asset('plugins/common/common.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/settings.js')); ?>"></script>
    <script src="<?php echo e(asset('js/gleek.js')); ?>"></script>
    <script src="<?php echo e(asset('js/styleSwitcher.js')); ?>"></script>
    <script src="<?php echo e(asset('js/alertify.js')); ?>"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/alertify.css')); ?>" />
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.orgchart.js')); ?>"></script>
    <script src="js/jquery.circliful.js"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/layouts/app.blade.php ENDPATH**/ ?>