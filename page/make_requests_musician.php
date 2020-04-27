<?php
require "db.php";
require "functions.php";
if(!isset($_SESSION["id"])){
  header("Location: auth.php");
    exit();
}
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
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/request.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
</head>
<body>
  <?php require("header.php"); ?>
  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="block">
          <h2>Ищете музыканта? Тогда Вы по адресу!</h2>
          <h4>Заполните несколько полей и мы обязательно найдем для Вас музыканта</h4>
          <form method = "POST">
            <div class="info">
              <input type="text" name="musicians_name" class="form-input" placeholder="Название группы">
              <input type="text" name="musicians_city"  class="form-input" placeholder="Город"><br>
            </div>

          <div class="sel_block">
            <div class="mus">
              <h5>Требуемые музыкальные данные</h5>
              <select name="musicians_instrument">
                <option selected="selected" disabled>Инструмент</option>
                <?php setinstruments($connection); ?>
              </select><br>
              <select name="musicians_experience" placeholder="Опыт">
                <option selected="selected" disabled>Опыт</option>
                <option>< 1 года</option>
                <option>1 - 3 года</option>
                <option>3 - 5 лет</option>
                <option>> 5 лет</option>
                <option>Любой</option>
              </select><br>
              <select name="musicians_genre">
                <option selected="selected" disabled>Жанр</option>
                  <?php setgenres($connection); ?>
              </select>
            </div>

            <div class="phys">
              <h5>Требуемые физические данные</h5>
              <select name="musicians_sex">
                <option selected="selected" disabled>Пол</option>
                <option>Мужской</option>
                <option>Женский</option>
                <option>Любой</option>
              </select><br>
              <select name="musicians_age">
                <option selected="selected" disabled>Возраст</option>
                <option>< 20 лет</option>
                <option>20 - 30 лет</option>
                <option>30 - 40 лет</option>
                <option>40 - 50 лет</option>
                <option>> 50 лет</option>
                <option>Любой</option>
              </select>
            </div>
          </div>

          <textarea name="musicians_description" cols="43" rows="5" placeholder="Расскажите о Вашей группе, нам очень интересно!"></textarea><br>
          <h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
          <input type="text" class="form-input" placeholder="Промокод вводить сюда!"><br>
          <input type = "submit" name = "save" value = "Добавить"/>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="../js/main.js"></script>
</body>
