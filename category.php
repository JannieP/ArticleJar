<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');

$vsql="select * from `category` order by `name`";
$result = $db->sql_query($vsql);
$row = $db->sql_fetchrow($result);
$afrow = $db->sql_affectedrows();
if($afrow>0)
{
   echo '<select name="category" id="category" size="1">';
   echo '<option>- -None- -</option>';
   for ($r=0;$r<$afrow;$r++)
   {
   	echo '<option>'.$row['name'].'</option>';
	$row = $db->sql_fetchrow($result);
   }
   echo '</select>';
}
?>