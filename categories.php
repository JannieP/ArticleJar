<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
extract($GLOBALS);
  if (!$_SESSION['UserIsOK'])
  {
  	//$vLogedinas="You are logged in as:".$_SESSION['luser'];
  	header('Location: register_form.php');
  } 

$vsql="select a.id,a.name,b.group_name,b.id as gid from `category` a,`groups` b ";
$vsql=$vsql."where a.`group`=b.`id` ";
$vsql=$vsql."order by a.`status` DESC,a.`name`";
//echo $vsql;
if( !($result = $db->sql_query($vsql)) )
{

	echo '<table width="100%" border="1">';
	echo '<tr>';
	echo '<td></td>';
	echo '</tr>';
	echo '</table>';
}
else
{
	$row = $db->sql_fetchrow($result);
	$afrow = $db->sql_affectedrows();
	if ($afrow>0)
	{
		echo '<table width="100%" >';
		echo '<tr>';
		echo '<td background="images/tbhdr.jpg">';
		echo 'Categories:';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="auth_cell_head">';
		//echo $afrow;
		for ($b=0;$b<$afrow;$b++)
		{
		echo '<table width="100%" border="1">';
		echo '<tr>';
		echo '<td>';

		echo '<form action="cat_group_submit.php">';
		echo '<table width="100%">';
		echo '<tr align="left" width="25%">';
		echo '<td>';
		echo ''.$row['name'].'';
		echo '<input name="category" type="hidden" value="'.$row['id'].'">';
		echo '</td>';
		echo '<td align="right" width="25%">';
	    $_GET = array();
	    $_GET['g'] = $row['gid'];
		include('group_select.php');
		echo '</td>';
		echo '<td align="right" width="25%">';
		echo '<input type="submit" value="submit" onclick="dosubmit();">';
		echo '</td>';
		
		echo '</tr>';
		echo '</table>';
		
		echo '</form>';
		
		echo '</td>';
		echo '</tr>';
		
		
		$row = $db->sql_fetchrow($result);
		}
		if ($afrow > 0)
		{
			echo '<tr><td></td></tr>';
			echo '</table>';
		}
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	}
	else
	{
		echo '<table width="100%" border="1">';
		echo '<tr>';
		echo '<td></td>';
		echo '</tr>';
		echo '</table>';
	}
}
  

?>