<?php
	require 'db.php';
	unset($_SESSION['id']);
	unset($_SESSION['loged_user']);
	header('Location: /');
?>
