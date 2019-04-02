<?php 
require_once '../head.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>话题</title>
	<script src="http://localhost:8080/xiaodabang2.0/js/myfunction.js"></script>
	<style type="text/css">
	.lable_content h6{display: inline;}
	.lable_content img{width: 8em}
	.content_foot{margin-bottom: 1em;padding-bottom:0.5em}
	.content_foot img{width: 1.2em}
	.content_foot span{margin-right: 1em}
	.comment_content a:hover,.comment_content a:visited,.comment_content a:link,.comment_content a:active {text-decoration: none;color: black;}
	.lable_a a{line-height: 1.5em;margin:0.8em 0.4em;}
</style>
</head>
<body style="background-color: #f6f6f6">
	<div class="container" style="margin-top: 5em">
		<ul class="nav nav-tabs" >
			<li class="nav-item dropdown ">
				<a class="nav-link" id="down_item" data-toggle="tab" href="#" onclick="open_dropdown()">热门标签</a>
				<div class="dropdown-menu lable_choose">
					<a class="dropdown-item" href="javascript:void(0)" onclick="up_dropdown(this.innerHTML)">优化</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="up_dropdown(this.innerHTML)">测试</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="up_dropdown(this.innerHTML)">询问</a>
					<a class="dropdown-item" href="javascript:void(0)" onclick="up_dropdown(this.innerHTML)">游戏</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" id="recommend" href="javascript:void(0)" onclick="question_ajax(this.id)">推荐</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" id="hot" href="javascript:void(0)" onclick="question_ajax(this.id)">热门</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" id="classify" href="javascript:void(0)" onclick="question_ajax(this.id)">分类</a>
			</li>
		</ul>
	</div>
	<div class="container">

	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-10 lable_content">
			</div>
			<div class="col-sm-2 d-none d-sm-block">
				<h5>标签选择</h5>
				<div class="lable_a" >
				
				</div>
			</div>
		</div>
	</div>
		
	<?php 
	include "foot.php";
	?>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		lable_choose_ajax();
		function GetQueryString(lable_id) {     //js获取其他页面传来的标签id
			var reg = new RegExp("(^|&)" + lable_id + "=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if (r != null) return unescape(r[2]); return null;
		}
		var lable_id=GetQueryString('lable_id');  //根据id来查找标签名
		if (lable_id!=null) {
			$.ajax({
				url: "question_ajax.php",
				type: 'post',
				dataType: 'text',
				data: {case: "search_lable",lable_id:lable_id},
				error : function(XMLHttpRequest, textStatus, errorThrown) {//这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
					　　　　alert(XMLHttpRequest.responseText); 
					alert(XMLHttpRequest.status);
					alert(XMLHttpRequest.readyState);
				alert(textStatus); // parser error;
			},
			success:return_lable_name
		})
		}else {
			$("#recommend").click();
		}
		
	});
	function return_lable_name(text){
		if(text!=''){
			$(".lable_a").html('');   //清空本来页面打开时的标签
			up_dropdown(text);  //查找到标签名就修改下拉菜单名称
			$('#down_item').addClass("active");
			lable_choose_ajax();
		}
		else {
			$("#recommend").click();
		}
	}

	function lable_choose_ajax(){    //标签选择栏的标签的请求
		$.ajax({     //请求标签
			url: "../lable_ajax.php",
			type: 'post',
			dataType: 'json',
			data: {case: "lable_choose"},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				　　　　alert(XMLHttpRequest.responseText); 
				alert(XMLHttpRequest.status);
				alert(XMLHttpRequest.readyState);
				alert(textStatus); // parser error;
			},
			success:return_lable
		})
	}

	function return_lable(json){  //循环打印标签选择栏的标签
		var arr_color=['rgb(255,238,210)','rgb(108,185,78)','rgb(230,155,3)','rgb(209,73,78)','rgb(108,73,78)','rgb(108,185,78)','rgb(35,68,108)','rgb(93,108,52)'];
		if(json!=''){
			var j=0;
				$.each(json, function(i, val) {    //循环json对象，新增数据
					$(".lable_a").append('<a href="http://localhost:8080/xiaodabang2.0/topic/index.php?lable_id='+val.id+'" class="badge badge-pill"  style="background: '+arr_color[j]+'">'+val.name+'</a>');
					j++;
				});
			}
		}

	function open_dropdown(){   //切换选择标签
		$('.lable_choose').toggle();
	}

	function up_dropdown(val){
		$('.lable_choose').hide();
		$('#down_item').text(val);
		question_ajax(val);
	}
	function question_ajax(data){
		$(".lable_choose").hide();     //如果元素为显现,则将其隐藏
		$.ajax({
			url: "question_ajax.php",
			type: 'post',
			dataType: 'json',
			data: {case: data},
			error : function(XMLHttpRequest, textStatus, errorThrown) {//这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
				　　　　alert(XMLHttpRequest.responseText); 
				alert(XMLHttpRequest.status);
				alert(XMLHttpRequest.readyState);
			alert(textStatus); // parser error;
		},
		success:lable_ajax
	})
		function lable_ajax(json){
			$(".lable_content").html('');
			// console.log("success");
			$.each(json, function(i, val) {  //循环json对象，新增数据
				$(".lable_content").append('<div class="comment_content" style="border-bottom:1px solid #ccc;">'+
					'<h6 class="font-weight-bold">'+val.author+'</h6>'+
					'<span style="font-size:0.8em;margin-left:10%"><img style="width: 1.2em" src="../images/lable.png" alt="分享" title="分享">'+val.qtopic+'</span>'+
					'<h5 class="font-weight-bold"><a href="../comment.php?id='+val.id+'">'+val.theme+'</a></h5>'+
					'<p><a href="../comment.php?id='+val.id+'">'+val.content+'</a></p>'+
					'<img src="../'+val.photo_url+'">'+
					'<div class="text-right content_foot">'+
					'<span><img src="../images/time.png" alt="分享" title="分享">'+val.date+'</span>'+
					'<a href="../comment.php?id='+val.id+'"><img src="../images/comments.png" alt="评论" title="评论"></a>'+
					'<span>'+val.reply+'</span>'+
					'<a style="margin-right:1em" href="javascript:void(0)"><img src="../images/share.png" alt="分享" title="分享"></a>'+
					'</div>'+
					'</div>');
			});
			$('img').each(function(){
			    var obj=$(this);
			    if($.trim(obj.attr('src'))=='../' || $.trim(obj.attr('src'))=='../null'){
			        obj.hide();
			    }
			});
			function trim(str){ //删除左右两端的空格
    	　　     return str.replace(/(^\s*)|(\s*$)/g, "");
    		}
		}
	}

</script>
</html>