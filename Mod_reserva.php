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

 <?php 
  $DatoObtenido=ConsultarReserva($_GET['Id_Reserva']);
  function ConsultarReserva($No_Reserva){
  require 'database.php';
 $Consulta2 = "SELECT * FROM Reserva WHERE Id_Reserva ='$No_Reserva'";
 $resultado = sqlsrv_query($con,$Consulta2);

 $filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);

return[

  $filas['Id_Reserva'],
  $filas['title'],
  $filas['Grupo'],
  $filas['UnidadAprendizaje'],
  $filas['Asunto'],
  $filas['color'],
  $filas['Laboratorios'],
  $filas['Usuario'],
  $filas['textColor'],
  $filas['start'],
  $filas['fin']
];

  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/css/login_css.css">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <title>Modificar Reserva</title>
  </head>
  <body>
  <?php if (!empty($User)):?>
    <?php require 'Partials/headerAdmin.php' ?>

    <span><a href="Mod_reserva.php"></a> </span>
    <div class="container">

      <h3 class="rale">Modificar Reservacion</h3>

      <div class="row justify-content-md-center">

        <div class="man">
<!-- ndgasidfgasdfsagfasdf<hkgzidfh<dfilhfs-->
          <form action="Mod_reserva2.php" method="post">

            <div class="row">
              <div class="col-md-6">

                <p class="tit">Id</p>
                <input type="text" name="Id_Reserva" value="<?php echo $DatoObtenido[0] ?>" class="form-control" readonly><br>

                <p class="tit">Titulo de Reserva</p>
                <input type="text" required="true" name="title" class="form-control" value="<?php echo $DatoObtenido[1] ?>" ><br>

                <p class="tit">Grupo</p>
                <input type="text" name="Grupo" required="true" class="form-control" value="<?php echo $DatoObtenido[2] ?>"><br>

                <p class="tit">Unidad De Aprendizaje</p>
                <input type="text" name="UnidadAprendizaje" required="true" class="form-control" value="<?php echo $DatoObtenido[3] ?>"><br>

                <p class="tit">Asunto</p>
                <input type="text" name="Asunto" class="form-control" required="true" value="<?php echo $DatoObtenido[4] ?>"><br>

                <p class="tit">Color de cinta</p>
                <input type="color" name="color" class="form-control" required="true" value="<?php echo $DatoObtenido[5] ?>"><br>
              </div>

              <div class="col-md-6">
                
                <p class="tit">Laboratorio</p>
                <select name="Laboratorios" class="form-control" required="true">
                  <?php   
                    require 'database.php';
                    $sentencia= "SELECT * FROM Laboratorios WHERE Visibilidad = 1";
                    $resultado = sqlsrv_query($con,$sentencia);
                    while ($filas=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)) {
                      if ($filas['Id_Laboratorios']==$DatoObtenido[6]) {
                        echo '<option value="'.$filas['Id_Laboratorios'].'" selected>'.$filas['Laboratorio'].'</option>';
                      }else {
                        echo '<option value="'.$filas['Id_Laboratorios'].'">'.$filas['Laboratorio'].'</option>';
                      }
                    }
                   ?>

                </select><br>

                <p class="tit">Color del texto</p>
                <input type="color" name="textColor" required="true" class="form-control" value="<?php echo $DatoObtenido[8] ?>"><br>

                <p class="tit">Fecha de inicio</p>
                <input type="datetime-local" name="start" required="true" class="form-control" value="<?php echo $DatoObtenido[9]->format('Y-m-d').'T'.$DatoObtenido[9]->format('H:i:s') ?>" size="15"><br>

                <p class="tit">Fecha de termino</p>
                <input type="datetime-local" name="end" required="true" class="form-control" value="<?php echo $DatoObtenido[10]->format('Y-m-d').'T'.$DatoObtenido[10]->format('H:i:s') ?>" size="15"><br><br>

                <input type="submit" name="Aceptar" value="Enviar" class="form-control bot">

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php echo $DatoObtenido[6] ?>


      <?php else: ?>
    <h1>Please Login or SignUp</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a> or
  <?php endif;?>
    
    

  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>

