<?php   require "db.php"; require "functions.php"; ?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="../css/account.css">
  <link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
  <link rel="stylesheet" href="libs/font-awesome-4.2.0/css/font-awesome.min.css" />
</head>
<title>Believe - Личный кабинет</title>
<body>
<?php require("../page/header.php"); ?>

  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <h1>Личный кабинет</h1>
        <div class="account">
          <div class="my-acc">
            <h2>Моя анкета</h2>
            <?php user_data_output($connection, 1); ?>
          </div>
          <div class="my-app">
            <h2>Мои заявки</h2>
            <?php user_request_output($connection, 1); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="../js/main.js"></script>
</body>
  
