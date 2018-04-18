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
  <script src="js/bootstrap.js"></script>
  <style>
body{ background: url(chid1.jpg)}
#asddd{margin-top:13px}
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


    /* On small screens, set height to 'auto' for sidenav and grid */
    @media only screen and (min-width : 481px) {
        .row.equal-height {
            display: flex;
            flex-wrap: wrap;
        }
        .row.equal-height > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }
        .row.equal-height.row:after,
        .row.equal-height.row:before {
            display: flex;
        }

        .row.equal-height > [class*='col-'] > .thumbnail,
        .row.equal-height > [class*='col-'] > .thumbnail > .caption {
            display: flex;
            flex: 1 0 auto;
            flex-direction: column;
        }
        .row.equal-height > [class*='col-'] > .thumbnail > .caption > .flex-text {
            flex-grow: 1;
        }
        .row.equal-height > [class*='col-'] > .thumbnail > img {
            width: 100%;
            height: 200px; /* force image's height */

            /* force image fit inside it's "box" */
            -webkit-object-fit: cover;
               -moz-object-fit: cover;
                -ms-object-fit: cover;
                 -o-object-fit: cover;
                    object-fit: cover;
        }
    }

	#imagerss img {border: 0.3px black solid;
	margin: 0 auto;
  height: 100%;
  width: 100%;

	}
	#smborder a{color:black;}
  .thumbnail{
    border-style: groove;
    border-width: 2px;
  }
#hovo:hover{background-color: skyblue;}
  </style>
</head>
<body>
<?php include "header.php" ?>
<div>                                                                                                                                        </div>
<div id='asddd'>                                                                                                                                        </div>





  <div class="row content">

    <div class="col-sm-8 text-left" >
	<div id="smborder" >

      <h1>Marshmello's identity</h1>

	  <?php
   if(isset($_SESSION['username']))
                            {
							 echo "<p>Add new place <a href='clude.php' id = 'hovo'><u>here</u></a></p>";
                            }
							else
                {
                    echo
                    " ";
                }
                             ?>

 <div id="imagerss">

   <div class="row equal-height">
   <?php
       $host = "localhost";
   	$user = "root";
   	$psw = "";
   	$db = "mysqlq";

   	$con = mysqli_connect($host , $user , $psw , $db);
   	if(!$con)
   		die("Could not connect to DB".mysqli_connect_error());


   	$sql = "select * from item";
   	$items = mysqli_query($con,$sql);
    if(!$items)
      die("Error: ".mysqli_error($db));
   	$count = count($items);

   	if($count <= 0){
   		echo "0";
   	}else{
   		while($row = mysqli_fetch_assoc($items)){
   			?>
   			<div class="col-md-4 col-sm-6 col-xs-12">
   				<div class="thumbnail">
   					<a href="Upload/<?php echo $row['item_image']; ?>">
   						<img src="Upload/<?php echo $row['item_image']; ?>" alt="" margin="50" height="200" width="350" /><br>
   					</a>
   					<div class="caption">
   						<a href="pages.php?id=<?php echo $row['item_id']; ?>" class="btn btn-info"><i style = "color: white;"><?php echo $row['item_art']; ?></i></a>
   					</div>
   				</div>
   			</div>
   			<?php
   		}
   	}
   ?>
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
