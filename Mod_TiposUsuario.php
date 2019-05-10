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

 <?php 
  $DatoObtenido=ConsultarTiposUsuario($_GET['Id_TiposUsuario2']);
  function ConsultarTiposUsuario($No_TiposUsuario){
  require 'database.php';
  $Consulta2 = "SELECT * FROM TiposUsuario WHERE Id_TiposUsuario='$No_TiposUsuario'";
  $resultado = sqlsrv_query($con,$Consulta2);
  $filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
return[
  $filas['Id_TiposUsuario'],
  $filas['TipoUsuario']
];

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
    <title>Modificar Tipos de usuario</title>
  </head>
  <body>
  <?php if (!empty($User)):?>
    <?php require 'Partials/headerAdmin.php' ?>

    <span><a href="Mod_TiposUsuario.php"></a> </span>
    <div class="container">

      <h3 class="rale">Modificar Tipos de Usuario</h3>

      <div class="row justify-content-md-center">

        <div class="man col-md-4">
<!-- ndgasidfgasdfsagfasdf<hkgzidfh<dfilhfs-->
          <form action="Mod_TiposUsuario2.php" method="post">
            <p class="tit">Id</p>
            <input type="text" name="Id_TiposUsuario" class="form-control" value="<?php echo $DatoObtenido[0] ?>" readonly>
            

            <p class="tit">Tipo de usuario</p>
            <input type="text" name="TipoUsuario" class="form-control" value="<?php echo $DatoObtenido[1] ?>">
            <br>

            <input type="submit" name="Aceptar" value="Enviar" class="form-control bot">
          </form>
        </div>

      </div>
      

    </div>



      <?php else: ?>
    <h1>Please Login or SignUp</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a> or
  <?php endif;?>
    
    

  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>

