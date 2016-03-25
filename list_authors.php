<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
include('session.php');

extract($GLOBALS);

$vResultsPerPage = 10;

$vType=htmlspecialchars($_GET["t"]);
$vAuthorId=htmlspecialchars($_GET["id"]);
$vPage=htmlspecialchars($_GET["p"]);
$vRefered=htmlspecialchars($_GET["ajrefer"]);

if ($vType=='fellow')
{
	$vemail=$_SESSION['luemail'];
	$vsql="SELECT u.id,u.user_firstname,u.user_lastname,f.status FROM `users` u,`fellow_authors` f where u.id = f.main_author_id ";
	$vsql=$vsql."and f.fellow_author_id=";
	$vsql=$vsql."".$vAuthorId." ";
	$vsql=$vsql." order by `status` ";
	
	$vheading = "My Fellow Authors";

}
elseif($vType=='top')
{
	$vsql="Select * from `users` where user_status='c' order by `user_active_articles` DESC ";
	$vsqlp="limit 10";
	$vsql=$vsql.$vsqlp;
}
else
{

	$vheading = "Authors";
	
    $vsqlc = "select count(*) as cnt from `users` where user_status='c' ";
	$result = $db->sql_query($vsqlc);
	$row = $db->sql_fetchrow($result);
	$vcount = $row['cnt'];
	$vpagese = $vcount % $vResultsPerPage;
	$vpages = round($vcount / $vResultsPerPage,0);
	if ($vpagese > 0 and $vpagese < ($vResultsPerPage/2))
	{
		$vpages = $vpages + 1;
	}
	if ($vP <= $vpages)
	{
	   if ($vP == 1)
	   {
		  if ($vpages > 1){
		  $vNP = $vP + 1;
		  $vspages = "<a href='".$vRefered."?ajp=".$vNP."&".$vQS."'>+ ".$vResultsPerPage."</a>";
		  if ($vpages > 1)
		  {
			 $vspages = $vspages."|<a href='".$vRefered."?ajp=".$vpages."&".$vQS."'>>>"."</a>";
		  }
		  }
	   }
	   else
	   {
		  if ($vP == $vpages)
		  {
			 $vPP = $vP - 1;
			 $vspages = "<a href='".$vRefered."?ajp=1&".$vQS."'><<"."</a>";
			 $vspages = $vspages."|<a href='".$vRefered."?ajp=".$vPP."&".$vQS."'>- ".$vResultsPerPage."</a>";
		  }
		  else
		  {
			 $vNP = $vP + 1;
			 $vPP = $vP - 1;
			 $vspages = "<a href='".$vRefered."?ajp=1&".$vQS."'><<"."</a>";
			 $vspages = $vspages."|<a href='".$vRefered."?ajp=".$vPP."&".$vQS."'>- ".$vResultsPerPage."</a>";
			 $vspages = $vspages."|<a href='".$vRefered."?ajp=".$vNP."&".$vQS."'>+ ".$vResultsPerPage."</a>";
			 if ($vP < $vpages)
			 {
				$vspages = $vspages."|<a href='".$vRefered."?ajp=".$vpages."&".$vQS."'>>>"."</a>";
			 }
		  } 
	   }  

	}

	$vsql="Select * from `users` where user_status='c' ";
	if (!$vP.""=="")
	{
		$page = ($vP - 1) * $vResultsPerPage;
		$vsqlp="limit ".$page.",".$vResultsPerPage;
	}
	else
	{
		$vP = 1;
		$vsqlp="limit ".$vResultsPerPage;
	}
	$vsql=$vsql.$vsqlp;
	
}

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

		echo '<table border="0" width="100%"><tr><td align="left">';
		echo $vheading;
		echo '</td>';
		if (!$vType=="fellow")
		{

			echo '<td align="right">';
			echo '('.$vpages.' Pages Found)'.$vspages;
			echo '</td>';
		}
		echo '</tr></table>';
		echo '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td class="auth_cell_head">';
        $vSt="0";
	    for ($b=0;$b<$afrow;$b++)
		{
			echo '<table width="100%">';
			if ($vType=="fellow")
			{//echo $row['status'];
				if ($row['status']=="1")
				{
					$vSubHeading = "Accepted";
				}
				if ($row['status']=="2")
				{
					$vSubHeading ="Requesting";
				}
				if ($row['status']=="3")
				{
					$vSubHeading = "Rejected";
				}
				if ($row['status']=="4")
				{
					$vSubHeading = "On Hold";
				}
				
			    if ($vSt == $row['status'])
				{}else{
				
					echo '<tr>';
					echo '<td class="auth_cell_head"><strong>';
					echo $vSubHeading;
					echo '</strong></td>';
					echo '</tr>';
				}
				$vSt=$row['status'];
			}
			
			echo '<tr>';
			echo '<td>';
			if ($vType.""=="fellow")
			{
			   echo '<table border="0" width="100%"><tr><td align="left">';
			   echo '<a href="author.php?id='.$row['id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</a>';
			   echo '</td><td align="right">';
			   
			   echo '<a href="userauthors.php?ua='.$row['id'].'" >Accept</a>|<a href="userauthors.php?ur='.$row['id'].'" >Reject</a>|<a href="userauthors.php?uh='.$row['id'].'" >Hold</a>';
			   echo '</td></tr></table>';
			}
			elseif($vType=='top')
			{
			   echo ($b+1).'.<a href="author.php?aja='.$row['id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</a> - '.$row['user_active_articles'].' Published Articles';
			}
			else
			{
			   echo '<a href="author.php?aja='.$row['id'].'">'.$row['user_firstname'].' '.$row['user_lastname'].'</a>';
			}   
			echo '</td>';
			echo '</tr>';
			echo '</table>';
			$row = $db->sql_fetchrow($result);
		}
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
		
		echo '</td>';
		echo '</tr>';
		if (!$vType=="fellow")
		{
			echo '<tr>';
			echo '<td>';
			echo '<table border="0" width="100%"><tr><td align="left">';
			echo '</td><td align="right">';
			echo '('.$vpages.' Pages Found)'.$vspages;
			echo '</td></tr></table>';
			echo '</td>';
			echo '</tr>';
		}		
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