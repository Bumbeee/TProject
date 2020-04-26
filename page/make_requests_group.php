<?php
  require "db.php";
  require "functions.php";

  if (isset($_POST['save']))
	{
    $groups_creator = $_SESSION['id'];
    $groups_experience = $_POST['groups_experience'];
    $groups_instrument = $_POST['groups_instrument'];
    $groups_genre = $_POST['groups_genre'];
    $groups_description = $_POST['groups_description'];
		make_request_groups($connection, $groups_creator, $groups_experience, $groups_instrument,
    $groups_genre, $groups_description);
	}
?>
<h2>Кажется Вы хотите найти себе группу... Не вопрос!</h2>
<h4>Заполните несколько полей и мы обязательно подберем для Вас группу</h4>

<form method = "POST">
<select name="groups_instrument">
  <option selected="selected" disabled>Инструмент</option>
  <?php setinstruments($connection); ?>
</select><br>
<select name="groups_experience">
  <option selected="selected" disabled>Опыт</option>
  <option>< 1 года</option>
  <option>1 - 3 года</option>
  <option>3 - 5 лет</option>
  <option>> 5 лет</option>
</select><br>
<select name="groups_genre">
  <option selected="selected" disabled>Жанр</option>
    <?php setgenres($connection); ?>
</select><br>
<textarea name="groups_description" cols="43" rows="5" placeholder="Расскажите о себе, нам очень интересно!"></textarea><br>
<h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
<input type="text" placeholder="Промокод вводить сюда!"><br><br>
<input type = "submit" name = "save" class = "button" value = "Добавить"/>
</form>
