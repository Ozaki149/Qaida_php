<?php
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
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<script> alert( 'Sorry, file is alredy exist' );
			</script>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<script> alert( 'Sorry, your file is too large.' );
			</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script> alert( 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.' );
			</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script> alert( 'Sorry, your file was not uploaded.' );
			</script>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<script> alert( 'The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.' );
			</script>";
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

$namik = $_POST['namik'];

$place = $_POST['place'];
$descr = $_POST['descr'];

$item_image = $target_dir;
if($namik == ''|| $place == '' || $descr == ''){
	echo "Error";
}else{
	if(!$connection){
		echo 'Error: '.mysqli_error();
	}
	else{
	$DB = "INSERT INTO item(item_namik , item_place , item_descr , item_image) VALUES ('".$namik."','".$place."','".$descr."','".$name."')";
	mysqli_query($connection , $DB);
	header("location: ../fri1/home.php");
	}

	mysqli_close($connection);
	}

}
}

header("Refresh:0; marsh.php");
?>
