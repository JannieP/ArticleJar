<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
include('session.php');

extract($GLOBALS);

$vResultsPerPage = 10;

$vC=htmlspecialchars($_GET["ajc"]);
$vE=htmlspecialchars($_GET["aje"]);
$vP=htmlspecialchars($_GET["ajp"]);
$vF=htmlspecialchars($_GET["ajf"]);
$vTop=htmlspecialchars($_GET["ajtop"]);
//echo $vTop;

$vRefered=htmlspecialchars($_GET["ajrefer"]);

$vsqlc = "select count(*) as cnt from `article` a ";

$vsqlr="select a.* from `article` as a ";

$vsqlw="where 1=1 ";
if (!$vC.""=="")
{
   $vsqlw.="and a.status='c' ";
   $vheading = "Category: ";
   $vsqlw=$vsqlw."and a.category=c.name ";
   $vsqlw=$vsqlw."and c.`id`='".$vC."' ";
   $vsqlc = $vsqlc.", `category` as c ";
   $vsqlr = $vsqlr.", `category` as c ";
   $vQS = "ajc=".$vC;
}
elseif (!$vE.""=="")
{
   //$vsqlw="where status='c' ";
   $vheading = "My Articles: ";
   $vsqlw=$vsqlw."and `author`='".$vE."' ";
   $vQS = "aje=".$vE;
}
elseif(!$vTop.""=="")
{
  //$vsqlw.=" order by `views` DESC limit 10 ";
}
else
{
$vsqlw.="and a.status='c' ";
}

if (!$vF.""=="")
{
 $vsqlw.="and a.`title` like '%".$vF."%' ";
}


//echo $vP;
if (!$vP.""=="")
{
//echo "qw<br>";

    $page = ($vP - 1) * $vResultsPerPage;
	$vsqlp="limit ".$page.",".$vResultsPerPage;
}
else
{
//echo "er<br>";
    $vP = 1;
	$vsqlp="limit ".$vResultsPerPage;
}

if(!$vTop.""=="")
{
    $vsqlo=" order by `views` ";
	$vsqlp="DESC limit 10 ";
}
else
{
	$vsqlo="order by `date` DESC ";
}
//echo $vsql;  

$vsql=$vsqlc.$vsqlw.$vsqlo;

//echo $vsql."-0<br>";


$result = $db->sql_query($vsql);
$row = $db->sql_fetchrow($result);
if(!$vTop.""=="")
{
    $vcount = 10;
}
else
{
	$vcount = $row['cnt'];
}

$vpagese = $vcount % $vResultsPerPage;
$vpages = round($vcount / $vResultsPerPage,0);
if ($vpagese > 0 and $vpagese < ($vResultsPerPage/2))
{
$vpages = $vpages + 1;
}


//echo $vcount."-1<br>";
//echo $vpages."-2<br>";
//echo $vpagese."-3<br>";
//echo $vResultsPerPage."-4<br>";

$vsql=$vsqlr.$vsqlw.$vsqlo.$vsqlp;
//echo $vsql."-1<br>";


