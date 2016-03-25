<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');

function login()
{
  extract($GLOBALS);
  if ($_POST["uname"]=="" || $_POST["upwd"]=="")
  {
    $vmessage="Login Failed";
    $_SESSION['Message']="".$vmessage;
    header('Location: message.php');
  }
  else
  {
    $vsql="select * from users where upper(user_email)=";
    $vsql=$vsql."'".strtoupper($_POST["uname"])."' ";
    $vsql=$vsql."and user_password = '".$_POST["upwd"]."'";

    if( !($result = $db->sql_query($vsql)) )
    {
      $vmessage="Login Failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();
    if($afrow>0)
    {
      if ($row['user_status']=='w')
      {
        $vmessage="Login Failed, You have NOT confirmed your registration.<br>Please do so before logging in.<br><br>Thank You";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
      }
      else
      {
        $_SESSION['UserIsOK']=true;
		if ($row['user_role']=='admin')
		{
			$_SESSION['UserIsAdmin']=true;
		}
        $_SESSION['luser']=$row['user_firstname'].' '.$row['user_lastname'];
        $_SESSION['luemail']=$row['user_email'];
		$_SESSION['luid']=$row['id'];
        header('Location: home.php');
      }
    }
    else
    {
      $vmessage="Login Failed2";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
  } 
  return $function_ret;
} 
$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="login")
{
  Login();
}
else
{
  $vmessage="Login Failed3";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
}
?>