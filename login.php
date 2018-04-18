
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
<script src="login.js"></script>

   <style>
body{ background: url(chid1.jpg)}
.icon_find{
    background:transparent url("images/find.png") no-repeat top left;
}
#ducks{padding-bottom: 51px;}
#er{color: red;}
</style>
</head>

<body>
<div id="ducks">
<?php include "header.php" ?>
</div>





<div class="login">

    <form method="post" action="" class="regiform">

<div class="form-group">
  <h3>Login</h3>
            <label>Username</label>
            <input name="username" type="text" size="15" maxlength="15" placeholder="Username" class="form-control"  id="uname" required>
</div><div class="form-group">
            <label>Password</label>
            <input name="password" type="password" size="15" maxlength="15" placeholder="Password" class="form-control" id="psw" required>
          </div>  <div >

                <label >
              <input name="autovhod" type="checkbox" value="1"> AutoLogin?
            </label>
          </div>
          <div class="clearfix">
            <br>
            <button type="submit" name="submit" class="btn btn-default" id="btnLogin" value="Login"  style=" margin-right:100px; width:300px;">Enter</button>
            <button type="submit" class="btn btn-default" style="background-color:black; margin-left:100px; width:300px;"><a href="contact.php">                               Back                               </a></button>
<p id="er"></p>
</div>



    </form>
</div>
<script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
    <script src="js/roti.js" type="text/javascript"></script>


</body>
<footer style="background-color: #101010;position: sticky;
width: 100%; height:15%; margin-top:122px">
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
 if(isset($_POST['submit'])){
if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } //заносим введенный пользователем логин в переменную $username, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($username) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
  exit ("<script>document.getElementById('er').innerHTML = 'Fill all fields'</script>");//останавливаем выполнение сценариев

}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести



// дописываем новое********************************************

// подключаемся к базе
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь

// минипроверка на подбор паролей



//можно добавить несколько своих символов по вкусу, например, вписав "b3p6f". Если этот пароль будут взламывать методом подбора у себя на сервере этой же md5,то явно ничего хорошего не выйдет. Но советую ставить другие символы, можно в начале строки или в середине.

//При этом необходимо увеличить длину поля password в базе. Зашифрованный пароль может получится гораздо большего размера.


$result = mysqli_query($db,"SELECT * FROM users WHERE username='$username' AND password='$password'");
if(!$result)
  die("Error: ".mysqli_error($db));
$myrow = mysqli_fetch_array($result);
if (empty($myrow['id']))
{

 //останавливаем выполнение сценариев
  exit ("<script>document.getElementById('er').innerHTML = 'Wrong login or password'</script>");//останавливаем выполнение сценариев

}
else {

          //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
          $_SESSION['password']=$myrow['password'];
		  $_SESSION['username']=$myrow['username'];
          $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь

//Далее мы запоминаем данные в куки, для последующего входа.
//ВНИМАНИЕ!!! ДЕЛАЙТЕ ЭТО НА ВАШЕ УСМОТРЕНИЕ, ТАК КАК ДАННЫЕ ХРАНЯТСЯ В КУКАХ БЕЗ ШИФРОВКИ

if    (isset($_POST['autovhod'])){
            //Если    пользователь хочет входить на сайт автоматически

            setcookie("auto", "yes",    time()+9999999);
            setcookie("username",    $_POST["username"], time()+9999999);
            setcookie("password",    $_POST["password"], time()+9999999);
            setcookie("id",    $myrow['id'], time()+9999999);}
 else{
  setcookie("auto", "no",    time()+90);
  setcookie("username",    $_POST["username"], time()+1);
  setcookie("password",    $_POST["password"], time()+1);
  setcookie("id",    $myrow['id'], time()+1);
}
}

echo "<html><head><meta http-equiv='Refresh' content='0; URL=contact.php'></head></html>";

//перенаправляем пользователя на главную страничку, там ему и сообщим об удачном входе
}
?>
