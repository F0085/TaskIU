<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <style type="text/css">

      </style>
      <script type="text/javascript">
        function ConfirmarAsistencia(){
          alert('Confirmado');
        }
      </script>

   </head>
   <body>
<!--       <h3>INVITACIÓN A REUNIÓN</h3> -->
      <p>Se le ha asignado como {{$Tipo}} a la reunión con el tema de {{$Tema}} el día {{$Fecha}} a las {{$Hora}}<br><br><br>
      <b>Para más información puede acceder al <a href="http://localhost:8080/" >sistema web</a>  con sus credenciales de acceso</b></p><br>
      <center>
        @if(isset($Id_Reunion) && isset($Id_Usuario) )
         <a  style="text-decoration: none;
                     padding: 10px;
                     font-weight: ;
                     color: #ffffff;
                     background-color: #1883ba;
                     border-radius: 20px;
                     text-align: center;
                     border: 1px solid #ceccecee;" 
                      href="{{url('/ConfirmAsistencia/'.$Id_Reunion.'/'.$Id_Usuario.'/C')}}">
                     CONFIRMO MI ASISTENCIA
          </a>
          <br>
          <br>
          <br>
          <a  style="text-decoration: none;
                     padding: 10px;
                     font-weight: ;
                     color: #ffffff;
                     background-color: #1883ba;
                     border-radius: 20px;
                     text-align: center;
                     border: 1px solid #ceccecee;" 
                      href="{{url('/ConfirmAsistencia/'.$Id_Reunion.'/'.$Id_Usuario.'/NA')}}">
                     NO PODRÉ ASISTIR
          </a>
        @endif
             <br><br><br><br>
      </center> 
      <!-- <a href="http://localhost:8080/" style="color: white" class="button"> Confirmar Asistencia</a> -->
   </body>
</html>