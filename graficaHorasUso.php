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
      <h1 class="rale">Horas de Uso</h1>
    <?php
        $fInicio = $_POST['inicioHorasUso'];
        $fFin =$_POST['finHorasUso'];


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
        
        
    ?>

      

    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
    
  </div>
  <script>
      Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Horas de Uso'
        },
        xAxis: {
            categories: [<?php 
            for ($i=0; $i < sizeof($NomLabs); $i++) { 
            echo "'".$NomLabs[$i]."',";
            }
            ?>],
            title: {
            text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
            text: '',
            align: 'high'
            },
            labels: {
            overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Horas'
        },
        plotOptions: {
            bar: {
            dataLabels: {
                enabled: true
            }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '<?php echo $fInicio?><br><?php echo $fFin?>',
            data: [<?php
                for ($i=0; $i < sizeof($NomLabs); $i++) { 
                    $query = "SELECT SUM(DATEDIFF(n, start, fin)) AS 'TotalHoras' FROM Agenda2 WHERE Laboratorio = '$NomLabs[$i]' AND('$fInicio' BETWEEN start AND fin OR '$fFin' BETWEEN start AND fin OR start BETWEEN '$fInicio' AND '$fFin')";
                    // echo $query;
                    $Ejecutar = sqlsrv_query($con,$query);
                    $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_NUMERIC);
                    echo round($resultados[0]/60).',';
                }
            ?>
            ]
        }]
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