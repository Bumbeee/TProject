<?php
require "../page/db.php";
require "../page/functions.php";
$arr = get_vips($connection, $_POST);
?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
  <link rel="stylesheet" href="../libs/remodal/remodal.css">
  <link rel="stylesheet" href="../libs/remodal/remodal-default-theme.css">
</head>

<title>Believe - Админ-панель</title>

<body>

<div class="container">
  <div class="col-md-12">
    <div class="row">
      <div class="header">
        <img src="../img/logo.png" alt="">
        <a href="../">На главную</a>
        <h1>Панель администратора</h1>
      </div>

      <div class="codes">
        <h4>Сколько VIP-кодов сгенерировать?</h4>
        <form class="vips" method="post">
        <input type="number" name= "code_count" id="code" value="10">
        <input type="submit" name= "get_vips" value = "Сгенерировать">
      </form>
      </div>
    </div>
  </div>
</div>

<?php admins_requsts_output_mus($connection);
 admins_requsts_output_gr($connection);?>

<script src="js/admin.js"></script>
<script type="text/javascript" src="../libs/jquery/jquery-1.11.1.min.js"></script>
<script src="../libs/remodal/remodal.min.js"></script>
</body>
