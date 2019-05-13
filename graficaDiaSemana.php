<?php 

  session_start();

  require 'database.php';

  if (isset($_SESSION['Id_Usuario'])) {

    $Id_Usuario = $_SESSION['Id_Usuario'];

    $stmt = "SELECT * FROM Usuario WHERE Id_Usuario='$Id_Usuario'";

    $Ejecutar = sqlsrv_query($con,$stmt);

    $Datos = sqlsrv_Fetch_array($Ejecutar);

    $User = null;

    if (count($Datos)>0) {
      $User = $Datos;

    }

  }

 ?>
 <!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login_css.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <meta charset="utf-8">
    <title>Agenda Web Graficas</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>
<body>     

  <?php require 'partials/headerAdmin.php' ?>
  <div class="container">
      <h1 class="rale">Horas por día de la semana</h1>
    <?php
        $fInicio = $_POST['inicioSemana'];
        $fFin =$_POST['finSemana'];


        $sentencia= "SELECT DISTINCT Id_Laboratorios, Laboratorio FROM Agenda2 WHERE '$fInicio' BETWEEN start AND fin OR '$fFin' BETWEEN start AND fin OR start BETWEEN '$fInicio' AND '$fFin' ";
        $resultado = sqlsrv_query($con,$sentencia);
        // $LABOs=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
        // echo '------------';
        // echo $resultado[0][1];
        $i=0;
        while ($LABOs=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)) {
            $NomLabs[$i] = $LABOs['Laboratorio'];
            $i++;
        }
        $DiasSemana = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];
        // SELECT SUM(DATEDIFF(n, start, fin)) AS 'TotalHoras' FROM Agenda2 WHERE Laboratorio = 'Aula Samsung' AND DATENAME ( dw ,  CONVERT(date, start))='Monday' AND('2019-05-01' BETWEEN start AND fin OR '2019-05-31' BETWEEN start AND fin OR start BETWEEN '2019-05-01' AND '2019-05-31')
    ?>

      

    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
    
  </div>
  <script>
      Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Horas por día de la semana'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
            'Lunes',
            'Martes',
            'Miercoles',
            'Jueves',
            'Viernes',
            'Sabado',
            'Domingo'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
            text: 'Horas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
            }
        },
        series: [
            <?php
                for ($i=0; $i < sizeof($NomLabs); $i++) { 
                    echo "{ name: '".$NomLabs[$i]."',
                        data:[";
                        for ($j=0; $j < sizeof($DiasSemana); $j++) { 
                            // $query = "SELECT SUM(DATEDIFF(n, start, fin)) AS 'TotalHoras' FROM Agenda2 WHERE Laboratorio = '$NomLabs[$i]' AND('$fInicio' BETWEEN start AND fin OR '$fFin' BETWEEN start AND fin OR start BETWEEN '$fInicio' AND '$fFin')";
                            $query = "SELECT SUM(DATEDIFF(n, start, fin)) AS 'TotalHoras' FROM Agenda2 WHERE Laboratorio = '$NomLabs[$i]' AND DATENAME ( dw ,  CONVERT(date, start))='$DiasSemana[$j]' AND('$fInicio' BETWEEN start AND fin OR '$fFin' BETWEEN start AND fin OR start BETWEEN '$fInicio' AND '$fFin')";
                            // echo $query;
                            $Ejecutar = sqlsrv_query($con,$query);
                            $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_NUMERIC);
                            echo round($resultados[0]/60).',';
                        } 
                    echo "]},";
                }
                ?>
        ]
        });
  </script>
  
  


<?php 
    if (!empty($User)):?>
    <div class="Holis"> 
    </div>


  <?php else: ?>
    <h1>Please Login or SignUp</h1>
    <a href="login.php">Login</a> or
    <a href="signup.php">SignUp</a>
  <?php endif;?>

    

</body>
</html>