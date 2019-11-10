<?php
  session_start(); 
    
?>
@if(isset($_SESSION['id']))
   <script type="text/javascript">
            window.location = "/home";//here double curly bracket
        </script>
@endif

<!DOCTYPE html>
<html class="h-100" lang="en"> 
<head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>CARDIOCENTRO MANTA</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logocc.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="h-100" style="background-color: #4e73df">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="cargar">

    </div>
    <!--*******************
        Preloader end
    ********************-->
    <br><br>
    <div class="login-form-bg " >
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-xl-10">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4">
                                <center><img src="images/logocardiocentro.png" width="30%" alt=""></center>
                               <hr style=" background-color: red; height: 1px">
                   <!--                  <a class="text-center" href="index.html"> <h4>REGISTRARSE</h4></a> -->
                              <div id="MensajeAlerta"></div>
                            <form class="mt-5 mb-5 " id="contenidoRegister">
                                <div  id="inputIUS"></div>
                                <div class="row">
                                    <div class="col-md-4">
                                       
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Cédula</b></label>
                                            <input onblur="ObtenerUsuariosPreparar()" type="number" class="form-control input-default"  placeholder="Ingrese cédula" id="cedula" name="cedula" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Nombres</b></label>
                                            <input type="text" class="form-control input-default"  placeholder="Ingrese nombres" id="nombre" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>Apellidos</b></label>
                                            <input type="text" id="apellido" name="apellido" class="form-control input-default"  placeholder="Ingrese apellidos" required>
                                        </div>
                                    </div>       

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                         <label for="" style="color: black"><b>Dirección</b></label>
                                            <input type="text" id="direccion" name="direccion" class="form-control input-default"  placeholder="Ingrese dirección" required>
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>Celular</b></label>
                                            <input type="number" class="form-control input-default"  placeholder="Ingrese celular" id="Celular" name="Celular" required>
                                        </div>
                                    </div>   
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="" style="color: black"><b>Sexo</b></label>
                                            <select class="form-control input-default" name="Sexo" id="Sexo">
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                     </div>                                      
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Tipo de Usuario</b></label>
                                            <select class="form-control input-default" name="tipoUser" id="tipoUser">
                                                <option selected="true" value="1">Empleado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Email</b></label>
                                            <input type="email" id="email" name="email" class="form-control input-default"  placeholder="Email" required>
                                        </div>
                                    </div> 
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Área</b></label>
                                            <select  onchange="AreaSubARegisUser(this.value,'')" class="form-control input-default" name="Area" id="Area">}
                                                <option value="0">Seleccione el Área</option>
                                                    @if(isset($Area))
                                                        @foreach($Area as $valor)
                                                            <option value="{{$valor['Id_Area']}}">{{$valor['Descripcion']}}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>   
                                     
                                </div>
                                <div class="row">

                                    <div class="col-md-6">  
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>SubArea</b></label>
                                            <select onchange="SubAreaRoles(this.value)"   disabled="true"  class="form-control input-default" name="SubArea" id="SubArea">}
                                                <option value="0">Seleccione la SubArea</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                         <div class="form-group" >
                                            <label for="" style="color: black"><b>Rol</b></label>
                                            <select disabled="true"  class="form-control input-default" name="Rol" id="Rol">}
                                                <option value="0">Seleccione el Rol</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Contraseña</b></label>
                                            <input type="password" id="password" name="password" class="form-control input-default"  placeholder="Clave" required>
                                        </div>
                                    </div>      
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Confirmar Contraseña</b></label>
                                            <input type="password" id="passwordConfir" name="passwordConfir" class="form-control input-default"  placeholder="Confirmar Clave" required>
                                        </div>
                                    </div>           
                                </div>
                                <div id="IngresarUser" >
                                <button type="button" onclick="RegistrarUsuario('Z')" class="btn btn-primary btn-block">Registrar</button>
                                <br>
                                </div>  <p align="center">Ya tengo una cuenta! <a href="{{url('login')}}" class="text-primary">Iniciar Sesión</a></p>
                            </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('js/AdministracionGeneral.js') }}"></script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="{{ asset('js/alertify.js') }}" defer></script>
    <!-- CSS -->
    <link rel="stylesheet" href="css/alertify.css" />
</body>
</html>

