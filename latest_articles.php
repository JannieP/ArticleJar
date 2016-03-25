<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
include('session.php');

extract($GLOBALS);

$vsql="select * from `article` ";
$vsql=$vsql."where status='c' ";
$vsql=$vsql."order by `date` DESC ";
$vsql=$vsql."limit 20";
  
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
		echo 'Most Recent Articles to go LIVE:';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="auth_cell_head">';
	    for ($b=0;$b<$afrow;$b++)
		{
		
		$vsql1="select * from `users` ";
		$vsql1=$vsql1."where `user_email`='".$row['author']."' ";
		$result1 = $db->sql_query($vsql1);
		$row1 = $db->sql_fetchrow($result1);
		
		echo '<table width="100%">';
		echo '<tr>';
		echo '<td>';
		echo '<a href="article.php?aja='.$row['id'].'&a='.$row['title'].'">'.$row['title'].'</a> - by '.$row1['user_firstname'].' '.$row1['user_lastname'].'';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="grey_text">';
		echo $row['excerpt'];
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		$row = $db->sql_fetchrow($result);
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