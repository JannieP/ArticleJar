<?php
include('mysql.php');
$dbhost = 'localhost';
$dbname = 'aj';
$dbuser = 'root';
$dbpasswd = 'root';
$db = new sql_db($dbhost, $dbuser, $dbpasswd, $dbname, false);    
if(!$db->db_connect_id)
{
  print "Could not connect to the database";
}
?>