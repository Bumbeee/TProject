<?php
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
      <tr><td>Имя</td><td>$cat[users_name]</td></tr>
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
 ?>
