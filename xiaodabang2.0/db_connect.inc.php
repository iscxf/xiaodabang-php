<?php 
$db = @mysqli_connect("localhost","root","123456","xiaodabang")
or die("无法连接数据库！");		//连接数据库
mysqli_query($db,"SET NAMES 'UTF8'");
 ?>