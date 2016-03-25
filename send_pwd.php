<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');

function send_pwd($uemail,$ufname,$ulname,$upwd)
{

  $message="Thank You,".$ufname." ".$ulname."\n\n";
  $message=$message."You login details for your account on Articlejar.com\n\n";
  $message=$message."_________________________________________\n";
  $message=$message."Login User name:".$uemail."\n";
  $message=$message."Password:".$upwd."\n\n";
  $message=$message."_________________________________________\n";
  
  $subject="Articlejar.com Login information for [".$ufname." ".$ulname."]";
  
  $from = "ArticleJar Registration <support@articlejar.com>";
  $headers = "From: $from";
  
  return mail($uemail,$subject,$message,$headers);
  
}

function sendpwd()
{
  extract($GLOBALS);

  $vemail = $_POST["uname"];

  if ($vemail=="")
  {
    $vmessage="Password Send failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }
  else
  {
    $vsql="select * from users where upper(user_email)=";
    $vsql=$vsql."'".strtoupper($vemail)."'";
 
    if( !($result = $db->sql_query($vsql)) )
    {
      $vmessage="Password Send failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();

    if($afrow>0)
    {
      send_pwd($vemail,$row["user_firstname"],$row["user_lastname"],$row["user_password"]);
      $vmessage="An email has been sent to ".$vemail."<br>"."This Email contains your login details for Articlejar.com.";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
    else
    {
      $vmessage="Password Send failed, email address [".$vemail."] does not exist on the system.";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
  } 
  return $function_ret;
} 

$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="resend")
{
  sendpwd();
}
else
{
  $vmessage="Password Send failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
}
?>