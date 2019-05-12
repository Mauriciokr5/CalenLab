<?php  
    require 'database.php';
    $NumLABO = "1";
    $start="2019-05-15 00:00:00.000";
    $end="2019-05-15 23:59:00.000";
    $sentencia= "SELECT DATEDIFF(hh, \"start\", \"fin\") FROM Agenda2 WHERE Id_Laboratorios = $NumLABO AND'$start' BETWEEN \"start\" AND \"fin\" OR '$end' BETWEEN \"start\" AND \"fin\" OR \"start\" BETWEEN '$start' AND '$end' ";
    echo $sentencia;
    $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);
    echo $resultados[0];


    // $sentencia= "SELECT DATEDIFF(hh, \"start\", \"fin\") FROM Agenda2 WHERE Id_Laboratorios = $NumLABO AND'$start' BETWEEN \"start\" AND \"fin\" OR '$end' BETWEEN \"start\" AND \"fin\" OR \"start\" BETWEEN '$start' AND '$end' ";
    // echo $sentencia;
    // $Ejecutar = sqlsrv_query($con,$sentencia);
    // //print_r($Ejecutar);
    // // $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);
    // // echo $resultados.length;
    // $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_NUMERIC);
    // echo $resultados[0];
    /*if($resultados === true){
        echo "coincide";
        echo $resultados[0];
    }else{
        echo "fuck";
    }*/
    /*$i=0;
    while($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)){

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
    }
    //echo json_encode($Resultados);
    $res = json_encode($Resultados);
    echo $Resultados[0]['start']->format('Y-m-d H:i:s');*/



    // Horas entre inicio y fin
    $sentencia= "SELECT DATEDIFF(hh, \"start\", \"fin\") FROM Agenda2 WHERE Id_Laboratorios = $NumLABO AND'$start' BETWEEN \"start\" AND \"fin\" OR '$end' BETWEEN \"start\" AND \"fin\" OR \"start\" BETWEEN '$start' AND '$end' ";
    echo $sentencia;
    // Total horas entre fechas
    // SELECT SUM(DATEDIFF(hh, "start", "fin")) AS 'TotalHoras' FROM Agenda2 WHERE Id_Laboratorios = 1 AND'2019-05-15 00:00:00.000' BETWEEN "start" AND "fin" OR '2019-05-15 23:59:00.000' BETWEEN "start" AND "fin" OR "start" BETWEEN '2019-05-15 00:00:00.000' AND '2019-05-15 23:59:00.000'
?>