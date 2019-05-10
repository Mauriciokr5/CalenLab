<?php 
	require 'database.php';

	ModificarTiposUsuario(
		$_POST['Id_TiposUsuario'],
		$_POST['TipoUsuario']
	);

	function ModificarTiposUsuario($Id_TiposUsuario,$TipoUsuario){
		require 'database.php';
		$sentencia = "UPDATE TiposUsuario SET TipoUsuario='$TipoUsuario' WHERE Id_TiposUsuario='$Id_TiposUsuario'";

		$DatosConsulta=sqlsrv_query($con,$sentencia);

	}

 ?>

 <script type="text/javascript">
 	window.location.href='Crud_TiposUsuario.php';

 </script>