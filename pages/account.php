<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/account.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
  <link rel="stylesheet" href="libs/font-awesome-4.2.0/css/font-awesome.min.css" />
</head>
<title>Believe - Личный кабинет</title>
<body>
  <script type="text/javascript" src="../js/main.js"></script>
<?php require("../pages/header.php"); ?>

  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <h1>Личный кабинет</h1>
        <div class="account">
          <div class="my-acc">
            <h2>Моя анкета</h2>
            <table>
              <tr>
                <td>Имя</td>
                <td>Михаил</td>
              </tr>
              <tr>
                <td>Фамилия</td>
                <td>Дынин</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>azyrbaigen@gmail.com</td>
              </tr>
              <tr>
                <td>Пол</td>
                <td>Мужской</td>
              </tr>
              <tr>
                <td>Дата рождения</td>
                <td>23.08.1999</td>
              </tr>
              <tr>
                <td>Город</td>
                <td>Воронеж</td>
              </tr>
            </table>
            <a href="#">Редактировать</a>
          </div>
          <div class="my-app">
            <h2>Мои заявки</h2>
            <div class="box">
                <img src="../img/123.jpg" alt="">
                <div class="text_block">
                  <h3>Заявка №3</h3>
                  <h4>Поиск группы</h4>
                  <input type="checkbox" id="hd-1" class="hide"/>
                  <label for="hd-1" >Подробнее</label>
                    <div>
                      <ul>
                        <li><b>Название группы:</b> Попугайчики</li>
                        <li><b>Желаемый опыт:</b> от 3 лет</li>
                        <li><b>Жанр:</b> Инди</li>
                      </ul>
                      <p><h4>Описание группы</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                      </p>
                    </div>
                  </div>
                </div>

                <div class="box">
                    <img src="../img/123.jpg" alt="">
                    <div class="text_block">
                      <h3>Заявка №3</h3>
                      <h4>Поиск группы</h4>
                      <input type="checkbox" id="hd-2" class="hide"/>
                      <label for="hd-2" >Подробнее</label>
                        <div>
                          <ul>
                            <li><b>Название группы:</b> Попугайчики</li>
                            <li><b>Желаемый опыт:</b> от 3 лет</li>
                            <li><b>Жанр:</b> Инди</li>
                          </ul>
                          <p><h4>Описание группы</h4>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                          </p>
                        </div>
                      </div>
                    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
