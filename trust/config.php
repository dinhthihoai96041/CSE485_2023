<?php
	session_start();
	ob_start();
  
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_data = "btth01_cse485";

	$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_data);
	mysqli_set_charset($connect, 'utf8');


?>