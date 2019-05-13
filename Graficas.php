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
    <meta charset="utf-8">
    <title>Agenda Web Graficas</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>
<body>     

  <?php require 'partials/headerAdmin.php' ?>
  <div class="container">
      <h1 class="rale">Graficas</h1>
    <div class="row justify-content-md-center">
      <div class="man col-md-10">
        <div class="row">
          <div class="col-md-6 linea">
            <h1 class="titw">Horas de Uso</h1>
            <br>
            <form action="graficaHorasUso">
              <div class="row noms">
                <div class="col-xs ancho">
                  <p style="color: #ffffff; text-align:center;">Inicio</p>
                  <input required="true" type="time" name="inicioHorasUso" id="inicioHorasUso" class="form-control" oninput="validarHora()">
                </div>
                
                <div  class="col-xs ancho">
                  <p style="color: #ffffff; text-align:center;">Fin</p>
                  <input required="true" type="time" name="finHorasUso" id="finHorasUso"  class="form-control">
                </div>
              </div>
              <br>
              <input type="submit" name="Insertar" value="Enviar" class="form-control bot">
            </form>
          </div>
          <div class="col-md-6">
          <h1 class="titw">Horas por día de la semana</h1>

          <br>
            <form action="graficaDiaSemana">
              <div class="row noms">
                <div class="col-xs ancho">
                  <p style="color: #ffffff; text-align:center;">Inicio</p>
                  <input required="true" type="time" name="inicioSemana" id="inicioSemana" class="form-control" oninput="validarHora2()">
                </div>
                <div  class="col-xs ancho">
                  <p style="color: #ffffff; text-align:center;">Fin</p>
                  <input required="true" type="time" name="finSemana" id="finSemana"  class="form-control">
                </div>
              </div>
              <br>
              <input type="submit" name="Insertar" value="Enviar" class="form-control bot">
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <style>
    .titw{
      color: white;
      font-size:150%;
      text-align:center;
    }
    @media (max-width: 767px) {
      .linea {
        border-bottom: 2px solid white;
        margin-bottom: 10px;
        padding-bottom: 10px;
      }
    }
    @media (min-width: 768px) {
      .linea {
        border-right: 2px solid white;
      }
    }

    .ancho{
      width:40%;
    }
    .noms{
      display:flex;
      justify-content: space-around;
    }
  </style>
  <script>
      function validarHora() {
          var horaInicio = document.getElementById("inicioHorasUso").value;
          var remplazoUltimoNum = (parseInt(horaInicio.charAt(horaInicio.length - 1)) + 1) + "";

          if (remplazoUltimoNum == '10') {
              remplazoUltimoNum = '9';
          }
          var horaMinima = horaInicio.replaceAt((horaInicio.length - 1), remplazoUltimoNum);
          console.log(horaMinima);

          document.getElementById("finHorasUso").min = horaMinima;
      }
      function validarHora2() {
          var horaInicio = document.getElementById("inicioSemana").value;
          var remplazoUltimoNum = (parseInt(horaInicio.charAt(horaInicio.length - 1)) + 1) + "";

          if (remplazoUltimoNum == '10') {
              remplazoUltimoNum = '9';
          }
          var horaMinima = horaInicio.replaceAt((horaInicio.length - 1), remplazoUltimoNum);
          console.log(horaMinima);

          document.getElementById("finSemana").min = horaMinima;
      }
      String.prototype.replaceAt = function(index, replacement) {
          return this.substr(0, index) + replacement + this.substr(index + replacement.length);
      }
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