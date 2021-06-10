<?php
$worker = $_GET['id'];
$lastname = $pdo->getData("select Имя || ' ' || Фамилия as fio from Сотрудники where Номер_жетона=".$worker)[0]['fio'];
$log = $pdo->getData("select Логин from Сотрудники where Номер_жетона = ".$worker)[0]['Логин'];
?>

<h3>
Отчетность по сотруднику <?=$lastname?>
&nbsp;&nbsp;
</h3>

<?php
if ($page->hasMessages()) {
	$page->printMessages();
}
?>

<?php
$sql = "Select (select Сотрудники.Имя from Сотрудники where Номер_жетона = ".$worker.") || ' ' || (select Сотрудники.Фамилия from Сотрудники where Номер_жетона = ".$worker.") as ФИО, (select count(*) from Активные_дела where Сотрудник = ".$worker.") as Активных_дел, (select count(*) from Архив where Сотрудник = ".$worker.") as Закрытых_дел from Сотрудники where Номер_жетона = ".$worker;

$data = $pdo->getData($sql);


if (!$data) {
    echo 'No data!';
    return ;
}

$fields = array_keys($data[0]);
 ?>

 <table class="table table-pg">
 	<tr>
 	<?php
 	foreach ($fields as $field) {
 	    echo '<th><a href="">'.$field.'</a></th>';
 	}
 	?>
 	</tr>
 	    <tr>
 	    <?php
 	    foreach ($fields as $field) {
 	        echo '<td>'.$data[0][$field].'</td>';
 	    }
 	    ?>
 	    </tr>

 </table>

 <a href="?page=tbl_report">Go back</a>
