<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  $_SESSION['Header']=5;
  
  if ($_SESSION['UserIsOK'])
  {
  	$vemail = $_SESSION['luemail'];
  } 


  $vOperation=htmlspecialchars($_GET["a"]);
  if ($vOperation.""=="contact")
  {
    $uemail='jannie.pieterse@gmail.com';
	$subject='Contact From Articlejar.com';
	$from = 'ArticleJar <support@articlejar.com>';
	$headers = 'From: $from';
	
	$message = ''.$_POST['message'].'  from:- '.$_POST['emailaddress'].'';
	
	mail($uemail,$subject,$message,$headers);

    $vmessage="Message Sent";
    $_SESSION['Message']="".$vmessage;
    header('Location: message.php');
  }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - Contact</title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><?php include ('header.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="18">&nbsp;</td>
    <td width="144">&nbsp;</td>
    <td width="570">
	<form id="contact" name="contact" method="post" action="contact.php?a=contact">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="auth_cell_head">
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="21%">My Email Address: </td>
          <td width="73%">
		  <?php 
		     if ($_SESSION['UserIsOK'])
			 {
			 	echo $vemail.'<input type="hidden" name="emailaddress" value"'.$vemail.'">';
			 }
			 else
			 {
			 	echo '<input type="text" name="emailaddress">';
			 }
		  ?>
		  </td>
          <td width="3%">&nbsp;</td>
        </tr>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><textarea name="message" rows="5" cols="50"></textarea></td>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit_contact" value="Submit" /></td>
		<td>&nbsp;</td>
		</tr>
      </table>

	  </form></td>
    <td width="18">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
