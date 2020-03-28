<?php
  function user_data_output($connection, $id = null)
  {
    $query = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
    $cat = mysqli_fetch_assoc($query);
    echo "<table>
    <tr><td>Имя</td><td>$cat[name]</td></tr>
    <tr><td>Фамилия</td><td>$cat[surname]</td></tr>
    <tr><td>Email</td><td>$cat[email]</td></tr>
    <tr><td>Пол</td><td>$cat[sex]</td></tr>
    <tr><td>Дата рождения</td><td>$cat[birth_date]</td></tr>
    <tr><td>Город</td><td>$cat[city]</td></tr>";
		echo"</table>";
  }

  function user_data_edit($connection, $id = null)
  {
    $query = mysqli_query($connection, "UPDATE users SET name = '$name', surname = '$surname',
      email = '$email', sex = '$sex', birth_date = '$birth_date', city = '$city' WHERE id = '$id'");
  }
 ?>
