<?php
	require "../libs/rb.php";
$connection = mysqli_connect('127.0.0.1', 'root', '', 'believe_database');
R::setup ('mysql:host=localhost;dbname=believe_database',
		  'mysql','mysql');
@session_start();
?>
