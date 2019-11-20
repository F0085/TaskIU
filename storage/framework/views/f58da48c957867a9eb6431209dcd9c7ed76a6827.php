<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <style type="text/css">
.button {
  background-color: #7571f9;
  border: none;
  color: white;
  padding: 10px 27px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
      </style>

   </head>
   <body>
      <h3>INVITACIÓN A REUNIÓN</h3>
      <p>Se le ha asignado como <?php echo e($Tipo); ?> a la reunión con el tema de <?php echo e($Tema); ?> el día <?php echo e($Fecha); ?> a las <?php echo e($Hora); ?><br><br><br>
      <b>Para más información puede acceder al <a href="#">sistema web</a>  con sus credenciales de acceso</b></p><br>
      <a href="http://localhost:8080/" style="color: white" class="button"> Confirmar Asistencia</a>
   </body>
</html><?php /**PATH C:\xampp\htdocs\TaskManta\resources\views/GestionReunion/Email/email.blade.php ENDPATH**/ ?>