<?php 
    require_once "../head.php";
	$records_per_page=10;		//设置每页数据条数
	if(isset($_GET["page"]))	//获取页码
	$page=$_GET["page"];	
	else
		$page=1;				//若没指定则设为第一页
	if(isset($_COOKIE['user']))
	{	
		require_once 'db_connect.inc.php';
		$sql="select * from message where receive_user='${_COOKIE['user']}' order by mdate desc";		//通过cookie的用户名来查找消息详细信息
		$result=mysqli_query($db,$sql);		//sql命令
		$total_message=mysqli_num_rows($result);
		$total_pages=ceil($total_message/$records_per_page);	//计算获取总页数
		$started_record=$records_per_page*($page-1);			//获取本页开始序号
		mysqli_data_seek($result,$started_record);				//将记录指针移到本页第一条数据
	}else echo "用户登录出错，请重新登录！";
?>
<!DOCTYPE html>
<html>
<head>
	<title>消息中心</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css"/>
</head>
<style type="text/css">

</style>
<body style="background-color: #f6f6f6;">
	<div class="container" style="margin-top: 5em">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" href="index.php">用户动态</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="sys_message.php">系统通知</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="collection_up.php">收藏更新</a>
			</li>
		</ul>
	</div>
	<div class="container">
		<div class="row">
			<div>
				系统通知
			</div>
			
		</div>
	</div>
	<div class="container" style="margin-top: 2em">                
		<ul class="pagination justify-content-center">
				<?php if($page>1)				//产生导航翻页 
				echo'<li class="page-item"><a class="page-link" href="sys_message.php?page='.($page-1).'">上一页</a></li>';
				for($j=1;$j<=$total_pages;$j++)   //产生导航页码
				{
					if($j==$page)
						echo '<li class="page-item active"><a class="page-link" href="#">'.$j.'</a></li>';
					else
						echo '<li class="page-item"><a class="page-link" href="sys_message.php?page='.$j.'">'.$j.'</a></li>';
				}
				if($page<$total_pages)		//产生导航翻页
				echo '<li class="page-item"><a class="page-link" href="sys_message.php?page='.($page+1).'">下一页</a></li>';
				?>
			</ul>
		</div>
		<?php
		include "foot.php";
		?>

	</body>
</html>
