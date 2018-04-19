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
else if ($_COOKIE['auto'] == 'no')
{
$_SESSION['username'] = $_COOKIE['username'];
$_SESSION['password']=$_COOKIE['password'];
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
    <?php include "head.php" ?>
    
    <style>
    
    html, body {
    height: 100%;
    }
    #right-panel {
    margin: 0 1em;
    border-width: 2px;
    width: 25%;
    height: 100%;
    float: left;
    text-align: left;
    padding-top: 1%;
    }
    #directions-panel {
    margin-top: 0;
    background-color: white;
    padding: 10px;
    color: black;
    }
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
    input{
    color:black;
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
    @media screen and (max-width: 767px) {
    .sidenav {
    height: auto;
    padding: 15px;
    }
    .row.content {height:auto;}
    }
    .switch {
    margin: 5%;
    position: relative;
    display: inline-block;
    float: right;
    width: 60px;
    height: 34px;
    }
    .switch input {display:none;}
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }
    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }
    input:checked + .slider {
    background-color: #2196F3;
    }
    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }
    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }
    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }
    .slider.round:before {
    border-radius: 50%;
    }
    directions-panel
    #directions-panel::-webkit-scrollbar-track
    {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      border-radius: 10px;
      background-color: #F5F5F5;
    }
    #directions-panel::-webkit-scrollbar
    {
      width: 12px;
      background-color: #F5F5F5;
    }
    #directions-panel::-webkit-scrollbar-thumb
    {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
    }
    #waypoints::-webkit-scrollbar-track
    {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      border-radius: 10px;
      background-color: #F5F5F5;
    }
    #waypoints::-webkit-scrollbar
    {
      width: 12px;
      background-color: #F5F5F5;
    }
    #waypoints::-webkit-scrollbar-thumb
    {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
    }
    </style>
  </head>
  <body>
    <?php include "header.php" ?>
    
    <div id="map"></div>
    <form>
    <div id="right-panel">
      <div class="form-group">
          <input id="start" type="text"  class="form-control" placeholder="origin">
          Choose/Random waypoints<label class="switch"  >
            <input type="checkbox" id ="myCheck" >
            <span class="slider round"></span>
          </label>
          <br>
          <input style="margin-bottom:3px" class="form-control" placeholder="enter waypoints/number of waypoints" id ="test1" type="text">
          <select multiple id="waypoints" class="form-control">
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
            $count = count($items);
            if($count <= 0){
            echo "0";
            }else{
            while($row = mysqli_fetch_assoc($items)){
            ?>
            <?php
            if(isset($_SESSION['username']))
            {
            echo "<option>";
                echo $row['item_place'];
            echo "</option>";
            }
            ?>
            <?php
            }
            }
            mysqli_close($con);
            ?>
          </select>
          <button type="submit" name="submit" class="btn btn-default" id="submit1"  style="margin-bottom:3px">Add waypoint</button>
          <br>
          <b>End:</b><br> 
          <input id="end" type="text" class="form-control" style="margin-bottom:3px" placeholder="destination">
          <button type="submit"  class="btn btn-default" id="submit" >Build route</button>
        </div>

      <div class="form-group">
        <div id="directions-panel" class="form-control" style="height:120px;width:240px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">Enter origin and destination point</div>

      </div>
      </div>
    </div>
    </form>
   <?php include "mapjs.php" ?>
    </body>
  </html>