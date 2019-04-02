<?php
$db = @mysqli_connect("localhost","root","123456","xiaodabang");
	$a = "SELECT * from user where uname='${_POST['q']}' AND password='${_POST['w']}'";	//通过ajax接收到数据并进行sql命令
	//$a = "SELECT * from User where user='aaa' AND password='123456'";
	$res = mysqli_query($db,$a);
	$row = mysqli_fetch_object($res);
	//$jiegou[]=$row->user;
	//$jiegou[1]="登录成功！";
	
	if($row!=null){
		setcookie("user", $row->uname, time() + 3600 * 24 * 30); 	//设置用户名cookie
		setcookie ( "pwd", $row->password, time () + 3600 * 24 * 30 );		//设置用户密码cookie
		//$jieguo = array('a'=> $_COOKIE['user']);
		$jieguo = array('b' => "登录成功！");		//登录成功返回信息
		$text='登录成功！';
		echo $text;
		    // header("refresh:0;url=index.html");
	}else{
		$jieguo = array('b' => "用户名或密码不正确！");		//登录失败返回信息
		// echo json_encode($jieguo);
		$text='用户名或密码不正确！';
		echo $text;
	    // header("refresh:3;url=index.html");
	}
?>