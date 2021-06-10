<?php
$error = '';
if (isset($_POST['jsubmit'])){
  $res1 = $pdo->query("insert into Потерпевшие values ('".$_POST['pass']."', '".$_POST['fn']."', '".$_POST['ln']."', '".$_POST['birthday']."', '".$_POST['city']."', '".$_POST['ph_n']."');");
  if ($res1){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Потерпевшие">';
}
else {
  $error = 'Ошибка! Проверьте введенные данные и попробуйте снова';
}
}
 ?>

 <form method='post'>
 <h1>Добавить потерпевшего</h1>
  <p>Номер паспорта<br /><input type='text' name='pass'></p>
  <p>Имя<br /><input type='text' name='fn'></p>
  <p>Фамилия<br /><input type='text' name='ln'></p>
  <p>Дата рождения<br /><input type='text' name='birthday'></p>
  <p>Место рождения<br /><input type='text' name='city'></p>
  <p>Номер телефона для связи<br /><input type='text' name='ph_n'></p>
  <p><input type='submit' name='jsubmit' value='Добавить'> <br></p></form>

<h3><?=$error?></h3>
