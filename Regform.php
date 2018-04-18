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
<head>
  <title>MarshMello_DJ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/login.js"></script>
   <style>
body{ background: url(chid1.jpg)}
.item{
    position:relative;
    background-color:#f0f0f0;
    float:right;
    width:52px;
    margin:0px 5px;
    height:52px;
    border:2px solid #ddd;
    -moz-border-radius:30px;
    -webkit-border-radius:30px;
    border-radius:30px;
    -moz-box-shadow:1px 1px 3px #555;
    -webkit-box-shadow:1px 1px 3px #555;
    box-shadow:1px 1px 3px #555;
    cursor:pointer;
    overflow:hidden;
}

.icon_find{
    background:transparent url("images/find.png") no-repeat top left;
}

.link{
    left:2px;
    top:2px;
    position:absolute;
    width:48px;
    height:48px;
}

.item_content{
    position:absolute;
    height:52px;
    width:220px;
    overflow:hidden;
    left:56px;
    color:black;
    top:7px;
    background:transparent;
    display:none;
}
.item_content h2{
    color:#aaa;
    text-shadow: 1px 1px 1px #fff;
    background-color:transparent;
    font-size:14px;
}
.item_content a{
    background-color:transparent;
    float:left;
    margin-right:7px;
    margin-top:3px;
    color:#bbb;
    text-shadow: 1px 1px 1px #fff;
    text-decoration:none;
    font-size:12px;
}
.item_content a:hover{
    color:#0b965b;
}
.item_content p {
    background-color:transparent;
    display:none;
}
.item_content p input{
    border:1px solid #ccc;
    padding:1px;
    width:155px;
    float:left;
    margin-right:5px;
}
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
#ducks{padding-bottom: 51px;}
#er{color: red;}
  </style>
</head>
<body>
  <div id="ducks">
  <?php include "header.php" ?>
  </div>
<!-- MAIN PART -->

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




<script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
 <script src="js/roti.js" type="text/javascript"></script>
</body>
<footer style="background-color: #101010;position: sticky;
width: 100%;  margin-top:38px">
<div class="container-fluid text-center">


<ul style="list-style: none;">
	<li><a href="contact.php">Contacts</a></li>
      <li>+1 202 265 6942</li>
	  <li>Ozaki@gmail.com</li>
<li>by Sanatov</li>
    </ul>


</div>
</footer>
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