if (!$vQS.""=="")
{
$vRefered = $vRefered."?".$vQS."";
}
else
{
$vRefered = $vRefered."?n=1";
}
//echo $vRefered."<br>";
//echo $vQS."<br>";
if ($vP <= $vpages)
{
   if ($vP == 1)
   {
      if ($vpages > 1){
      $vNP = $vP + 1;
	  $vspages = "<a href='".$vRefered."&ajp=".$vNP."'>+ ".$vResultsPerPage."</a>";
	  if ($vpages > 1)
	  {
	     $vspages = $vspages."|<a href='".$vRefered."&ajp=".$vpages."'>>>"."</a>";
	  }
	  }
   }
   else
   {
	  if ($vP == $vpages)
	  {
		 $vPP = $vP - 1;
	     $vspages = "<a href='".$vRefered."&ajp=1'><<"."</a>";
		 $vspages = $vspages."|<a href='".$vRefered."&ajp=".$vPP."'>- ".$vResultsPerPage."</a>";
	  }
	  else
	  {
	     $vNP = $vP + 1;
		 $vPP = $vP - 1;
         $vspages = "<a href='".$vRefered."&ajp=1'><<"."</a>";
		 $vspages = $vspages."|<a href='".$vRefered."&ajp=".$vPP."'>- ".$vResultsPerPage."</a>";
	     $vspages = $vspages."|<a href='".$vRefered."&ajp=".$vNP."'>+ ".$vResultsPerPage."</a>";
		 if ($vP < $vpages)
		 {
	        $vspages = $vspages."|<a href='".$vRefered."&ajp=".$vpages."'>>>"."</a>";
		 }
	  } 
   }  
}
//echo $vP."<br>";
//echo $vNP."<br>";
//echo $vPP."<br>";
//echo $vpages."<br>";
//echo $vspages."<br>";
//echo $vResultsPerPage."<br>";
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

    if (!$vC.""=="")
    {
       $vheading = $vheading."'".$row['category']."'";
    }


	if ($afrow>0)
	{
		echo '<table width="100%" >';
		echo '<tr>';
		echo '<td background="images/tbhdr.jpg">';
		echo '<table border="0" width="100%"><tr><td align="left">';
		echo $vheading; 
		echo '</td><td align="right">';
		echo '('.$vpages.' Pages Found)'.$vspages;
		echo '</td></tr></table>';
		echo '</td>';
		echo '</tr>';
		echo '<tr><td>';
		if (!$vC.""=="")
        {
		    echo '<form action="'.$vRefered.'" method="post">Filter:<input name="ajf" type="text"></form>';
		}
		else{
			echo '<form action="'.$vRefered.'">Filter:<input name="ajf" type="text"></form>';
		}
		echo '</td></tr>';
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
		if (!$vE.""=="")
        {
		   echo '<table border="0" width="100%"><tr><td align="left">';
		   echo '<a href="article.php?aja='.$row['id'].'&a='.$row['title'].'">'.$row['title'].'</a>';
		   echo '</td><td align="right">';
		   
		   echo '<a href="article_stats.php?a='.$row['id'].'">Stats</a>|<a href="submit_form.php?a=e&aja='.$row['id'].'">Edit</a>|<a href="#" onclick="confirm_delete()">Delete</a>';
		   echo '</td></tr></table>';
		}
		elseif(!$vTop.""=="")
		{
		   echo '<table border="0" width="100%"><tr><td align="left">';
		   echo ($b+1).'.<a href="article.php?aja='.$row['id'].'&a='.$row['title'].'">'.$row['title'].'</a> - by '.$row1['user_firstname'].' '.$row1['user_lastname'].'';
		   echo '</td><td align="right">';
		   echo '<a href="article_stats.php?a='.$row['id'].'">Stats</a>';
		   echo '</td></tr></table>';
		}
		else
		{
		   echo '<table border="0" width="100%"><tr><td align="left">';
		   echo '<a href="article.php?aja='.$row['id'].'&a='.$row['title'].'">'.$row['title'].'</a> - by '.$row1['user_firstname'].' '.$row1['user_lastname'].'';
		   echo '</td><td align="right">';
		   echo '<a href="article_stats.php?a='.$row['id'].'">Stats</a>';
		   echo '</td></tr></table>';
		}   
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
		echo '<tr>';
		echo '<td>';
		//for ($pa=1;$pa<$vpages+1;$pa++)
		//{
		//   $vspages = $vspages."|"."<a href='".$vRefered."?ajp=".$pa."&".$vQS."'>".$pa."</a>";
		//}
//		echo 'Page:'.$vspages;
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		echo '<table border="0" width="100%"><tr><td align="left">';
		//echo $vheading;
		echo '</td><td align="right">';
		echo '('.$vpages.' Pages Found)'.$vspages;
		echo '</td></tr></table>';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	}
	else
	{
		echo '<table width="100%" class="auth_cell_head">';
		echo '<tr>';
		echo '<td>';
	    echo '<form action="'.$vRefered.'">Filter:<input name="ajf" type="text"></form>';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<table width="100%" class="auth_cell_head">';
		echo '<tr>';
		echo '<td>';
		echo 'NO RESULT FOUND.';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	}

}
  

?>