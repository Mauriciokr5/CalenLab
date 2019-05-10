<?php
  $serverName = 'Localhost\sqlexpress';

  $connectionInfo = array("Database"=>"Agenda", "UID"=>"Joss", "PWD"=>"n0m3l0", "CharacterSet"=>"UTF-8");
  $con = sqlsrv_connect($serverName, $connectionInfo);

  if( $con ) {
  }else{
       die( print_r( sqlsrv_errors(), true));
  }
 ?>
