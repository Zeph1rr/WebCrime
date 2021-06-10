<?php
$table = $_GET['table'];

$datap = $pdo->getData('Select Логин from Сотрудники');
$dataj = $pdo->getData('Select Логин from Судьи');
$p = 0;
$j = 0;
foreach($datap as $v){
	if ($_SESSION['login'] == $v['Логин']){
    $p=1;
  }
}
foreach($dataj as $v){
	if ($_SESSION['login'] == $v['Логин']){
    $j=1;
  }
}

if ($table != 'Администрация.Пользователи'){
?>

<h3>
Просмотр таблицы <?=$table?>
&nbsp;&nbsp;
</h3>
<?php
}
else { ?>
	<h3>
  Пользователи
	&nbsp;&nbsp;
	</h3>

<?php
}
if ($page->hasMessages()) {
	$page->printMessages();
}
?>


<?php
if ($table == 'Потерпевшие' || $table == 'Подозреваемые' || $table == 'Осужденные') {
	$limit = 10;
}
else {
	$limit = 5;
}

if ($_GET['start']){
	$start = $limit*$_GET['start'];
}
else $start = 0;
$countAll = $pdo->getData('SELECT COUNT(*) AS c FROM '.$table)[0]['c'];

$pageLinks = generatePagesLinks($limit, $start, $countAll, $floatLimit=10);

$primaryKeys = $pdo->primaryKeys($table, 1);

// Находим order
$order = $_GET['order'];
if (!$order) {
    if (count($primaryKeys)) {
    	$order = $pks[0];
    }
}

// Составляем запрос
$sql = 'SELECT * FROM '.$table.'';
if ($order) {
	$sql .= ' ORDER BY "'.$order.'"';
}
if ($_GET['order-desc']) {
	$sql .= ' DESC';
}
$sql .= ' LIMIT '.$limit.' OFFSET '.$start;

// Извлекаем данные
$data = $pdo->getData($sql);


if (!$data) {
	if ($table != 'Дела'){
    echo 'Нет данных';
	}
	else {
		echo 'У вас нет активных дел';
	}
		if ($table == 'Подозреваемые' && ($_SESSION['login'] == 's1l2p4' || $p==1)) {
			echo '<br><a href=?page=new_pod>Добавить подозреваемого</a>';
		}
		if ($table == 'Дела' && $p==1){
			echo '<br><a href=?page=new_crime>Открыть новое дело</a>';
		}
    return ;
}

$fields = array_keys($data[0]);


?>


<table class="table table-pg">
<tr>
<?php
foreach ($fields as $field) {
    $add = '';
    if ($field == $_GET['order']) {
        if ($_GET['order-desc']) {
        	$add = '&order-desc=';
        } else {
        	$add = '&order-desc=1';
        }
    } else {
        if ($_GET['order-desc']) {
        	$add = '&order-desc=';
        }
    }
    echo '<th><a href="'.url('order='.$field.$add).'">'.$field.'</a></th>';
}
?>
</tr>
<?php
foreach ($data as $row) {
    $where = [];
    foreach ($primaryKeys as $pk) {
    	$where []= '"'.$pk.'"=\''.$row[$pk].'\'';
    }
    $where = implode(' AND ', $where);
    ?>
    <tr>
    <?php
		foreach ($fields as $field) {
			if ($field == 'Ссылка') {
				echo '<td><a target="_blank" href="'.$row[$field].'">Ссылка<a></td>';
			}
			else {
				echo '<td>'.$row[$field].'</td>';
			}
		}
    ?>
    </tr>
    <?php
}


?>
</table>

<?php
if ($table == 'Сотрудники' && $_SESSION['login'] == 's1l2p4') {
	echo '<a href=?page=new_police>Добавить сотрудника</a>';
}
if ($table == 'Судьи'  && $_SESSION['login'] == 's1l2p4') {
	echo '<a href=?page=new_judge>Добавить судью</a>';
}
if ($table == 'Потерпевшие' && ($_SESSION['login'] == 's1l2p4' || $p==1)) {
	echo '<a href=?page=new_pot>Добавить потерпевшего</a>';
}
if ($table == 'Подозреваемые' && ($_SESSION['login'] == 's1l2p4' || $p==1)) {
	echo '<a href=?page=new_pod>Добавить подозреваемого</a>';
}
if ($table == 'Дела' && $p==1){
	echo '<a href=?page=new_crime>Открыть новое дело</a>';
}
if ($table == 'Дела' && $j==1){
	echo '<a href=?page=close>Закрыть дело</a>';
}
echo $pageLinks;
?>
