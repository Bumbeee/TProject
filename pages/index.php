<?php
	require "db.php";
	require "functions.php";

	if(isset($_POST["do_vip"])){
		get_vips($connection, 10);
	}
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
<form method="post">
<input type="submit" name="do_vip" value="Сгенерировать коды">
</form>
