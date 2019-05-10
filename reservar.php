<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <meta charset="utf-8">
    <title>Registro</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>
  <body>

    <?php require 'partials/headerAdmin.php'?>

    <?php if (!empty($message)): ?>
      <p><?= $message ?></p>
    <?php endif; ?>


    <h1>Registro</h1>
    <span><a href="reservar.php"></a> </span>

    <form action="reservar.php" method="post">
      <input type="text" name="UnidadAprendizaje" placeholder="Unidad deaprendizaje"><br>
      <input type="datetime" name="HoraIncio" placeholder="Hora de Inicio"><br>
      <input type="datetime" name="HoraTermino" placeholder="Hora de HoraTermino"><br>
      <input type="text" name="Grupo" placeholder="Grupo"><br>
      <input type="text" name="Asunto" placeholder="Asunto"><br>
      <select name="Laboratorios">
        <option value="1">Bases de datos</option>
        <option value="2">NUEVAS TECNOLOGIAS</option>
        <option value="3">Desarrollo de software</option>
        <option value="4">Siglo XXI</option>
        <option value="5">Aula Samsung</option>
        <option value="6">Aula Interactiva</option>
      </select><br>
      <select name="Area">
        <option value="1">Area Basica</option>
        <option value="2">Humanistica</option>
        <option value="3">Programacion</option>
        <option value="4">Maquinas c/Sistemas automatizados</option>
        <option value="5">Sistemas Digitales</option>
      </select><br>
      <input type="submit" name="Insertar" value="Enviar">
    </form>

  <?php
  require 'database.php';

  if (isset($_POST['Insertar'])) {
    $UnidadAprendizaje =$_POST['UnidadAprendizaje'];


    $HoraIncio =new DateTime($_POST['HoraIncio']);
    $strHoraInicio=$HoraIncio-> format('Y-m-d-H-i-s');
  


    $HoraTermino =new DateTime($_POST['HoraTermino']);
    $strHoratermino=$HoraTermino->format('Y-m-d-H-i-s');


    $Grupo =$_POST['Grupo'];
    //$Contraseña = password_hash($_POST['Contraseña'], PASSWORD_BCRYPT);
    //$Contraseña = $_POST['Contraseña'];
    $Asunto =$_POST['Asunto'];
    $Laboratorios =$_POST['Laboratorios'];
    $Area =$_POST['Area'];
    $Usuario ="1";

    $sql= "INSERT INTO Reserva (UnidadAprendizaje, HoraIncio, HoraTermino, Grupo, Asunto,Laboratorios, Usuario) VALUES ('$UnidadAprendizaje','$strHoraInicio','$strHoratermino','$Grupo','$Asunto','$Laboratorios','$Usuario')";

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



  </body>
</html>
