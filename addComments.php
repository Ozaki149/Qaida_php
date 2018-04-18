<?php
$item=$_GET['id'];
$commentaries = mysqli_query($link,"SELECT * FROM comments WHERE item_id = '$item'");
if(mysqli_num_rows($commentaries) > 0){
$row_c = mysqli_fetch_array($commentaries);
do{

echo '
<center>
<br/>

<p>'.$row_c["comment_info"].'</p>
<hr/></center>
';

}while($row_c = mysqli_fetch_array($commentaries));
}

?>
<?php
If(isset($_POST['cadd'])){
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'mysqlq';
$today = date("Y-m-d H:i:s");
$link = mysqli_connect($host , $username , $password , $db);
mysqli_select_db($link,"new");

mysqli_query($link,"INSERT INTO comments (comment_owner,item_id,comment_info,comment_date)
VALUE(
'".$_SESSION['username']."',
'".$_GET['id']."',
'".$_POST["cbody"]."',
'".$today."'

)");
}
header("Location:pages.php?id=".$_GET['id']);
?>
