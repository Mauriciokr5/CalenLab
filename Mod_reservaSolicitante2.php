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
    if (count($Datos)>0 && ($TiposUsuario == 1 || $TiposUsuario==2 || $TiposUsuario >2) ) {
      $User = $Datos;
    }
  }
 ?>


<?php 
	require 'database.php';

		$Id_Reserva=$_POST['Id_Reserva'];
		$title=$_POST['title'];
		$Grupo=$_POST['Grupo'];
		$UnidadAprendizaje=$_POST['UnidadAprendizaje'];
		$Asunto=$_POST['Asunto'];
		$color=$_POST['color'];
		$Id_Laboratorios=$_POST['Laboratorios'];
		$textColor=$_POST['textColor'];
		$start=$_POST['start'];
		$end=$_POST['end'];

		echo $Id_Usuario;
		echo $Id_Reserva;

		$sentencia = "UPDATE Reserva SET title='$title',Grupo='$Grupo',UnidadAprendizaje='$UnidadAprendizaje',Asunto='Asunto',color='$color',Laboratorios='$Id_Laboratorios',Usuario='$Id_Usuario', textColor='$textColor', start='$start' , fin='$end' WHERE Id_Reserva='$Id_Reserva'";

		$DatosConsulta=sqlsrv_query($con,$sentencia);


 ?>

 <script type="text/javascript">
 	window.location.href='AgendaSolicitante.php';

 </script>