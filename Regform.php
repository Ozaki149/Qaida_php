<?php
session_start();
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
if (isset($_COOKIE['auto']) and    isset($_COOKIE['username']) and isset($_COOKIE['password']))
{//если есть    необходимые переменные
if ($_COOKIE['auto'] == 'yes') { // если    пользователь желает входить автоматически, то запускаем сессии
$_SESSION['password']=$_COOKIE['password']; //в куках    пароль был не зашифрованный, а в сессиях обычно храним зашифрованный
$_SESSION['username']=$_COOKIE['username'];//сессия с логином
$_SESSION['id']=$_COOKIE['id'];//идентификатор    пользователя
}
}
if (!empty($_SESSION['username']) and !empty($_SESSION['password']))
{
//если существет логин и пароль в сессиях, то проверяем их и извлекаем аватар
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$result = mysqli_query($db,"SELECT id FROM users WHERE username='$username' AND password='$password'");
$myrow = mysqli_fetch_array($result);
//извлекаем нужные данные о пользователе
}
?>
<!DOCTYPE html>
<html lang="en">
   <?php include "head.php" ?>
  <body>
      <?php include "header.php" ?>
    <!-- MAIN PART -->
    <div class="container center_div">
    <form class="regiform" method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label for="inputdefault" >Email:</label>
        <input name="email" type="text" class="form-control" id="emai" size="15" maxlength="25" required>
      </div>
      <div class="form-group">
        <label for="inputdefault" >Name:</label>
        <input name="username" type="text" class="form-control" id="uname" size="15" maxlength="15" required>
      </div>
      <div class="form-group">
        <label for="inputsm">Password:</label>
        <input name="password" type="password" class="form-control input-sm" id="psw" size="15" maxlength="15" required>
      </div>
      <div class="form-group">
        <label for="inputsm">Repeate Password:</label>
        <input name="rpass" type="password" class="form-control input-sm"  style="height:30px;" id="rpassword"  size="15" maxlength="15" required>
      </div>
      <div class="clearfix">
        <button type="submit" name="register" class="btn btn-default" value="Submit"  style="width:400px;"  onclick="validate(); myFunction();">Join</button>
        <button class="btn btn-default" style="background-color:black; width:400px;"><a href="contact.php">                                     Back                                     </a></button>
        <div>                                                                                                                                        </div>
        <p id="er"></p>
      </div>
    </form>
  </div>
    <script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
    <script src="js/roti.js" type="text/javascript"></script>
  </body>
   <?php include "footer.php" ?>
</html>
<?php
if(isset($_POST['register'])){
if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } //заносим введенный пользователем логин в переменную $username, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
if (isset($_POST['rpass'])) { $rpass=$_POST['rpass']; if ($rpass =='') { unset($rpass);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($username) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
echo ("<script>document.getElementById('er').innerHTML = 'You entered not all information, go back and fill all of them')</script>"); //останавливаем выполнение сценариев
}
if ($password != $rpass){
exit ("<script>document.getElementById('er').innerHTML = 'password and repeat password not same'</script>");}
if (strlen($username) < 6 or strlen($username) > 15) {
exit ("<script>document.getElementById('er').innerHTML = 'Username need be longer than 6'</script>"); //останавливаем выполнение сценариев
}
if (strlen($password) < 6 or strlen($password) > 15) {
exit ("<script>document.getElementById('er').innerHTML = 'Password need be longer than 6'</script>");//останавливаем выполнение сценариев
}
// подключаемся к базе
// проверка на существование пользователя с таким же логином
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
// проверка на существование пользователя с таким же логином
$result = mysqli_query($db,"SELECT id FROM users WHERE username='$username'");
if(!$result)
die("Error: ".mysqli_error($db));
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id'])) {
exit ("<script>document.getElementById('er').innerHTML = 'Occupied username, take another'</script>");
}
// если такого нет, то сохраняем данные
$result2 = mysqli_query ($db,"INSERT INTO users (username,password) VALUES('$username','$password')");
// Проверяем, есть ли ошибки
if ($result2=='TRUE')
{
?>
<script type="text/javascript">
window.location.href = 'contact.php';
</script>
<?php
exit;
}else {
exit ("<script>document.getElementById('er').innerHTML = 'Error, ur not logged in'</script>");
}
}
?>