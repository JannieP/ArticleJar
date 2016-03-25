<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
extract($GLOBALS);

$vsql="select * from `groups` ";

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
		if ($afrow > 0)
		{
			echo '<table width="100%">';
		}
		$c = 0;
	    for ($b=0;$b<$afrow;$b++)
		{
		if ($c == 3)
		{
		   $c = 0 ;
		}
		$c = $c + 1;
		
		//$vsql1="select * from `groups` ";
		
		//$result1 = $db->sql_query($vsql1);
		//$row1 = $db->sql_fetchrow($result1);
		
		if ($c == 1){
			echo '<tr>';
		}

		echo '<td>';
		echo '<a href="group.php?ajc='.$row['id'].'&g='.$row['group_name'].'">'.$row['group_name'].'</a>';
//		echo '<a href="group.php/'.$row['id'].'/'.$row['group_name'].'">'.$row['group_name'].'</a>';
		echo '</td>';

		if ($c == 3){
			echo '</tr>';
		}
		
		
		$row = $db->sql_fetchrow($result);
		}
		if ($afrow > 0)
		{
			echo '<tr><td colspan="3"></td></tr>';
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