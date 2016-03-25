<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
include('session.php');

extract($GLOBALS);

    $graphType = 'vBar';
    $graphShowValues = 2;
    $graphValues = '123,456,789,987,654,321';
    $graphLabels = 'Horses,Dogs,Cats,Birds,Pigs,Cows';
    $graphBarWidth = 20;
    $graphBarLength = '1.0';
    $graphLabelSize = 12;
    $graphValuesSize = 12;
    $graphPercSize = 12;
    $graphPadding = 10;
    $graphBGColor = '#ABCDEF';
    $graphBorder = '1px solid blue';
    $graphBarColor = '#A0C0F0';
    $graphBarBGColor = '#E0F0FF';
    $graphBarBorder = '2px outset white';
    $graphLabelColor = '#000000';
    $graphLabelBGColor = '#C0E0FF';
    $graphLabelBorder = '2px groove white';
    $graphValuesColor = '#000000';
    $graphValuesBGColor = '#FFFFFF';
    $graphValuesBorder = '2px groove white';

$vsql1="Select max(views) as vmax from `article` where `author`='".$_SESSION['luemail']."' ";
$result = $db->sql_query($vsql1);
$row = $db->sql_fetchrow($result);
$vmax = $row['vmax'];

$vsql="select * from `article` where `id`=".$_GET["a"]." ";
//$vsql=$vsql."order by `views` DESC ";
//$vsql=$vsql."limit 10";
$result = $db->sql_query($vsql);
	$row = $db->sql_fetchrow($result);
	$afrow = $db->sql_affectedrows();

?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - Author Article Stats</title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><?php include ('header.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="18">&nbsp;</td>
    <td width="144">
	<?php 

	?>
	&nbsp;</td>
    <td width="570">
<?php
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
	if ($afrow>0)
	{
       $graphValues = ''.$row['views'].','.$vmax.'';
       $graphLabels = 'This Article Views,Top Article Views';

       //echo $graphValues;
	  if($graphValues!="") {
		include('graphs_php/graphs.inc.php');
		$graph = new BAR_GRAPH($graphType);
		$graph->values = $graphValues;
		$graph->labels = $graphLabels;
		$graph->showValues = $graphShowValues;
		$graph->barWidth = $graphBarWidth;
		$graph->barLength = $graphBarLength;
		$graph->labelSize = $graphLabelSize;
		$graph->absValuesSize = $graphValuesSize;
		$graph->percValuesSize = $graphPercSize;
		$graph->graphPadding = $graphPadding;
		$graph->graphBGColor = $graphBGColor;
		$graph->graphBorder = $graphBorder;
		$graph->barColors = $graphBarColor;
		$graph->barBGColor = $graphBarBGColor;
		$graph->barBorder = $graphBarBorder;
		$graph->labelColor = $graphLabelColor;
		$graph->labelBGColor = $graphLabelBGColor;
		$graph->labelBorder = $graphLabelBorder;
		$graph->absValuesColor = $graphValuesColor;
		$graph->absValuesBGColor = $graphValuesBGColor;
		$graph->absValuesBorder = $graphValuesBorder;

   		echo '<table width="80%">';
		echo '<tr>';
		echo '<td>';
		echo '<a href="article.php?aja='.$row['id'].'">'.$row['title'].'</a>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="grey_text">';
		echo $row['excerpt'];
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo $graph->create();
		echo '</td>';
		echo '</tr>';
		echo '</table>';


		
	  }
	  else echo '<h4>No values!</h4>';
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
	
	</td>
    <td width="18">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
