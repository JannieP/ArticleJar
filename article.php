<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  $vOperation=htmlspecialchars($_GET["aja"]);
  $vdisplay="";
  $vauthoremail=$_SESSION['luemail'];
  if (!$vOperation.""=="")
  {
	  $vsql="select * from `article` where id=".$vOperation;
      if (!$_SESSION['UserIsAdmin'])
	  {
		  $vsql=$vsql." and (`status`='c' ";
		  $vsql=$vsql." or `author`='".$_SESSION['luemail']."') ";
		  
	  }
     
 
	  if(($result = $db->sql_query($vsql)) )
	  {
	  	$row = $db->sql_fetchrow($result);
		$afrow = $db->sql_affectedrows();
		if($afrow == 0)
		{
        	header('Location: home.php');
		}

		$vauthor=$row['author'];
		if (!$vauthor == $_SESSION['luemail'])
		{
		  $vsql1 = "Update `article` set `views`=`views`+1 where id=".$vOperation;
		  $result = $db->sql_query($vsql1);
		}
		$vtitle=$row['title'];
		$vstatus=$row['status'];
		$varticle=$row['id'];
		$vdisplay=$row['article'];
		//$str     = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
		$order   = array("\r\n", "\n", "\r");
		$replace = '<br />';
		// Processes \r\n's first so they aren't converted twice.
		$vdisplay = str_replace($order, $replace, $vdisplay);

	    $vsql1="select * from `users` where `user_email`='".$vauthor."'";
        $result1 = $db->sql_query($vsql1);
		$row1 = $db->sql_fetchrow($result1);
		$vufname=$row1['user_firstname'];
		$vulname=$row1['user_lastname'];
		$vuadsenseid=$row1['user_adsense_pub_id'];
        $vauthorid=$row1['id'];
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
<meta name="description" content="<?php echo $vtitle; ?>" />
<meta name="keywords" content="<?php echo $vtitle; ?>" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - Article - <?php echo $vtitle; ?></title>
</head>

<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><?php include ('header.php') ?></td>
  </tr>
  <tr>
    <td height="100" colspan="3" align="center"><?php include('adsense_leaderboard.php'); ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
  <td valign="top"><?php include('adsense_skyscraper.php'); ?></td>
  <td valign="top" align="left"> 
  <table>
  <tr>
    <td>&nbsp;</td>
    <td><H1><?php echo $vtitle; ?></H1><p>By <a href="author.php?id=<?php echo $vauthorid; ?>"><?php echo $vufname.' '.$vulname; ?></a></p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php include('adsense_block.php'); ?>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="714" class="auth_cell_head"><div><?php if (!$vdisplay=="") { echo $vdisplay; }?><br /><br /> Article source:<?php echo '<a href="?aja='.$varticle.'">http://www.articlejar.com?aja='.$varticle.'</a>'; ?></div> </td>
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
		    echo '<table>';
			echo '<tr>';
			echo '<td>';
		  	echo '<form action="submit_form.php?a=e&aja='.$varticle.'" method="post">';
			echo '<input type="submit" name="submit_edit" value="Edit" />';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		  
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
