<?php
$str = "test\r\n";
$str = $str. "dfg";

echo $str;
echo '<br>';
echo strpos($str,"\r\n");
?>