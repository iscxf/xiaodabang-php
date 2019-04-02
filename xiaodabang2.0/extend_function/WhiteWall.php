<?php 
	include('../head.php');
	$records_per_page=20;
	if(isset($_GET["page"]))
		$page=$_GET["page"];
	else
		$page=1;
	include('db_connect.inc.php');
	$sql="select * from WhiteWall order by wdate desc";
	$result=mysqli_query($db,$sql);
	$total_records=mysqli_num_rows($result);
	$total_pages=ceil($total_records/$records_per_page);
	$started_record=$records_per_page*($page-1);
	$love_record=$total_records;
	mysqli_data_seek($result,$started_record);
?>
<!DOCTYPE html>
<html>
<head>
	<title>表白墙</title>
	<link rel="stylesheet" href="http://localhost:8080/xiaodabang2.0/css/font-awesome.min.css">
	<script src="http://localhost:8080/xiaodabang2.0/js/myfunction.js"></script>
</head>
<style type="text/css">
body{background-color: #F9F9F9;}
</style>
<body>
	<div class="container" style="border-bottom: 1px solid #ccc;margin-top: 5em;padding-bottom: 1%">
		<button onclick="change_status(this.id);" id="off" class="btn btn-primary change_btn" type="button" data-toggle="collapse" data-target="#form_div" aria-expanded="false" aria-controls="form_div">
			    发布
			  </button>
			
			<div class="collapse" id="form_div">
			  <div class="card card-body">
			    <form class="form-group" id="w_form" action="whitewall_form.php" method="post">
			    	<i class='fa fa-heart text-danger'></i>
				    <input type="text" name="target" class="form-control col-md-3" style="display: inline ">
				    <small class="text-muted">
				     写下TA的名字
				    </small>
				    <h5>我想对你说:</h5>
					<textarea class="form-control" rows="3" type="text" name="content" id="input_content"/></textarea>
				</form>
				<button class="btn btn-primary" type="button" onclick="sub()">提交</button>
			  </div>
			</div>
	</div>
	<?php 
	$i=1;
	while ($row=mysqli_fetch_assoc($result) and $i<=$records_per_page) {
		echo "<div class='container' style='border-bottom:1px solid #ccc;'>
			<div class=''>
				<i class='fa fa-heart text-danger'>表白</i>
				<span>".$love_record."</span>
			</div>
			<div class=''>
				<h4>".$row["target"]."</h4>
				<p>".$row["wcontent"]."</p>
			</div>
		</div>";
		$love_record--;
		$i++;
	}
	?>
	<div class="container" style="margin-top: 2em">                
		<ul class="pagination justify-content-center">
			<?php if($page>1)				//产生导航翻页 
			echo'<li class="page-item"><a class="page-link" href="WhiteWall.php?page='.($page-1).'">上一页</a></li>';
			for($j=1;$j<=$total_pages;$j++)   //产生导航页码
			{
				if($j==$page)
					echo '<li class="page-item active"><a class="page-link" href="#">'.$j.'</a></li>';
				else
					echo '<li class="page-item"><a class="page-link" href="WhiteWall.php?page='.$j.'">'.$j.'</a></li>';
			}
			if($page<$total_pages)		//产生导航翻页
			echo '<li class="page-item"><a class="page-link" href="WhiteWall.php?page='.($page+1).'">下一页</a></li>';
			?>
		</ul>
	</div>
	<?php include('foot.php'); ?>
</body>
<script type="text/javascript">
	function getCookie(name){		//判断是否登录
	  var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	  if(arr != null) return unescape(arr[2]); 
	  return null;
	}
	function sub(){
        if(getCookie('user')==null){
        	alert("请先登录！");
        }
        else{
	        if(trim($("#input_content").val())==""){
	            alert("内容不能为空！");
	            $("#input_content").focus();
	            return;
	        }else
	        	$("#w_form").submit(); 
		    }
		}
	function trim(str){		 //删除左右两端的空格
    　　return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	function change_status(val){
			if(val=='off'){
				$('.change_btn').html('收起');
				$('.change_btn').attr('id','on');
			}
			else{
				$('.change_btn').html('发布');
				$('.change_btn').attr('id','off');
			}
			
		}
</script>
</html>
