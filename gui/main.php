<?php

session_start();

define('APP_NAME', 'Главная страница');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'WebCrime');

define('BASE_URL', str_replace('index.php', '', $_SERVER['PHP_SELF']));

include_once 'Pg_Pdo.php';
include_once 'Page.php';


$page = new Page;

global $pdo;
$pdo = new PG_PDO;
$pdo->connect(DB_HOST, $_SESSION['login'], $_SESSION['password'], DB_NAME);

if (!$pdo->connect) {
    echo $pdo->error;
	exit;
}



function generatePagesLinks($limit, $start, $countAll, $floatLimit=50)
{
    $pageLinks = '';
    $pageCount = ceil($countAll / $limit);
    if ($pageCount == 1) {
        return '';
    }
    $j = 0;
    if ($start > $floatLimit) {
        $pageLinks .= '<li><a href="'.url('start=0').'">1...</a></li> ';
    }
    for ($i = max(1, $start - $floatLimit); $i <= $pageCount; $i ++) {
        if ($j > $floatLimit * 2) {
            break;
        }
        $st = '';
        if ($i - 1 == $start) {
            $st = ' style="font-weight:bold; color:#FF0000; background-color:green; color:white "';
        }
        $pageLinks .= '<li><a'.$st.' href="'.url('start='.($i-1)).'">'.$i.'</a></li> ';
        $j ++;
    }
    if ($pageCount > $floatLimit * 2) {
        $pageLinks .= '<li><a href="'.url('start='.($pageCount-1)).'"><span aria-hidden="true">&raquo;</span></a></li> ';
    }
    $pageLinks = '
        <nav aria-label="Page navigation">
          <ul class="pagination">
            '.$pageLinks.'
          </ul>
        </nav>
    ';
    return $pageLinks;
}

function url($add='', $query='')
{
    $httpHost = 'http://'.$_SERVER['HTTP_HOST'];
    $path     = $_SERVER['SCRIPT_NAME'];
    $query    = $query == '' ? $_SERVER['QUERY_STRING'] : $query;
    if ($query == '') {
        return $path.'?'.$add;
    }
    parse_str($query, $currentAssoc);
    parse_str($add, $addAssoc);
    if (is_array($addAssoc)) {
        foreach ($addAssoc as $k => $v) {
            $currentAssoc [$k]= $v;
        }
    }
    $a = array();
    foreach ($currentAssoc as $k => $v) {
        if ($v == '') {
            continue;
        }
        $a []= $v == '' ? $k : "$k=$v";
    }
    return $path.'?'.implode('&', $a);
}
$dataln = $pdo->getData("Select Фамилия || ' ' || Имя as ФИО from Сотрудники where Логин = '".$_SESSION['login']."'");
  if ($dataln){
    $ln = $dataln[0]['ФИО'];
  }
  else {
    $dataln = $pdo->getData("Select Фамилия from Судьи where Логин ='".$_SESSION['login']."'");
    if ($dataln) {
      $ln = $dataln[0]['Фамилия'];
    }
    else {
      $ln = 'Администратор';
    }
  }


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
?>



<!DOCTYPE html>
<html>
<head>
  <?php
  if (!$_GET['table']){
   ?>
    <title><?=APP_NAME?></title>
<?php }
else {
  ?>
  <title><?=$_GET['table']?></title>
  <?php
} ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <style type="text/css">
    body {background: #E0FFFF;}
    nav {background: #E0FFFF;}
    .table-pg {width:auto; }
    .tbl-menu {list-style:none; padding: 0; font-size: 11px;}
    h3 {margin: 0 0 15px; font-size: 20px;}
    </style>
</head><body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=BASE_URL?>"><?=APP_NAME?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href=""><?=$ln?></a></li>
        <?php
        if ($p==1){ ?>
          <li><a href="">Сотрудник полиции</a></li>
      <?php  }
      if ($j==1){?>
        <li><a href="">Судья</a></li>
      <?php }
        if ($_SESSION['login'] == 's1l2p4') {
        ?>
        <li><a href="?page=tbl_data&table=Администрация.Пользователи&order=Идентификационный_номер">Пользователи</a></li>
        <li><a href="?page=tbl_report">Отчетность по сотрудникам</a></li>
        <?php } ?>
        <li><a href="index.php">Выход</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-10">
            <?php
            if ($_GET['page']) {
                $p = $_GET['page'];
            	include_once $p.'.php';
            } else {
                include_once 'tbl_list.php';
            }
            ?>
        </div>
    </div>


</div>

</body></html>
