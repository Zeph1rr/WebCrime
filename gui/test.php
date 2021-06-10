<?php
include_once 'Pg_Pdo.php';
$pdo = new PG_PDO;
$pdo->connect('localhost', 'postgres', '', 'WebCrime');

$k=0;
$test = 'skoroboy';
$datap = $pdo->getData('Select Логин from Сотрудники');
foreach ($datap as $v){
  if ($test == $v['Логин']){
    $k=1;
  }
}
echo $k;


?>
