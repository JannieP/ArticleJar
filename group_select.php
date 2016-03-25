<?php
session_start();
session_register("UserIsOK_session");
include('db/db.php');
$g=$_GET["g"];
$vsql_g="select * from `groups` order by `group_name`";
$result_g = $db->sql_query($vsql_g);
$row_g = $db->sql_fetchrow($result_g);
$afrow_g = $db->sql_affectedrows();
if($afrow_g>0)
{
   echo '<select name="group" id="group" size="1">';
   echo '<option value="0">- -None- -</option>';
   for ($r=0;$r<$afrow_g;$r++)
   {
   	echo '<option value="'.$row_g['id'].'"';if($g==$row_g['id'])echo ' selected';echo '>'.$row_g['group_name'].'</option>';
	$row_g = $db->sql_fetchrow($result_g);
   }
   echo '</select>';
}
?>