<?php
$vOperation=htmlspecialchars($_GET["aja"]);
if (!$vOperation.""=="")
{
  header('Location: article.php?aja='.$vOperation);
}
else
{
  header('Location: home.php');
}
?>