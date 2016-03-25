<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
extract($GLOBALS);

$vOperation=htmlspecialchars($_GET["ajg"]);

$vsql="select * from `category` ";

if (!$vOperation.""=="")
{
   $vsql=$vsql."where `group`=".$vOperation." ";
   //echo $vsql;
}

$vsql=$vsql."order by `name`";

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

		if ($afrow > 0)
		{
			echo '<table width="100%">';
		}
		$c = 0;
	    for ($b=0;$b<$afrow;$b++)
		{
		//echo $b;
		if ($c == 3)
		{
		   $c = 0 ;
		}
		$c = $c + 1;
		
		if ($c == 1){
			echo '<tr>';
		}

		echo '<td>';
		echo '<a href="articles.php?ajc='.$row['id'].'&c='.$row['name'].'">'.$row['name'].'</a>';
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