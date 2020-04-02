<!DOCTYPE html>
<head>

</head>

<title>Believe - Регистрация</title>

<body>


  <div class="">
    <div class="">
      <div class="">
        <div class="">
          <a href="../">< ></a>

          <?php if(!empty($arr['message'])){
          echo  '<div class="error_message">'.$arr['message'].'</div>';
          }
          ?>
          <form class="" method="post">
            <input type="text" class="" name="name" placeholder="Имя" required value="">
            <input type="text" class="" name="surname" placeholder="Фамилия" required value="">
            <input type="email" class="" name="email" placeholder="Email" required value="">
            <div class="sex">
              <p>Пол</p>
              <p><input type="radio" name="gender" value="man" required>Мужчина</p>
              <p><input type="radio" name="gender" value="woman">Женщина</p>
            </div>
            <input type="date" class="" id="date" name="date" placeholder="Дата рождения: " required value="">
            <input type="text" class="" name="city" placeholder="Город" required value="" />
            <input type="password" class="" name="password" placeholder="Пароль" required>
            <input type="password" class="" name="repassword" placeholder="Повторите пароль" required>
            <p class="">Уже есть аккунт? Тогда быстрее <a href="auth.php">авторизируйся</a>!</p>
            <input type="submit" name="do_submit" value="Зарегистрироваться">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
