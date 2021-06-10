<?php
$data = $pdo->getData('select * from Сотрудники order by Сотрудники');
?>

<h3>Список сотрудников базы данных <?=DB_NAME?></h3>

<?php
if ($page->hasMessages()) {
	$page->printMessages();
    $page->redirect(BASE_URL, 1);
    return ;
}
?>

<table class="table table-pg">
<?php
foreach ($data as $v) {
    $table_name = $v['Номер_жетона'];
    $rows = $v['Фамилия'];
?>
<tr>
    <td><?=$table_name?></td>
    <td><a href="?page=report&id=<?=$table_name?>"><?=$rows?></a></td>
</tr>
<?php
}
?>
</table>
