<?php

	include("database.php");
	

	if (substr($_FILES['excel']['name'],-3)=="csv")
	{
		$fecha		= date("Y-m-d_H-i-s");
		$carpeta 	= "tmp_excel/";
		$excel  	= $fecha."-".$_FILES['excel']['name'];

		move_uploaded_file($_FILES['excel']['tmp_name'], "$carpeta$excel");
		
		$row = 1;

		$fp = fopen ("$carpeta$excel","r");

		//fgetcsv. obtiene los valores que estan en el csv y los extrae.
		while ($data = fgetcsv ($fp, 1000, ","))
		{
			//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
			if ($row!=1)
			{
				$num = count($data);
				$insertar="INSERT INTO Reserva (title,Grupo,UnidadAprendizaje,Asunto,color,Laboratorios,Usuario,textColor,start,fin) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]',convert(datetime,'$data[8]',103),convert(datetime,'$data[9]',103))";
				$sql = sqlsrv_query ($con,$insertar) or die(print_r('
				<script>
					alert(`Carga completada`);
					document.location.replace(\'Importar.php\');
				</script>
				',true));
				if (!$sql){
					echo "<div>Hubo un problema al momento de importar porfavor vuelva a intentarlo</div >";
					exit;
				}

			}

		$row++;

		}

		fclose ($fp);
		header('location: Importar.php');
		exit;


	}

?>