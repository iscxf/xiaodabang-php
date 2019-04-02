<?php 
include 'db_connect.inc.php';
if($_POST['case']=='name'){
	$sql="SELECT uname FROM user WHERE uname='${_POST['name']}'";
	$result=mysqli_query($db,$sql);
	$row=mysqli_fetch_object($result);			//获取数据量
	if($row!=null)
		echo "no";
	else 
		echo "yes";
}else
{
	$name=$_POST['name'];
	$password=$_POST['password'];
	$sex=$_POST['sex'];
// $grade=$_POST['grade'];
// $major=$_POST['major'];
	$register_time=date("Y-m-d H:i:s");
	$a="insert into user (uname,password,flag,sex,udate,status) values ('$name','$password',1,'$sex','$register_time','普通用户')";
// $result=execute_sql($db,"xiaodabang",$a);
	if (!mysqli_query($db,$a))
	{
		die('Error: ' . mysqli_error($db));
	}
	else{
		setcookie("user", $name, time() + 3600 * 24 * 30); 
		setcookie ( "pwd", $password, time () + 3600 * 24 * 30 ); 
		$jiegou = array('b' => "登录成功！");
	}
	mysqli_close($db);
	header("refresh:0;url=index.php");
// echo "成功注册！";
}
?>