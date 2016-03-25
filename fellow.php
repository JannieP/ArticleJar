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
$vOperation=htmlspecialchars($_GET["request"]);
if ($vOperation.""=="1")
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
    $vuid=$_GET["uid"];
	
  $vemail=$_SESSION['luemail'];
  $vsql="select * from `users` where upper(user_email)=";
  $vsql=$vsql."'".strtoupper($vemail)."' ";
  $result = $db->sql_query($vsql);
  $row = $db->sql_fetchrow($result);
  $vCurid=$row['id'];	
//echo $vCurid.'|'.$vsql;
 
    $vsql="insert into `fellow_authors` (`main_author_id`,`fellow_author_id`,`status`,`date`) ";
    $vsql=$vsql."VALUES(".$vCurid.",".$vuid.",'2',NOW())";

    if( !($result = $db->sql_query($vsql)) )
    {
      $vmessage="Submit Failed2";
	  //$_SESSION['Message']="".$_POST["article"];
        $_SESSION['Message']="".$vmessage."<br>".$vsql;
        header('Location: message.php');
    }
	else
	{
      $vmessage="Fellowship Requested";
	  //$_SESSION['Message']="".$_POST["article"];
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
	}
  } 
}
else
{
  $vmessage="Submit Failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
}

?>