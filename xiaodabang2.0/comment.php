<?php 
	include('head.php');		//引入头部
	include 'db_connect.inc.php';
	$question_id=$_REQUEST['id'];
	$sql="select * from question where id='".$question_id."'";		//通过评论连接传过来的问题id来查找问题详细信息
	$result=mysqli_query($db,$sql);		//sql命令
	$row=mysqli_fetch_assoc($result);
	//echo $_REQUEST['id'];
	$sql2="select * from reply where question_id='".$question_id."' order by rdate desc";
	$result_reply=mysqli_query($db,$sql2);
	$total_comment=mysqli_num_rows($result_reply);
	// if(!is_resource($result)) 	//判断是否有回复的数据
	// {
	// 	$row2=mysqli_fetch_assoc($result_reply);
	// }
	
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

	?>
<!DOCTYPE html>
<html>
<head>
	<title>评论</title>
	<style type="text/css">
	#bt_up{background-color: #e5f2ff;color: #0084ff; border-radius:5px; box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.5);border:none;margin:0 0 5px;padding:5px;}
	/*#image{margin-top: 1em;max-width: 100%;max-height:10em; }*/
	a:hover, a:visited, a:link, a:active {text-decoration: none;color: black;}
	.lable_a a{line-height: 1.5em;margin:0.8em 0.4em;}
	</style>
</head>
<body style="background-color: #f6f6f6">
	 <div class="container" style="margin-top: 5em">
		<div class="row">
			<div class="col-md-9">
				<div style="">
					<h3><?php echo $row['theme'] ?></h3>		<!--打印问题主题-->
					
					<span><?php echo $row['author'] ?></span>
					<span class=""><?php echo $date2 ?></span>
					<img style="width:1.2em;" src="images/lable.png" alt="标签" title="标签">
					<a href="#"><?php echo $row['qtopic'] ?></a>
					<button type="button" class="btn btn-primary love float-right" value='<?php echo $row['id'] ?>' onclick="mylove()">收藏</button>
				</div>
				<div style="padding: 1em;border-bottom:1px solid #ccc;margin-bottom: 1em;">
				<p class="lead"><?php echo $row['content'] ?></p>		<!--打印问题内容-->
				<?php echo "<img id='image' src=".$row['photo_url'].">" ?>
				</div>
						
			  <button onclick="change_status(this.id);" id="off"  class="btn btn-primary change_btn" type="button" data-toggle="collapse" data-target="#comment_div" aria-expanded="false" aria-controls="comment_div">
			    评论
			  </button>
			
			<div class="collapse" id="comment_div">
			  <div class="card card-body">
			    <form class="form-group" action="comment_form.php" method="post" id="c_form">
					<input class="form-control" type="hidden" name="question_id" value="<?php echo $question_id ?>"/>
					<input class="form-control" type="hidden" name="receive_author" value="<?php echo $row['author']?>"/>
					<textarea class="form-control" rows="3" type="text" name="content" id="input_content"/></textarea>
				</form>
				<button class="btn btn-primary" type="button" id="close_comment" onclick="sub()">提交评论</button>
			  </div>
			</div>

			<?php 
		$i=1;

		if ($total_comment==0) {
			echo "<p class='text-center'>暂无评论，赶紧抢占沙发！</p>";
		}
		while($row2=mysqli_fetch_assoc($result_reply) and $i<=$total_comment) {
			echo"<div class='' style='border-bottom:1px solid #ccc;margin-top:1em;'>
					<h3>".$row2['sender_author']."</h3>
					<p>".$row2['content']."</p>
				<div  class='text-right'>
					<span>".$row2['rdate']."</span>";
				if(isset($_COOKIE['user'])){
				$sql3="SELECT status FROM up WHERE up_user_name='${_COOKIE['user']}' AND reply_id='".$row2['id']."'";
				$result_up=mysqli_query($db,$sql3);
				$row3=mysqli_fetch_assoc($result_up);}
					if(isset($_COOKIE['user'])&&$row3!=NULL && $row3['status']==1){
					echo"<button type='button' value='".$row2['id']."' id='bt_up' class='fa fa-thumbs-up' '><span>".$row2['up']."</span></button>
					</div>
				</div>";}
				else {
					echo"<button type='button' value='".$row2['id']."' id='bt_up' class='fa fa-thumbs-o-up' '><span>".$row2['up']."</span></button>
					</div>
				</div>";
			}
				$i++;
		}
	?>
			</div>
			<div class="col-md-3 d-none d-sm-block" style="position: relative;">
				<div style="height: 20em;width: 10em; position: fixed;">
					<h5>标签选择</h5>
					<div class="lable_a" >
						
					</div>
				</div>
			</div>
		</div>
	<?php include('foot.php');?> 
	 </div>
</body>
<script>
	$(document).ready(function(){  

		$.ajax({     //请求标签
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
		
		function return_lable(json){  //循环打印标签
		var arr_color=['rgb(255,238,210)','rgb(108,185,78)','rgb(230,155,3)','rgb(209,73,78)','rgb(108,73,78)','rgb(108,185,78)','rgb(35,68,108)','rgb(93,108,52)'];
			if(json!=''){
				var j=0;
				$.each(json, function(i, val) {    //循环json对象，新增数据
					$(".lable_a").append('<a href="http://localhost:8080/xiaodabang2.0/topic/index.php?lable_id='+val.id+'" class="badge badge-pill"  style="background: '+arr_color[j]+'">'+val.name+'</a>');
					j++;
				});
			}
		}

  		$(document).on("click",".fa-thumbs-o-up",function(e){
  		if(getCookie('user')==null){
        	alert("请先登录！");
        }else{ 
  			$(this).attr("class","fa fa-thumbs-up");
  			var reply_id=$(this).val();  //reply_id的值
  			up('up',reply_id);
  		} 
		});  
		$(document).on("click",".fa-thumbs-up",function(e){  
  			$(this).attr("class","fa fa-thumbs-o-up");
  			var reply_id=$(this).val();  //reply_id的值
  			up('cancel_up',reply_id);

		});
	}); 


	function change_status(val){
		if(val=='off'){
			$('.change_btn').html('收起');
			$('.change_btn').attr('id','on');
		}
		else{
			$('.change_btn').html('评论');
			$('.change_btn').attr('id','off');
		}
		
	}
	function up(x,y){
		// var reply_id=$(this).val();  //reply_id的值
		var question_id=$(".love").val();  //love问题的id值
	    $.ajax({
	       url:'up_ajax.php', 
	       type:'post',      
	       dataType:'json',     
	       data:{reply_id:y,question_id:question_id,case:x,number:Math.random()},       
	       // success:$("button[value="+y+"] #up_sum").html(text);
	       success:up_update,
	    	});
	    function up_update(text) {
  			$("button[value="+y+"] span").text(text);
		}
   		};

	
	function mylove() {
	    var reply_id=$(".love").val();  //reply_id的值
		alert("已收藏！（其实是骗你的）");
	}
	function open_comment(){
		document.getElementById("comment_form").style.display="block";
		document.getElementById("open_comment").style.display="none";
		document.getElementById("close_comment").style.display="block";
	}
	function close_comment(){
		document.getElementById("comment_form").style.display="none";
		document.getElementById("open_comment").style.display="block";
		document.getElementById("close_comment").style.display="none";
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
	        	$("#c_form").submit(); 
		    }
		}
    function trim(str){		 //删除左右两端的空格
    　　     return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	function getCookie(name){		//判断是否登录
	  var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	  if(arr != null) return unescape(arr[2]); 
	  return null;
	}
</script>
</html>