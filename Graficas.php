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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <meta charset="utf-8">
    <title>Agenda Web</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>
<body>     

  <?php require 'partials/headerAdmin.php' ?>


<?php 
    if (!empty($User)):?>
    <div class="Holis"> 
    <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>    
    
    <script>  
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
    // The type of chart we want to create
        type: 'bar',

        <?php
              require 'dabase.php';
              $sentencia= "SELECT * FROM Laboratorios WHERE Visibilidad = 1";
              $Ejecutar = sqlsrv_query($con,$sentencia);
              $labs = "";


                while ($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)) {
                  //echo $resultados['Laboratorio'].",";
                  $labs=$labs."'".$resultados['Laboratorio']."',";
                };
                echo $labs;
             ?>
    // The data for our dataset
        data: {
            labels: [],
            datasets: [{
                label: 'Usos por laboratorio',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [2, 1, 1, 2, 0, 5,]
            }]
        },

    // Configuration options go here
    options: {}
});</script>

<p>Nota: esta seccion sigue en desarrollo</p>

  <?php else: ?>
    <h1>Please Login or SignUp</h1>
    <a href="login.php">Login</a> or
    <a href="signup.php">SignUp</a>
  <?php endif;?>

    <style type="text/css">
    body{
      background-color: #f9f7f7;
    }
    .bie{
      font-family: "Raleway", sans-serif;
      text-align: center;
      font-size: 3rem;
      font-weight: lighter;
      margin-top: 28vh;
      color: #3f72af;
    }
    .Holis{
    display: flex;
    justify-content: space-around;
    }
  </style>

</body>
</html>