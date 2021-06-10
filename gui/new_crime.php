<?php
$error = '';
$datas = $pdo->getData("select id::char || '. ' || Номер_статьи || '.' || Часть || ' ' || Описание as Статья from Статьи order by Статьи");
$datapot = $pdo->getData("select Паспорт || ' ' || Имя || ' ' || Фамилия || ' ' || Дата_рождения || ' ' || Место_рождения as pot from Потерпевшие");
$datapod = $pdo->getData("select Паспорт || ' ' || Имя || ' ' || Фамилия || ' ' || Дата_рождения || ' ' || Место_рождения || ' ' || Статус as pod from Подозреваемые");
$dataj = $pdo->getData("select Номер_пропуска || '. ' || Фамилия || ' ' || Название || ' г. ' || Город as Судья from Судьи inner join Суды on Суд = Номер");
if (isset($_POST['jsubmit'])){
  $res1 = $pdo->query("insert into Активные_дела values ((select count (*) from Активные_дела)+(select count (*) from Архив) + 1, ".$_POST['state'].", (select Номер_жетона from Сотрудники where Логин = '".$_SESSION['login']."'), current_date, ".$_POST['pot'].", ".$_POST['pod'].", ".$_POST['sud'].");");
  if ($res1){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=tbl_data&table=Дела&order=Номер_дела">';
}
else {
  $error = 'Ошибка! Проверьте введенные данные и попробуйте снова';
}
}
 ?>

 <form method='post'>
 <h1>Открыть новое дело</h1>
  <p>Статья<br /><details>
  <?php
  foreach ($datas as $rowss) {
    echo '<p>'.$rowss['Статья'].'</p>';
  }
  ?>
  </details><input type='text' name='state'></p>
  <p>Паспорт потерпевшего<br />
    <details>
    <?php
    foreach ($datapot as $rowss) {
      echo '<p>'.$rowss['pot'].'</p>';
    }
    ?>
    </details><input type='text' name='pot'></p>
  <p>Паспорт подозреваемого<br />  <details>
    <?php
    foreach ($datapod as $rowss) {
      echo '<p>'.$rowss['pod'].'</p>';
    }
    ?>
    </details><input type='text' name='pod'></p>
  <p>Номер пропуска судьи<br /><details>
    <?php
    foreach ($dataj as $rowss) {
      echo '<p>'.$rowss['Судья'].'</p>';
    }
    ?>
    </details><input type='text' name='sud'></p>
  <p><input type='submit' name='jsubmit' value='Открыть'> <br></p></form>

<h3><?=$error?></h3>
