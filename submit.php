<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
extract($GLOBALS);
if (!$_SESSION['UserIsOK'])
{
  	$vmessage="You are NOT Loged in.";
    $_SESSION['Message']="".$vmessage;
    header('Location: message.php');
} 

function send_admin_notice()
{
	$uemail='jannie.pieterse@gmail.com';
	$subject='New Article Posted';
	$from = 'ArticleJar <support@articlejar.com>';
	$headers = 'From: $from';
	$message = 'New Article Posted';
	
	mail($uemail,$subject,$message,$headers);
}

function submit_article()
{
  extract($GLOBALS);
  
  
  if ($_SESSION['luemail']=="")
  {
    $vmessage="Submit Failed, Login Expired";
    $_SESSION['Message']="".$vmessage;
    header('Location: message.php');
  }
  else
  {
  //print $_POST["article"];
  
    $varticleid=$_POST["articleid"];
	$vaction=$_POST["submitaction"];
	$_SESSION['Message']="".$vaction;
    header('Location: message.php');

  
    $vtitle=mysql_real_escape_string($_POST["title"]);

	$vcategory=$_POST['category'];
	if ($_POST["type"]=="html")
	{
		$varticle=str_replace("\'","'",$_POST["article"]);
		$varticle = mysql_real_escape_string($varticle);
	}
	else
	{
		$varticle=str_replace("\'","'",$_POST["article_txt"]);
		$varticle = mysql_real_escape_string($varticle);
	}
	$vexcerpt = str_replace("\'","'",$_POST["excerpt"]);
    $vexcerpt = mysql_real_escape_string($vexcerpt);

//	$varticle = strip
	//$varticle =  htmlspecialchars( $varticle ) ;
	
	if (!$varticleid.""=="")
	{
       $vsql="update `article` ";
	   $vsql=$vsql."set ";
       $vsql=$vsql."`title`='".$vtitle."', ";
	   $vsql=$vsql."`article`='".$varticle."', ";
	   if ($vaction=="save")
	   {
		   $vsql=$vsql."`status`='s', ";
	   }
	   else
	   {
		   if ($vaction=="saveapprove"){
			   $vsql=$vsql."`status`='c', ";
		   }else{
	   
			   $vsql=$vsql."`status`='w', ";
		   }
	   }
	   $vsql=$vsql."`date`=NOW(), ";
	   $vsql=$vsql."`category`='".$vcategory."', ";
	   $vsql=$vsql."`excerpt`='".$vexcerpt."' ";
	   $vsql=$vsql."where id=".$varticleid."";
	}
	else
	{
       $vsql="insert into `article` (`title`,`article`,`author`,`status`,`date`,`category`,`excerpt`) ";
       $vsql=$vsql."VALUES('".$vtitle."','".$varticle."','".$_SESSION['luemail']."','w',NOW(),'".$vcategory."','".$vexcerpt."')";
	}

    if( !($result = $db->sql_query($vsql)) )
    {
      $vmessage="Submit Failed2";
	  //$_SESSION['Message']="".$_POST["article"];
        $_SESSION['Message']="".$vmessage."<br>".$vsql;
        header('Location: message.php');
    }
    else
    {
	  $vsql="update users set `user_articles`=(`user_articles` + 1) ";
      $vsql=$vsql."where `user_email`='".$_SESSION['luemail']."'";
	  if( !($result = $db->sql_query($vsql)) )
      {
		  $vmessage="Submit Failed3";
		  //$_SESSION['Message']="".$_POST["article"];
		  $_SESSION['Message']="".$vmessage;
		  header('Location: message.php');
      }

      send_admin_notice();
      $vmessage="Article Submitted";
      $_SESSION['Message']="".$vmessage."---".$vaction;
      header('Location: message.php');
    }

  } 
  return $function_ret;
} 
$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="submit")
{
  submit_article();
}
else
{
  $vmessage="Submit Failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
}
?>