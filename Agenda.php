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
    $(document).ready(function(){
      $('#CalendarioWeb').fullCalendar({
        header:{
          left:'month,agendaWeek,agendaDay,today',
          center:'title',
          right: 'prevYear,prev,next,nextYear'
        },

          dayClick: function(date,jsEvent,view){
            $('#txtFecha').val(date.format());
            $("#ModalEventos").modal();
        },
        $('#CalendarioWeb').fullCalendar({
          events:[
          {
            title: 'Hola',
            start: '2019-03-2T13:13:55.008',
            end: '2019-03-5T13:13:55.008'
          }
          
          ]
        });
        //events:'localhost/AgendaWeb/eventos.php',
       // eventClick:function(calEvent,jsEvent,view){
       // $('#titulo_evento').html(calEvent.title);
       // $('#descripcion_evento').html(calEvent.descripcion);
       // $("#Modalito").modal();

      ///}
      });
    });
  </script>

  <!-- Modal notificacion-->
  <div class="modal fade" id="Modalito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="tituloEvento">Agreagar titulo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div id="descripcion_evento"></div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Agregar</button>
          <button type="button" class="btn btn-success">Modificar</button>
          <button type="button" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

<!--modal de insercion de datos-->
  <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento">Agreagar titulito</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="descripcionEvento"></div>

          Fecha:<input type="text" id="txtFecha" name="txtFecha"/><br/>
          Titulo:<input type="text" id="txtTitulo" name="txtTitulo"/><br/>
          Hora:<input type="text" id="txtHora" value="10:30"/><br/>
          Descripcion:<textarea id="txtDescripcion" rows="3"></textarea><br/>
          Color:<input type="color" id="txtColor" value="#ff0000"/><br/>


        </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregar" class="btn btn-primary">Agregar</button>
          <button type="button" class="btn btn-success">Modificar</button>
          <button type="button" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>

  <script>

  $('#btnAgregar').click(function(){
    var NuevoEvento={
      title:$('#txtTitulo').val(),
      start:$('#txtFecha').val+" "+$('#txtHora').val(),
      color:$('#txtColor').val(),
      descripcion:$('#txtDescripcion').val(),
      textColor:"#FFFFFF",
    };
    $('#Agenda').fullCalendar('renderEvent',NuevoEvento);
    $("#ModalEventos").modal('toggle');

  });


  </script>

</body>

</html>
