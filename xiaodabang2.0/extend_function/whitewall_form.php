<?php 
include '../db_connect.inc.php';
$content=$_POST['content'];
$target=$_POST['target'];
$date=date("Y-m-d H:i:s");
if(isset($_COOKIE['user']))
	$author=$_COOKIE['user'];
else{
	mysqli_close($db);
	header("refresh:0;url=http://localhost:8080/xiaodabang2.0/extend_function/WhiteWall.php");
}
$sql="insert into whitewall (author,target,wcontent,wdate) values ('$author','$target','$content','$date')";
if(!mysqli_query($db,$sql)){		//执行sql命令
		 die('Error: ' . mysqli_error($db));
	}
	else{
		mysqli_close($db);
		header('location: '.$_SERVER['HTTP_REFERER']);		//发布成功则返回
	}

 ?>