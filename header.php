<style type="text/css">@import "css/aj.css";</style>
<div id="header">
  <center>
    <img src="images/articlejar_logo.jpg" alt="" width="411" height="98" />
    <div id="navcontainer">
      <ul id="navlist">
        <li><a <?php if($_SESSION['Header']==1){echo 'id="current"';} ?> href="home.php">Home</a></li>
        <li><?php if ($_SESSION['UserIsOK']){}else{echo '<a '; if($_SESSION['Header']==2){echo 'id="current"';} echo ' href="register_form.php">Register</a>';} ?></li>
        <li><?php if ($_SESSION['UserIsOK']){}else{echo '<a '; if($_SESSION['Header']==3){echo 'id="current"';} echo ' href="login_form.php">Login</a>';} ?></li>
        <li><?php if ($_SESSION['UserIsOK']){echo '<a '; if($_SESSION['Header']==4){echo 'id="current"';} echo ' href="submit_form.php">Submit</a>';} ?></li>
        <li><a <?php if($_SESSION['Header']==5){echo 'id="current"';} ?> href="contact.php">Contact Us</a></li>
        <li><?php echo $vLogedinas; if ($_SESSION['UserIsOK']){echo '<a href="logout.php">[logout]</a>';} ?></li>
        <li><?php if ($_SESSION['UserIsOK']){echo '<a '; if($_SESSION['Header']==6){echo 'id="current"';} echo ' href="myarticles.php">My Jar</a>';} ?></li>
        <li><?php if ($_SESSION['UserIsAdmin']){echo '<a '; if($_SESSION['Header']==7){echo 'id="current"';} echo ' href="admin.php">Admin</a>';} ?></li>
        <li><?php if ($_SESSION['UserIsAdmin']){echo '<a id="bad" href="import.php">Import</a>';} ?></li>
      </ul>
    </div>
  </center>
</div>