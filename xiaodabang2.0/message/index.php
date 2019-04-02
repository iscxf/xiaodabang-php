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
		$sql2="update message set status=0 where receive_user='${_COOKIE['user']}'";
		mysqli_query($db,$sql2);		//sql命令
	}else echo "用户登录出错，请重新登录！";
?>
<!DOCTYPE html>
<html>
<head>
	<title>消息中心</title>
	<link rel="stylesheet" href="http://localhost:8080/xiaodabang2.0/css/font-awesome.min.css"/>
	<style type="text/css">
a:hover, a:visited, a:link, a:active {text-decoration: none;color: #7a7a7a;}
a:hover, a:active {text-decoration: none;color: black;}
.message_user_name{color: black !important;}
</style>
</head>
<style type="text/css">
	.chose .active{color: black !important; font-size: 1.2em;  }
</style>
<body style="background-color: #f6f6f6;">
	<div class="container" style="margin-top: 5em">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" id="message_user_dynamics" href="index.php">用户动态</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="sys_message.php">系统通知</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="collection_up.php">收藏更新</a>
			</li>
		</ul>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-2" style="border-right:1px solid #ccc; margin-top: 0.5em; padding:0 -2rem 0 0; height: 10em">
				<ul class="nav flex-column text-center chose">
					<li class="nav-item">
						<a class="nav-link all" href="#all" data-toggle="tab">全部</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#comment" data-toggle="tab">评论</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#up" data-toggle="tab">点赞</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#callme" data-toggle="tab">@我</a>
					</li>
				</ul>
			</div>
			<div class="col-10">
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade show active" id="all">
						<?php 
						$i=1;
						$result=mysqli_query($db,$sql);	
						while($row=mysqli_fetch_assoc($result) and $i<=$records_per_page) {
							echo"
							<div style='margin: 0.5em 0.5em 0 0.5em;border-bottom:1px solid #ccc;'>
							<h4 class='font-weight-bold' style='display:inline'></h4>
							<a class='message_user_name' href='javascript:void(0)'>".$row['send_user']."</a>
							<p><a href='http://localhost:8080/xiaodabang2.0/comment.php?id=".$row['question_id']."'>".$row['content']."</a></p>
							<span>".$row['mdate']."</span>
							</div>
							";
							$i++;
						}
						?>
					</div>
					<div class="tab-pane fade" id="comment">
						<?php 
						$result=mysqli_query($db,$sql);	
						$i=1;
						while($row=mysqli_fetch_assoc($result) and $i<=$records_per_page) {
							if($row['flag']=='2')
								echo"
								<div style='margin: 0.5em 0.5em 0 0.5em;border-bottom:1px solid #ccc;'>
								<h4 class='font-weight-bold' style='display:inline'></h4>
								<a class='message_user_name' href='javascript:void(0)'>".$row['send_user']."</a>
								<p><a href='http://localhost:8080/xiaodabang2.0/comment.php?id=".$row['question_id']."'>".$row['content']."</a></p>
								<span>".$row['mdate']."</span>
								</div>
								";
							$i++;
						}
						?>
					</div>
					<div class="tab-pane fade" id="up">
						<?php 
						$result=mysqli_query($db,$sql);	
						$i=1;
						while($row=mysqli_fetch_assoc($result) and $i<=$records_per_page) {
							if($row['flag']=='3')
								echo"
								<div style='margin: 0.5em 0.5em 0 0.5em;border-bottom:1px solid #ccc;'>
								<h4 class='font-weight-bold' style='display:inline'></h4>
								<a class='message_user_name' href='javascript:void(0)'>".$row['send_user']."</a>
								<p><a href='http://localhost:8080/xiaodabang2.0/comment.php?id=".$row['question_id']."'>".$row['content']."</a></p>
								<span>".$row['mdate']."</span>
								</div>
								";
							$i++;
						}
						?>
					</div>
					<div class="tab-pane fade" id="callme">
						<?php 
						$result=mysqli_query($db,$sql);	
						$i=1;
						while($row=mysqli_fetch_assoc($result) and $i<=$records_per_page) {
							if($row['flag']=='4')
								echo"
								<div style='margin: 0.5em 0.5em 0 0.5em;border-bottom:1px solid #ccc;'>
								<h4 class='font-weight-bold' style='display:inline'></h4>
								<a class='message_user_name' href='javascript:void(0)'>".$row['send_user']."</a>
								<p><a href='http://localhost:8080/xiaodabang2.0/comment.php?id=".$row['question_id']."'>".$row['content']."</a></p>
								<span>".$row['mdate']."</span>
								</div>
								";
							$i++;
						}
						?>
					</div>
				</div>

			</div>
		</div>
	</div>




	<div class="container" style="margin-top: 2em">                
		<ul class="pagination justify-content-center">
				<?php 
				if($page>1)				//产生导航翻页 
					echo'<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'">上一页</a></li>';
				for($j=1;$j<=$total_pages;$j++)   //产生导航页码
				{
					if($j==$page)
						echo '<li class="page-item active"><a class="page-link" href="#">'.$j.'</a></li>';
					else
						echo '<li class="page-item"><a class="page-link" href="index.php?page='.$j.'">'.$j.'</a></li>';
				}
				if($page<$total_pages)		//产生导航翻页
				echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'">下一页</a></li>';
				?>
			</ul>
		</div>
		<?php
		include "foot.php";
		?>

</body>
<script type="text/javascript">
$(document).ready(function(){
	$(".all").click();
	$("#message_user_dynamics").addClass("active");
});
</script>
</html>
