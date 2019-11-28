<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ServicesOnlineChone</title>


   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
   
  </head>
  
  <body >
    <center style="padding-top: 200px">
    	<div class="row">
    		<div class="col-md-2"></div>
    		<div class="col-md-8">

	    		<div class="alert alert-success" role="alert" >
	    			@if(isset($Id_Reunion) && isset($Id_Usuario) )
				  	<h4 class="alert-heading">INDIQUE EL MOTIVO DE POR QUÉ NO PUEDE ASISTIR A LA REUNIÓN</h4>
				  	<hr>
				  	<form  enctype="multipart/form-data" class="form-horizontal  " method="POST" action="{{ url('Motivo/'.$Id_Reunion.'/'.$Id_Usuario) }}">
                    {{ csrf_field() }}
				 	<div class="row">
					  	<div class="col-md-12" align="right">
					  		<textarea required="true" name="motivo" class="form-control" placeholder="(Opcional)"></textarea>
					  	</div>
					  	
				  	</div>
				  	<br>
				  	<div class="row">
					  	<div class="col-md-12" align="right">
					  		<button class="btn btn-success" type="submit">Aceptar</button>
					  	</div>
				  	</div>
				  	</form>
	<!-- 				  <label>Lugar:</label>
					  <p class="mb-0">Calceta</p> -->
					  @endif
				</div>

    		</div>
    		<div class="col-md-2"></div>

    	</div>



   
</center>
  </body>
</html>