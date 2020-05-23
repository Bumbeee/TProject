<?php
  require "db.php";
  require "functions.php";
  if(!isset($_SESSION["id"])){
    header("Location: auth.php");
      exit();
  }
  if(checkisadmin($connection)){
    header("Location: ../admin");
    exit();
  }
  if (isset($_POST['save']))
  {
    $arr = make_request_groups($connection, $_POST);
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
          <h2>Кажется Вы хотите найти себе группу... Не вопрос!</h2>
          <h4>Заполните несколько полей и мы обязательно подберем для Вас группу</h4>
          <?php
          if(!empty($arr['message'])){
          echo  '<div class="error_message">';
          echo $arr['message'];
          echo '</div>';
          }
        ?>
          <form method = "POST">
          <select name="groups_instrument">
            <option selected="selected" disabled>Инструмент</option>
            <?php setinstruments($connection); ?>
          </select>
          <select name="groups_experience">
            <option selected="selected" disabled>Опыт</option>
            <option>< 1 года</option>
            <option>1 - 3 года</option>
            <option>3 - 5 лет</option>
            <option>> 5 лет</option>
          </select>
          <select name="groups_genre">
            <option selected="selected" disabled>Жанр</option>
              <?php setgenres($connection); ?>
          </select><br>
          <textarea name="groups_description" cols="43" rows="5" placeholder="Расскажите о себе, нам очень интересно!"><?php echo $arr["description"]?></textarea><br>
          <h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
          <input type="text" name="vipcode"placeholder="Промокод вводить сюда!" value="<?php echo $arr['code']?>"><br>
          <input type = "submit" name = "save" class = "button" value = "Добавить"/>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../js/main.js"></script>
</body>
