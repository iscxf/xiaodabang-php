<?php 
include 'db_connect.inc.php';
$content=$_POST['content'];
$question_id=$_POST['question_id'];
$receiver_author=$_POST['receive_author'];
$rdate=date("Y-m-d H:i:s");
if(isset($_COOKIE['user']))
	$sender_author=$_COOKIE['user'];
else{
	mysqli_close($db);
	header("refresh:0;url=http://localhost:8080/xiaodabang2.0/index.php");
}
$sql="insert into reply (receiver_author,sender_author,content,rdate,question_id) values ('$receiver_author','$sender_author','$content','$rdate','$question_id')";
$sql2="insert into message (flag,status,send_user,content,question_id,receive_user,mdate) values ('2','1','$sender_author','$content','$question_id','$receiver_author','$rdate')";
$sql3="update question set reply=(reply+1) where id=".$question_id."";

if(!mysqli_query($db,$sql)){		//执行sql命令
		 die('Error: ' . mysqli_error($db));
	}
	else{
		if($receiver_author!=$_COOKIE['user'])
			mysqli_query($db,$sql2);
		mysqli_query($db,$sql3);
		mysqli_close($db);
		header('location: '.$_SERVER['HTTP_REFERER']);		//发布成功则返回
	}
?>