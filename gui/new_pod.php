<?php
$error = '';
if (isset($_POST['psubmit'])){
  $res1 = $pdo->query("insert into Подозреваемые values (".$_POST['pass'].", '".$_POST['fn']."', '".$_POST['ln']."', '".$_POST['birthday']."', '".$_POST['city']."', 'Ранее не судим');");
  if ($res1){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Подозреваемые">';
}
else {
  $error = 'Ошибка! Проверьте введенные данные и попробуйте снова';
}
}
 ?>

 <form method='post'>
 <h1>Добавить подозреваемого</h1>
  <p>Номер паспорта<br /><input type='text' name='pass'></p>
  <p>Имя<br /><input type='text' name='fn'></p>
  <p>Фамилия<br /><input type='text' name='ln'></p>
  <p>Дата рождения<br /><input type='text' name='birthday'></p>
  <p>Место рождения<br /><input type='text' name='city'></p>
  <p><input type='submit' name='psubmit' value='Добавить'> <br></p></form>

<h3><?=$error?></h3>
