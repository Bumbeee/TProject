<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/filter.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
  <link rel="stylesheet" href="../libs/font-awesome-4.2.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../libs/remodal/remodal.css">
  <link rel="stylesheet" href="../libs/remodal/remodal-default-theme.css">
</head>
<body>

  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="all_filter">
          <div class="filter">
            <h4>Фильтр</h4>
            <select class="">
              <option selected="selected" disabled>Инструмент</option>
              <?php setinstruments($connection); ?>
            </select>
            <select class="">
              <option selected="selected" disabled>Пол</option>
              <option>Мужской</option>
              <option>Женский</option>
            </select>
            <select class="">
              <option selected="selected" disabled>Опыт</option>
              <option>< 1 года</option>
              <option>1 - 3 года</option>
              <option>3 - 5 лет</option>
              <option>> 5 лет</option>
            </select>
            <select class="">
              <option selected="selected" disabled>Жанр</option>
              <?php setgenres($connection); ?>
            </select>
            <input type="text" placeholder="Город">
            <input type="number" placeholder="Возраст">
            <input type="submit" value="Найти">
          </div>

            <div class="order">
              <h4>Оставить заявку на поиск</h4>
              <a href="#modal_mus">Поиск музыканта</a>
              <a href="#modal_group">Поиск группы</a>
            </div>
        </div>
      </div>
    </div>
  </div>


<!-- Формы для создания заявок -->
  <div class="remodal" data-remodal-id="modal_mus">
    <button data-remodal-action="close" class="remodal-close"></button>
    <form class="order_form" action="index.html" method="post">
      <h2>Ищете музыканта? Тогда Вы по адресу!</h2>
      <h4>Заполните несколько полей и мы обязательно найдем для Вас музыканта</h4>
      <label for="#name">Название группы</label>
      <input type="text" id="name" name="" value=""><br>
      <select class="">
        <option selected="selected" disabled>Инструмент</option>
        <?php setinstruments($connection); ?>
      </select>
      <select class="">
        <option selected="selected" disabled>Опыт</option>
        <option>< 1 года</option>
        <option>1 - 3 года</option>
        <option>3 - 5 лет</option>
        <option>> 5 лет</option>
      </select>
      <select class="">
        <option selected="selected" disabled>Жанр</option>
          <?php setgenres($connection); ?>
      </select><br>
      <textarea name="" cols="43" rows="5" placeholder="Расскажите о Вашей группе, нам очень интересно!"></textarea><br>
      <h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
      <input type="text" placeholder="Промокод вводить сюда!"><br><br>
      <button data-remodal-action="confirm" class="remodal-confirm" id="mus_find">Найти</button>
    </form>
</div>

<div class="remodal" data-remodal-id="modal_group">
  <button data-remodal-action="close" class="remodal-close"></button>
  <form class="order_form" action="index.html" method="post">
    <h2>Кажется Вы хотите найти себе группу... Не вопрос!</h2>
    <h4>Заполните несколько полей и мы обязательно подберем для Вас группу</h4>
    <select class="instrument">
      <option selected="selected" disabled>Инструмент</option>
      <?php setinstruments($connection); ?>
    </select>
    <select class="experience">
      <option selected="selected" disabled>Опыт</option>
      <option>< 1 года</option>
      <option>1 - 3 года</option>
      <option>3 - 5 лет</option>
      <option>> 5 лет</option>
    </select>
    <select class="genre">
      <option selected="selected" disabled>Жанр</option>
      <?php setgenres($connection); ?>
    </select><br>
    <textarea name="" cols="43" rows="5" class="about_you" placeholder="Расскажите о себе, нам очень интересно!"></textarea><br>
    <h5>Хотите чтобы Вашу заявку увидели первой? Введите VIP-код!</h5>
    <input type="text" class="vipcode" placeholder="Промокод вводить сюда!"><br><br>
    <button data-remodal-action="confirm" class="remodal-confirm" id="gr_find">Найти</button>
  </form>
</div>

<!-- Подключение JS -->
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../libs/jquery/jquery-1.11.1.min.js"></script>
    <script src="../libs/remodal/remodal.min.js"></script>
</body>
