<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/orders.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
  <link rel="stylesheet" href="../libs/font-awesome-4.2.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../libs/remodal/remodal.css">
  <link rel="stylesheet" href="../libs/remodal/remodal-default-theme.css">
</head>
<title>Believe - Личный кабинет</title>
<body>
  <?php require("header.php"); ?>
  <?php require("filter.php"); ?>

  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <h2 class="title">Подберите для себя лучшего музыканта</h2>
        <div class="orders">
          <div class="box">
            <h2>Иванов Иван</h2>
              <img src="../img/123.jpg" alt="">
              <div class="info">
                <ul>
                  <li>Пол: мужской</li>
                  <li>Возраст: 19 лет</li>
                  <li>Инструмент: гитара</li>
                  <li>Опыт: 3 года</li>
                  <li>Жанр: джаз</li>
                  <li>Город: Воронеж</li>
                </ul>
              </div>
            <div class="about">
              <h4>О себе</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident,
              sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
            <nav><a href="#id-1">Откликнуться!</a></nav>

            <div class="remodal" data-remodal-id="id-1">
              <button data-remodal-action="close" class="remodal-close"></button>
              <h4>Понравился музыкант? Напишите ему на почту!</h4>
              <a href="mailto:dynin.michael21@gmail.com">dynin.michael21@gmail.com</a>
          </div>

          </div>
        </div>
      </div>
    </div>
  </div>



  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript" src="../libs/jquery/jquery-1.11.1.min.js"></script>
  <script src="../libs/remodal/remodal.min.js"></script>
</body>
