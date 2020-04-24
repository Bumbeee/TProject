<?php   require "db.php";
  require "functions.php"; ?>
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
          <?php musicians_request_output($connection); ?>
        </div>
      </div>
    </div>
  </div>



  <script type="text/javascript" src="../js/main.js"></script>
  <script type="text/javascript" src="../libs/jquery/jquery-1.11.1.min.js"></script>
  <script src="../libs/remodal/remodal.min.js"></script>
</body>
