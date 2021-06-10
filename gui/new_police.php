<?php
$error = '';
if (isset($_POST['usubmit'])){
  $login = trim(htmlspecialchars(stripslashes($_POST['log'])));
  $password = trim(htmlspecialchars(stripslashes($_POST['pass'])));
  $res1 = $pdo->query("Call Новый_сотрудник('".$_POST['fn']."', '".$_POST['ln']."', '".$_POST['job']."', '".$_POST['otd']."', '".$_POST['log']."', '".$_POST['pass']."');");
  $res2 = $pdo->query("create user ".$login." with password '".$password."' in role police;");
  if ($res1 && $res2){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Сотрудники">';
}
else {
  $error = 'Ошибка! Проверьте введенные данные и попробуйте снова';
}
}
 ?>

 <form method='post'>
 <h1>Добавить сотрудника</h1>
  <p>Имя<br /><input type='text' name='fn'></p>
  <p>Фамилия<br /><input type='text' name='ln'></p>
  <p>Звание<br /><input type='text' name='job'></p>
  <p>Отдел<br /><input type='text' name='otd'></p>
  <p>Логин<br /><input type='text' name='log'></p>
  <p>Пароль<br /><input type='password' name='pass'></p>
  <p><input type='submit' name='usubmit' value='Добавить'> <br></p></form>

<h3><?=$error?></h3>
