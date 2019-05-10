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
	<title>Usuarios</title>
</head>
<body>

<?php if (!empty($User)):?>

	<?php require 'partials/headerAdmin.php' ?>
<br><br>
	<h1 align="center">Usuarios</h1>
<br><br>	
<div id="Contenido" class="">
	<table class="table table-hoever">
		<thead>
			<tr>
				<th>Id</th>
				<th>Ap.Paterno</th>
				<th>Ap.Materno</th>
				<th>Nomnre</th>
				<th>Correo</th>
				<th>contraseña</th>
				<!--<th>Sexo</th>-->
				<!--<th>FechaAlta</th>-->
				<th>Area</th>
				<th>Rol</th>
				<th>Tipo Usuario</th>
				<th>Visibilidad</th>
				<th><a href="signup.php"><button type="button" class="btn btn-success">Nuevo</button></a></th>
			</tr>
		</thead>
<?php 
require 'database.php';
$sentencia= "SELECT * FROM Usuarios";
$resultado = sqlsrv_query($con,$sentencia);
while($filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
echo "<tbody>";
	echo "<tr>";
		echo "<td>"; echo $filas['Id_Usuario']; echo "</td>";
		echo "<td>"; echo $filas['ApPat']; echo "</td>";
		echo "<td>"; echo $filas['ApMat']; echo "</td>";
		echo "<td>"; echo $filas['Nombre']; echo "</td>";
		echo "<td>"; echo $filas['Correo']; echo "</td>";
		//echo "<td>"; echo $filas['Contraseña']; echo "</td>";
		//echo "<td>"; echo $filas['Sexo']; echo "</td>";
		//echo "<td>"; echo $FechaAlta=date_format($filas['FechaAlta'],"Y/m/d H:i:s"); echo "</td>";
		echo "<td>"; echo $filas['Area']; echo "</td>";
		echo "<td>"; echo $filas['Rol']; echo "</td>";
		echo "<td>"; echo $filas['TipoUsuario']; echo "</td>";
		echo "<td>"; echo $filas['Visibilidad']; echo "</td>";

		echo "<td><a href='Mod_Usuarios.php?Id_Usuario2=".$filas['Id_Usuario']."'><button type='button' class='btn btn-success'>Modificar</button></a></td>";

		echo "<td><a href='Eliminar_Usuario.php?Id_Usuario2=".$filas['Id_Usuario']."'><button type='button' class='btn btn-warning'>Eliminar</button></a></td>";
	echo "</tr>";
echo "</tbody>";
}
?>
</table>
</div>

  <?php else: ?>
    <h1>Please Login or SignUp</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a> or
  <?php endif;?>





</body>
</html>