<?php
  require "db.php";
  require "functions.php";

  if (isset($_POST['button1']))
	{
		add();
	}
	function add()
	{
		$connection = mysqli_connect('127.0.0.1', 'root', '', 'believe_database');
    $musicians_creator = $_SESSION['id'];;
    $musicians_experience = $_POST['musicians_experience'];
    $musicians_instrument = $_POST['musicians_instrument'];
    $musicians_genre = $_POST['musicians_genre'];
		$musicians_description = $_POST['musicians_description'];
		make_request($connection, $musicians_creator, $musicians_experience,
    $musicians_instrument, $musicians_genre, $musicians_description);
		echo "<meta http-equiv='refresh' content='0'>";
	}
?>

<form method = "POST">
  Опыт:
  <p><input type = "text" name = "musicians_experience"></p>
  Музыкальный инструмент:
  <p><input type = "text" name = "musicians_instrument"></p>
  Жанр:
  <p><input type = "text" name = "musicians_genre"></p>
  Описание:
  <p><textarea class="FormElement" name="musicians_description"
  id="musicians_description" cols="40" rows="5"></textarea></p>
	<input type = "connection" name = "connection" value ="$connection" hidden />
	<input type = "submit" name = "button1" class = "button" value = "Добавить" onclick = "button1()"/>
</form>
