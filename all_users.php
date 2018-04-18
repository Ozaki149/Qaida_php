<?php
// вся процедура работает на сессиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!
session_start();

include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь

if (!empty($_SESSION['username']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сессиях, то проверяем, действительны ли они
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$result2 = mysqli_query($db,"SELECT id FROM users WHERE username='$username' AND password='$password'");
$myrow2 = mysqli_fetch_array($result2);
if (empty($myrow2['id']))
   {
   //если данные пользователя не верны
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {
//Проверяем, зарегистрирован ли вошедший
exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
?>
<html>
<head>
<title>List of users</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<style>

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
#imagerss img {border: 0.3px black solid;
margin: 10px 20px 4px 30px;
width: 350px;
height: 225px;
}
#smborder{margin-top: 50px; color:black;}
#smborder a{color:black;}
</style>
</head>
<body>
  <?php include "header.php" ?>
  <div class="container-fluid text-center">
    <div class="row content">

      <div class="col-sm-8 text-left" >
    <div id="smborder">
<h2>List of users</h2>


<?php
//выводим меню


$result = mysqli_query($db,"SELECT username,id FROM users ORDER BY username"); //извлекаем логин и идентификатор пользователей
$myrow = mysqli_fetch_array($result);
do
{
//выводим их в цикле

printf("<a href='page.php?id=%s'>%s</a><br>",$myrow['id'],$myrow['username']);
echo "<div>                                                                                                                     </div>";
}
while($myrow = mysqli_fetch_array($result));

?>
</div>
</div>
</div>
</body>
</html>
