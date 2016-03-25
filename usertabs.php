<div id="adminheader">
  <center>
    <div id="navcontainer">
      <ul id="navlistb">
        <li><a <?php if($_SESSION['UserTab']==1){echo 'id="current"';} ?> href="myarticles.php">My Articles</a></li>
        <li><a <?php if($_SESSION['UserTab']==2){echo 'id="current"';} ?> href="userupdate_form.php">My Profile</a></li>
        <li><a <?php if($_SESSION['UserTab']==3){echo 'id="current"';} ?> href="userbio.php">My Biography</a></li>
        <li><a <?php if($_SESSION['UserTab']==4){echo 'id="current"';} ?> href="userauthors.php">My Fellow Authors</a></li>
        <li><a <?php if($_SESSION['UserTab']==5){echo 'id="current"';} ?> href="mystats.php">My Stats</a></li>
      </ul>
    </div>
  </center>
</div>