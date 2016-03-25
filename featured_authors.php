<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
include('session.php');
extract($GLOBALS);
$vsql="select * from `users`";
$vsql=$vsql."order by rand() ";
$vsql=$vsql."limit 5";
$vuadsenseid='pub-0277044545832511';
$vuadsensechannel='8308980023';

  
if( !($result = $db->sql_query($vsql)) )
{

	echo '<table width="100%" border="0">';
	echo '<tr>';
	echo '<td></td>';
	echo '</tr>';
	echo '</table>';
}
else
{
	echo '<table width="100%" border="0">';
	echo '<tr>';
	echo '<td width="116" align="center" background="images/tbhdr.jpg">Stats</td>';
	echo '</tr>';
	echo '</table>';
    echo '<table width="100%" class="auth_cell_head">';
	echo '<tr>';
	echo '<td>';
	echo '<a href="articles.php?ajtop=1">Top 10 Articles</a>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo '<a href="authors.php?t=top">Top 10 Authors</a>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table width="100%" class="auth_cell_head">';
	echo '<tr>';
	echo '<td>';
	include("adsense_skyscraper.php"); 
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table width="100%" border="0">';
	echo '<tr>';
	echo '<td width="116" align="center" background="images/tbhdr.jpg">Featured Authors</td>';
	echo '</tr>';
	echo '</table>';

	$row = $db->sql_fetchrow($result);
	$afrow = $db->sql_affectedrows();
	if ($afrow>0)
	{
	    for ($b=0;$b<$afrow;$b++)
		{
		echo '<table width="100%" class="auth_cell_head">';
		echo '<tr>';
		echo '<td  bgcolor="#A9A9F5">';
		echo '<a href="author.php?id='.$row['id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</a><br>';
		//echo '<a href="http://'.$row['user_weburl'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</a><br>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo 'from '.$row['user_country'].'';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo ''.$row['user_articles'].' Submited Articles';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo ''.$row['user_active_articles'].' Live Articles';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		$row = $db->sql_fetchrow($result);
		}
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