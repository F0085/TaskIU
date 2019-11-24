
@extends('layouts.reporte')
@section('content')
<style type="text/css">
table {
   width: 100%;
  /* border: 1px solid #000;*/
}
th, td {
  padding: 5px;
    border-top: 0px;
    border-right: 0px;
    border-bottom: 0px solid black;
    border-left: 0px;
}
    </style>
   


	<div class="table-responsive" style="font-size: 12px;">
        <div class="row">
            <div align="center" class="col-md-12"style="border: solid 1px #000000;">
                <h3>@if(isset($tarea)){{$tarea['Nombre']}}@endif</h3>
            </div>
             <div class="col-md-12"style="border: solid 1px #000000;">
                <p style="padding-left:5px;"><b>Descripción:</b>  {{$tarea['Descripcion']}}</p>
                <p style="padding-left:5px;"><b>Fecha de Creación:</b>  {{$tarea['FechaCreacion']}}</p>
                <p style="padding-left:5px;"><b>Fecha de Inicio:</b>  {{$tarea['FechaInicio']}} {{$tarea['Hora_Inicio']}}</p>
                <p style="padding-left:5px;"><b>Fecha límite:</b>  {{$tarea['FechaFin']}} {{$tarea['Hora_Fin']}}</p>
                @if($tarea['Estado_Tarea'] == 'Terminada') 
                <p style="padding-left:5px;"><b>Entregada el:</b>  {{$tarea['FechaEntrega']}}</p>
                @endif
                <p style="padding-left:5px;"><b>Estado:</b>  {{$tarea['Estado_Tarea']}}</p>
                 <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>RESPONSABLES:</b></p>
                @foreach($tarea['responsables'] as $vres)
                    <p style="padding-left:5px;"><ul><li>{{$vres['usuario']['Nombre']}} {{$vres['usuario']['Apellido']}}</li></ul> </p>
                @endforeach
                <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>PARTICIPANTES:</b></p>
                @foreach($tarea['participantes'] as $vPar)
                    <p style="padding-left:5px;"><ul><li>{{$vPar['usuario']['Nombre']}} {{$vPar['usuario']['Apellido']}}</li></ul> </p>
                @endforeach
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>OBSERVADORES:</b></p>
                @foreach($tarea['observadores'] as $vObs)
                    <p style="padding-left:5px;"><ul><li>{{$vObs['usuario']['Nombre']}} {{$vObs['usuario']['Apellido']}}</li></ul> </p>
                @endforeach
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>LISTA DE OBSERVACIONES:</b></p>
                @foreach($tarea['observacion'] as $vObse)
                    <p style="padding-left:5px;"><ul><li><b>{{$vObse['usuario']['Nombre']}} {{$vObse['usuario']['Apellido']}} </b> ({{$vObse['Fecha']}}) <br>{{$vObse['Descripcion']}} </li>
                    @foreach($vObse['sub_observaciones'] as $vSub)
                        <p style="padding-left:5px;"><ul><li><b>{{$vSub['usuario']['Nombre']}} {{$vSub['usuario']['Apellido']}}</b> ({{$vSub['Fecha']}}) <br>{{$vSub['Descripcion']}} </li></ul> </p>
                    @endforeach
                    </ul> </p>
                @endforeach
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>LISTA DE EVIDENCIAS:</b></p>

                <table style="padding-left:5px;" >
                    <thead>
                        <tr  >
                            <th style="       " >Nombre</th>

                            <th >Usuario</th>
                            <th >Fecha</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($tarea['documento'] as $vDoc)
                        <tr>
                            <td style="color:blue"><u>{{$vDoc['Descripcion']}}</u></td>
                            <td>{{$vDoc['usuario']['Nombre']}} {{$vDoc['usuario']['Apellido']}}</td>
                            <td>{{$vDoc['Fecha']}}</td>
                        </tr>
                          
                        @endforeach
                        
                    </tbody>
                </table>
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>SUBTAREAS:</b></p>

                <table style="padding-left:5px;" >
                    <thead >
                        <tr  >
                            <th >Nombre</th>
                            <th >Fecha Creación</th>
                            <th >Fecha Inicio</th>
                            <th >Fecha Límite</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($tarea['reporte_sub_tareas'] as $vSubT)
                        <tr>
                            <td style="color:blue"><u>{{$vSubT['Nombre']}}</u></td>
                            <td>{{$vSubT['FechaCreacion']}}</td>
                            <td>{{$vSubT['FechaInicio']}}</td>
                            <td>{{$vSubT['FechaFin']}}</td>
                        </tr>
                          
                        @endforeach
                        
                    </tbody>
                </table>

<!--                 <p style="padding-left:5px;"><b>Fecha de Creación:</b>  {{$tarea['FechaCreacion']}}</p>
                <p style="padding-left:5px;"><b>Fecha de Inicio:</b>  {{$tarea['FechaInicio']}}</p>
                <p style="padding-left:5px;"><b>Fecha límite:</b>  {{$tarea['FechaFin']}}</p>
                <p style="padding-left:5px;"><b>Entregada el:</b>  {{$tarea['FechaEntrega']}}</p> -->
            </div>

        </div>
                <!-- table class="table " style="border: solid 1px #000000; " id="myTable">
                    <thead>
                        <tr style="color: black">
                            <th  style="cursor: pointer;" title="Ordenar" scope="col" colspan="4">@if(isset($tarea)){{$tarea['Nombre']}}@endif</th>
              <th style="cursor: pointer;" title="Ordenar" scope="col">Fecha Límite</th>
                            <th style="cursor: pointer;" title="Ordenar"  scope="col">Creado Por</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Responsables</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Participantes</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col">Observadores</th>
                            <th style="cursor: pointer;" title="Ordenar" scope="col" rowspan="2">Tipo</th>
                        </tr>
                    </thead>
                    <tbody id="TablaTareas">
                    </tbody>
                </table> -->
    </div>
    <br>
    <br>
    <br>

      
@endsection