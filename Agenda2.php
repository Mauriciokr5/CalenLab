<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agenda web</title>

  <!--bootstrap css-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/navbar_css.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Roboto" rel="stylesheet">

  <!-- herramientas -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/moment.min.js"></script>

  <!-- full calendar -->
  <link rel="stylesheet" href="assets/css/fullcalendar.css">
  <script src="assets/js/fullcalendar.js" charset="utf-8"></script>
  <script src="assets/js/es.js" charset="utf-8"></script>

    <!--bootstrap js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>
  <?php require 'partials/headerAdmin.php' ?>
  <br><br>

    <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-7"><div id="CalendarioWeb"></div></div>
      <div class="col"></div>
    </div>
  </div>

  <script>
    var httpes = new XMLHttpRequest();
    httpes.open('GET','eventos.php',true);
    httpes.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(JSON.parse(this.responseText))

            var $Calendario = JSON.parse(this.responseText); 

            console.log($Calendario)
      
      $('#CalendarioWeb').fullCalendar({
        header:{
          left:'month,agendaWeek,agendaDay,today',
          center:'title',
          right: 'prevYear,prev,next,nextYear'
        },
        eventSources:[{
          events:[
          {
          title: $Calendario.Asunto,
          start: $Calendario.HoraIncio.date,
          end: $Calendario.HoraTermino.date
        },
          ],

      
          color: 'green',
          textColor: 'black'

        }


        ]


      });
   








       }
    };
    httpes.send();
  


  </script>

    <a href="reservar.php" type="button" class="btn btn_success">Reservar</a>




</body>
</html>