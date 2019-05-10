<?php

header('Content-Type: application/json');
require 'database.php';
//eventos del calendario
$sentencia= "SELECT Asunto,HoraIncio,HoraTermino FROM Reserva";

$Ejecutar = sqlsrv_query($con,$sentencia);

$resultado = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)or die("no puedo dar resultado");

echo json_encode($resultado);
?>
