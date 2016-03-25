<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');
  extract($GLOBALS);
  $_SESSION['Header']=6;
  $_SESSION['UserTab']=4;
  $vP=htmlspecialchars($_GET["ajp"]);
  
  $vA=htmlspecialchars($_GET["ua"]);
  $vR=htmlspecialchars($_GET["ur"]);
  $vH=htmlspecialchars($_GET["uh"]);
  $vUid=$_SESSION['luid'];
  
  if(!$vA.""=="")
  {
	  $vsql1 = "Update `fellow_authors` set `status`=1 where `fellow_author_id`=".$vUid.' and `main_author_id`='.$vA.'';
	  $result = $db->sql_query($vsql1);
  }
  if(!$vR.""=="")
  {
	  $vsql1 = "Update `fellow_authors` set `status`=3 where `fellow_author_id`=".$vUid.' and `main_author_id`='.$vR.'';
	  $result = $db->sql_query($vsql1);
  }
  if(!$vH.""=="")
  {
	  $vsql1 = "Update `fellow_authors` set `status`=4 where `fellow_author_id`=".$vUid.' and `main_author_id`='.$vH.'';
	  $result = $db->sql_query($vsql1);
  }
  
  define('MAINDIR',dirname(__FILE__) . '/');
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
@import "css/aj.css";
</style>
<title>ArticleJar.com - Fellowship</title>
</head>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><?php include ('header.php') ?><?php include ('usertabs.php') ?></td>
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
                <td><?php include ('sidebarleft.php'); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td width="64%" valign="top" align="left">
		  
		  <?php 
		        //echo $_SESSION['luemail'];
			    $_GET = array();
			    $_GET['t'] = "fellow";
				$_GET['id'] = $_SESSION['luid'];
				$_GET['ajrefer'] = $_SERVER['PHP_SELF'];
				if (!$vP.""=="")
				{
				   $_GET['p'] = $vP;
				}
			    include('list_authors.php');

			?>

			</td>
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
