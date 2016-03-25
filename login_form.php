<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  $_SESSION['Header']=3;

  if ($_SESSION['UserIsOK'])
  {
  	$vmessage="You are allready Registered and Loged in.";
    $_SESSION['Message']="".$vmessage;
    header('Location: message.php');
  } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - Login</title>
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
    <td width="18">&nbsp;</td>
    <td width="696" align="center" border="1">
	<table>
	<tr>
	<td class="auth_cell_head">
      <form id="login1" name="logon" method="post" action="login.php?voperation=login">
        <table>
          <tr>
            <td width="144">Email:</td>
            <td><input name="uname" type="text" /></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><input type="password" name="upwd" /></td>
          </tr>
        </table>
		<table align="right">
		<tr>
		<td>
        <input type="submit" name="submit_login" value="Login" />
		</td>
		</tr>
		</table>
      </form>
	  </td>
	  </tr>
	  </table>
    </td>
    <td width="18">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" border="1">
	<table>
	<tr>
	<td class="auth_cell_head">
      <form id="resend1" name="resend" method="post" action="resend_confirm.php?voperation=resend">
        <table>
          <tr>
            <td width="144">Email:</td>
            <td><input name="uname" type="text" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<table align="right">
		<tr>
		<td>
        <input type="submit" name="submit_resend" value="Resend Confirmation" />
		</td>
		</tr>
		</table>
      </form>    
	  </td>
	  </tr>
	  </table>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" border="1">
	<table>
	<tr>
	<td class="auth_cell_head">
      <form id="send2" name="send_pwd" method="post" action="send_pwd.php?voperation=resend">
        <table>
          <tr>
            <td width="144">Email:</td>
            <td><input name="uname" type="text" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<table align="right">
		<tr>
		<td>
        <input type="submit" name="submit_Send2" value="Send Password" />
		</td>
		</tr>
		</table>
      </form>    
	  </td>
	  </tr>
	  </table>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
