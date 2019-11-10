<?php
  session_start(); 
    
?>
@extends('layouts.app')
@section('contenido')
<div id="cargar"></div>
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                 <div class="card">
                     <div class="card-body">

                            <h4 align="center">Registro de Usuarios</h4>
                            <hr style=" background-color: red; height: 1px">
                            <div id="MensajeAlerta"></div>
        
                            <form class="mt-5 mb-5 ">
                                <div  id="inputIUS"></div>
                                <div class="row">
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Cédula</b></label>
                                            <input onblur="ObtenerUsuariosPreparar()" type="number" onkeyup="borderInput('cedula')"  class="form-control input-default"  placeholder="Ingrese cédula" id="cedula" name="cedula" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Nombres</b></label>
                                            <input onkeyup="borderInput('nombre')" type="text" class="  form-control input-default"  placeholder="Ingrese nombres" id="nombre" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>Apellidos</b></label>
                                            <input onkeyup="borderInput('apellido')" type="text" id="apellido" name="apellido" class="form-control input-default"  placeholder="Ingrese apellidos" required>
                                        </div>
                                    </div>    
                                    <div class="col-md-3">                                     
                                    <div class="form-group">
                                         <label for="" style="color: black"><b>Dirección</b></label>
                                            <input onkeyup="borderInput('direccion')" type="text" id="direccion" name="direccion" class="form-control input-default"  placeholder="Ingrese dirección" required>
                                        </div>
                                    </div>      

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                       
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Celular</b></label>
                                            <input onkeyup="borderInput('Celular')" type="number" class="form-control input-default"  placeholder="Ingrese celular" id="Celular" name="Celular" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Sexo</b></label>
                                            <select  onchange="borderInput('Sexo')"  class="form-control input-default" name="Sexo" id="Sexo">
                                                 <option value="0">Seleccione el Sexo...</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Tipo de Usuario</b></label>
                                            <select onchange="borderInput('tipoUser')" class="form-control input-default" name="tipoUser" id="tipoUser">
                                                <option value="0">Seleccione Tipo Usuario...</option>
                                                <option value="1">Empleado</option>
                                                <option value="2">Adminsitrador</option>
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>Email</b></label>
                                            <input onkeyup="borderInput('email')" type="email" id="email" name="email" class="form-control input-default"  placeholder="Email" required>
                                        </div>
                                    </div>      

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" style="color: black"><b>Área</b></label>
                                            <select   onchange="AreaSubARegisUser(this.value,'')" class="form-control input-default" name="Area" id="Area">}
                                                <option value="0">Seleccione el Área</option>
                                                    @if(isset($Area))
                                                        @foreach($Area as $valor)
                                                            <option value="{{$valor['Id_Area']}}">{{$valor['Descripcion']}}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>SubArea</b></label>
                                            <select onchange="SubAreaRoles(this.value)"   disabled="true"  class="form-control input-default" name="SubArea" id="SubArea">}
                                                <option value="0">Seleccione la subarea</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        
                                        <div class="form-group">
                                           <label for="" style="color: black"><b>Rol</b></label>
                                            <select onchange="borderInput('Rol')"   disabled="true"  class="form-control input-default" name="Rol" id="Rol">}
                                                <option value="0">Seleccione el Rol</option>
                                            </select>
                                        </div>
                                    </div> 

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                           <label id="passwordLabel" for="" style="color: black"><b>Contraseña</b></label>
                                            <input onkeyup="borderInput('password')" type="password" id="password" name="password" class="form-control input-default"  placeholder="Clave" required>
                                        </div>
                                    </div>    
                                          <div class="col-md-6">
                                        
                                        <div class="form-group">
                                           <label id="passwordConfirLabel" for="" style="color: black"><b>Confirmar Contraseña</b></label>
                                            <input onkeyup="borderInput('passwordConfir')" type="password" id="passwordConfir" name="passwordConfir" class="form-control input-default"  placeholder="Confirmar Clave" required>
                                        </div>
                                    </div> 
                                    
                                </div>
                               
                                <div id="IngresarUser" >
                                <button type="button" onclick="RegistrarUsuario('A')" class="btn btn-primary btn-block">Registrar</button>
                                </div> 
                            </form>

                            <div class="row">
                                <div class="col-md-12"> 
                                    <h4 align="center">Lista de Usuarios</h4>
                                    <hr style=" background-color: red; height: 1px">
                                        <div class="table-responsive" style="overflow:scroll; height:230px; width:100%;">
                                            <table class="table table-bordered table-sm " style="color: black" >
                                                <thead>
                                                    <tr align="center"  >
                                                        <th >Usuario</th>
                                                        <th >Cédula</th>
                                                        <th >Dirección</th>
                                                        <th >Tipo Usuario</th>
                                                        <th>Email</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_Usuarios">
                                                    @if(isset($Usuarios))
                                                        @foreach($Usuarios as $valor)
                                                            <tr align="center">
                                                                <td >{{$valor['Nombre']}} {{$valor['Apellido']}} </td>
                                                                <td >{{$valor['Cedula']}}</td>
                                                                <td >{{$valor['Direccion']}}</td>
                                                                <td >{{$valor['TipoUsuario']}}</td>
                                                                <td >{{$valor['email']}}</td>
                                                                <td><button  type="button" class=" btn btn-info btn-sm" onclick="EditarUsuarios('{{$valor['Id_Usuario']}}')">  <span class="ti-pencil-alt"></span></button>  <button disabled="" readonly type="button" class=" btn btn-danger btn-sm" onclick="EliminarArea('{{$valor['Id_Usuario']}}')">  <span class="icon-trash"></span></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
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
          <script src="{{ asset('js/AdministracionGeneral.js') }}"></script>
@endsection