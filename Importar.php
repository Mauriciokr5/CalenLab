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
<html lang="en">
<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
  <meta charset="UTF-8">
  <title>Importar</title>
</head>
<body>

<?php if (!empty($User)):?>

  <?php require 'partials/headerAdmin.php' ?>
<br><br>
  <h1 align="center">Importar Desde archivo</h1>
<br>


<div class="Holis">

  <div>
    <p align="center"><h5>Laboratorios</h5></p>
    <table class="table table-hoever">
      <thead>
        <tr>
          <th>Id_Laboratorio</th>
          <th>Laboratorio</th>
        </tr>
      </thead>
<?php 
require 'database.php';
$sentencia= "SELECT * FROM Laboratorios WHERE Visibilidad= 1";
$resultado = sqlsrv_query($con,$sentencia);

while($filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
echo "<tbody>";
  echo "<tr>";
    echo "<td>"; echo $filas['Id_Laboratorios']; echo "</td>";
    echo "<td>"; echo $filas['Laboratorio']; echo "</td>";
  echo "</tr>";
echo "</tbody>";
}
 ?>
    </table>
  </div>

  <div>
       <p align="center"><h5>Usuarios</h5></p>
    <table class="table table-hoever">
      <thead>
        <tr>
          <th>Id_Usuario</th>
          <th>Usuario</th>
        </tr>
      </thead>
<?php 
require 'database.php';
$sentencia= "SELECT * FROM Usuario WHERE Visibilidad= 1";
$resultado = sqlsrv_query($con,$sentencia);

while($filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
echo "<tbody>";
  echo "<tr>";
    echo "<td>"; echo $filas['Id_Usuario']; echo "</td>";
    echo "<td>"; echo $filas['Nombre']." ".$filas['ApPat']." ".$filas['ApMat']; echo "</td>";
  echo "</tr>";
echo "</tbody>";
}
 ?>
    </table>

  </div>
  
</div>

<br><br>
<div id="Contenido" class="">
  <h2 align="center">Le recomendamos que la tabla de su archivo.csv sea con el formato siguiente</h2>
  <table class="table table-hoever">
    <thead>
      <tr>
        <th>title</th>
        <th>Grupo</th>
        <th>UnidadAprendizaje</th>
        <th>Asunto</th>
        <th>color</th>
        <th>Laboratorios</th>
        <th>Usuario</th>
        <th>textColor</th>
        <th>start</th>
        <th>fin</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Ejemplo</td>
        <td>6IV7</td>
        <td>Ingenieria de software</td>
        <td>Ejemplo</td>
        <td>#00F326</td>
        <td>1</td>
        <td>2</td>
        <td>#FFFFFF</td>
        <td>2019-03-16 10:30:00</td>
        <td>2019-04-17 18:30:00</td>
      </tr>
    </tbody>
</table>
</div>

<hr width="80%">
<br><br><br>

<div >
  <p align="center"><h1 align="center">Subir Archivos</h1></p>
    <form name="frmcargararchivo" method="post" enctype="multipart/form-data">
      <p><input type="file" name="excel" id="excel" class="form-control"></p>
      <p align="center"><input type="button" class="btn btn-default" value="subir" class="form-control" onclick="cargarHojaExcel();" /></p>
    </form>

</div>



  <?php else: ?>
    <h1>Please Login or SignUp</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a> or
  <?php endif;?>

<style type="text/css">
  .Holis{
    display: flex;
    justify-content: space-around;
  }
</style>

<script type="text/javascript">
  function cargarHojaExcel()
  {
    if(document.frmcargararchivo.excel.value=="")
    {
      alert("Suba un archivo");
      document.frmcargararchivo.excel.focus();
      return false;
    }   

    document.frmcargararchivo.action = "procesar.php";
    document.frmcargararchivo.submit();
  }

</script>

</body>
</html>