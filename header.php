
<div id="header">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="contact.php"><img src="images/QAlogi.gif"></a>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

        <li><a href="Contact.php">Map</a></li>
		<li>
      <?php
          if(isset($_SESSION['username']))
          {
           echo "<a href='arty.php'>Places</a>";

          }
      ?>
      </li>

		<li>
            <?php
                if(isset($_SESSION['username']))
                {
	               echo "";
                 if ($_SESSION['username']=='rixxter'){echo "<a href='all_users.php'>All Users</a>";}
                }else
                {
                    echo
                    "<a href='Regform.php'>Registration</a>";
                }
            ?>
            </li>
            <li><a href="help.php">help!</a></li>
      </ul>
        <div class="item">
                <a class="link icon_find"></a>
                <div class="item_content">
                    <p>
                        <input type="text">
                        <a href="">Go</a>
                    </p>
                </div>
            </div>
      <ul class="nav navbar-nav navbar-right">
        <li>
            <?php

if(isset($_SESSION['username']))
{

	echo "<a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> ";
    echo "Logout ".$_SESSION['username'];
    echo " ";
        echo"</a>";
}
else
{
echo
"<a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a>";
}

?></li>
      </ul>
    </div>
  </div>
</nav>
    </div>
