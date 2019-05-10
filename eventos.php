<?php

header('Content-Type: application/json');
require 'database.php';

//eventos del calendario


$sentencia= "SELECT Id_Laboratorios,Laboratorio FROM Laboratorios";

$Ejecutar = sqlsrv_query($con,$sentencia);
//$lel =  sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);


while ($lel=  sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)) {

	echo $lel['Id_Laboratorios']." ".$lel['Laboratorio']."\n";
}
//echo $lel[1];
//print_r($Ejecutar);
$i=0;
/*while($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)){

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
print_r($lel) ;
//$res = json_encode($Resultados);
?>
