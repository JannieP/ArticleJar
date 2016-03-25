<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
function send_confirmation($uemail,$ufname,$ulname,$utoken)
{

  $url = "http://www.articlejar.com/register/";
  $url = $url.'?aja=c&aje='. urlencode($uemail) .
  '&ajt='. $utoken; 

  $message="Thank You,".$ufname." ".$ulname."\n\n";
  $message=$message."You have registered an account on Articlejar.com\n\n";
  $message=$message."_________________________________________\n";
  $message=$message."Please confirm your registration by clicking on the following link:\n";
  $message=$message.$url."\n\n";
  $message=$message."Or copy the link to a new browser window.";
  
  $subject="Registration Confirmation for [".$ufname." ".$ulname."]";
  
  $from = "ArticleJar Registration <support@articlejar.com>";
  $headers = "From: $from";
  
  return mail($uemail,$subject,$message,$headers);
  
}

function resend()
{
  extract($GLOBALS);

  $vemail = $_POST["uname"];

  if ($vemail=="")
  {
    $vmessage="ReSend failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }
  else
  {
    $vsql="select * from users where upper(user_email)=";
    $vsql=$vsql."'".strtoupper($vemail)."'";
 
    if( !($result = $db->sql_query($vsql)) )
    {
      $vmessage="ReSend failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();

    if($afrow>0)
    {
      send_confirmation($vemail,$row["user_firstname"],$row["user_lastname"],$row['user_token']);
      $vmessage="A confirmation email has been sent to ".$vemail."<br>"."Please confirm your registration by clicking on the link in the email.";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
    else
    {
      $vmessage="ReSend failed, email address [".$vemail."] does not exist on the system.";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
  } 
  return $function_ret;
} 

$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="resend")
{
  resend();
}
else
{
  $vmessage="ReSend failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
}
?>