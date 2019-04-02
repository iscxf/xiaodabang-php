<?php 
    require_once 'head.php';    //引入头部
	$records_per_page=10;		//设置每页数据条数
	if(isset($_GET["page"]))	//获取页码
	$page=$_GET["page"];	
	else
		$page=1;				//若没指定则设为第一页
	include 'db_connect.inc.php';		//数据库连接
	$sql="select * from question order by qdate desc";			//sql命令，查询问题表的全部数据
	$result=mysqli_query($db,$sql);							//执行sql命令
	$total_records=mysqli_num_rows($result);				//获取数据量
	$total_pages=ceil($total_records/$records_per_page);	//计算获取总页数
	$started_record=$records_per_page*($page-1);			//获取本页开始序号
	mysqli_data_seek($result,$started_record);				//将记录指针移到本页第一条数据
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<!-- <link rel="icon" href="images\xiaodabang_title_logo.png" type="image/x-icon"/> -->
	<link rel="shortcut icon" href="images\xiaodabang_title_logo.png">

	<title>校大帮</title>
	<script src="js/myfunction.js"></script>
	<style>
	body{background-color: #f6f6f6;}
	.comment_content{background-color:#fff;border-radius:10px;;padding: 0.5em 0.5em 0 0.5em;}
	a:hover, a:visited, a:link, a:active {text-decoration: none;color: black;}
	.extend_function{ position: fixed;max-width: 10em}
	.extend_function ul{background-color: #fff}
	.extend_function li:hover{background-color: #eee}
	.lable_a a{line-height: 1.5em;margin:0.8em 0.4em;}
</style>
</head>
<body style="background-color: #f6f6f6;">
	<div class="container" style="margin-top: 5em;">
		<div class="row justify-content-center clearfix">
			<div class="col-md-9  column">
				<div class="row justify-content-center" id="luenbo" style="margin-bottom:1em;">
					<div id="carouselExampleIndicators" class="carousel slide col-md-8" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<a href="#"><img class="d-block w-100" src="images/a2.jpg" alt="First slide"></a>
							</div>
							<div class="carousel-item">
								<a href="#"><img class="d-block w-100" src="images/b1.jpg" alt="Second slide"></a>
							</div>
							<div class="carousel-item">
								<a href="#"><img class="d-block w-100" src="images/c1.jpg" alt="Third slide"></a>
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
						</a>
					</div>
				</div>
				<?php 
					if($page!=1)					//页码为1则显示轮播图
					echo '<script>
					document.getElementById("luenbo").style.display="none";
				</script>';
					?>

					<?php
					$i=1;		//循环打印数据
					while ($row=mysqli_fetch_assoc($result) and $i<=$records_per_page) {
						$sql2="SELECT * from user where uname='".$row['author']."'"; 	//根据问题作者名查找相关用户信息
						$result2=mysqli_query($db,$sql2);		//执行sql命令
						$row2=mysqli_fetch_assoc($result2);
						$now_time=date("Y-m-d H:i:s", time());  
					    $now_time=strtotime($now_time);
					    $dur=$now_time-strtotime($row['qdate']); 
				        if ($dur<60) {  
				            $date2=$dur .'秒前';  
				        } else {  
				            if ($dur<3600) {  
				                $date2=floor($dur/60) . '分钟前';  
				            } else {  
				                if ($dur<86400) {  
				                    $date2=floor($dur/3600) . '小时前';  
				                } else {  
				                      $date2=floor($dur/86400) . '天前';  
				                   	}  
				                }  
				            }  
				    
						echo '<div class="comment_content">
						<h6 class="font-weight-bold" style="display:inline">
						'.$row['author'].'
						</h6>
						<span>'.$row2['status'].'</span>
						<h5 class="font-weight-bold">
							<a href="comment.php?id='.$row['id'].'">
								'.$row['theme'].'
							</a>
						</h5>
						<p>
							<a href="comment.php?id='.$row['id'].'">
								'.$row['content'].'
							</a>
						</p>
						<img style="width:8em;" src="'.$row['photo_url'].'">
						<div class="text-right" style="margin-bottom: 1em;padding-bottom:0.5em">
							<span style="margin-right:1em"><img style="width:1.2em" src="images/time.png" alt="分享" title="分享">'.$date2.'</span>
							<a href="comment.php?id='.$row['id'].'"><img style="width:1.2em" src="images/comments.png" alt="评论" title="评论"></a>
							<span style="margin-right:1em">'.$row['reply'].'</span>
							<a style="margin-right:1em" href="#"><img style="width:1.2em" src="images/share.png" alt="分享" title="分享"></a>
						</div>
						</div>';
						$i++;
					}
					?>
				</div>
				<div class="col-sm-2 d-none d-sm-block" >
					<div class="extend_function">
						<ul class="list-unstyled text-center">	
							<li><a class="nav-link" href="http://localhost:8080/xiaodabang2.0/extend_function/aboutme.php">关于</a></li>
							<li class="nav-item">
								<a class="nav-link" href="http://localhost:8080/xiaodabang2.0/extend_function/WhiteWall.php"><i class='fa fa-heart text-danger'></i>表白墙</a>
							</li>
							<li><a class="nav-link" href="http://localhost:8080/xiaodabang2.0/extend_function/feedback.php"><i class='fa fa-pencil-square-o text-info'></i>反馈留言</a></li>
							<!-- <li><a class="nav-link" href="#">校园简讯</a></li>
							<li><a class="nav-link" href="#">校历查看</a></li> -->
						</ul>
						<div  class="text-center" style="background-color: #fff;margin-top: 1em;">
							<h5>标签选择</h5>
							<div class="lable_a" >
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container" style="margin-top: 2em">                
			<ul class="pagination justify-content-center">
				<?php if($page>1)				//产生导航翻页 
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

			<div class="container text-center">
				<?php require 'foot.php' ?>
			</div>
	</body>
<script type="text/javascript">
	$(document).ready(function() {
		$.ajax({
				url: "lable_ajax.php",
				type: 'post',
				dataType: 'json',
				data: {case: "lable_choose"},
				error : function(XMLHttpRequest, textStatus, errorThrown) {//这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
				　　　　alert(XMLHttpRequest.responseText); 
				alert(XMLHttpRequest.status);
				alert(XMLHttpRequest.readyState);
				alert(textStatus); // parser error;
				},
				success:return_lable
			})
		
		function return_lable(json){
		var arr_color=['rgb(255,238,210)','rgb(108,185,78)','rgb(230,155,3)','rgb(209,73,78)','rgb(108,73,78)','rgb(108,185,78)','rgb(35,68,108)','rgb(93,108,52)'];
			if(json!=''){
				var j=0;
				$.each(json, function(i, val) {    //循环json对象，新增数据
					$(".lable_a").append('<a href="http://localhost:8080/xiaodabang2.0/topic/index.php?lable_id='+val.id+'" class="badge badge-pill"  style="background: '+arr_color[j]+'">'+val.name+'</a>');
					j++;
				});
			}
		}
});
</script>
</html>