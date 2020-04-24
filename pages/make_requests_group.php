<?php
  require "db.php";
  require "functions.php";

  if (isset($_POST['save']))
	{
    $groups_creator = $_SESSION['id'];
    $groups_name = $_POST['groups_name'];
    $groups_experience = $_POST['groups_experience'];
    $groups_instrument = $_POST['groups_instrument'];
    $groups_genre = $_POST['groups_genre'];
    $groups_sex = $_POST['groups_sex'];
    $groups_city = $_POST['groups_city'];
    $groups_age = $_POST['groups_age'];
    $groups_description = $_POST['groups_description'];
		make_request_groups($connection, $groups_creator, $groups_name, $groups_experience, $groups_instrument,
    $groups_genre, $groups_sex, $groups_city, $groups_age, $groups_description);
	}
?>

<form method = "POST">
  Название группы:
  <p><input type = "text" name = "groups_name"></p>
  Опыт:
  <p><input type = "text" name = "groups_experience"></p>
  Музыкальный инструмент:
  <p><input type = "text" name = "groups_instrument"></p>
  Жанр:
  <p><input type = "text" name = "groups_genre"></p>
  Пол:
  <p><input type = "text" name = "groups_sex"></p>
  Город:
  <p><input type = "text" name = "groups_city"></p>
  Возраст:
  <p><input type = "text" name = "groups_age"></p>
  Описание:
  <p><textarea class="FormElement" name="groups_description"
  id="groups_description" cols="40" rows="5"></textarea></p>
	<input type = "connection" name = "connection" value ="$connection" hidden />
	<input type = "submit" name = "save" class = "button" value = "Добавить"/>
</form>
