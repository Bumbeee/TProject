<?php
	require "db.php";
	require "functions.php";
?>

<a href="account.php">Личный кабинет</a>
<?php if(isset($_SESSION['logged_user'])){
echo '<a href="logout.php">Выход</a>';
}
else{
	echo '<a href="registration.php">Регистрация</a>';
	echo '<a href="auth.php">Авторизация</a>';
}
?>
