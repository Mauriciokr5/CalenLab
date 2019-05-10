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
    <title>Registro</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>

    <!--<link rel="stylesheet" href="assets/css/style.css">-->

  <body>

    <?php if (!empty($message)): ?>
      <p><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($User)):?>

  <?php require 'partials/headerAdmin.php' ?>
    <span><a href="signup.php"></a> </span>


  <div class="container">
      <h1 class="rale">Registro</h1>
    <div class="row justify-content-md-center">
      <div class="man col-md-4">
        <form action="signup.php" method="post">
          <input type="text" name="ApPat" placeholder="Apellido Paterno" class="form-control"><br>
          <input type="text" name="ApMat" placeholder="Apellido Materno" class="form-control"><br>
          <input type="text" name="Nombre" placeholder="Nombre(s)" class="form-control"><br>
          <input type="text" name="Correo" placeholder="Correo Electronico" class="form-control"><br>
          <input type="text" name="Contraseña" placeholder="Contraseña" class="form-control"><br>
          <select name="Sexo" class="form-control">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select><br>
          <select name="Area" class="form-control">
            <option value="1">Area Basica</option>
            <option value="2">Humanistica</option>
            <option value="3">Programacion</option>
            <option value="4">Maquinas c/Sistemas automatizados</option>
            <option value="5">Sistemas Digitales</option>
          </select><br>
          <select name="Rol" class="form-control">
            <option value="1">Profesor</option>
            <option value="2">Alumno</option>
            <option value="3">PAE</option>
          </select><br>
          <select name="TiposUsuario" class="form-control">
            <option value="2">Administrador</option>
            <option value="3">Solicitante</option>
          </select><br>
          <select name="Visibilidad" class="form-control">
            <option value="1">Visible</option>
            <option value="2">No Visible</option>
          </select><br>
          <input type="submit" name="Insertar" value="Enviar" class="form-control bot">
        </form>
      </div>
    </div>
  </div>

  <?php
  require 'database.php';

  if (isset($_POST['Insertar'])) {
    $ApPat =$_POST['ApPat'];
    $ApMat =$_POST['ApMat'];
    $Nombre =$_POST['Nombre'];
    $Correo =$_POST['Correo'];
    $Contraseña = password_hash($_POST['Contraseña'], PASSWORD_BCRYPT);
    //$Contraseña = $_POST['Contraseña'];
    $Sexo =$_POST['Sexo'];
    $Area =$_POST['Area'];
    $Rol =$_POST['Rol'];
    $TiposUsuario =$_POST['TiposUsuario'];
    $Visivilidad =$_POST['Visibilidad'];

    $sql= "INSERT INTO Usuario (ApPat, ApMat, Nombre, Correo, Contraseña, Sexo, Area, Rol, TiposUsuario, Visibilidad) VALUES ('$ApPat','$ApMat','$Nombre','$Correo','$Contraseña','$Sexo','$Area','$Rol','$TiposUsuario','$Visivilidad')";

    $Ejecutar = sqlsrv_query($con,$sql);

    if($Ejecutar === false){
      die( print_r( sqlsrv_errors(), true));
    }else {
      echo "Todo bien";
  }
}
    //require 'database.php';

  //  $message = '';

  //  if (!empty($_POST['ApPat']) && !empty($_POST['ApMat']) && !empty($_POST['Nombre']) && !empty($_POST['Correo'])  && !empty($_POST['Contraseña']) && !empty($_POST['Sexo']) && !empty($_POST['Area']) && !empty($_POST['Rol']) && !empty($_POST['TiposUsuario']) && !empty($_POST['Visibilidad'])){

  //  $sql= "INSERT INTO Usuario (Id_Usuario, ApPat, ApMat, Nombre, Correo, Contraseña, Sexo, FechaAlta, FechaBaja, Area, Rol, TiposUsuario, Visibilidad) VALUES (NULL, :ApPat, :ApMat, :Nombre, :Correo, :Contraseña, :Sexo, NULL, NULL, :Area, :Rol, :TiposUsuario, :Visibilidad)";

  //  $stmt = sqlsrv_prepare($conn,$sql);

  //   $stmt->bindParam(1,':ApPat',$_POST['ApPat'],PDO::PARAM_STR);
  //   $stmt->bindParam(1,':ApMat',$_POST['ApMat']);
  //   $stmt->bindParam(1,':Nombre',$_POST['Nombre']);
  //   $stmt->bindParam(1,':Correo',$_POST['Correo']);
  //   $Contrasena = password_hash($_POST['Contraseña']);
  //   $stmt->bindParam(1,':Contraseña',$Contrasena);
  //   $stmt->bindParam(1,':Sexo',$_POST['Sexo']);
  //   $stmt->bindParam(1,':Area',$_POST['Area']);
  //   $stmt->bindParam(1,':Rol',$_POST['Rol']);
  //   $stmt->bindParam(1,':TiposUsuario',$_POST['TiposUsuario']);
  //   $stmt->bindParam(1,':Visibilidad',$_POST['Visibilidad']);


  //     if($stmt->sqlsrv_execute()){
  //       $message = 'usuario creado satisfactoriamente';
  //     }else{
  //       $message = 'No se ha podido crear el usuario';
  //     }
  //   }
  ?>


<?php else: ?>
    <h1>Please Login</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a>
  <?php endif;?>
  </body>
</html>
