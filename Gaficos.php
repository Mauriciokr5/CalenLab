<?php

header('Content-Type: application/json');
require 'database.php';

//eventos del calendario
$sentencia= "SELECT * FROM Laboratorios WHERE Visibilidad = 1";
$Ejecutar = sqlsrv_query($con,$sentencia);

$i =0;
$labs = "";


while ($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)) {
	//echo $resultados['Laboratorio'].",";
	$labs=$labs."'".$resultados['Laboratorio']."',";
};

/*$Graficas[] = array(
'labels'*/
echo $labs;
//print_r($Ejecutar);
//$i=0;
/* while($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)){

	$Resultados[] = array(
	'title'=>$resultados['title'],
	'start'=>$resultados['start'],
	'end'=>$resultados['fin'],
	'Id_Reserva'=>	$resultados['Id_Reserva'],
	'Grupo'=>$resultados['Grupo'],
	'UnidadAprendizaje'=>$resultados['UnidadAprendizaje'],
	'Asunto'=>$resultados['Asunto'],
	'color'=>$resultados['color'],
	'Laboratorio'=>$resultados['Laboratorio'],
	'Nombre'=>$resultados['Nombre'],
	'textColor'=>$resultados['textColor'],
	);

	//$Cosa = 'Hola';
	 //

	//echo "que{$Cosa}cosa";
}*/
//echo json_encode($Resultados);
?>
