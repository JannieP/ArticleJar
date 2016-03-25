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

function is_email($email, $empty_ok=false)
{
    $email = trim($email);
    if ($empty_ok && $email == '') return true;

    if (eregi("^([a-z0-9_\.-])+@(([a-z0-9_-])+\\.)+[a-z]{2,6}$", trim($email)))
    return true;
    else
    return false;
}


function register()
{
  extract($GLOBALS);

  if ($_POST["emailaddress"]=="" || $_POST["password"]=="")
  {
    $vmessage="Registration failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }
  
  if (!is_email($_POST["emailaddress"],false))
  {
    $vmessage="Registration failed, Invalid Email Address";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }

  $vemail=mysql_real_escape_string($_POST["emailaddress"]);
  $vpwd=mysql_real_escape_string($_POST["emailaddress"]);

  $vsql="select * from users where upper(user_email)=";
  $vsql=$vsql."'".strtoupper($vemail)."' ";
  $vsql=$vsql."and user_password = '".$vpwd."'";

  if( !($result = $db->sql_query($vsql)) )
  {
    $vmessage="Registration failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }

  $row = $db->sql_fetchrow($result);
  $afrow = $db->sql_affectedrows();

  if($afrow>0)
  {
    $vmessage="Registration failed. User allready exists.";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }
  else
  {
    $token = md5(rand());
    $vsql="insert into users ";
    $vsql=$vsql."(`user_email`, `user_password`, `user_firstname`, `user_lastname`, `user_country`, `user_weburl`, `user_howheard`,`user_token`,`user_status`,`user_adsense_pub_id`,`user_adsense_channel`,`user_date`,`user_articles`,`user_active_articles`) " ;
    $vsql=$vsql."VALUES('".mysql_real_escape_string($_POST["emailaddress"])."', '".mysql_real_escape_string($_POST["password"])."', '".mysql_real_escape_string($_POST["firstname"])."', '".mysql_real_escape_string($_POST["lastname"])."', '".mysql_real_escape_string($_POST["country"])."', '".mysql_real_escape_string($_POST["url"])."', '".mysql_real_escape_string($_POST["how"])."','".$token."','w','".mysql_real_escape_string($_POST["adsense_id"])."','".mysql_real_escape_string($_POST["adsense_channel"])."',NOW(),0,0)";

    if(!($result = $db->sql_query($vsql)) )
    {
      $vmessage="Registration failed2";
        $_SESSION['Message']="".$vmessage.'|'.$vsql;
        header('Location: message.php');
    }
    else
    {
      send_confirmation($_POST["emailaddress"],$_POST["firstname"],$_POST["lastname"],$token);
      $vmessage="A confirmation email has been sent to ".$_POST["emailaddress"]."<br>"."Please confirm your registration by clicking on the link in the email.";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }
  }
  return $function_ret;
} 
$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="register")
{
  register();
}
else
{
  $vmessage="Registration failed3";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
}
?>
