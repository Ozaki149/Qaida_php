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
</head>
<body>
  <?php include "header.php" ?>
  
    <div class="container center_div">
  <div class="row content">
    <div class="col-sm-8 text-left" >
      <div id="smborder" >
        <h1>Help/Manual Page</h1>
        <div id="imagerss">
          <div class="row equal-height">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <a id="button1" class= 'helpu' href="#">How to use Random: Show/Hide</a>
              <div class="thumbnail" id="item1">
                Press on checkbox, add number of waypoints that go random, add start and end point of your journey, press build route
              </div>
              <a id="button2" class= 'helpu' href="#">Add own waypoints: Show/Hide</a>
              <div class="thumbnail" id="item2">
                First of all enter to the system(if you didn't registered yet, please Registrate yourself )
                then go to places and press here and then fill the form(image should smaller than 800x800)
              </div>
              <a id="button3" class= 'helpu' href="#">How to add slices: Show/Hide</a>
              <div class="thumbnail" id="item3">
                After you pressed checked the rounded checkbox, you are able to fill the enter waypoints/number of waypoints
                there you need to enter number of slices(no more than the number of waypoints in box)
              </div>
              <a id="button4" class= 'helpu' href="#">Problem: Show/Hide</a>
              <div class="thumbnail" id="item4">
                Directions request failed due to NOT_FOUND:
                it means that u need to add original and destination point
              </div>
            </div>
          </div>
        </div>
      </div></div>
    </div></div>
    
    <script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
    <script src="js/roti.js" type="text/javascript"></script>
  </body>
  <footer style="background-color: #101010;
    width: 99.9%; height:100%; margin-top:210px">
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