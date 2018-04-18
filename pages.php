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
    body{color:black;}
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
    .cmys{width: 95%; margin-top: 1%;
        display: block;
        border-radius:10px;
        -moz-border-radius:6px;
        }

  </style>

</head>

<body>
<?php include "header.php" ?>
<div>                                                                                                                                        </div>
<div>                                                                                                                                        </div>
<div>                                                                                                                                        </div>


<div class="container">
<?php
		$host = "localhost";
		$user = "root";
		$psw = "";
		$db = "mysqlq";

		$con = mysqli_connect($host , $user , $psw , $db);
		if(!$con)
			die("Could not connect to DB".mysqli_connect_error());




		$sql = "select * from item where item_id=".$_GET['id'];
		$items = mysqli_query($con,$sql);

		$count = count($items);

		$sql2 = "select * from comments WHERE item_id=".$_GET['id'];
		$comments = mysqli_query($con,$sql2);

		$count2 = count($comments);

		if($count <= 0){
			echo "0";
		}else{
			while($row = mysqli_fetch_assoc($items)){
				?>
					<div class="row">
						<div class="col-xs-12">
						 <div class="thumbnail">
							 <img src="Upload/<?php echo $row['item_image']; ?>">
							 <div class="caption">
								 <h2>Title: <?php echo $row['item_art']; ?></h2>

								 <h3>Place: <?php echo $row['item_place']; ?></h3>
								 <h3>Description: <?php echo $row['item_descr']; ?></h3>

							 </div>
						  </div>
						</div>
					</div>
				<?php
			}
		}

		mysqli_close($con);


?>
<div style="clear:both;">
  <div class="thumbnail">
    <div class="row">

<center>
<?php

if(!isset($_SESSION['username'])){
		echo "<h4><a href = 'Login.php'>Please, Login to write a comment!</a></h4>";
	}else{?>
<form action="addComments.php?id=<?php echo $_GET['id']?>" method="POST" >
<textarea  rows="4" class="cmys" name="cbody" placeholder="Enter your comment ..." ></textarea><br/>
<button type="submit" name="cadd" class="btn btn-default" style="width:30%; float: left; margin-left:3%; ">Add</button>
</form>
</center>
</div>

	<?php
	}
	?>



<?php
	if($count2<=0){
		echo "Be First";
	}else{
		while($row2 = mysqli_fetch_assoc($comments)){
			?>
        <hr style="width:95%;">
				<h3 style="text-align:left; margin-left:1.5%;">Author:<?php echo $row2['comment_owner']; ?></h3>
				<h4 style="text-align:left; margin-left:1.5%;"><?php echo $row2['comment_date']; ?></h4>
				<h4 style="text-align:left; margin-left:1.5%;"><?php echo $row2['comment_info']; ?></h4>
			<?php
		}
	}
?>
<div>                                                                                                                                        </div>

</div>
</div></div>
<?php include "footer.php" ?>
<script src="js/marsh.js"></script>
    <script src="js/bootstrap.js"></script>
<script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
<script src="js/roti.js" type="text/javascript"></script>
</body>
</html>
