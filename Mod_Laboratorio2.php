<?php 
	require 'database.php';

	ModificarLaboratorio(
		$_POST['Id_Laboratorios'],
		$_POST['Laboratorio'],
		$_POST['Visibilidad']
	);

	function ModificarLaboratorio($Id_Laboratorios,$Laboratorio,$Visibilidad){
		require 'database.php';
		$sentencia = "UPDATE Laboratorios SET Laboratorio='$Laboratorio',Visibilidad='$Visibilidad' WHERE Id_Laboratorios='$Id_Laboratorios'";

		$DatosConsulta=sqlsrv_query($con,$sentencia);

	}

 ?>

 <script type="text/javascript">
 	window.location.href='Crud_Laboratorios.php';

 </script>