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
  <title>QaidA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
  $(document).ready(function(){
      $("#directions-panel").hide();
      $("#submit").click(function(){
          $("#directions-panel").show();
      });
  });
  </script>



   <style>
   #right-panel {

     line-height: 30px;
     color:black;

     padding-left: 10px;
   }

   #right-panel select, #right-panel input {
     font-size: 15px;
   }
#asddd{margin-top:14px}
   #right-panel select {
     width: 100%;
   }

   #right-panel i {
     font-size: 12px;
   }

   html, body {
     height: 100%;
     margin: 0;
     padding: 0;
     font-family: 'Open Sans', sans-serif;
     font-weight: 100;
     background: url(chid1.jpg)
   }
       #map{height: 91%;
       float: left;
       width: 70%;
       }
       #right-panel {
         margin: 0 20px;
         border-width: 2px;
         width: 25%;
         height: 400px;
         float: left;
         text-align: left;
         padding-top: 1%;

       }
       #directions-panel {
         margin-top: 10px;
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
<div>                                                                                                                                        </div>
<div id='asddd'>                                                                                                                                        </div>
<div id="map"></div>
  <div id="right-panel">
                           <div id="smborder">
                         <div>



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
                         <div id="directions-panel" class="form-control" style="height:120px;width:240px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">Enter origin and destination point</div>
                       </div>
                         </div>







<script src="js/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
<script>
$("#submit1").click(function(){
if( $('#test1').val().length == 0 ){
  $('#test1').attr("placeholder", "Type waypoints");
}else {
					$('#waypoints').append($('<option>', {
    value: $("#test1").val(),
    text: $("#test1").val(),
    selected:"selected"
}));
      };
        });
      </script>
 <script src="js/roti.js" type="text/javascript"></script>
 <script>
   function initMap() {
     var directionsService = new google.maps.DirectionsService;
     var directionsDisplay = new google.maps.DirectionsRenderer;
     var map = new google.maps.Map(document.getElementById('map'), {
       zoom: 12,
       center: {lat: 43.234381,lng: 76.890339}
     });
     directionsDisplay.setMap(map);


     document.getElementById('submit').addEventListener('click', function() {
       calculateAndDisplayRoute(directionsService, directionsDisplay);
     });
   }
   function compareRandom(a, b) {
   return Math.random() - 0.5;
   }
   function calculateAndDisplayRoute(directionsService, directionsDisplay) {
     var waypts = [];
     var checkboxArray = document.getElementById('waypoints');
     for (var i = 0; i < checkboxArray.length; i++) {
       if (checkboxArray.options[i].selected) {
         waypts.push({
           location: checkboxArray[i].value,
           stopover: true
         });
         if  (document.getElementById("myCheck").checked){
           waypts.sort(compareRandom);

         }
       }
     }

     if  (document.getElementById("myCheck").checked){

       var end = document.getElementById('test1').value;

     directionsService.route({
       origin: document.getElementById('start').value,
       destination: document.getElementById('end').value,
       waypoints: waypts.slice(1,end+1),
       optimizeWaypoints: true,
       travelMode: 'DRIVING'
     }, function(response, status) {
       if (status === 'OK') {
         directionsDisplay.setDirections(response);
         var route = response.routes[0];
         var summaryPanel = document.getElementById('directions-panel');
         summaryPanel.innerHTML = '';
         // For each route, display summary information.
         for (var i = 0; i < route.legs.length; i++) {
           var routeSegment = i + 1;
           summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
               '</b><br>';
           summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
           summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
           summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
         }
       } else {
         window.alert('Route ' + status+' please enter origin/destination points');
       }
     })
} else{directionsService.route({
  origin: document.getElementById('start').value,
  destination: document.getElementById('end').value,
  waypoints: waypts,
  optimizeWaypoints: true,
  travelMode: 'DRIVING'
}, function(response, status) {
  if (status === 'OK') {
    directionsDisplay.setDirections(response);
    var route = response.routes[0];
    var summaryPanel = document.getElementById('directions-panel');
    summaryPanel.innerHTML = '';
    // For each route, display summary information.
    for (var i = 0; i < route.legs.length; i++) {
      var routeSegment = i + 1;
      summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
          '</b><br>';
      summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
      summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
      summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
    }
  } else {
    window.alert('Route ' + status+' please enter origin/destination points');
  }
})}
     ;
   }
 </script>

<script src="js/mapi.js" type="text/javascript">
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-LW6fyInExELEgImDzU1sQ7jtSRTokOo&callback=initMap">
</script>
</body>
</html>
