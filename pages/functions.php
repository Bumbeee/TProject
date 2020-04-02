<?php
function do_register($arr, $link){
  if(isset($arr["do_submit"])){
  	if(empty($arr['name']) || empty($arr['surname'])  || empty($arr['gender'] || empty($arr['city']))
  		|| empty($arr['password']) || empty($arr['repassword'])){
  			$message = "Пожалуйста, заполните все поля!";
  		}
  	else{
  		$name = $arr['name'];
  		$surname = $arr['surname'];
      $gender = $arr['gender'];
      $email = $arr['email'];
      $city = $arr['city'];
      $date = $arr['date'];
  		$password = $arr['password'];
  		$password2 = $arr['repassword'];
  		$query = mysqli_query($link, "SELECT * FROM users WHERE users_email = '$email'");
  		$numrows = mysqli_num_rows($query);
  		if($numrows != 0) {
  			$message = "Пользователь с данной почтой уже существует!";
  		}
  		else{
  			if($password != $password2){
  				$message = "Введённые пароли должны совпадать!";
  			}
  			else{
  				$password = password_hash($password, PASSWORD_DEFAULT);
  				$result = mysqli_query($link,
  				"INSERT INTO users (users_name, users_surname, users_email, users_sex, users_city, users_password, users_birth_date) VALUES('$name', '$surname', '$email', '$gender', '$city', '$password', '$date')");
  				if($result == FALSE) {
  					$message = "Проблемы при создании аккаунта!";
  				}
  				else{
            $_SESSION['logged_user'] = $email;
  					header("Location: ../");
  					exit();
  				}
  			}
  		}
  	}
  }
  return [
    'message' => $message,
    'name' => $name,
    'surname' => $surname,
    'gender' => $gender,
    'email' => $email,
    'date' => $date,
    'city' => $city,
    ];
}
function user_data_output($connection, $users_id = null)
{
  $query = mysqli_query($connection, "SELECT * FROM users WHERE users_id = $users_id");
  $cat = mysqli_fetch_assoc($query);
  echo "<table>
  <tr><td>Имя</td><td>$cat[users_name]</td></tr>
  <tr><td>Фамилия</td><td>$cat[users_surname]</td></tr>
  <tr><td>Email</td><td>$cat[users_email]</td></tr>
  <tr><td>Пол</td><td>$cat[users_sex]</td></tr>
  <tr><td>Дата рождения</td><td>$cat[users_birth_date]</td></tr>
  <tr><td>Город</td><td>$cat[users_city]</td></tr>";
  echo"</table>";
}
function user_data_edit($connection, $users_id = null, $users_name = null, $users_surname = null,
 $users_email = null, $sex = null, $users_birth_date = null, $users_city = null)
{
  $query = mysqli_query($connection, "UPDATE users SET users_name = '$users_name',
    users_surname = '$users_surname', users_email = '$users_email', users_sex = '$users_sex',
    users_birth_date = '$users_birth_date', users_city = '$users_city'
     WHERE users_id = '$users_id'");
}
function user_request_output($connection, $users_id = null)
{
  $query = mysqli_query($connection, "SELECT * FROM musicians
  LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
  LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
  WHERE musicians_creator = $users_id");
  while ($cat = mysqli_fetch_assoc($query))
  {
    echo "<table>
    <tr><td>Имя</td><td>$cat[users_name]</td></tr>
    <tr><td>Опыт</td><td>$cat[musicians_experience]</td></tr>
    <tr><td>Инструмент</td><td>$cat[instruments_name]</td></tr>
    <tr><td>Жанр</td><td>$cat[genres_name]</td></tr>
    <tr><td>Описание</td><td>$cat[musicians_description]</td></tr>";
  }
  echo"</table>";

  $query = mysqli_query($connection, "SELECT * FROM groups
  LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
  LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
  WHERE groups_creator = $users_id");
  while ($cat = mysqli_fetch_assoc($query))
  {
    echo "<table>
    <tr><td>Имя</td><td>$cat[groups_name]</td></tr>
    <tr><td>Опыт</td><td>$cat[groups_experience]</td></tr>
    <tr><td>Инструмент</td><td>$cat[instruments_name]</td></tr>
    <tr><td>Жанр</td><td>$cat[genres_name]</td></tr>
    <tr><td>Пол</td><td>$cat[groups_sex]</td></tr>
    <tr><td>Возраст</td><td>$cat[groups_age]</td></tr>
    <tr><td>Город</td><td>$cat[groups_city]</td></tr>
    <tr><td>Описание</td><td>$cat[groups_description]</td></tr>";
  }
  echo"</table>";
}
function musicians_request($connection, $users_id = null, $musicians_creator = null,
$musicians_experience = null, $musicians_instrument = null, $musicians_genre = null,
$musicians_description = null, $musicians_isvip = null)
{
  //mysqli_query($connection, 'SET foreign_key_checks = 0');
  $query = mysqli_query($connection, "INSERT INTO musicians (musicians_creator,
  musicians_experience, musicians_instrument, musicians_genre, musicians_description,
  musicians_isvip) VALUES ('$musicians_creator'.'$musicians_experience', '$musicians_instrument',
  '$musicians_genre', '$musicians_description', '$musicians_isvip')");
}
function groups_request($connection, $users_id = null, $groups_name = null, $groups_instrument = null,
$groups_experience = null, $groups_genre = null, $groups_description = null, $groups_isvip = null,
$groups_creator = null, $groups_sex = null, $groups_city = null, $groups_age = null)
{
  //mysqli_query($connection, 'SET foreign_key_checks = 0');
  $query = mysqli_query($connection, "INSERT INTO groups (groups_name, groups_instrument,
  groups_experience, groups_genre, groups_description, groups_isvip, groups_creator, groups_sex,
  groups_city, groups_age) VALUES ('$groups_name'.'$groups_instrument', '$groups_experience',
  '$groups_genre', '$groups_description', '$groups_isvip', '$groups_creator', '$groups_sex',
  '$groups_city', '$groups_age')");
}
?>
