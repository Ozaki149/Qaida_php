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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/marsh.css">
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
#asddd{margin-bottom: 16px;}
#smborder{height: 100%}
  </style>

</head>

<body>
<?php include "header.php" ?>
<div>                                                                                                                                        </div>
<div id='asddd'>                                                                                                                                        </div>


   <figure ><img style="height:30px; width:100%" src="images/moun.JPG" /></figure>
        <div id="smborder">
<div class="thumbnail">
        <h3>IF YOU HAVE ANY IDEA OF HIS IDENTITY, PLEASE UPLOAD IT!</h3>
      <hr class="style14">
	 <div id='oops'>

<form action='' method='post' class="form-horizontal" name="myForm" enctype='multipart/form-data'>
  <p id="er"></p>
     <label for="message-text" class="control-label">Name:</label>
      <input type="text" class="form-control" name="art">

      <label for="message-text" class="control-label">Place/Concert:</label>
      <input type="text" class="form-control" name="place">

      <label for="message-text" class="control-label">Description:</label>
      <input type="text" class="form-control" name="descr">

	<label for='upload'>Select image to upload: </label>
<input type='file' name='fileToUpload' id='fileToUpload'> <br>
<input type='submit' value='Upload Image' class="btn btn-default" style=" margin-right:100px; width:300px;" name='submit1'>

</form>
</div>
</div>
</div>

<script src="js/marsh.js"></script>
    <script src="js/bootstrap.js"></script>
<script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
<script src="js/roti.js" type="text/javascript"></script>
</body>
<footer style="background-color: #101010;
width: 100%; height:112px; ">
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
if($_SERVER["REQUEST_METHOD"] == "POST")
{

$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$name = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit1"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {


  echo "<script> alert( 'Sorry, file is alredy exist' );			</script>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {


  echo "<script> alert( 'Sorry, your file is too large.' );			</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {


  echo "<script> alert( 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.' );			</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script> alert( 'Sorry, your file was not uploaded.' );			</script>";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  echo "<script> alert( 'The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.' );			</script>";



    } else {
  echo "<script> alert( 'Sorry, there was an error uploading your file.' );			</script>";


    }
}

if($uploadOk == 1){
	if(isset($_POST['submit1'])){
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'mysqlq';
$connection = mysqli_connect($host , $username , $password , $db);

$art = $_POST['art'];

$place = $_POST['place'];
$descr = $_POST['descr'];

$item_image = $target_dir;
if($art == ''|| $place == '' || $descr == ''){
	echo "Error";
}else{
	if(!$connection){
		echo 'Error: '.mysqli_error();
	}
	else{
	$DB = "INSERT INTO item(item_art , item_place , item_descr , item_image) VALUES ('".$art."','".$place."','".$descr."','".$name."')";
	mysqli_query($connection , $DB);
	header("location: ../fri1/home.php");
	}

	mysqli_close($connection);
	}

}}
}

}
?>
