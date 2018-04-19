<nav class="navbar navbar-expand-lg navbar-dark indigo">
  <a class="navbar-brand" href="contact.php"><img src="images/logo.gif" height="50em"></a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
  aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="basicExampleNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="Contact.php">
          <span class="sr-only">Map</span>
        </a>
      </li>
      <li class="nav-item">
        <?php
        if(isset($_SESSION['username']))
        {
        echo "<a class='nav-link' href='arty.php'>Places</a>";
        }
        ?>
      </li>
      <li class="nav-item">
        <?php
        if(isset($_SESSION['username']))
        {
          echo "";
        if ($_SESSION['username']=='rixxter'){echo "<a class='nav-link' href='all_users.php'>All Users</a>";}
        }else
        {
        echo
        "<a href='Regform.php' class='nav-link'>Registration</a>";
        }
        ?>
      </li>
      <li class="nav-item"><a class="nav-link" href="help.php">help!</a></li>
      <li class="nav-item">
        <?php
        if(isset($_SESSION['username']))
        {
        echo "<a class='nav-link' href='logout.php'> ";
          echo "Logout ".$_SESSION['username'];
          echo " ";
        echo"</a>";
        }
        else
        {
        echo
        "<a class='nav-link' href='login.php'> Login</a>";
        }
      ?></li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
      
      <form class="form-inline">
        <div class="md-form mt-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        </div>
      </form>
    </ul>
  </div>
</nav>