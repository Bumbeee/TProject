<?php
  require "db.php";
  require "functions.php";

  $arr = test($_POST, $connection);

?>

<form class="" method="post">
  Опыт:
  <p><input type = "text" name = "musicians_experience"></p>
  Музыкальный инструмент:
  <p><input type = "text" name = "musicians_instrument"></p>
  Жанр:
  <p><input type = "text" name = "musicians_genre"></p>
  Описание:
  <p><textarea class="FormElement" name="musicians_description"
  id="musicians_description" cols="40" rows="5"></textarea></p>
  Вип_код: /TODO
	<input type = "connection" name = "connection" value ="$connection" hidden />
	<p><input type = "submit" name = "save" class = "button" value = "Добавить" onclick = "save()"/></p>
</form>
