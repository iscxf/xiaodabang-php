<?php 
// if(!isset($_COOKIE['user']))
// 	echo"<script>window.close();</script>";

$arr = $_POST;
include 'db_connect.inc.php';		//数据库连接
$sql_reply="SELECT sender_author FROM reply WHERE id='".$_POST['reply_id']."'";
$result_reply=mysqli_query($db,$sql_reply);
$row_reply=mysqli_fetch_row($result_reply);
$mdate=date("Y-m-d H:i:s");
if($_POST['case']=='up'){
	$sql_up="INSERT INTO up (reply_id,up_user_name,status) VALUES ('${_POST['reply_id']}','${_COOKIE['user']}','1')";			//sql命令，向点赞表插入数据
	mysqli_query($db,$sql_up);
	$sql2="UPDATE reply SET up=up+1 WHERE id='${_POST['reply_id']}'";		//sql命令，更新回复表点赞数数据
	mysqli_query($db,$sql2);
	if($_COOKIE['user']!=$row_reply[0]){
		$sql_message="INSERT INTO message (flag,status,send_user,content,question_id,receive_user,mdate) VALUES ('3','1','${_COOKIE['user']}','给你点赞了','${_POST['question_id']}','$row_reply[0]','$mdate')";
		mysqli_query($db,$sql_message);
	}
}else if($_POST['case']=='cancel_up'){
	$sql_up="DELETE FROM up WHERE up_user_name='${_COOKIE['user']}' AND reply_id='${_POST['reply_id']}'";			//sql命令，点赞表删除数据
	mysqli_query($db,$sql_up);
	$sql2="UPDATE reply SET up=up-1 WHERE id='${_POST['reply_id']}'";
	mysqli_query($db,$sql2);
}
$sql_return="SELECT up FROM reply WHERE id='".$_POST['reply_id']."'";
$result_return=mysqli_query($db,$sql_return);
$row_return=mysqli_fetch_row($result_return);
$text=$row_return;
	echo($text[0]);
 ?>