    <?php 

    session_start();

    require 'database.php';

    if (isset($_POST['Aceptar'])) {

      if (!empty($_POST['Correo']) && !empty($_POST['Contraseña'])) {

        $Correo = $_POST['Correo'];
        $Contraseña=$_POST['Contraseña'];

        $records = "SELECT * From Usuario Where Correo='$Correo'";

        $Ejecutar = sqlsrv_query($con,$records);

        $Datos = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);

        $message = '';
      
        if(count($Datos) > 0 && password_verify($_POST['Contraseña'],$Datos['Contraseña'])){
          if ($Datos['Visibilidad']==1) {
          $_SESSION['Id_Usuario']=$Datos['Id_Usuario'];
          $_SESSION['TiposUsuario']=$Datos['TiposUsuario'];
          $_SESSION['Rol']=$Datos['Rol'];

            if ($_SESSION['TiposUsuario'] <= 2) {
              header('location: inicio.php');
            }elseif ($_SESSION['TiposUsuario'] > 2) {
              header('location: inicioSolicitante.php');
            }

        }else{
          $message = "<p style='color:#FF0000'>Tu estatus es inactivo<p/>";
        }
      }else{
        $message = "<p style='color:#FF0000'>No hay coincidencia en la base de datos<p/>";
      }
      }

    }
 ?>


<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/css/login_css.css">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <title>Login</title>
  </head>
  <body>

    <?php require 'partials/headerNormal.php' ?>

   <span><a href="login.php"></a> </span>
    <div class="container">

      <h1 class="rale">Inicio de sesión</h1>

      <div class="row justify-content-md-center">

        <div class="man col-md-4">
 
    <?php if (!empty($message)): ?>
      <p><?=  $message ?></p>
    <?php endif; ?>


          <form action="login.php" method="post">
            <p class="tit">Correo</p>

            <input type="email" name="Correo" placeholder="Correo" class="form-control" required="true">
            <br>
            <p class="tit">Contraseña</p>

            <input type="password" name="Contraseña" placeholder="Contraseña" class="form-control" required="true">
            <br><br>
            <input type="submit" name="Aceptar" value="Enviar" class="form-control bot" required="true">
          </form>
        </div>

      </div>
      

    </div>

    
    
    

  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
