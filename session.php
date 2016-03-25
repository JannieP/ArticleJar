<?php 
  extract($GLOBALS);
  if ($_SESSION['UserIsOK'])
  {
    if ($_SESSION['UserIsAdmin'])
	{
	$vLogedinas="You are logged in as: ".$_SESSION['luser']."[ADMIN]";
	}
	else
	{
  	$vLogedinas="You are logged in as: ".$_SESSION['luser'];
	}
  } 
  else
  {
  	$vLogedinas="You are NOT Logged on";
  }
?>