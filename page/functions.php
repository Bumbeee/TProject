<?php
// Создание заявки на поиск музыканта
function make_request_musicians($connection, $arr)
{
  $musicians_creator = $_SESSION['id'];
  $musicians_experience = $arr['musicians_experience'];
  $musicians_instrument = $arr['musicians_instrument'];
  $musicians_genre = $_arr['musicians_genre'];
  $musicians_description = $arr['musicians_description'];
  $musicians_name = $arr['musicians_name'];
  $musicians_city = $arr['musicians_city'];
  $musicians_age = $arr['musicians_age'];
  $musicians_sex = $arr['musicians_sex'];
  if(!isset($arr['musicians_experience']) || !isset($arr['musicians_instrument']) || !isset($arr['musicians_genre'])
    || !isset($arr['musicians_name']) || !isset($arr['musicians_city']) || !isset($arr['musicians_age'])){
    $message = "Пожалуйста, заполните все обязательные поля.";
  }
  else{
    if($musicians_sex == "Мужской"){
      $sex = "man";
    }
    else if($musicians_sex == "Женский"){
      $sex = "woman";
    }
    else $sex = "Любой";

    $isvip = 0;
    if(!empty($arr['vipcode'])){
      $temp = activate_code($connection, $arr['vipcode']);
      if ($temp['status'] == TRUE )
        {
          $isvip = 1;
          mysqli_query($connection, 'SET foreign_key_checks = 0');
          $query = mysqli_query($connection, "INSERT INTO groups (groups_creator, groups_experience, groups_name,
            groups_instrument, groups_genre, groups_description, groups_city, groups_age, groups_sex, groups_isvip) VALUES
            ('$musicians_creator', '$musicians_experience', '$musicians_name', '$musicians_instrument', '$musicians_genre',
            '$musicians_description', '$musicians_city', '$musicians_age', '$sex', '$isvip')");
         header("Location: musician.php");
         exit();
        }
        else{
          $message = $temp['message'];
        }
      }
      else{
        mysqli_query($connection, 'SET foreign_key_checks = 0');
        $query = mysqli_query($connection, "INSERT INTO groups (groups_creator, groups_experience, groups_name,
          groups_instrument, groups_genre, groups_description, groups_city, groups_age, groups_sex, groups_isvip) VALUES
          ('$musicians_creator', '$musicians_experience', '$musicians_name', '$musicians_instrument', '$musicians_genre',
            '$musicians_description', '$musicians_city', '$musicians_age', '$sex', '$isvip')");
        header("Location: musician.php");
        exit();
      }
    }
  return [
    'message' => $message,
    'name' => $musicians_name,
    'city' => $musicians_city,
    'description' => $musicians_description,
    'code' => $arr['vipcode'],
  ];return [
    'message' => $message,
    'name' => $musicians_name,
    'city' => $musicians_city,
    'description' => $musicians_description,
    'code' => $arr['vipcode'],
  ];
}
// Создание заявки на поиск группы
function make_request_groups($connection, $arr)
{
  $groups_creator = $_SESSION['id'];
  $groups_experience = $arr['groups_experience'];
  $groups_instrument = $arr['groups_instrument'];
  $groups_genre = $arr['groups_genre'];
  $groups_description = $arr['groups_description'];
  if(!isset($arr['groups_experience']) || !isset($arr['groups_instrument']) || !isset($arr['groups_genre'])){
    $message = "Пожалуйста, заполните все обязательные поля.";
  }
  else{
    $isvip = 0;
    if(!empty($arr['vipcode'])){
      $temp = activate_code($connection, $_POST['vipcode']);
      if ($temp['status'] == TRUE )
        {
          $isvip = 1;
          mysqli_query($connection, 'SET foreign_key_checks = 0');
          $query = mysqli_query($connection, "INSERT INTO musicians (musicians_creator, musicians_experience,
            musicians_instrument, musicians_genre, musicians_description, musicians_isvip) VALUES('$groups_creator',
            '$groups_experience', '$groups_instrument', '$groups_genre', '$groups_description', '$isvip')");
          header("Location: group.php");
          exit();
        }
      else{
          $message = $temp['message'];
        }
      }
    else{
      mysqli_query($connection, 'SET foreign_key_checks = 0');
      $query = mysqli_query($connection, "INSERT INTO musicians (musicians_creator, musicians_experience,
        musicians_instrument, musicians_genre, musicians_description, musicians_isvip) VALUES('$groups_creator',
        '$groups_experience', '$groups_instrument', '$groups_genre', '$groups_description', '$isvip')");
      header("Location: group.php");
      exit();
    }
  }
  return [
    'message' => $message,
    'description' => $groups_description,
    'code' => $arr['vipcode'],
  ];
}

