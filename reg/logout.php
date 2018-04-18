<?php 
	session_start();

			echo "
		<form action = '' method = 'post'>
			<input type='submit' value = 'logout' name = 'btn-logout'>
			<input type='submit' value = 'cancel' name = 'btn-cancel'>
		</form>
		";

	
	if(isset($_SESSION['EMail']))
	{
		if (isset($_POST['btn-logout']))
		{
			unset($_SESSION['EMail']);
			session_destroy();
			unset($_COOKIES['EMail']);
            setcookie("EMail", $_COOKIE["EMail"], time()-100, "/Web3_V3");
			header("Location: /Web3_V3/Home.php");
		}
		
		if (isset($_POST['btn-cancel']))
		{
		header("Location: /Web3_V3/Home.php");
		}
	}
	else  
	{
		header("Location: /Web3_V3/Home.php");
	}
	
?>