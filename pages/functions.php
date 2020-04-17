<?php

function make_request($connection, $musicians_creator = null, $musicians_experience = null,
$musicians_instrument = null, $musicians_genre = null, $musicians_description = null)
{
  mysqli_query($connection, 'SET foreign_key_checks = 0');
  $query = mysqli_query($connection, "INSERT INTO musicians (musicians_creator, musicians_experience, musicians_instrument,
    musicians_genre, musicians_description) VALUES('$musicians_creator', '$musicians_experience',
      '$musicians_instrument', '$musicians_genre', '$musicians_description')");
  header("Location: ../");
}

function do_register($connection, $arr){
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
  		$query = mysqli_query($connection, "SELECT * FROM users WHERE users_email = '$email'");
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
  				$result = mysqli_query($connection,
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
function do_auth($connection, $arr){
  if(isset($arr["do_login"])){
  	if(empty($arr['email'])|| empty($arr['password'])){
  			$message = "Пожалуйста, заполните все поля!";
  		}
  	else{
  		$email = $arr['email'];
  		$password = $arr['password'];
  		$query = mysqli_query($connection, "SELECT * FROM users WHERE users_email = '$email'");
  		if(mysqli_num_rows($query) == 0){
  			$message = "Неверный логин или пароль!";
  		}
  		else {
  			$query = mysqli_query($connection, "SELECT users_password FROM users WHERE users_email = '$email' LIMIT 1");
  			$array = mysqli_fetch_array($query);
  			$hash = $array['users_password'];
  			if(password_verify($password, $hash)){
  				$_SESSION['logged_user'] = $email;
  				header("Location: ../");
  					exit();
  			}
  			else {
  				$message = "Неверный логин или пароль";
  			}
  		}
  	}
  }
  return [
    'message' => $message,
    'email' => $email,
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
  <tr><td>Город</td><td>$cat[users_city]</td></tr>
  <tr><td><a href = accountupdate.php?users_id=$cat[users_id]&update=1>Редактировать</a></td><td></td></tr>";
  echo"</table>";
}

function user_data_edit($connection, $users_id = null, $users_name = null, $users_surname = null,
 $users_email = null, $users_sex = null, $users_birth_date = null, $users_city = null)
{
  $query = mysqli_query($connection, "UPDATE users SET users_name = '$users_name',
    users_surname = '$users_surname', users_email = '$users_email', users_sex = '$users_sex',
    users_birth_date = '$users_birth_date', users_city = '$users_city'
     WHERE users_id = '$users_id'");
}

function post($connection, $users_id = null)
	{
		$query = mysqli_query($connection, "SELECT * from users WHERE users_id = $users_id");
		$cat = mysqli_fetch_array($query);
		return $cat;
	}

function musicians_request_output($connection)
  {
    $query = mysqli_query($connection, "SELECT * FROM groups
    LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
    LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id");
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

function groups_request_output($connection)
  {
    $query = mysqli_query($connection, "SELECT * FROM musicians
    LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
    LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id");
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
function musicians_request($connection, $musicians_creator = null,
$musicians_experience = null, $musicians_instrument = null, $musicians_genre = null,
$musicians_description = null, $musicians_isvip = null)
{
  mysqli_query($connection, 'SET foreign_key_checks = 0');
  $query = mysqli_query($connection, "INSERT INTO musicians (musicians_creator,
  musicians_experience, musicians_instrument, musicians_genre, musicians_description,
  musicians_isvip) VALUES ('$musicians_creator'.'$musicians_experience', '$musicians_instrument',
  '$musicians_genre', '$musicians_description', '$musicians_isvip')");
}
function groups_request($connection, $groups_name = null, $groups_instrument = null,
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
function generate_code($seed){
    $key = md5($seed);
    $new_key = '';
    for($i=1; $i <= 16; $i ++ ){
              $new_key .= $key[$i];
              if ( $i%4==0 && $i != 16) $new_key.='-';
    }
 return strtoupper($new_key);
 }
 function isInArr($arr, $item){
   foreach($arr as &$value){
     if($value == $item)
       return true;
   }
   return false;
 }
 function generate_codes($count){
   $array = [];
   for($i = 1; $i <= $count; $i++){
     $code = generate_code($i * time());
     if(!isInArr($array, $code))
     array_push($array, $code);
   }
   return $array;
 }
 function print_array($arr){
   foreach($arr as &$value){
   echo $value;
   echo '</br>';
   }
 }
 function get_vips($connection, $count){
 if($count >= 1){
   $fd = fopen("../vip_codes.txt", 'w') or die("Не удалось открыть файл");
   $arr = generate_codes($count);
   foreach($arr as &$value){
     $query = mysqli_query($connection, "SELECT * FROM vip WHERE vip_code = '$value'");
     if(mysqli_num_rows($query) == 0){
       $result = mysqli_query($connection,
       "INSERT INTO vip (vip_code) VALUES('$value')");
       if($result == TRUE) {
         $item = "$value" . "\n";
         fwrite($fd, $item);
       }
     }
   }
   fclose($fd);
 }
}
function remove_code($connection, $code){
  return $query = mysqli_query($connection, "DELETE from vip WHERE vip_code = '$code'");
}
function activate_code($connection, $code){
  $key = strtoupper($code);
  $query = mysqli_query($connection, "SELECT * from vip WHERE vip_code = '$key'");
  if(mysqli_num_rows($query) == 0){
    $message = "Недействительный код. Проверьте правильность введенных данных.";
    $status = FALSE;
  }
  else{
    if(remove_code($connection, $key) == FALSE){
      $message = "Проблемы при активации VIP-кода. Попробуйте позже.";
      $status = FALSE;
    }
    else{
      $status = TRUE;
    }
  }
  return [
    'status' => $status,
    'message' => $message,
  ];
}
?>
