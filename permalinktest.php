<?php
$url = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
$url = explode('/', $url);
$ind = 0;
echo $url[1];
?>