<!DOCTYPE html>
<html>
<head>
  <title>Авторизация</title>
  <style type="text/css">
body {background: #F0F8FF;}
  .modal{
  padding: 50px;
  position: fixed; top: 50%; left: 50%;
  background: #E0FFFF;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
  </style>
</head>
<body>
  <div class="modal">
<form alingn=center id='forma' action='script1.php' method='post'>
<h1>Авторизация</h1>
<p>Заполните все поля, чтобы получить доступ<br>к базе данных</p>
<p>Логин<br /><input type='text' name='login'></p>
<p>Пароль<br /><input type='password' name='password'></p>
<p><input type='submit' name='submit' value='Войти'> <br></p></form>
</div>
</body>
</html>
