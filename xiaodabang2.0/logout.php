<?php 
setcookie("user", "", time()-3600);
setcookie("pwd", "", time()-3600);
$home_url = 'index.php';
header('Location:'.$home_url);
?>