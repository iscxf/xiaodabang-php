<?php 
	require_once '../head.php';
	if(isset($_COOKIE['user']))
	{	
		// include 'db_connect.inc.php';
		$sql="select * from user where uname='${_COOKIE['user']}'";		//通过cookie的用户名来查找消息详细信息
		$result=mysqli_query($db,$sql);		//sql命令
		$total_message=mysqli_num_rows($result);
	}else echo "用户登录出错，请重新登录！";
?>
<!DOCTYPE html>
<html>
<head>
	<title>个人中心</title>
	<link rel="stylesheet" href="http://localhost:8080/xiaodabang2.0/css/font-awesome.min.css"/>
	<script src="http://localhost:8080/xiaodabang2.0/js/myfunction.js"></script>
</head>
<style type="text/css">
body{background-color: #F6f6f6;}
</style>
<body>
	<div class="container" style="margin-top: 5em">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" href="#">基本信息</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">账号管理</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">我的问题</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">我的回答</a>
			</li>
		</ul>
	</div>
	<div class="container">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link" href="#">头像</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">账号名称</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">兴趣话题</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">身份认证</a>
			</li>
		</ul>
	</div>

</body>
</html>