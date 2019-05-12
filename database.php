<?php
  $serverName = 'Localhost\sqlexpress';

  $connectionInfo = array("Database"=>"Agenda", "UID"=>"Kronos", "PWD"=>"ennui", "CharacterSet"=>"UTF-8");
  $con = sqlsrv_connect($serverName, $connectionInfo);

  if( $con ) {
  }else{
       die( print_r( sqlsrv_errors(), true));
  }
 ?>
