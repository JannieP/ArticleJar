<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
extract($GLOBALS);

$vid = $_GET["category"];
$vgroup = $_GET["group"];

//echo $vid."<br>";
//echo $vgroup."<br>";

if ($vgroup=="0")
{
    //echo 'NONE';
   header('Location: categories.php');
}

$vsql="update `category` set `group`=".$vgroup." , `status`='c' where `id`=".$vid ;
//echo $vsql;
$result = $db->sql_query($vsql);

header('Location: categories.php');


?>