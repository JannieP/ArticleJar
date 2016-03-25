<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');
  extract($GLOBALS);

  $vOperation=htmlspecialchars($_GET["ajc"]);
//  $vIsPerma = 0;
//  $vCSS = $_SERVER["SERVER_NAME"].'/aj/css/aj.css';
//  $vCSS2 = $_SERVER['PATH_INFO'];
//  $vSELF = $_SERVER['SCRIPT_NAME'];
//  $vCSS3 = 'css/aj.css';
//  echo $vCSS.'-1<br>';
//  echo $vCSS2.'-2<br>';
//  echo $vSELF.'-4<br>';
//  echo ABSPATH.'-5<br>';
//  echo '567890<br>';
// echo '-'.$vOperation.'-<br>';
//  $url = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
//  echo $url;
//  $vfffname = dirname(__FILE__);
 //echo $vfffname.'-3';

  
//  if ($vOperation.""=="")
//  {
//     //echo '123';
//	 $vIsPerma = 1;
//     $url = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
//	 echo $url.'<br>';
//     $url = explode('/', $url);
//	 echo sizeof($url).'<br>';
//	 for($i = 0; $i < sizeof($url)-1; $i++)
//	 {
//	    
//	    $vCSS3 = '../'.$vCSS3;
//		echo $vCSS3.'<br>';
//	 }
//     $ind = 0;
//     $vOperation = $url[1];
//	 echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
//  }	 


  
//foreach ($url as $slug)
//{
//echo $ind++.'->'.$slug.'<br>';
//}
  
//  define('MAINDIR',dirname(__FILE__) . '/');
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

<title>ArticleJar.com - Group</title>
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
                <td><?php include ('sidebarleft.php'); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td width="64%" valign="top" align="left">
		  <?php 
		     if (!$vOperation.""=="")
			 {
			    $_GET = array();
			    $_GET['ajg'] = $vOperation;
			    include('list_categories.php');
			 }
			 else
			 {
			    include('list_categories.php');
			 } 
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