// Регистрация.
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
            $query = mysqli_query($connection, "SELECT users_id FROM users WHERE users_email = '$email' LIMIT 1");
      			$array = mysqli_fetch_array($query);
      			$id = $array['users_id'];
            $_SESSION['logged_user'] = $email;
            $_SESSION['id'] = $id;
  					header("Location: account.php");
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
// Авторизация.
function do_auth($connection, $arr){
  if(isset($arr["do_login"])){
  	if(empty($arr['email'])|| empty($arr['password'])){
  			$message = "Пожалуйста, заполните все поля!";
  		}
  	else{
  		$email = $arr['email'];
  		$password = $arr['password'];
  		$query = mysqli_query($connection, "SELECT * FROM users WHERE users_email = '$email'");
  		if(mysqli_num_rows($query) == 1){
  			$query = mysqli_query($connection, "SELECT users_password FROM users WHERE users_email = '$email' LIMIT 1");
  			$array = mysqli_fetch_array($query);
  			$hash = $array['users_password'];
  			if(password_verify($password, $hash)){
          $query = mysqli_query($connection, "SELECT users_id FROM users WHERE users_email = '$email' LIMIT 1");
          $array = mysqli_fetch_array($query);
          $id = $array['users_id'];
  				$_SESSION['logged_user'] = $email;
          $_SESSION['id'] = $id;
  				header("Location: account.php");
  					exit();
  			}
      }
      $query = mysqli_query($connection, "SELECT * FROM admins WHERE admins_email = '$email'");
      if(mysqli_num_rows($query) == 1){
  			$query = mysqli_query($connection, "SELECT admins_password FROM admins WHERE admins_email = '$email' LIMIT 1");
  			$array = mysqli_fetch_array($query);
  			$hash = $array['admins_password'];
  			if(password_verify($password, $hash)){
          $query = mysqli_query($connection, "SELECT admins_id FROM admins WHERE admins_email = '$email' LIMIT 1");
          $array = mysqli_fetch_array($query);
          $id = $array['admins_id'];
  				$_SESSION['logged_user'] = $email;
          $_SESSION['id'] = $id;
  				header("Location: ../admin");
  					exit();
  			}
      }
  			else {
  				$message = "Неверный логин или пароль";
  			}
  		}
  	}
    return [
      'message' => $message,
      'email' => $email,
  ];
}
// Фильтрация по категории.
function filter_by($arr, $cat, $value, $zero_key){
  if($value != "" && $value != $zero_key){
    $res = [];
    foreach($arr as &$item){
      if(mb_strtoupper($item["$cat"]) == mb_strtoupper($value)){
        array_push($res, $item);
      }
    }
    return $res;
  }
  return $arr;
}
// Возраст по дате рождения формата yyyy-mm-dd.
function get_age($birth_date){
  $age = 0;
  $tmp = explode('-',$birth_date);
  $age = date("Y") - $tmp[0];
  if($tmp[1] > date("m"))
    $age = $age -1;
  return $age;
}
// Выовод массива заявок музыкантов.
function print_musicians_requests($requests){
  if(!empty($requests)){
  $i = 1;
  foreach($requests as $cat)
  {
    if ($cat['musicians_ismodered'] == 1)
    {
    $age = get_age($cat["users_birth_date"]);
    if($cat["users_sex"] == "man"){
      $sex = "Мужской";
    }
    else if($cat["users_sex"] == "woman"){
      $sex = "Женский";
    }
    else $sex = "Любой";
    echo "<div class=\"box\">";
    echo "<h2>$cat[users_surname] $cat[users_name]</h2>";
    echo "<img src='../img/".$cat['instruments_picture']."' />";
    echo "<div class=\"info\">";
    echo "<ul>
      <li>Пол: $sex</li>
      <li>Возраст: $age</li>
      <li>Инструмент: $cat[instruments_name]</li>
      <li>Опыт: $cat[musicians_experience]</li>
      <li>Жанр: $cat[genres_name]</li>
      <li>Город: $cat[users_city]</li>
    </ul>";
    echo "</div>";
    echo "<div class=\"about\">";
    echo "<h4>О себе</h4><p>$cat[musicians_description]</p>";
    echo "</div>";
    if(isset($_SESSION["id"])){
    echo "<nav><a href=\"#id-$i\">Откликнуться!</a></nav>";
    echo "  <div class=\"remodal\" data-remodal-id=\"id-$i\">
        <button data-remodal-action=\"close\" class=\"remodal-close\"></button>
        <h4>Понравился музыкант? Напишите ему на почту!</h4>
        <a href=\"mailto:$cat[users_email]\">$cat[users_email]</a>
          </div>";
        }
      else{
        echo "<nav><a href=\"auth.php\">Авторизуйтесь, чтобы ответить на заявку</a></nav>";
      }
    echo "</div>";
    $i++;
  }
}
}
else{
  echo "По вашему запросу ничего не найдено";
}
}
// Массив всех заявок музыкантов.
function all_musicians($connection){
  $requests = [];
  $query = mysqli_query($connection, "SELECT * FROM musicians
  LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
  LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
  WHERE musicians.musicians_isvip = 1");
  if(mysqli_num_rows($query) != 0){
    while($request = mysqli_fetch_assoc($query)){
      array_push($requests, $request);
    }
 }
  $query = mysqli_query($connection, "SELECT * FROM musicians
  LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
  LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
  WHERE musicians.musicians_isvip = 0");
  if(mysqli_num_rows($query) != 0){
    while($request = mysqli_fetch_assoc($query)){
      array_push($requests, $request);
    }
 }
  return $requests;
}
// Массив заявок музыкантов по фильтру.
function musicians_by_filter($connection, $arr){
  if(isset($arr["do_filter"])){
    if(empty($arr['instrument']) && empty($arr['genre'])  && empty($arr['sex']) && empty($arr['city'])
  		&& empty($arr['experience']) && empty($arr['age'])){
        return all_musicians($connection);
  		}
    else{
      if($arr["sex"] == "Мужской"){
        $sex = "man";
      }
      else if($arr["sex"] == "Женский"){
        $sex = "woman";
      }
      //else $sex = "Любой";
      $requests = all_musicians($connection);
      $temp = [];


      $temp = filter_by($requests, "users_city", $arr["city"], "Любой");
      $temp = filter_by($temp, "users_sex", $sex, "Пол");
      $temp = filter_by($temp, "instruments_id", $arr["instrument"], "0");
      $temp = filter_by($temp, "genres_id", $arr["genre"], "0");
      $temp = filter_by($temp, "musicians_experience", $arr["experience"], "Опыт");
      $res = $temp;
      $temp = [];
      if(!empty($arr["age"]) && $arr["age"] != "Возраст"){
         foreach($res as &$item){
            if(($arr["age"] == "< 20 лет" && get_age($item["users_birth_date"]) < 20)
            || ($arr["age"] == "20 - 30 лет" && get_age($item["users_birth_date"]) >= 20 && get_age($item["users_birth_date"]) < 30)
            || ($arr["age"] == "30 - 40 лет" && get_age($item["users_birth_date"]) >= 30 && get_age($item["users_birth_date"]) < 40)
            || ($arr["age"] == "40 - 50 лет" && get_age($item["users_birth_date"]) >= 40 && get_age($item["users_birth_date"]) < 50)
            || ($arr["age"] == "> 50 лет" && get_age($item["users_birth_date"]) >= 50)
          ){
            array_push($temp, $item);
          }
        }
        $res = $temp;
      }
     }
   }
   return $res;
}

// Выовод массива заявок групп.
function print_groups_requests($requests){
  if(!empty($requests)){
  $i = 1;
  foreach($requests as $cat)
  {
    if ($cat['groups_ismodered'] == true)
    {
    if($cat["groups_sex"] == "man"){
      $sex = "Мужской";
    }
    else if($cat["groups_sex"] == "woman"){
      $sex = "Женский";
    }
    else $sex = "Любой";
    echo "<div class=\"box\">";
    echo "<h2>$cat[groups_name]</h2>";
    echo "<img src='../img/".$cat['instruments_picture']."' />";
    echo "<div class=\"info\">";
    echo "<ul>
      <li>Пол: $sex</li>
      <li>Возраст: $cat[groups_age]</li>
      <li>Инструмент: $cat[instruments_name]</li>
      <li>Опыт: $cat[groups_experience]</li>
      <li>Жанр: $cat[genres_name]</li>
      <li>Город: $cat[groups_city]</li>
    </ul>";
    echo "</div>";
    echo "<div class=\"about\">";
    echo "<h4>О группе</h4><p>$cat[groups_description]</p>";
    echo "</div>";
    if(isset($_SESSION["id"])){
    echo "<nav><a href=\"#id-$i\">Откликнуться!</a></nav>";
    echo "  <div class=\"remodal\" data-remodal-id=\"id-$i\">
        <button data-remodal-action=\"close\" class=\"remodal-close\"></button>
        <h4>Понравилась группа? Напишите представителю группы на почту!</h4>
        <a href=\"mailto:$cat[users_email]\">$cat[users_email]</a>
          </div>";
        }
          else{
            echo "<nav><a href=\"auth.php\">Авторизуйтесь, чтобы ответить на заявку</a></nav>";
          }
    echo "</div>";
    $i++;
  }
}
}
  else{
    echo "По вашему запросу ничего не найдено";
  }
}




// Массив всех заявок групп.
function all_groups($connection){
  $requests = [];
  $query = mysqli_query($connection, "SELECT * FROM groups
  LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
  LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
  WHERE groups.groups_isvip = 1");
  if(mysqli_num_rows($query) != 0){
    while($request = mysqli_fetch_assoc($query)){
      array_push($requests, $request);
    }
 }
 $query = mysqli_query($connection, "SELECT * FROM groups
 LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
 LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
 LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
 WHERE groups.groups_isvip = 0");
  if(mysqli_num_rows($query) != 0){
    while($request = mysqli_fetch_assoc($query)){
      array_push($requests, $request);
    }
 }
  return $requests;
}
// Массив заявок групп по фильтру.
function groups_by_filter($connection, $arr){
  if(isset($arr["do_filter"])){
    if(empty($arr['instrument']) && empty($arr['genre'])  && empty($arr['sex']) && empty($arr['city'])
  		&& empty($arr['experience']) && empty($arr['age'])){
        return all_groups($connection);
  		}
    else{
      if($arr["sex"] == "Мужской"){
        $sex = "man";
      }
      else if($arr["sex"] == "Женский"){
        $sex = "woman";
      }
      //else $sex = "Любой";
      $temp = all_groups($connection);

      $temp = filter_by($temp, "groups_city", $arr["city"], "Любой");
      $temp = filter_by($temp, "groups_sex", $sex, "Пол");
      $temp = filter_by($temp, "instruments_id", $arr["instrument"], "0");
      $temp = filter_by($temp, "genres_id", $arr["genre"], "0");
      $temp = filter_by($temp, "groups_experience", $arr["experience"], "Опыт");
      $temp = filter_by($temp, "groups_age", $arr["age"], "Возраст");
      $res = $temp;
     }
   }
   return $res;
}


function user_data_output($connection, $users_id = null)
{
  $query = mysqli_query($connection, "SELECT * FROM users WHERE users_id = $users_id");
  $cat = mysqli_fetch_assoc($query);

  if($cat["users_sex"] == "man"){
    $sex = "Мужской";
  }
  else if($cat["users_sex"] == "woman"){
    $sex = "Женский";
  }
  else $sex = "Любой";
  $tmp = explode('-',$cat['users_birth_date']);
  $date = $tmp[2] . '.' . $tmp[1] . '.' . $tmp[0];

  echo "<table>
  <tr><td>Имя</td><td>$cat[users_name]</td></tr>
  <tr><td>Фамилия</td><td>$cat[users_surname]</td></tr>
  <tr><td>Email</td><td>$cat[users_email]</td></tr>
  <tr><td>Пол</td><td>$sex</td></tr>
  <tr><td>Дата рождения</td><td>$date</td></tr>
  <tr><td>Город</td><td>$cat[users_city]</td></tr>
  <tr><td><a href = account_update.php?users_id=$cat[users_id]&update=1>Редактировать</a></td><td></td></tr>";
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



function groups_request_output($connection)
  {
    $query = mysqli_query($connection, "SELECT * FROM groups
    LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
    LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
    WHERE groups.groups_isvip = 1");
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
      echo "</table>";
    }
    $query = mysqli_query($connection, "SELECT * FROM groups
    LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
    LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
    WHERE groups.groups_isvip = 0");
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
      echo "</table>";
    }
}

function musicians_request_output($connection)
  {
    $query = mysqli_query($connection, "SELECT * FROM musicians
    LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
    LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
    WHERE musicians.musicians_isvip = 1");
    $i = 1;
    while ($cat = mysqli_fetch_assoc($query))
    {
      echo "<div class=\"box\">";
      echo "<h2>$cat[users_surname] $cat[users_name]</h2>";
      echo "<img src='../img/".$cat['instruments_picture']."' />";
      echo "<div class=\"info\">";
      echo "<ul>
        <li>Пол: $cat[users_sex]</li>
        <li>Возраст: $cat[users_birth_date]</li>
        <li>Инструмент: $cat[instruments_name]</li>
        <li>Опыт: $cat[musicians_experience]</li>
        <li>Жанр: $cat[genres_name]</li>
        <li>Город: $cat[users_city]</li>
      </ul>";
      echo "</div>";
      echo "<div class=\"about\">";
      echo "<h4>О себе</h4><p>$cat[musicians_description]</p>";
      echo "</div>";
      echo "<nav><a href=\"#id-$i\">Откликнуться!</a></nav>";
      echo "  <div class=\"remodal\" data-remodal-id=\"id-$i\">
          <button data-remodal-action=\"close\" class=\"remodal-close\"></button>
          <h4>Понравился музыкант? Напишите ему на почту!</h4>
          <a href=\"mailto:$cat[users_email]\">$cat[users_email]</a>
            </div>";
      echo "</div>";
    }
    $query = mysqli_query($connection, "SELECT * FROM musicians
    LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
    LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
    WHERE musicians.musicians_isvip = 0");
    //$i = 1;
    while ($cat = mysqli_fetch_assoc($query))
    {
      echo "<div class=\"box\">";
      echo "<h2>$cat[users_surname] $cat[users_name]</h2>";
      echo "<img src='../img/".$cat['instruments_picture']."' />";
      echo "<div class=\"info\">";
      echo "<ul>
        <li>Пол: $cat[users_sex]</li>
        <li>Возраст: $cat[users_birth_date]</li>
        <li>Инструмент: $cat[instruments_name]</li>
        <li>Опыт: $cat[musicians_experience]</li>
        <li>Жанр: $cat[genres_name]</li>
        <li>Город: $cat[users_city]</li>
      </ul>";
      echo "</div>";
      echo "<div class=\"about\">";
      echo "<h4>О себе</h4><p>$cat[musicians_description]</p>";
      echo "</div>";
      echo "<nav><a href=\"#id-$i\">Откликнуться!</a></nav>";
      echo "  <div class=\"remodal\" data-remodal-id=\"id-$i\">
          <button data-remodal-action=\"close\" class=\"remodal-close\"></button>
          <h4>Понравился музыкант? Напишите ему на почту!</h4>
          <a href=\"mailto:$cat[users_email]\">$cat[users_email]</a>
            </div>";
      echo "</div>";
    }
}

function user_request_output($connection, $users_id = null)
{
  $query = mysqli_query($connection, "SELECT * FROM musicians
  LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
  LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
  WHERE musicians_creator = $users_id");
  $i = 1;
  while ($cat = mysqli_fetch_assoc($query))
  {
    echo "<div class=\"box\">";
    echo "<div class=\"text_block\">";
    echo "<h3>Заявка №$i</h3>";
    echo "<h4>Поиск музыканта</h4>";
    echo "<input type=\"checkbox\" id=\"hd-$i\" class=\"hide\"/>";
    echo "<label for=\"hd-$i\" >Подробнее</label>
      <div>
        <ul>
          <li><b>Имя:</b> $cat[users_name]</li>
          <li><b>Опыт:</b> $cat[musicians_experience]</li>
          <li><b>Инструмент:</b> $cat[instruments_name]</li>
          <li><b>Жанр:</b> $cat[genres_name]</li>
        </ul>
        <p><h4>О себе</h4>
          $cat[musicians_description]
        </p>
      </div>";
      echo "<form method='post'>
            <input type = 'submit' name = 'rejectm-$cat[musicians_id]' value = 'Удалить'>
            </form>";
    echo "</div>";
    echo "</div>";
          if(isset($_POST['rejectm-'.$cat['musicians_id']]))
          {
          rejectm($connection, $cat[musicians_id]);
          echo "<meta http-equiv='refresh' content='0'>";
          }
    $i++;
  }

  $query = mysqli_query($connection, "SELECT * FROM groups
  LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
  LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
  LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
  WHERE groups_creator = $users_id");
  while ($cat = mysqli_fetch_assoc($query))
  {
    if($cat["groups_sex"] == "man")
      $sex = "Мужской";
    else if($cat["groups_sex"] == "woman")
      $sex = "Женский";
      else $sex = "Любой";
    echo "<div class=\"box\">";
    echo "<div class=\"text_block\">";
    echo "<h3>Заявка №$i</h3>";
    echo "<h4>Поиск группы</h4>";
    echo "<input type=\"checkbox\" id=\"hd-$i\" class=\"hide\"/>";
    echo "<label for=\"hd-$i\" >Подробнее</label>
      <div>
        <ul>
          <li><b>Название группы:</b> $cat[groups_name]</li>
          <li><b>Желаемый опыт:</b> $cat[groups_experience]</li>
          <li><b>Пол:</b> $sex</li>
          <li><b>Возраст:</b> $cat[groups_age]</li>
          <li><b>Город:</b> $cat[groups_city]</li>
          <li><b>Инструмент:</b> $cat[instruments_name]</li>
          <li><b>Жанр:</b> $cat[genres_name]</li>
        </ul>
        <p><h4>Описание группы</h4>
          $cat[groups_description]
        </p>
      </div>";
      echo "<form method='post'>
            <input type = 'submit' name = 'rejectg-$cat[groups_id]' value = 'Удалить'>
            </form>";
    echo "</div>";
    echo "</div>";

          if(isset($_POST['rejectg-'.$cat['groups_id']]))
          {
          rejectg($connection, $cat['groups_id']);
          echo "<meta http-equiv='refresh' content='0'>";
          }
    $i++;
  }
}

/*function setinstruments($connection, $instruments_id = null, $instruments_name = null)
  {
    $query = mysqli_query($connection, "SELECT * FROM instruments");
    while ($cat = mysqli_fetch_assoc($query))
    {
    echo "<option value='".$cat['instruments_id']."'>".$cat['instruments_name']."</option>";
  }
}

function setgenres($connection, $genres_id = null, $genres_name = null)
  {
    $query = mysqli_query($connection, "SELECT * FROM genres");
    while ($cat = mysqli_fetch_assoc($query))
    {
    echo "<option value='".$cat['genres_id']."'>".$cat['genres_name']."</option>";
  }
}*/
function getinstruments($connection, $instrument, $clear){
  $query = mysqli_query($connection, "SELECT * FROM instruments");
  if(isset($clear)){
    $instrument = null;
  }
  echo '<option selected = "selected" value = "0">';
  echo "Инструмент";
  echo '</option>';
  while($row = mysqli_fetch_assoc($query)){
    if($row["instruments_id"] == $instrument){
      echo "<option selected =\"selected\" value='".$row['instruments_id']."'>".$row['instruments_name']."</option>";
    }
    else{
      echo "<option value='".$row['instruments_id']."'>".$row['instruments_name']."</option>";
    }
  }
}
function getsexes($coonection, $sex, $clear){
  if(isset($clear)){
    $sex = null;
  }
  $sexes = array(
     1 => "Пол",
     2 => "Мужской",
     3 => "Женский"
   );
   foreach($sexes as &$item){
     if($sex == $item){
       echo "<option selected = \"selected\">".$item."</option>";
     }
     else {
       echo "<option>".$item."</option>";
   }
  }
}
function getgenres($connection, $genre, $clear){
  $query = mysqli_query($connection, "SELECT * FROM genres");
  if(isset($clear)){
    $genre = null;
  }
  echo '<option selected = "selected" value = "0">';
  echo "Жанр";
  echo '</option>';
  while($row = mysqli_fetch_assoc($query)){
    if($row["genres_id"] == $genre){
      echo "<option selected =\"selected\" value='".$row['genres_id']."'>".$row['genres_name']."</option>";
    }
    else{
      echo "<option value='".$row['genres_id']."'>".$row['genres_name']."</option>";
    }
  }
}
function getexps($connection, $exp, $clear){
  if(isset($clear)){
    $exp = null;
  }
  $exps = array(
    1 => "Опыт",
    2 => "< 1 года",
    3 => "1 - 3 года",
    4 => "3 - 5 лет",
    5 => "> 5 лет"
  );
  foreach($exps as &$item){
    if($exp == $item){
      echo "<option selected = \"selected\">".$item."</option>";
    }
    else {
      echo "<option>".$item."</option>";
    }
  }
}
function getages($connection, $age, $clear){
  if(isset($clear)){
    $age = null;
  }
 $ages = array(
    1 => "Возраст",
    2 => "< 20 лет",
    3 => "20 - 30 лет",
    4 => "30 - 40 лет",
    5 => "40 - 50 лет",
    6 => "> 50 лет"
  );
  foreach($ages as &$item){
    if($age == $item){
      echo "<option selected = \"selected\">".$item."</option>";
    }
    else {
      echo "<option>".$item."</option>";
    }
  }
}

// Генерация кода вида AAAA-AAAA-AAAA-AAAA.
function generate_code($seed){
    $key = md5($seed);
    $new_key = '';
    for($i=1; $i <= 16; $i ++ ){
              $new_key .= $key[$i];
              if ( $i%4==0 && $i != 16) $new_key.='-';
    }
 return strtoupper($new_key);
 }
 // Проверка наличия значения в массиве.
 function isInArr($arr, $item){
   foreach($arr as &$value){
     if($value == $item)
       return true;
   }
   return false;
 }
 // Генерация заданного колличества кодов.
 function generate_codes($count){
   $array = [];
   for($i = 1; $i <= $count; $i++){
     $code = generate_code($i * time());
     if(!isInArr($array, $code))
     array_push($array, $code);
   }
   return $array;
 }
 // Печать массива.
 function print_array($arr){
   foreach($arr as &$value){
   echo $value;
   echo '</br>';
   }
 }
 // Генерация VIP-кодов и скачивание файла с ними.
 function get_vips($connection, $arr){
   if(isset($_POST['get_vips'])){
      $count = $_POST['code_count'];
      if($count >= 1){
      $fd = fopen("../admin/codes.txt", 'w') or die("Не удалось открыть файл");
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
      if (file_exists("../admin/codes.txt")) {
      if (ob_get_level()) {
        ob_end_clean();
      }
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . basename("../admin/codes.txt"));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize("../admin/codes.txt"));
      readfile("../admin/codes.txt");
      exit;
    }
   }
 }
}
function remove_code($connection, $code){
  return $query = mysqli_query($connection, "DELETE from vip WHERE vip_code = '$code'");
}
// Активация кода.
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

function checkisadmin($connection)
{
  $query = mysqli_query($connection, "SELECT * FROM admins");
  while($cat = mysqli_fetch_assoc($query))
  {
    if ($cat['admins_email'] == $_SESSION['logged_user'])
    {
      return true;
    }
  }
  return false;
}

function acceptm($connection, $musicians_id = null)
{
  $query = mysqli_query($connection, "UPDATE musicians SET musicians_ismodered = 1
  WHERE musicians_id = '$musicians_id'");
}

function rejectm($connection, $musicians_id = null)
{
  $query = mysqli_query($connection, "DELETE FROM musicians WHERE musicians_id = '$musicians_id'");
}

function acceptg($connection, $groups_id = null)
{
  $query = mysqli_query($connection, "UPDATE groups SET groups_ismodered = 1
  WHERE groups_id = '$groups_id'");
}

function rejectg($connection, $groups_id = null)
{
  $query = mysqli_query($connection, "DELETE FROM groups WHERE groups_id = '$groups_id'");
}

function admins_requsts_output_mus($connection)
  {
    $query = mysqli_query($connection, "SELECT * FROM musicians
    LEFT OUTER JOIN instruments ON musicians.musicians_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON musicians.musicians_creator = users.users_id
    LEFT OUTER JOIN genres ON musicians.musicians_genre = genres.genres_id
    WHERE musicians_ismodered = 0");
    while ($cat = mysqli_fetch_assoc($query))
    {
      $mail = $cat["users_email"];
      if($cat["users_sex"] == "man"){
        $sex = "Мужской";
      }
      else if($cat["users_sex"] == "woman"){
        $sex = "Женский";
      }
      else $sex = "Любой";
      $age = get_age($cat["users_birth_date"]);
      echo "<div class=\"box\">";
      echo "<h2>$cat[users_surname] $cat[users_name]</h2>";
      echo "<div class=\"info\">";
      echo "<ul>
        <li>Пол: $sex</li>
        <li>Возраст: $age</li>
        <li>Инструмент: $cat[instruments_name]</li>
        <li>Опыт: $cat[musicians_experience]</li>
        <li>Жанр: $cat[genres_name]</li>
        <li>Город: $cat[users_city]</li>
      </ul>";
      echo "</div>";
      echo "<div class=\"about\">";
      echo "<h4>О себе</h4><p>$cat[musicians_description]</p>";
      echo "</div>";
      echo "<form class = \"\" method='post'>
            <input type = 'submit' name = 'acceptm-$cat[musicians_id]' value = 'Одобрить'>
            <input type = 'submit' name = 'rejectm-$cat[musicians_id]' value = 'Отклонить'>
            <select  name=\"reason\">
              <option>Некорректные данные</option>
              <option>Нецензурные выражения</option>
              <option>Оскорбления</option>
              <option>Спам</option>
            </select>
            </form>";
            if(isset($_POST['acceptm-'.$cat['musicians_id']]))
            {
              $recepient = $mail;
              $text = "Ваша заявка на поиск группы с сайта Believe была одобрена! Спасибо, что вы с нами!";
              $pagetitle = "Ответ на заявку на сайте Believe";
              mail($recepient, $pagetitle, $text, "From: believe@gmail.com");
              acceptm($connection, $cat['musicians_id']);
              echo "<meta http-equiv='refresh' content='0'>";
            }
            if(isset($_POST['rejectg-'.$cat['musicians_id']]))
            {
              $recepient = $mail;
              $text = "Ваша заявка на поиск группы с сайта Believe была отклонена! Причина: ".$_POST["reason"]."." ;
              $pagetitle = "Ответ на заявку на сайте Believe";
              mail($recepient, $pagetitle, $text, "From: believe@gmail.com");
              rejectm($connection, $cat['musicians_id']);
              echo "<meta http-equiv='refresh' content='0'>";
            }echo "</div>";
    }
  }

  function admins_requsts_output_gr($connection)
  {
    $query = mysqli_query($connection, "SELECT * FROM groups
    LEFT OUTER JOIN instruments ON groups.groups_instrument = instruments.instruments_id
    LEFT OUTER JOIN users ON groups.groups_creator = users.users_id
    LEFT OUTER JOIN genres ON groups.groups_genre = genres.genres_id
    WHERE groups_ismodered = 0");
    while ($cat = mysqli_fetch_assoc($query))
    {
      $mail = $cat["users_email"];
      if($cat["groups_sex"] == "man"){
        $sex = "Мужской";
      }
      else if($cat["groups_sex"] == "woman"){
        $sex = "Женский";
      }
      else $sex = "Любой";
      echo "<div class=\"box\" value=\"$mail\">";
      echo "<h2>$cat[groups_name]</h2>";
      echo "<div class=\"info\">";
      echo "<ul>
        <li>Пол: $sex</li>
        <li>Возраст: $cat[groups_age]</li>
        <li>Инструмент: $cat[instruments_name]</li>
        <li>Опыт: $cat[groups_experience]</li>
        <li>Жанр: $cat[genres_name]</li>
        <li>Город: $cat[groups_city]</li>
        <li>Почта: $cat[users_email];
      </ul>";
      echo "</div>";
      echo "<div class=\"about\">";
      echo "<h4>О группе</h4><p>$cat[groups_description]</p>";
      echo "</div>";
      echo "<form class = \"\" method='post'>
            <input type = 'submit' name = 'acceptg-$cat[groups_id]' value = 'Одобрить'>
            <input type = 'submit' name = 'rejectg-$cat[groups_id]' value = 'Отклонить'>
            <select  name=\"reason\">
              <option>Некорректные данные</option>
              <option>Нецензурные выражения</option>
              <option>Оскорбления</option>
              <option>Спам</option>
            </select>
            </form>";
            if(isset($_POST['acceptg-'.$cat['groups_id']]))
            {
              $recepient = $mail;
              $text = "Ваша заявка на поиск музыканта с сайта Believe была одобрена! Спасибо, что вы с нами!";
              $pagetitle = "Ответ на заявку на сайте Believe";
              mail($recepient, $pagetitle, $text, "From: believe@gmail.com");
              acceptg($connection, $cat['groups_id']);
              echo "<meta http-equiv='refresh' content='0'>";
            }
            if(isset($_POST['rejectg-'.$cat['groups_id']]))
            {
              $recepient = $mail;
              $text = "Ваша заявка на поиск музыканта с сайта Believe была отклонена! Причина: ".$_POST["reason"]."." ;
              $pagetitle = "Ответ на заявку на сайте Believe";
              mail($recepient, $pagetitle, $text, "From: believe@gmail.com");
              rejectg($connection, $cat['groups_id']);
              echo "<meta http-equiv='refresh' content='0'>";
            }echo "</div>";
    }
  }
?>
