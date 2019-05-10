<?php

header('Content-Type: application/json');
require '../database.php';

//eventos del calendario
$sentencia= "SELECT Laboratorio FROM Laboratorios where Visibilidad = 1";

$Ejecutar = sqlsrv_query($con,$sentencia);
//print_r($Ejecutar);
$i=0;
while($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)){

	$Resultados[]= array(
		$resultados ['Laboratorio'],
	);

}
echo json_encode($Resultados);
?>
