<?php
session_start();
session_register("UserIsOK_session");
include('../db/db.php');

function user_confirm($vemail,$vtoken)
{
  extract($GLOBALS);
  if ($vemail=="" || $vtoken=="")
  {
    $vmessage="Confirmation failed1";
        $_SESSION['Message']="".$vmessage;
        header('Location: ../message.php');
    
  }
  else
  {
    $vsql="select * from users where upper(user_email)=";
    $vsql=$vsql."'".strtoupper($vemail)."' ";
    $vsql=$vsql."and user_token = '".$vtoken."'";

    if( !($result = $db->sql_query($vsql)) )
    {
        $vmessage="Confirmation failed2";
        $_SESSION['Message']="".$vmessage;
        header('Location: ../message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();

    if($afrow>0)
    {
      $vsql="update users set user_status='c',`user_active_date`=NOW() where user_email='".$vemail."' and user_token='".$vtoken."'";
      if( !($result = $db->sql_query($vsql)) )
      {
        $vmessage="Confirmation failed3";
        $_SESSION['Message']="".$vmessage;
        header('Location: ../message.php');
      }
      else
      {
        $_SESSION['UserIsOK']=true;
        $_SESSION['luser']=$row['user_firstname'].' '.$row['user_lastname'];
        $_SESSION['luemail']=$row['user_email'];
        $vmessage="Thank you, ".$row['user_firstname']."<br>Your registration has been Confirmed.";
        $_SESSION['Message']="".$vmessage;
        header('Location: ../message.php');
      }
    }
    else
    {
        $vmessage="Confirmation failed4";
        $_SESSION['Message']="".$vmessage;
        header('Location: ../message.php');
    }
  } 
  return $function_ret;
} 

$vaction=htmlspecialchars($_GET["aja"]);
$vemail=htmlspecialchars($_GET["aje"]);
$vtoken=htmlspecialchars($_GET["ajt"]);

if ($vaction.""=="c")
{
  //print "".$vemail;
  //print "".$vtoken;
  user_confirm($vemail,$vtoken);
}
else
{
  $vmessage="Confirmation failed5";
        $_SESSION['Message']="".$vmessage;
        header('Location: ../message.php');
}
?>