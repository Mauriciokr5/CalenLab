<?php 
	require 'database.php';

	$DatoObtenido=EliminarLaboratorio($_GET['Id_Laboratorios2']);

	function EliminarLaboratorio($Id_Laboratorio){
		require 'database.php';
		$sentencia = "UPDATE Laboratorios SET Visibilidad='2' WHERE Id_Laboratorios='$Id_Laboratorio'";

		$DatosConsulta=sqlsrv_query($con,$sentencia);

	}

 ?>

 <script type="text/javascript">
 	window.location.href='Crud_Laboratorios.php';

 </script>