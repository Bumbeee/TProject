<?php
require "db.php";
require "functions.php";
$arr = do_auth($connection, $_POST);
?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/">
</head>

<title>Believe - Авторизация</title>

<body>

  <div class="">
    <div class="">
      <div class="">
        <div class="">
          <div class="">
            <a href="../"><img src="" alt=""></a>
          </div>
          <?php
					if(!empty($arr['message'])){
					echo  '<div class="error_message">'.$arr['message'].'</div>';
					}
				?>
          <form class="reg" method="post">
              <input type="email" class="" name="email" placeholder="Email" required value = "<?php echo $arr['email']?>">
              <input type="password" class="" name="password" placeholder="Пароль" required>
              <p class="">Ещё нет аккунта? <a href="registration.php">Регистрируйся</a> прямо сейчас!</p>
              <input type="submit" name="do_login" value="Войти">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
