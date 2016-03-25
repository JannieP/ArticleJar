<?php
  session_start();
  session_register("UserIsOK_session");
  include('../db/db.php');
  extract($GLOBALS);
  if ($_SESSION['UserIsOK'])
  {
  	$vLogedinas="You are logged in as:".$_SESSION['luser'];
  } 
  else
  {
  	$vLogedinas="You are NOT Logged on";
  }
  $vOperation=htmlspecialchars($_GET["author"]);
  $vdisplay="";
  if (!$vOperation.""=="")
  {
	  $vsql="select * from `users` where id=".$vOperation;

	  if(($result = $db->sql_query($vsql)) )
	  {
	  	$row = $db->sql_fetchrow($result);
		$vufname=$row['user_firstname'];
		$vulname=$row['user_lastname'];
		$vucountry=$row['user_country'];
		$vuadsenseid=$row1['user_adsense_pub_id'];
		//$vuaid=$vuadsenseid;
		if ($vuadsenseid.""=="")
		{
			$vuadsenseid='pub-0277044545832511';
			$vuadsensechannel='8308980023';
		}
		else
		{
			$vuadsensechannel=$row1['user_adsense_channel'];
			if ($vuadsensechannel.""=="")
			{
				$vuadsensechannel='';
			}
		}
		
	  }
  
	 
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "../css/aj.css";</style>
<title>ArticleJar.com - Article</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><?php include ('../header.php') ?></td>
  </tr>
  <tr>
    <td height="100" colspan="3" align="center"><?php include('../adsense_leaderboard.php'); ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
  <td valign="top"><?php include('../adsense_skyscraper.php'); ?></td>
  <td valign="top"> 
  <table>
  <tr>
    <td>&nbsp;</td>
    <td><H1><?php echo $vtitle; ?></H1><p>By <?php echo $vufname.' '.$vulname; ?></p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php include('../adsense_block.php'); ?>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="714"><div><?php if (!$vdisplay=="") { echo $vdisplay; }?></div> </td>
    <td width="18">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?php 
	   if ($_SESSION['UserIsAdmin'])
	   {
	      if ($vstatus=='w')
		  {
		    echo '<table>';
			echo '<tr>';
			echo '<td>';
		  	echo '<form action="approve.php?a=a" method="post">';
			echo '<input type="hidden" name="articleid" value="'.$varticle.'" />';
			echo '<input type="submit" name="submit_approve" value="Approve" />';
			echo '</form>';
			echo '</td>';
			echo '<td>';
			echo '<form action="approve.php?a=r" method="post">';
			echo '<input type="hidden" name="articleid" value="'.$varticle.'" />';
			echo '<input type="submit" name="submit_approve" value="Reject" />';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
			echo '</table>';

		  }
	   }
	?>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>  </td>
  <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
