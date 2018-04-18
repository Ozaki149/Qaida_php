<?php 
session_start();
    if(isset($_POST['EMail']))
    {
        if($_POST['EMail'] == "Kest@aa.cc" && $_POST['pass'] == '8064')
        {
             echo "<script> alert('Welcome, user');</script>";
            
            $_SESSION['EMail'] = $_POST['EMail'];
			
			setcookie('EMail', $_POST['EMail'] , time() + 10000);
			
			header("location: /Web3_V3/Home.php");
		}
		else 
		{         echo "<script> alert('Invalid username or password');</script>";
				header("location: /Web3_V3/Home.php");
        }
    }
?>
