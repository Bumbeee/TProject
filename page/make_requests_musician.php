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

    $musicians_name = $_POST['musicians_name'];
    $musicians_city = $_POST['musicians_city'];
    $musicians_age = $_POST['musicians_age'];
    $musicians_sex = $_POST['musicians_sex'];

		make_request_musicians($connection, $musicians_creator, $musicians_experience,
    $musicians_instrument, $musicians_genre, $musicians_description, $musicians_name, $musicians_city,
    $musicians_age, $musicians_sex);
	}
?>
<h2>Ищете музыканта? Тогда Вы по адресу!</h2>
<h4>Заполните несколько полей и мы обязательно найдем для Вас музыканта</h4>
<form method = "POST">
<label for="#musicians_name">Название группы</label>
<input type="text" id="musicians_name" name="musicians_name" value=""><br>
<select name="musicians_instrument">
  <option selected="selected" disabled>Инструмент</option>
  <?php setinstruments($connection); ?>
</select><br>
<select name="musicians_experience">
  <option selected="selected" disabled>Опыт</option>
  <option>Любой</option>
  <option>< 1 года</option>
  <option>1 - 3 года</option>
  <option>3 - 5 лет</option>
  <option>> 5 лет</option>
</select><br>
<select name="musicians_genre">
  <option selected="selected" disabled>Жанр</option>
    <?php setgenres($connection); ?>
</select><br>
<select name="musicians_sex">
  <option selected="selected" disabled>Пол</option>
  <option>Любой</option>
  <option>Мужской</option>
  <option>Женский</option>
</select><br>
<select name="musicians_age">
  <option selected="selected" disabled>Возраст</option>
  <option>Любой</option>
  <option>< 20 лет</option>
  <option>20 - 30 лет</option>
  <option>30 - 40 лет</option>
  <option>40 - 50 лет</option>
  <option>> 50 лет</option>
</select><br>
<label for="#musicians_city">Город</label>
<input type="text" id="musicians_city" name="musicians_city" value=""><br>
<textarea name="musicians_description" cols="43" rows="5" placeholder="Расскажите о Вашей группе, нам очень интересно!"></textarea><br>
<h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
<input type="text" placeholder="Промокод вводить сюда!"><br><br>
<input type = "submit" name = "save" class = "button" value = "Добавить"/>
</form>
