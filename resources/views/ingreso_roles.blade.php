@extends('layouts.app')
@section('contenido')
    <div class="container-fluid" >
        <div  class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h1 style="font-size: 20px" align="center" class="card-title">REGISTRO DE ROLES</h1>
                        <hr style=" background-color: red; height: 1px">
                        <br>
                  <!--       <p class="text-muted m-b-15 f-s-12">Use the input classes on an <code>.input-default, input-flat, .input-rounded</code> for Default input.</p> -->
                        <div class="basic-form">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                            @if(session()->has('rol_existe'))
                                 <script type="text/javascript">
                                    $(document).ready(function () {
                                         alertify.@if(session()->has('success')) success('{{session('rol_existe')}}') @else error('{{session('rol_existe')}}') @endif;
                                    });
                                </script>            
                            @endif 
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        <form class="form-horizontal" method="POST" action="{{ route('rolesUser') }}">
                             {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                         <input type="text" id="Nombre_Rol" name="Nombre_Rol" class="form-control input-rounded" placeholder="Nombre" required="">
                                    </div>
                                    <div class="col-md-4">
                                         <input type="number" id="Nivel_Rol" name="Nivel_Rol" class="form-control input-rounded" placeholder="Nivel" required="">
                                    </div>
                                       <div class="col-md-2"></div>
                                </div>
                                <div class=" form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <button class="btn btn-primary btn-block">Ingresar </button>
                                    </div> 
                                    <div class="col-md-2"></div> 
                                </div>
                            </form>
                           
                        </div>
                        <hr>
                        <div class="table-responsive" style="overflow:scroll;
                                                             height:270px;
                                                             width:100%;">
                            <div class="row" >
                                <div class="col-sm-12" >
                                    <table style="color: black" class="table table-striped table-bordered zero-configuration dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr align="center" >
                                                <th >Rol</th>
                                                <th>Nivel</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($roles_usuario))
                                                @foreach($roles_usuario as $valor)
                                                <tr align="center">
                                                    <td >{{$valor->descripcion}}</td>
                                                    <td>{{$valor->nivel}}</td>
                                                    <td><button style="background-color: red" type="button" class="btn-sm mb-1  btn-danger" href="">  <span class="icon-trash"></span></button></td>
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
            <div class="col-lg-2"></div>
        </div>

    </div>

@endsection