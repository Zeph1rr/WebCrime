<?php
$error = '';
if (isset($_POST['jsubmit'])){
  $login = trim(htmlspecialchars(stripslashes($_POST['log'])));
  $password = trim(htmlspecialchars(stripslashes($_POST['pass'])));
  $res1 = $pdo->query("Call Новый_судья('".$_POST['ln']."', '".$_POST['ln_sec']."', ".$_POST['sud'].", '".$login."', '".$password."');");
  $res2 = $pdo->query("create user ".$login." with password '".$password."' in role  judges");
  if ($res1 && $res2){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Судьи">';
}
else {
  $error = 'Ошибка! Проверьте введенные данные и попробуйте снова';
}
}
 ?>

 <form method='post'>
 <h1>Добавить судью</h1>
  <p>Фамилия<br /><input type='text' name='ln'></p>
  <p>Фамилия секретаря<br /><input type='text' name='ln_sec'></p>
  <p>Суд<br /><input type='text' name='sud'></p>
  <p>Логин<br /><input type='text' name='log'></p>
  <p>Пароль<br /><input type='password' name='pass'></p>
  <p><input type='submit' name='jsubmit' value='Добавить'> <br></p></form>

<h3><?=$error?></h3>
