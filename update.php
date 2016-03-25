<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');

function is_email($email, $empty_ok=false)
{
    $email = trim($email);
    if ($empty_ok && $email == '') return true;

    if (eregi("^([a-z0-9_\.-])+@(([a-z0-9_-])+\\.)+[a-z]{2,6}$", trim($email)))
    return true;
    else
    return false;
}


function update()
{
  extract($GLOBALS);

  if ($_POST["emailaddress"]=="")
  {
        $vmessage="Update failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }
  
  $vemail=mysql_real_escape_string($_POST["emailaddress"]);
  //$_SESSION['Message']="".$vemail;
  //header('Location: message.php');
  
  if (!is_email($vemail,false))
  {
        $vmessage="Update failed, Invalid Email Address";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
  }

  

  $vsql="select * from users where upper(user_email)=";
  $vsql=$vsql."'".strtoupper($vemail)."' ";

  if( !($result = $db->sql_query($vsql)) )
  {
      $vmessage="Update failed2";
      $_SESSION['Message']="".$vmessage;
      header('Location: message.php');
  }

  $row = $db->sql_fetchrow($result);
  $afrow = $db->sql_affectedrows();

  if($afrow>0)
  {
    $vsql="update users ";
    
    if ($_POST["password"] == "")
    {
      $vsql=$vsql."set`user_firstname`='".mysql_real_escape_string($_POST["firstname"])."' ";
    }
    else
    {
      $vsql=$vsql."set `user_password`='".mysql_real_escape_string($_POST["password"])."'" ;
      $vsql=$vsql.",`user_firstname`='".mysql_real_escape_string($_POST["firstname"])."' ";
    }
    
    $vsql=$vsql.",`user_lastname`='".mysql_real_escape_string($_POST["lastname"])."' ";
    $vsql=$vsql.",`user_country`='".mysql_real_escape_string($_POST["country"])."' ";
    $vsql=$vsql.",`user_weburl`='".mysql_real_escape_string($_POST["url"])."' ";
    $vsql=$vsql.",`user_howheard`='".mysql_real_escape_string($_POST["how"])."' ";
    $vsql=$vsql.",`user_adsense_pub_id`='".mysql_real_escape_string($_POST["adsense_id"])."' " ;
    $vsql=$vsql.",`user_adsense_channel`='".mysql_real_escape_string($_POST["adsense_channel"])."' " ;
    $vsql=$vsql."where user_email='".mysql_real_escape_string($_POST["emailaddress"])."'";

    if(!($result = $db->sql_query($vsql)) )
    {
      $vmessage="Update failed3".$vsql;
      $_SESSION['Message']="".$vmessage;
      header('Location: message.php');
    }
    else
    {
      $vmessage="Your details have been successfully updated.";
      $_SESSION['Message']="".$vmessage;
      header('Location: message.php');
    }
  }
  else
  {
      $vmessage="Update failed. User does NOT exist.".$vemail;
      $_SESSION['Message']="".$vmessage;
      header('Location: message.php');
  }
  return $function_ret;
} 
$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="update")
{
  update();
}
else
{
  $vmessage="Update failed4";
  $_SESSION['Message']="".$vmessage;
  header('Location: message.php');
}
?>
