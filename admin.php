<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  $_SESSION['Header']=7;

  $vsql="select * from `article` where status='w'"; 

  if(($result = $db->sql_query($vsql)) )
  {
	$row = $db->sql_fetchrow($result);
	$afrow = $db->sql_affectedrows();
	//$vdisplay=$row['article'];
	
  }
  
	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - Admin</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" valign="bottom"><?php include ('header.php') ?><?php include ('admintabs.php') ?></td>
  </tr>
  
  <tr>
    <td width="18">&nbsp;</td>
    <td width="714">
	<div>
	<?php 
		if ($afrow>0) 
		{ 
			echo '<table width="100%" >';
			echo '<tr>';
			echo '<td background="images/tbhdr.jpg">';
			echo 'Articles Wanting to go LIVE:';
			echo '</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td class="auth_cell_head">';
		
			for ($r=0;$r<$afrow;$r++)
			{
			
				$vsql1="select * from `users` ";
				$vsql1=$vsql1."where `user_email`='".$row['author']."' ";
				$result1 = $db->sql_query($vsql1);
				$row1 = $db->sql_fetchrow($result1);

				echo '<table>'; 
				echo '<tr>';
				echo '<td>';
				echo '<a href="article.php?aja='.$row['id'].'">'.$row['title'].'</a> - by '.$row1['user_firstname'].' '.$row1['user_lastname'].'';
				echo '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="grey_text">';
				echo $row['excerpt'];
				echo '</td>';
				echo '</td>';
				echo '</tr>';
				echo '</table>';
				$row = $db->sql_fetchrow($result);
			}
			echo '</td>';
			echo '</tr>';
			echo '</table>';

		}
	?>
	</div>
	&nbsp;</td>
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
