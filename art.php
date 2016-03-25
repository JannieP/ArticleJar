<?php
$url = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
$url = explode('/', $url);
$ind = 0;
foreach ($url as $slug)
{
echo $ind++.'->'.$slug.'<br>';
}
?>