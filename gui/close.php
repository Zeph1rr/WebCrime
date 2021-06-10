<?php
$error = '';
$datajail = $pdo->getData("Select Номер_тюрьмы || '. ' || Название || ' ' || Адрес as j from Тюрьмы");
if (isset($_POST['jsubmit'])){
  $res1 = $pdo->query("call Закрыть_дело(".$_POST['num'].", ".$_POST['tur'].", '".$_POST['sr']."');");
  if ($res1){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Дела&order=Номер_дела">';
}
else {
  $error = 'Ошибка! Проверьте введенные данные и попробуйте снова';
}
}
if (isset($_POST['nsubmit'])){
  $res1 = $pdo->query("delete from Активные_дела where Номер_дела = ".$_POST['num'].";");
  if ($res1){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Дела&order=Номер_дела">';
}
}
 ?>

 <form method='post'>
 <h1>Вынести решение</h1>
  <p>Номер дела<br /><input type='text' name='num'></p>
  <p>Номер тюрьмы<br /><details>
  <?php
  foreach ($datajail as $rowss) {
    echo '<p>'.$rowss['j'].'</p>';
  }
  ?>
  </details><input type='text' name='tur'></p>
  <p>На срок<br /><input type='text' name='sr'> Лет </p>
  <p><input type='submit' name='jsubmit' value='Закрыть'></form>

  <form method='post'>
  <h1>Закрыть дело за отсутствием состава преступления</h1>
   <p>Номер дела<br /><input type='text' name='num'></p>
   <p><input type='submit' name='nsubmit' value='Закрыть за отсутствием состава преступления'></p></form>

<h3><?=$error?></h3>
