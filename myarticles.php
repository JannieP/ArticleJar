<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');
  extract($GLOBALS);
  $_SESSION['Header']=6;
  $_SESSION['UserTab']=1;
  //$vOperation=htmlspecialchars($_GET["ajc"]);
  $vP=htmlspecialchars($_GET["ajp"]);
  $vF=htmlspecialchars($_GET["ajf"]);
  
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
<script language="javascript">
function confirm_delete()
{
		var resp = confirm('Delete This Article! Are you Sure?')
		if (resp)
		{
		   window.location="article.php?aja=11340";
		   return true;
		}
		else
		{
		   return false;
		}
}
</script>
<title>ArticleJar.com - My Articles</title>
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
			    $_GET['aje'] = $_SESSION['luemail'];
				$_GET['ajrefer'] = $_SERVER['PHP_SELF'];
				
				if (!$vP.""=="")
				{
				   $_GET['ajp'] = $vP;
				}
				if (!$vF.""=="")
				{
				   $_GET['ajf'] = $vF;
				}
			    include('list_articles.php');

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
