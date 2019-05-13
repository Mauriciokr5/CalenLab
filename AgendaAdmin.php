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
  
  $NumLABO=$_GET['labs'];
  //echo $NumLABO;
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
    <span><a href="AgregarReserva.php"></a> </span>
    <br><br>

	<div class="container ">
		<div class="row">
			<div class="col"></div>
			<div class="col-7">
				<div id="CalendarioWeb"></div>
			</div>
			<div class="col"></div>
		</div>
	</div>

	
	<script>
		$(document).ready(function(){
			$('#CalendarioWeb').fullCalendar({

				windowResize: function(view) {
  				},

				header:{
					left:'prev, next, customButton, today',
					center: 'title' ,
					right: 'month,agendaWeek,agendaDay,listMonth'
				},

				customButtons:{
					customButton:{
						text:'Agregar Reserva',
						click: function(){
							window.location.href='reservar.php?labs=<?php echo $_GET['labs']?>'
					}
				}
			},

				//dayClick: function(date,jsEvent,view){

					//alert("Valor seleccionado: "+date.format());
					//alert("Vista actual: "+view.name);
					//$("#exampleModal").modal();
				//},
				<?php  
				require 'database.php';
				$sentencia= "SELECT * FROM Agenda2 WHERE Id_Laboratorios = $NumLABO";

				$Ejecutar = sqlsrv_query($con,$sentencia);
				//print_r($Ejecutar);
				$i=0;
				while($resultados = sqlsrv_fetch_array($Ejecutar,SQLSRV_FETCH_ASSOC)){

					$Resultados[] = array(
					'title'=>$resultados['title'],
					'start'=>$resultados['start']->format('Y-m-d H:i:s'),
					'end'=>$resultados['fin']->format('Y-m-d H:i:s'),
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
				?>

				<?php if ($Resultados) {
					echo ("events:".$res.",");
				} else{
					
				}

				?>

				eventClick: function(calEvent,jsEvent,view){
					let inicio = calEvent.start.toString();
					let fin = calEvent.end.toString();
					var Otro = calEvent.Id_Reserva.toString();
					let inicioChido = new Date(inicio);

					console.log(inicioChido,inicio)
					$('#Id_Reserva').html(calEvent.Id_Reserva);
					$('#title').html(calEvent.title);
					$('#Grupo').html(calEvent.Grupo);
					$('#UnidadAprendizaje').html(calEvent.UnidadAprendizaje);
					$('#Asunto').html(calEvent.Asunto);
					$('#color').html(calEvent.color);
					$('#Laboratorio').html(calEvent.Laboratorio);
					$('#Usuario').html(calEvent.Nombre);
					$('#textColor').html(calEvent.textColor);
					$('#start').html(moment(inicio).utc(0000).format('YYYY-MM-DD hh:mm:ss a',true));
					$('#end').html(moment(fin).utc(0000).format('YYYY-MM-DD hh:mm:ss a',true));

					console.log(Otro)
					$("#f1t1").val(Otro);
					$("#exampleModal").modal();
				}
				
			});

		});


	</script>



		<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hoever">
	      		<tbody>
	      			<tr>
	      				<td>Id de reserva</td>
	      				<td><div id="Id_Reserva"></div>
	      					<input type="hidden" name="f1t1" id="f1t1">
	      				</td>
	      			</tr>
	      			<tr>
	      				<td>Grupo</td>
	      				<td><div id="Grupo"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Unidad de Aprendizaje</td>
	      				<td><div id="UnidadAprendizaje"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Asunto</td>
	      				<td><div id="Asunto"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Color de evento</td>
	      				<td><div id="color"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Laboratorio</td>
	      				<td><div id="Laboratorio"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Nombre de usuario</td>
	      				<td><div id="Usuario"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Color de texto</td>
	      				<td><div id="textColor"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Fecha de inicio</td>
	      				<td><div id="start"></div></td>
	      			</tr>
	      			<tr>
	      				<td>Fecha de termino</td>
	      				<td><div id="end"></div></td>
	      			</tr>
	      		
	      		</tbody>
	      	</table>
	      	
	        <!--<p id="Id_Reserva"></p>
	        <div id="Grupo"></div>
	        <div id="UnidadAprendizaje"></div>
	        <div id="Asunto"></div>
	        <div id="color"></div>
	        <div id="Laboratorio"></div>
	        <div id="Usuario"></div>
	        <div id="textColor"></div>
	        <div id="start"></div>
	        <div id="end"></div>-->
	      </div>
	      <div class="modal-footer">
	      	<!--<button type="button" class="btn btn-success">Agregar</button>-->
	      	<button type="button" class="btn btn-success" id="Modificar">Modificar</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>

		<script type="text/javascript">
		$('#Modificar').click(function(){
			Recolectar();
			var Id_Reserva = NuevoEvento.id;

			console.log(Id_Reserva)
			window.location="Mod_Reserva.php?Id_Reserva="+Id_Reserva;

		});

		function Recolectar(){
			NuevoEvento ={
				id:$('#f1t1').val()
			}
		}
	</script>



<?php else: ?>
    <h1>Please Login</h1>
    <h2>No cunetas con los permisos necesarios para realizar esto</h2>
    <a href="login.php">Login</a>
  <?php endif;?>


</body>
</html>