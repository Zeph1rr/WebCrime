<?php
$data = $pdo->listTablesFull();

?>

<h3>Список таблиц базы данных <?=DB_NAME?></h3>

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
    $table_name = $v['relname'];
    $rows = $v['reltuples'];
		if ($table_name == 'Активные_дела' || $table_name == 'Архив' || ($p == 1 && $table_name == 'Сотрудники') || (($j == 1 || $p == 1) && $table_name == 'Судьи')) {
			continue;
		}
?>
<tr>
    <td><a href="?page=tbl_data&table=<?=$table_name?>&order=<?=$table_name?>"><?=$table_name?></a></td>
</tr>
<?php
}
?>
<?php

?>
</table>
