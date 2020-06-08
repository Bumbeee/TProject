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
            <form class="filter" method = "post">
            <select class="select" id="instrument" name="instrument" >
            	<?php getinstruments($connection, $_POST["instrument"], $_POST["clear"]);?>
            </select>

            <select class="" name="sex">
              <?php getsexes($connection, $_POST["sex"], $_POST["clear"]);?>
            </select>
            <select class="" name="experience">
              <?php getexps($connection, $_POST["experience"], $_POST["clear"]);?>
            </select>
            <select class="" id="genre" name="genre">
              <?php getgenres($connection, $_POST["genre"], $_POST["clear"]); ?>
            </select>
            <input type="text" name="city" placeholder="Город" value="<?php if(!isset($_POST["clear"])) echo $_POST['city'];?>">
            <select class="" name="age">
              <?php getages($connection, $_POST["age"], $_POST["clear"]);?>
            </select>
            <input type="submit" name="clear" value = "Очистить">
            <input type="submit" name="do_filter" value="Найти">
          </div>
  </form>
            <div class="order">
              <h4>Оставить заявку на поиск</h4>
              <a href="make_requests_musician.php">Поиск музыканта</a>
              <a href="make_requests_group.php">Поиск группы</a>
            </div>
        </div>
      </div>
    </div>
  </div>
<!-- Подключение JS -->
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../libs/jquery/jquery-1.11.1.min.js"></script>
    <script src="../libs/remodal/remodal.min.js"></script>
</body>
