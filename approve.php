<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');


function approve($presp)
{
extract($GLOBALS);
	if (!$_SESSION['UserIsAdmin'])
	{
	   $vmessage='User is NOT an ADMIN user.';
	   $_SESSION['Message']="".$vmessage;
	   header('Location: message.php');
	}

  $vArticle=$_POST['articleid'];
  
  if ($vArticle=="")
  {
        $vmessage="Approval failed2";
        $_SESSION['Message']="".$vmessage.'-'.$vArticle;
        header('Location: message.php');
  }
  
  $vsql="select * from `artical` where id =".$vArticle;

  if( !($result = $db->sql_query($vsql)) )
  {
      $vmessage="Approval failed, Invalid Articla";
      $_SESSION['Message']="".$vmessage;
      header('Location: message.php');
  }

  if ($presp==true)
  {
  $vsql="update `article` set status='c' where id =".$vArticle;
  }
  elseif ($presp==false)
  {
  $vsql="update `article` set status='r' where id =".$vArticle;
  }
  else
  {
  $vsql='';
  }

  if( !($result = $db->sql_query($vsql)) )
  {
      $vmessage="Approval failed3.";
      $_SESSION['Message']="".$vmessage;
      header('Location: message.php');
  }
  else
  {
      $vsql="update users set `user_active_articles`=(`user_active_articles` + 1) ";
      $vsql=$vsql."where `user_email`='".$_SESSION['luemail']."'";
	  if( !($result = $db->sql_query($vsql)) )
      {
		  $vmessage="Submit Failed2";
		  //$_SESSION['Message']="".$_POST["article"];
		  $_SESSION['Message']="".$vmessage;
		  header('Location: message.php');
      }

      header('Location: admin.php');
  }
  return $function_ret;
} 

$vOperation=htmlspecialchars($_GET["a"]);
//print "".$vArticle.' - '.$_GET["a"];
//$_SESSION['Message']="".$vArticle.' - '.$_GET["a"];
//header('Location: message.php');
if ($vOperation.""=="a")
{
  approve(true);
}
elseif ($vOperation.""=="r")
{
	approve(false);
}
else
{
  $vmessage="Approval failed1";
  $_SESSION['Message']="".$vmessage;
  header('Location: message.php');
}
?>