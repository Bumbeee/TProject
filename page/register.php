<?php
  require "db.php";
  require "functions.php";
  $arr = do_register($connection, $_POST);
  ?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/register.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
</head>

<title>Believe - Регистрация</title>

<body>


  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="log_form">
          <a href="../"><img src="../img/logo.png" alt=""></a>
          <?php if(!empty($arr['message'])){
          echo  '<div class="error_message">'.$arr['message'].'</div>';
          }
          ?>
          <form class="reg" method="post">
            <input type="text" class="form-input" name="name" placeholder="Имя" required value="<?php echo $arr['name']?>">
            <input type="text" class="form-input" name="surname" placeholder="Фамилия" required value="<?php echo $arr['surname']?>">
            <input type="email" class="form-input" name="email" placeholder="Email" required value="<?php echo $arr['email']?>">
            <div class="sex">
              <p>Пол</p>
              <p><input type="radio" name="gender" value="man" required>Мужчина</p>
              <p><input type="radio" name="gender" value="woman">Женщина</p>
            </div>
            <input type="date" class="form-input" id="date" name="date" placeholder="Дата рождения: " required value="<?php echo $arr['date']?>">
            <input type="text" class="form-input" name="city" placeholder="Город" required value="<?php echo $arr['city']?>" />
            <input type="password" class="form-input" name="password" placeholder="Пароль" required>
            <input type="password" class="form-input" name="repassword" placeholder="Повторите пароль" required>
            <p class="">Уже есть аккунт? Тогда быстрее <a href="auth.php">авторизируйся</a>!</p>
            <input type="submit" name="do_submit" value="Зарегистрироваться">
          </form>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="../js/main.js"></script>
</body>
