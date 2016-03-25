<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');
  extract($GLOBALS);

  $vOperation=htmlspecialchars($_GET["ajc"]);
  $vP=htmlspecialchars($_GET["ajp"]);
  $vF=htmlspecialchars($_POST["ajf"]);
  $vTop=htmlspecialchars($_GET["ajtop"]);
  //echo $vTop.'-0<br>';
  
  define('MAINDIR',dirname(__FILE__) . '/');
//  $vsql="select * from `groups` ";
//  if (!$vOperation.""=="")
//  {
//     $vsql = $vsql."where id =";
//  }
//  $result = $db->sql_query($vsql)
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
@import "css/aj.css";
</style>
<title>ArticleJar.com - Category</title>
</head>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><?php include ('header.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="18">&nbsp;</td>
    <td width="714"><table width="100%">
        <tr>
          <td width="18%" valign="top"><table width="100%">
              <tr>
                <td ><?php include ('sidebarleft.php'); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td width="64%" valign="top" align="left">
		  <?php 
		    $_GET = array();
			$_GET['ajrefer'] = $_SERVER['PHP_SELF'];
			if (!$vTop.""=="")
			{
			   $_GET['ajtop'] = $vTop;
			}
			
			if (!$vP.""=="")
			{
			   $_GET['ajp'] = $vP;
			}
			if (!$vF.""=="")
			{
			   $_GET['ajf'] = $vF;
			}
			if (!$vOperation.""=="")
			{
			   $_GET['ajc'] = $vOperation;
			}
		    include('list_articles.php');
			?></td>
          <td width="18%" valign="top">
		  <table width="100%">
              <tr>
                <td><?php include ('sidebarright.php'); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table>
		  </td>
        </tr>
      </table></td>
    <td width="18">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
