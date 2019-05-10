<?php 
	require 'database.php';

	$Id_Usuario=$_POST['Id_Usuario'];
	$ApPat=$_POST['ApPat'];
	$ApMat=$_POST['ApMat'];
	$Nombre=$_POST['Nombre'];
	$Correo=$_POST['Correo'];
	$Contraseña=password_hash($_POST['Contraseña'], PASSWORD_BCRYPT);
	$Sexo=$_POST['Sexo'];
	$Area=$_POST['Area'];
	$Rol=$_POST['Rol'];
	$TiposUsuario=$_POST['TiposUsuario'];
	$Visibilidad=$_POST['Visibilidad'];

	echo $Id_Usuario;


		$sentencia = "UPDATE Usuario SET ApPat='$ApPat',ApMat='$ApMat',Nombre='$Nombre',Correo='$Correo',Contraseña='$Contraseña',Sexo='$Sexo',Area='$Area',Rol='$Rol',TiposUsuario='$TiposUsuario',Visibilidad='$Visibilidad' WHERE Id_Usuario='$Id_Usuario'";

		$DatosConsulta=sqlsrv_query($con,$sentencia);

 ?>

 <script type="text/javascript">
 	window.location.href='Crud_Usuarios.php';

 </script>