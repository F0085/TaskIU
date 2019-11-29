
@extends('layouts.ReporteReunion')
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
                <h3>@if(isset($reunion)){{$reunion['Tema']}}@endif</h3>
            </div>
             <div class="col-md-12"style="border: solid 1px #000000;">
                <p style="padding-left:5px;"><b>Orden del Día:</b>  {{$reunion['Orden_del_Dia']}}</p>
                <p style="padding-left:5px;"><b>Fecha de Creación:</b>  {{$reunion['FechaCreacion']}}</p>
                <p style="padding-left:5px;"><b>Fecha de Reunión:</b>  {{$reunion['FechadeReunion']}} {{$reunion['HoraReunion']}}</p>
                <p style="padding-left:5px;"><b>Lugar:</b>  {{$reunion['Lugar']}} </p>
                <p style="padding-left:5px;"><b>Estado:</b>  {{$reunion['Estado']}}</p>
                 <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>RESPONSABLES:</b></p>
                @foreach($reunion['responsables'] as $vres)
                    <p style="padding-left:5px;"><ul><li>{{$vres['usuario']['Nombre']}} {{$vres['usuario']['Apellido']}}</li></ul> </p>
                @endforeach
                <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>PARTICIPANTES:</b></p>
                @foreach($reunion['participantes'] as $vPar)
                    <p style="padding-left:5px;"><ul><li>{{$vPar['usuario']['Nombre']}} {{$vPar['usuario']['Apellido']}}</li></ul> </p>
                @endforeach
                <hr style=" border: solid 1px">
                <p style="padding-left:5px;"><b>LISTA DE OBSERVACIONES:</b></p>
                @foreach($reunion['observacion'] as $vObse)
                    <p style="padding-left:5px;"><ul><li><b>{{$vObse['usuario']['Nombre']}} {{$vObse['usuario']['Apellido']}} </b> ({{$vObse['Fecha']}}) <br>{{$vObse['Descripcion']}} </li>
                    @foreach($vObse['sub_observaciones'] as $vSub)
                        <p style="padding-left:5px;"><ul><li><b>{{$vSub['usuario']['Nombre']}} {{$vSub['usuario']['Apellido']}}</b> ({{$vSub['Fecha']}}) <br>{{$vSub['Descripcion']}} </li></ul> </p>
                    @endforeach
                    </ul> </p>
                @endforeach
                <hr style=" border: solid 1px ">
                <p style="padding-left:5px;"><b>Conclusión:</b></p>
                <p style="padding-left:5px;">{{$reunion['Conclusion']}} </p>

                
               


            </div>

        </div>
                
    </div>
    <br>
    <br>
    <br>

    <br><table style='page-break-after:always;'></br></table><br>   
    		<hr style=" border: solid 1px ">
    		<div class="row">
    			<div align="center" class="col-md-12">
    				<p><b>LISTA DE PARTICIPANTES</b></p>
    			</div>
    		 </div>
				<table >
                    <thead>
                        <tr   >
                            <th align="center" style="    border-top: 1px solid black;
										    border-right: 1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;" >Nombre y Apellidos</th>
                            <th align="center" style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;" >Asistencia</th>
                            <th align="center" style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;" >Firma</th>
                        </tr>
                    </thead>
                    <tbody  >
                        @foreach($reunion['participantes'] as $vPar)

                        <tr>
                            <td style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;">{{$vPar['usuario']['Nombre']}} {{$vPar['usuario']['Apellido']}}</td>
                            <td align="center" style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;">@if($vPar['asistencia']=='1') SI @elseif($vPar['asistencia']=='0') No @endif</td>
                            <td style="    border-top: 1px solid black;
										    border-right:1px solid black;
										    border-bottom: 1px solid black;
										    border-left: 1px solid black;"></td>
                        </tr>
                          
                        @endforeach
                        
                    </tbody>
                </table>



      
@endsection