<?php 
	require 'database.php';

	$DatoObtenido=EliminarUsuario($_GET['Id_Usuario2']);

	function EliminarUsuario($Id_Usuario){
		require 'database.php';
		$sentencia = "UPDATE Usuario SET Visibilidad='2' WHERE Id_Usuario='$Id_Usuario'";

		$DatosConsulta=sqlsrv_query($con,$sentencia);

	}

 ?>

 <script type="text/javascript">
 	window.location.href='Crud_Usuarios.php';

 </script>