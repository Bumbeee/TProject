<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/register.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
</head>

<title>Believe - Регистрация</title>

<body>
<script type="text/javascript" src="../js/main.js">

</script>

  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="log_form">
          <a href="../"><img src="../img/logo.png" alt=""></a>
          <form class="reg" method="post">
            <input type="text" class="form-input" name="name" placeholder="Имя" required>
            <input type="text" class="form-input" name="surname" placeholder="Фамилия" required>
            <input type="email" class="form-input" name="email" placeholder="Email" required>
            <div class="sex">
              <p>Пол</p>
              <p><input type="radio" name="gender" value="man" required>Мужчина</p>
              <p><input type="radio" name="gender" value="woman">Женщина</p>
            </div>
            <input type="date" class="form-input" id="date" name="date" placeholder="Дата рождения: " required>
            <input type="text" class="form-input" name="city" placeholder="Город" required>
            <input type="password" class="form-input" name="password" placeholder="Пароль" required>
            <input type="password" class="form-input" name="repassword" placeholder="Повторите пароль" required>
            <p class="qa">Уже есть аккаунт? Тогда быстрее <a href="auth.php">авторизируйся</a>!</p>
            <input type="submit" name="" value="Зарегистрироваться">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
