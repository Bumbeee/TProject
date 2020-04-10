<?php
  require "db.php";
  require "functions.php";

  $data = $_POST;
	$user = post($connection, $_GET['users_id']);
  $users_idt = $_GET['users_id'];

  if ($_GET['update'] == 1)
	{
	$data['users_name'] = $user['users_name'];
	$data['users_surname'] = $user['users_surname'];
	$data['users_email'] = $user['users_email'];
	$data['users_sex'] = $user['users_sex'];
	$data['users_birth_date'] = $user['users_birth_date'];
	$data['users_city'] = $user['users_city'];
	$update = 2;
	}

  if (isset($data['save']))
	{
		$errors = array();
		if (trim($data['users_name']) == '')
		{
			$errors[] = 'Введите имя!';
		}

		if (trim($data['users_surname']) == '')
		{
			$errors[] = 'Введите фамилию!';
		}

		if (trim($data['users_email']) == '')
		{
			$errors[] = 'Введите Email!';
		}

		// if (trim($data['users_sex']) == '')
		// {
		// 	$errors[] = 'Введите пол!';
		// }

		if (trim($data['users_birth_date']) == '')
		{
			$errors[] = 'Введите дату рождения!';
		}

		if (trim($data['users_city']) == '')
		{
			$errors[] = 'Введите город!';
		}

		if (empty($errors))
		{
			user_data_edit($connection, $_GET['users_id'], $data['users_name'], $data['users_surname'],
					$data['users_email'],  $data['users_sex'],  $data['users_birth_date'],  $data['users_city']);
			header("Location: account.php?users_id=$users_idt");
		}
		else
		{
			echo '<div class="">'.array_shift($errors).'</div>';
		}
	}
?>

<form action = "accountupdate.php?users_id=<?php echo $_GET['users_id']; ?>" method = "POST">
Имя:
<input type = "text" name = "users_name" value = "<?php echo @$data['users_name']; ?>">
Фамилия:
<input type = "text" name = "users_surname" value = "<?php echo @$data['users_surname']; ?>">
Email:
<input type = "text" name = "users_email" value = "<?php echo @$data['users_email']; ?>">
Пол:
<!-- <input type="radio" name="users_sex" value="man" required>Мужчина
<input type="radio" name="users_sex" value="woman">Женщина -->
<input type = "text" name = "users_sex" value = "<?php echo @$data['users_sex']; ?>">
Дата рождения:
<input type = "text" name = "users_birth_date" value = "<?php echo @$data['users_birth_date']; ?>">
Город:
<input type = "text" name = "users_city" value = "<?php echo @$data['users_city']; ?>">

<button type = "submit" name="save">Сохранить</button>
