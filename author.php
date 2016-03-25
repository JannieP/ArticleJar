<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  //$_SESSION['Header']=6;
  
  //if ($_SESSION['UserIsOK'])
  //{

  $vemail=$_SESSION['luemail'];
  $vsql="select * from `users` where upper(user_email)=";
  $vsql=$vsql."'".strtoupper($vemail)."' ";
//  $vsql=$vsql."and `user_status`='c' ";
  $result = $db->sql_query($vsql);
  $row = $db->sql_fetchrow($result);
  $vCurid=$row['id'];	

  	$vuid = $_GET["id"];
	
	//echo $vCurid.'|'.$vuid.'|'.$vemail;
	if ($vuid == $vCurid )
	{
		$visfellow = 1;
		//echo 'Is Same';
	}
	else
	{
	
		$vsql="select * from `fellow_authors` where main_author_id=";
		$vsql=$vsql."".$vCurid." ";
		$vsql=$vsql."and `fellow_author_id`=".$vuid." ";
//		$vsql=$vsql."and `status`='c' ";
		//echo $vsql;
		$result = $db->sql_query($vsql);
		$row = $db->sql_fetchrow($result);
		$afrows = $db->sql_affectedrows();
		//echo $
		if ($afrows > 0)
		{
			$vCurEmail=$row['user_email'];
			//echo 'Status='.$row['status'];
			if($row['status']=="1")
			{
				$visfellow = 1;
			}
			if($row['status']=="2")
			{
				$visfellow = 2;
			}
			if($row['status']=="3")
			{
				$visfellow = 3;
			}
			if($row['status']=="4")
			{
				$visfellow = 4;
			}
			//echo 'Status= '.$visfellow;
		}
		
	}

    $vsql="select * from users where `id`=";
    $vsql=$vsql.strtoupper($vuid);
    
    if( !($result = $db->sql_query($vsql)) )
    {
        $vmessage="User Data Retrieval Failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();
    if($afrow>0)
    {
      $upwd=$row["user_password"];
      $ufname=$row["user_firstname"];
      $ulname=$row["user_lastname"];
      $ucountry=$row["user_country"];
      $uurl=$row["user_weburl"];
      $uheard=$row["user_howheard"];
      $uadsense=$row["user_adsense_pub_id"];
	  $uchannel=$row['user_adsense_channel'];
	  $ubio=$row['user_bio'];
	  $uemail=$row['user_email'];
	  
    
    }
    else
    {
        $vmessage="User Data Retrieval Failed2";
        $_SESSION['Message']="".$vmessage.$vsql;
        header('Location: message.php');
    }

  	
//  } 
//  else
//  {
//  	$vLogedinas="You are NOT Logged on";
//    $_SESSION['Message']="".$vLogedinas;
//    header('Location: message.php');
//  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<title>ArticleJar.com - Author Details</title>
</head>
<body onload="select_value_set('country','<?php echo $ucountry ?>'); select_value_set('how','<?php echo $uheard; ?>');">
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
    <td width="144"><table width="100%">
              <tr>
                <td><?php include ('sidebarleft.php'); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
    <td width="570" valign="top">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
		<td colspan="4">
		<?php include('adsense_leaderboard.php'); ?>
		</td>
		</tr>
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="21%">Author Email Address: </td>
          <td width="73%"><?php if ($visfellow==1){echo $uemail;}else{echo 'N/A';  }?></td>
          <td width="3%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Author Name: </td>
          <td><?php echo $ufname.' '.$ulname; ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Author Country</td>
          <td><?php echo $ucountry; ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Author Web Url </td>
          <td><a href="http://<?php echo $uurl; ?>">Url 1</a></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Author Biography</td>
          <td><?php echo $ubio; ?></td>
          <td>&nbsp;</td>
        </tr>
		<tr>
		<td>&nbsp;</td>
		<td  colspan="2"><br />
		<?php 
			if ($_SESSION['UserIsOK'])
			{
			if ($visfellow==0 || $visfellow==4)
			{
				echo '<a href="fellow.php?request=1&uid='.$vuid.'>Request Fellowship</a><br />';
			}
			if ($visfellow==1)
			{echo '**You are in Fellowship with this Author.**';}
			if ($visfellow==2)
			{echo '**You Fellowship request with this Author is still Pending.**';}
			if ($visfellow==3)
			{echo '**You Fellowship request with this Author has been rejected.**';}
			if ($visfellow==4)
			{echo '**You Fellowship request with this Author has been placed on hold.**';}
			}
			?>
		</td>
		
		<td>&nbsp;</td>
		</tr>
      </table>

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
