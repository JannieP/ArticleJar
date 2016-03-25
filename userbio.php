<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  $_SESSION['Header']=6;
  $_SESSION['UserTab']=3;
  
  if ($_SESSION['UserIsOK'])
  {
  

  
  	$vemail = $_SESSION['luemail'];
$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="update")
{
  if ($_POST["userbio"]!="")
  {
  
  	  $vbio=str_replace("\'","'",$_POST["userbio"]);
	  $vbio = mysql_real_escape_string($vbio);
//echo $vbio.'<br>';
      $vsql="update `users` set `user_bio`='".$vbio."' where upper(user_email)=";
      $vsql=$vsql."'".$vemail."' ";
//echo $vsql.'<br>';
	  
    if( !($result = $db->sql_query($vsql)) )
    {
        $vmessage="Bio Update Failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
        $vmessage="Bio Updated";
  }
}


    $vsql="select * from `users` where upper(user_email)=";
    $vsql=$vsql."'".strtoupper($vemail)."' ";
//echo $vsql.'<br>';
    if( !($result = $db->sql_query($vsql)) )
    {
        $vmessage="User Data Retrieval Failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();
    if($afrow>0)
    {
      $ubio=$row["user_bio"];   
    }
    else
    {
        $vmessage="User Data Retrieval Failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

  	
  } 
  else
  {
  	$vLogedinas="You are NOT Logged on";
    $_SESSION['Message']="".$vLogedinas;
    header('Location: message.php');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - User Bio</title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><?php include ('header.php') ?><?php include ('usertabs.php') ?></td>
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
	<form id="bio" name="bio" method="post" action="userbio.php?voperation=update">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="3%">&nbsp;</td>
          <td colspan="2">Tell Us About YOU:</td>
          <td width="3%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><textarea name="userbio" cols="50" rows="10"><?php echo $ubio; ?></textarea></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><?php echo $vmessage; ?></td>
          <td>&nbsp;</td>
        </tr>
		<tr>
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="submit_bio" value="Update" /></td>
		<td>&nbsp;</td>
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
