<?php 
include '../db_connect.inc.php';
$content=$_POST['content'];
$date=date("Y-m-d H:i:s");
$author=$_COOKIE['user'];
$sql="insert into feedback (name,content,date) values ('$author','$content','$date')";
if(!mysqli_query($db,$sql)){		//执行sql命令
		 die('Error: ' . mysqli_error($db));
	}
	else{
		mysqli_close($db);
		header('location: '.$_SERVER['HTTP_REFERER']);		//发布成功则返回
	}

?>