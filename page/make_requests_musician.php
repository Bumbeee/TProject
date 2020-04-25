<?php
  require "db.php";
  require "functions.php";

  if (isset($_POST['save']))
	{
    $musicians_creator = $_SESSION['id'];
    $musicians_experience = $_POST['musicians_experience'];
    $musicians_instrument = $_POST['musicians_instrument'];
    $musicians_genre = $_POST['musicians_genre'];
		$musicians_description = $_POST['musicians_description'];
		make_request_musicians($connection, $musicians_creator, $musicians_experience,
    $musicians_instrument, $musicians_genre, $musicians_description);
	}
?>
<h2>Ищете музыканта? Тогда Вы по адресу!</h2>
<h4>Заполните несколько полей и мы обязательно найдем для Вас музыканта</h4>
<form method = "POST">
<label for="#name">Название группы</label>
<input type="text" id="name" name="" value=""><br>
<select name="musicians_instrument">
  <option selected="selected" disabled>Инструмент</option>
  <?php setinstruments($connection); ?>
</select>
<select name="musicians_experience">
  <option selected="selected" disabled>Опыт</option>
  <option>< 1 года</option>
  <option>1 - 3 года</option>
  <option>3 - 5 лет</option>
  <option>> 5 лет</option>
</select>
<select name="musicians_genre">
  <option selected="selected" disabled>Жанр</option>
    <?php setgenres($connection); ?>
</select><br>
<textarea name="musicians_description" cols="43" rows="5" placeholder="Расскажите о Вашей группе, нам очень интересно!"></textarea><br>
<h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
<input type="text" placeholder="Промокод вводить сюда!"><br><br>
<input type = "submit" name = "save" class = "button" value = "Добавить"/>
</form>

<!-- <form method = "POST">
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
	<input type = "submit" name = "save" class = "button" value = "Добавить"/>
</form> -->
