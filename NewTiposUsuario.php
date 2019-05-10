<?php 

  session_start();

  require 'database.php';

  if (isset($_SESSION['Id_Usuario'])) {

    $Id_Usuario = $_SESSION['Id_Usuario'];
    $TiposUsuario = $_SESSION['TiposUsuario'];

    $stmt = "SELECT * FROM Usuario WHERE Id_Usuario='$Id_Usuario'";

    $Ejecutar = sqlsrv_query($con,$stmt);

    $Datos = sqlsrv_Fetch_array($Ejecutar);

    $User = null;

    if (count($Datos)>0 && ($TiposUsuario == 1 || $TiposUsuario==2) ) {
      $User = $Datos;

    }

  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login_css.css">
    <meta charset="utf-8">
    <title>Tipos Usuario</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>

    <!--<link rel="stylesheet" href="assets/css/style.css">-->

  <body>

    <?php if (!empty($message)): ?>
      <p><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($User)):?>

  <?php require 'partials/headerAdmin.php' ?>
    <span><a href="NewTiposUsuario.php"></a> </span>


  <div class="container">
      <h1 class="rale">Tipos De Usuario</h1>
    <div class="row justify-content-md-center">
      <div class="man col-md-4">

        <form action="NewTiposUsuario.php" method="post">
          <input type="text" required="true" name="TipoUsuario" placeholder="Tipo de Usuario" class="form-control"><br>
          <input type="submit" name="Insertar" value="Enviar" class="form-control bot">
        </form>


      </div>
    </div>
  </div>

  <?php
  require 'database.php';

  if (isset($_POST['Insertar'])) {
    $TipoUsuario =$_POST['TipoUsuario'];

    $sql= "INSERT INTO TiposUsuario (TipoUsuario) VALUES ('$TipoUsuario')";

    $Ejecutar = sqlsrv_query($con,$sql);

    if($Ejecutar === false){
      die( print_r( sqlsrv_errors(), true));
    }else {
      echo "Todo bien";
  }
}

?>
<?php else: ?>
    <h1>Please Login</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a>
  <?php endif;?>
  </body>
</html>
