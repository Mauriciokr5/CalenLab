<?php  
    require 'database.php';
    $NumLABO = "1";
    $start="2019-05-15 03:03:00.000";
    $end="2019-05-15 05:00:00.000";
    $sentencia= "SELECT * FROM Agenda2 WHERE Id_Laboratorios = $NumLABO AND'$start' BETWEEN \"start\" AND \"fin\" OR '$end' BETWEEN \"start\" AND \"fin\" OR \"start\" BETWEEN '$start' AND '$end' ";
    echo $sentencia;
    $Ejecutar = sqlsrv_query($con,$sentencia);
    //print_r($Ejecutar);
    // $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);
    // echo $resultados.length;
    $resultados = sqlsrv_has_rows($Ejecutar);
    if($resultados === true){
        echo "";
    }else{
        echo "fuck";
    }
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
?>
<script>
    alert('hola');
</script>