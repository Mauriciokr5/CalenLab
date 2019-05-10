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
  
  //$NumLABO=2;
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Calendario Web</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login_css.css">


	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/moment.min.js"></script>

	<!--full calendar-->
	<link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.css">
	<script src="assets/js/fullcalendar.js"></script>
	<script src="assets/js/es.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



</head>
<body>
	<?php if (!empty($message)): ?>
      <p><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($User)):?>

  <?php require 'partials/headerAdmin.php' ?>


  <div align="center" class="conte justify-content-md-center">
  	<?php 
  	$sentencia= "SELECT Id_Laboratorios,Laboratorio FROM Laboratorios WHERE Visibilidad = 1";

	$Ejecutar = sqlsrv_query($con,$sentencia);
	//$lel =  sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC);


	while ($lel=  sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)) {
		?>
		<form action="AgendaAdmin.php">
	  	<input name="labs" type="hidden" value="<?php echo $lel['Id_Laboratorios']?>">
	  	<a href=""><button type="submit" class="boton"><?php echo $lel['Laboratorio']; ?></button></a>
	  	</form>
		<?php  
		//echo $lel['Id_Laboratorios']." ".$lel['Laboratorio']."\n";
	}
  	 ?>
  </div>

  


  <style>
  	.conte{
  		margin-top: 15vh; 
  	}
  	.boton{
  		text-decoration: none;
  		background-color: transparent;
  		border-radius: 5px;
  		border-color: #112d4e;
  		border: 1;
  		color: #3f72af;
  		font-size: 150%;
  		padding-right:  20px;
  		padding-left:  20px;
  		margin-top: 10px;

  	}
  </style>

	




<?php else: ?>
    <h1>Please Login</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a>
  <?php endif;?>


</body>
</html>