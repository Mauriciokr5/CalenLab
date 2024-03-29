<?php 

  session_start();

  require 'database.php';

  if (isset($_SESSION['Id_Usuario'])) {

    $Id_Usuario = $_SESSION['Id_Usuario'];
    $TiposUsuario = $_SESSION['TiposUsuario'];

    $stmt = "SELECT * FROM Usuario WHERE Id_Usuario='$Id_Usuario'";

    $Ejecutar = sqlsrv_query($con,$stmt);

    $Datos = sqlsrv_Fetch_array($Ejecutar);

    $User = null;

    if (count($Datos)>0 && ($TiposUsuario == 1 || $TiposUsuario==2) ) {
      $User = $Datos;

    }

  }
  

 ?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login_css.css">
    <meta charset="utf-8">
    <title>Reservar</title>
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
  </head>

    <!--<link rel="stylesheet" href="assets/css/style.css">-->

  <body>

    <?php if (!empty($message)): ?>
      <p><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($User)):?>

  <?php require 'partials/headerAdmin.php' ?>
    <span><a href="reservar.php"></a> </span>


  <div class="container">
      <h1 class="rale">Reserva</h1>
    <div class="row justify-content-md-center">
      <div class="man col-md-6">

        <form action="reservar.php" method="post">
          <input required="true" type="text" name="title" placeholder="Titulo" class="form-control"><br>
          <input required="true" type="text" name="Grupo" placeholder="Grupo" class="form-control"><br>
          <input required="true" type="text" name="UnidadAprendizaje" placeholder="Unidad de Aprendizaje" class="form-control"><br>
          <input required="true" type="text" name="Asunto" placeholder="Asunto" class="form-control"><br>

          <p style="color:#ffffff">Color de fondo</p>
          <input required="true" type="color" name="color" class="form-control" list="colores" value="#053f5e"><br>
          <datalist id="colores">
            <option value="#022c43">
            <option value="#053f5e">
            <option value="#115173">
            <option value="#834c69">
            <option value="#33313b">
            <option value="#393e46">
            <option value="#393232">
          </datalist>
          <select name="Laboratorios" class="form-control">
           <?php   
                    require 'database.php';
                    $sentencia= "SELECT * FROM Laboratorios WHERE Visibilidad = 1";
                    $resultado = sqlsrv_query($con,$sentencia);
                    while ($filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)) {
                      if ($filas['Id_Laboratorios']==$_GET['labs']) {
                        echo '<option value="'.$filas['Id_Laboratorios'].'" selected>'.$filas['Laboratorio'].'</option>';
                      }else {
                        echo '<option value="'.$filas['Id_Laboratorios'].'">'.$filas['Laboratorio'].'</option>';
                      }
                    }
                   ?>
          </select>
          <input required="true" type="hidden" name="textColor" class="form-control" placeholder="Color de texto" value="#fff"><br>
          
          <div>
          <p style="color: #ffffff">Fecha</p>
          <input required="true" type="date" min="<?php echo date("Y-m-d");?>" name="fecha" class="form-control"> 
          </div><br>
          <div class="row">


            <div class="col-sm">
            <p style="color: #ffffff">Hora de inicio</p>
            <input required="true" type="time" name="start2" id="inicio" class="form-control" oninput="validarHora()">
            </div>
            <div  class="col-sm">
            <p style="color: #ffffff">Hora de termino</p>
            <input required="true" type="time" name="end2" id="fin"  class="form-control" oninput="validarHoraFinal()">
            </div>
          </div>
          <br>
          
          <input type="submit" name="Insertar" value="Enviar" class="form-control bot">
        </form>


      </div>
    </div>
  </div>

  <?php
  require 'database.php';

  if (isset($_POST['Insertar'])) {
    $title=$_POST['title'];
    $Grupo=$_POST['Grupo'];
    $UnidadAprendizaje=$_POST['UnidadAprendizaje'];
    $Asunto= $_POST['Asunto'];
    $color=$_POST['color'];
    $Laboratorios =$_POST['Laboratorios'];
    $Usuario=$_SESSION['Id_Usuario'];
    $textColor=$_POST['textColor'];


    $start=$_POST['fecha']." ".$_POST['start2'];
    //$timestart = strtotime($start);
    //$timestart2=date('Y-m-d h:i:s',$timestart);


    $end=$_POST['fecha']." ".$_POST['end2'];
    //$timeend = strtotime($end);
    //$timeend2= date('Y-m-d h:i:s',$timeend);

    $sentenciaVal= "SELECT * FROM Agenda2 WHERE Id_Laboratorios = $Laboratorios AND'$start' BETWEEN \"start\" AND \"fin\" OR '$end' BETWEEN \"start\" AND \"fin\" OR \"start\" BETWEEN '$start' AND '$end' ";
    
    $EjecutarVal = sqlsrv_query($con,$sentenciaVal);
    //print_r($Ejecutar);
    // $resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);
    // echo $resultados.length;
    $resultadosVal = sqlsrv_has_rows($EjecutarVal);
    if($resultadosVal === true){
      echo "<script>alert('Existe un traslape');</script>";
    }else{
      $sql= "INSERT INTO Reserva (title,Grupo,UnidadAprendizaje,Asunto,color,Laboratorios,Usuario,textColor,start,fin) VALUES ('$title','$Grupo','$UnidadAprendizaje','$Asunto','$color','$Laboratorios','$Usuario','$textColor','$start','$end')";

      $Ejecutar = sqlsrv_query($con,$sql);

      if($Ejecutar === false){
        die( print_r( sqlsrv_errors(), true));
      }else {
        echo "<script>alert('Reserva exitosa');location.replace(\"agendaLabos.php\");</script>";
      }
    }

  
}

?>
<?php else: ?>
    <h1>Please Login</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a>
  <?php endif;?>
  <script>
        function validarHora() {
            var horaInicio = document.getElementById("inicio").value;
            var remplazoUltimoNum = (parseInt(horaInicio.charAt(horaInicio.length - 1)) + 1) + "";

            if (remplazoUltimoNum == '10') {
                remplazoUltimoNum = '9';
            }
            var horaMinima = horaInicio.replaceAt((horaInicio.length - 1), remplazoUltimoNum);
            console.log(horaMinima);

            document.getElementById("fin").min = horaMinima;
        }
        String.prototype.replaceAt = function(index, replacement) {
            return this.substr(0, index) + replacement + this.substr(index + replacement.length);
        }


        function validarHoraFinal() {
            var horaInicio = document.getElementById("fin").value;
            var horas = horaInicio.substring(0, 2);
            var minutos = horaInicio.substring(3, 5);
            if (minutos == '00') {
                if (parseInt(horas) <= 0) {
                    horas = 11;
                } else {
                    horas = (parseInt(horas) - 1);
                }
                console.log(horas);
                if (horas < 10) {
                    horas = "0" + horas;
                    console.log('entro');
                }
                minutos = '59';
                document.getElementById("fin").value = horas + ":" + minutos;
            }
        }
    </script>
  </body>
</html>
