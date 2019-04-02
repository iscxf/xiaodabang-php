<?php 
 ob_start();
  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://localhost:8080/xiaodabang2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost:8080/xiaodabang2.0/css/font-awesome.min.css">
	<script src="http://localhost:8080/xiaodabang2.0/js/jquery.min.js"></script>
	<script src="http://localhost:8080/xiaodabang2.0/js/bootstrap.bundle.min.js"></script>
	<script src="http://localhost:8080/xiaodabang2.0/js/bootstrap.min.js"></script>
	<script src="http://localhost:8080/xiaodabang2.0/js/myfunction.js"></script>
</head>
<style type="text/css">
.navbar-nav > li:hover .dropdown-menu {display: block;}
.file_div{position: relative;height: 5em;width: 5em;display: inline-block;padding: 0.5em 1em;overflow: hidden;line-height: 2em;}
.input_file{position: absolute;font-size: 0;height: 80px;width: 80px;top: 0;left: 0;opacity: 0;cursor:pointer;}
.file_span{ position: absolute;width: 5em;height: 5em;top: 0;left: 0;}
.photo_quit{display: none}
#image{margin-top: 1em;max-width: 100%;max-height:10em; }
#other_topic,.navbar_search{position: relative;}
.login_off,.login_on,.lable_tips,.all_search_tips{display: none}
.all_search_tips,.lable_tips{position: absolute;top:2.5em;z-index: 999;background-color: #fff;width: 80%;overflow:hidden;max-height: 10em;border:1px #ccc solid;border-radius: 0.2em;}
.lable_tips{top:2.4em;max-height: 8.5em;width:90%;}
.lable_tips_ul,.all_search_tips_ul{margin:0;}
.all_search_tips li:hover{background-color: #eee}
.lable_tips li:hover{background-color: #eee}
.hot_topic span:hover{cursor:pointer}
.lable_tips,.all_search_tips li{cursor:pointer}
</style>
<body>
	<!-- <div class="container"> -->
		<nav class="navbar navbar-expand-sm navbar-light bg-dark navbar-dark fixed-top ">
			<div class="col-sm-2"></div>
			<a class="navbar-brand" href="http://localhost:8080/xiaodabang2.0/index.php">
				<img class="img-fluid" src="http://localhost:8080/xiaodabang2.0/images/xiaodabang_logo.png" alt="校大帮" title="校大帮" style="width:5em;">
			</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse navbar_search" id="navbarSupportedContent">
				<ul class="navbar-nav first_nav">
					<li class="nav-item">
						<a class="nav-link" href="http://localhost:8080/xiaodabang2.0/index.php">首页</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://localhost:8080/xiaodabang2.0/topic/">标签</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://localhost:8080/xiaodabang2.0/extend_function/aboutme.php">关于</a>
					</li>
				</ul>
				<div class="navbar_search">
					<div class="input-group mb-3 my-2 my-sm-0">
						<input type="text" class="form-control" id="all_search_input" name="all_search_input" placeholder="搜索相关问题内容..." onkeyup="search_ajax(this.name,this.value)">
						<div class="input-group-append">
						   <button class="btn btn-light" type="button"><span class="fa fa-search" style="font-size:1.2em;"></span></button>
						</div>
					</div>
					<div class="all_search_tips">
						<ul class="all_search_tips_ul list-unstyled">
						</ul>
					</div>
				</div>				
				<button type="button" class="btn btn-primary mr-auto" data-toggle="modal" data-target="#myModal" style="margin-left: 1em;">提问</button>
				
				<ul class="navbar-nav login_off" id="login_off" >
					<li class="nav-item">
						<a class="nav-link" data-toggle="modal" data-target="#login" href="javascript:void(0)">登录</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="http://localhost:8080/xiaodabang2.0/register.html">注册</a>
					</li>
				</ul>
				<nav class="navbar-nav login_on" id="login_on" >
					<li class="nav-item">
						<a class="nav-link" href="http://localhost:8080/xiaodabang2.0/message/">消息<span class="badge badge-pill badge-danger" id="txtHint_total_message"></span></a>
						
					</li>
					<li class="dropdown nav-item">
						<a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
							<span id="username_text"><?php if(isset($_COOKIE['user'])) echo $_COOKIE['user']; ?></span>
							<span class="fa fa-ellipsis-v"></span>
						</a>
						<ul class="dropdown-menu text-center" style="min-width: 6em">
							<li><a href="http://localhost:8080/xiaodabang2.0/user/">个人中心</a></li>
							<li><a href="http://localhost:8080/xiaodabang2.0/logout.php">注销用户</a></li>
						</ul>
					</li>
				</nav>
			</div>
			<div class="col-sm-2"></div>
			
		</nav>
	<!-- </div> -->
	<div class="modal fade" id="myModal" >

		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content text-center">

				<!-- 模态框头部 -->
				<div class="modal-header">
					<h4 class="modal-title">填写问题内容</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- 模态框主体 -->
				<div class="modal-body">
					<form class="tiwen_input" id="t_form" action="http://localhost:8080/xiaodabang2.0/tiwen_form.php" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="theme" class="col-sm-2 col-form-label">主题：</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="theme" name="theme">
							</div>
						</div>
						<div class="form-group row">
							<label for="content" class="col-sm-2 col-form-label">详细：</label>
							<div class="col-sm-10">
								<!-- <input type="text" class="form-control" id="content" name="content"> -->
								<textarea class="form-control" rows="3" type="text" name="content" id="content"/></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="topic_input" class="col-sm-2 col-form-label">标签：</label>
							<div class="col-sm-7" id="other_topic">
								<input type="text" class="form-control" id="topic_input" name="topic_input" onkeyup="search_ajax(this.name,this.value)">
								<div class="lable_tips text-left">
									<ul class="list-unstyled lable_tips_ul">
									</ul>
								</div>
							</div>
							<span class="badge badge-pill badge-info show_topic" id="topic" style="height: 1.5em;margin: 1em 1em 0 1em"></span>
							<button type="button" class="close show_off" aria-label="Close" onclick="off_topic()">
								<span aria-hidden="true">&times;</span>
							</button>
							<button type="button" class="btn btn-primary add_topic" onclick="add_topic()">添加</button>
						</div>
						<div class="hot_topic">
							<sapn>热门<img style="width:1.2em;" src="http://localhost:8080/xiaodabang2.0/images/lable.png" alt="标签" title="标签">:</sapn>
							<span class="badge badge-pill badge-primary" onclick="top_topic(this)">失物招领</span>
							<span class="badge badge-pill badge-primary" onclick="top_topic(this)">电脑网络</span>
							<span class="badge badge-pill badge-primary" onclick="top_topic(this)">学习问答</span>
						</div>
						<div class="form-group row">
							<label for="photot" class="col-sm-3 col-form-label">添加图片：</label>
							<div class="col-sm-9 file_div" id="file_div">
									<img class="file_span" src="http://localhost:8080/xiaodabang2.0/images/add.png"/>
									<input id="input_file" class="input_file" type="file" name="file" accept=".jpg,.jpeg,.png" onchange="selectImage(this);" />
							</div>
							<img id="image" class="img-responsive" src=""/>
							<button type="button" class="close photo_quit" aria-label="Close" onclick="photo_off()" id="photo_quit">&times;</button>
						</div>
					</form>
					<button   type="button" class="btn btn-primary btn-block" onclick="tiwen_sub()" style="margin-top: 2em;">提交</button>
					<p><span class="badge badge-pill badge-danger" id="txtHint1"></span></p>
				</div>
				<!-- 模态框底部 -->
				<div class="modal-footer text-center">
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="login" >

		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content text-center">

				<!-- 模态框头部 -->
				<div class="modal-header">
					<h4 class="modal-title">登录</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- 模态框主体 -->
				<div class="modal-body">
					<form class="login_input" action="http://localhost:8080/xiaodabang2.0/check_form.php" method="post" >
						<div class="form-group row">
							<label for="Username" class="col-sm-2 col-form-label">账 号：</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="Username" name="zhanghao" placeholder="Uername">
							</div>
						</div>
						<div class="form-group row">
							<label for="Password" class="col-sm-2 col-form-label">密 码：</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="Password" name="mima" placeholder="Password">
							</div>
						</div>
					</form>
					<button name="submit" class="btn btn-primary btn-block"  style="margin-top: 2em;" onclick="login()" >登录</button>
					<p><span class="badge badge-pill badge-danger" id="txtHint"></span></p>
					<div class="login_register">
						<span>没有账号？</span>
						<a href="register.html">快速注册</a>
					</div>
					<a class="login_forget" href="#">忘记密码？</a>
				</div>
				<!-- 模态框底部 -->
				<div class="modal-footer text-center">
				</div>

			</div>
		</div>
	</div>
</body>
<?php
	chdir(dirname(__FILE__));        //文件定位，相对路径
	require_once 'db_connect.inc.php';
	if(isset($_COOKIE['user'])){		//检查是否登录
		$sql = "SELECT * from user where uname='${_COOKIE['user']}' AND password='${_COOKIE['pwd']}'";
		$sql2="SELECT * from message where receive_user='${_COOKIE['user']}' AND status='1'";
		$result1 = mysqli_query($db,$sql);
		$row = mysqli_fetch_object($result1);
		$result2=mysqli_query($db,$sql2);
		$total_unread_message=mysqli_num_rows($result2);
		if($row!=null){				//已登录则改变导航栏信息
			echo '<script>
			document.getElementById("login_on").style.display="inherit";
			</script>';
			if ($total_unread_message!=0) {
				echo '<script>
				document.getElementById("txtHint_total_message").innerHTML="'.$total_unread_message.'";
				</script>';
			}	
		}else{
			$logout_url = 'logout.php';
			header('Location:'.$logout_url);

		}
	}else{
		echo '<script>
		document.getElementById("login_off").style.display="inherit";
		</script>';
	}
?>
<script>
	$(".show_off").hide();
	function add_topic(){	                   //话题添加和删减
		var topic=$('input[name=topic_input]').val(); //话题的值
		if(trim(topic)!=null && trim(topic)!=""){
			$(".tiwen_input #other_topic").hide();
			$(".add_topic").hide();
			$(".show_topic").html(topic);
			$(".show_topic").show();
			$(".show_off").show();
			$(".hot_topic").hide();
		}else $("#txtHint1").val("话题不能为空！");
	}
	$('input[name=topic_input]').bind('keypress', function (event) {  //按回车键也能添加
		if (event.keyCode == "13") {
			$(".add_topic").click();
		}
	})
	function top_topic(x){	
			var topic=$(x).html(); //话题的值
			$(".tiwen_input #other_topic").hide();
			$(".add_topic").hide();
			$(".show_topic").html(topic);
			$(".show_topic").show();
			$(".show_off").show();
			$(".hot_topic").hide();
		}
		function off_topic(){
			$(".show_topic").hide();
			$(".show_off").hide();
			$("input[name=topic_input]").val("")
			$(".tiwen_input #other_topic").show();
			$(".add_topic").show();
			$(".hot_topic").show();
			$(".lable_tips").hide(); // 隐藏补全提示框
		}



		var image = '';                         //添加图片和取消图片
		function selectImage(file) {
			if (!file.files || !file.files[0]) {
				return;
			}
			var reader = new FileReader();
			reader.onload = function (evt) {
				document.getElementById('image').src = evt.target.result;
				image = evt.target.result;
			}
			reader.readAsDataURL(file.files[0]);
			document.getElementById('file_div').style.display="none";

			document.getElementById('photo_quit').style.display="inline";
		}
		function photo_off(){                     //取消图片
			document.getElementById('input_file').value="";
			document.getElementById('file_div').style.display="inline-block";
			document.getElementById('photo_quit').style.display="none";
			document.getElementById('image').src ="";
		}



    function login(){
   		var str=$("#Username").val();
		var str2=$("#Password").val();
		str2=str2.replace(/\%/g,"%25"); 
		str2=str2.replace(/\#/g,"%23"); 
		str2=str2.replace(/\&/g,"%26");
		str2=str2.replace(/\+/g,"%2B");
	    $.ajax({
	       url:'http://localhost:8080/xiaodabang2.0/check_form.php', //后台处理程序
	       type:'post',         //数据发送方式
	       dataType:'text',     //接受数据格式
	       data:{q:str,w:str2 },       //要传递的数据
	       success:update_login //回传函数(这里是函数名)
	    	});
   		};

	 function update_login (text) {
	 	if(text=="登录成功！"){
	 		document.getElementById("txtHint").innerHTML=text;
	 		$(".login_mask").fadeOut(100);
			$(".login_form").slideUp(200);
			window.location.reload(true);
	    }else{
	    	document.getElementById("txtHint").innerHTML=text;
	    }
	}

   function tiwen(){
   		var theme=$("#theme").val();
		var content=$("#content").val();
		var topic=$("#topic").text();
		var photo=$("#input_file")[0].files[0];    // js 获取文件对象
		content=content.replace(/\%/g,"%25"); 
		content=content.replace(/\#/g,"%23"); 
		content=content.replace(/\&/g,"%26");
		content=content.replace(/\+/g,"%2B");
		var formFile = new FormData();
		formFile.append("theme", theme);
		formFile.append("content", content);
		formFile.append("topic", topic);
		formFile.append("file", photo);
	    $.ajax({
	       url:'http://localhost:8080/xiaodabang2.0/tiwen_form.php', //后台处理程序
	       type:'post',         //数据发送方式
	       dataType:'text',     //接受数据格式
	       data:formFile,       //要传递的数据
	       processData : false, // 不处理发送的数据，因为data值是Formdata对象，不需要对数据做处理
           contentType : false, // 不设置Content-type请求头
	       success:update_question //回传函数(这里是函数名)
	    	});
   		};

	 function update_question (text) {
	 	$("#txtHint1").html(text);
	 	if(text=="发布成功！"){
	    	$(".tiwen_mask").fadeOut(100);
			$(".tiwen_form").slideUp(200);
			window.location.reload(true);
	    }
	}


    function tiwen_sub(){
    	var theme = document.getElementById("theme");
    	if(trim(theme.value)==null || trim(theme.value)==""){
    		document.getElementById("txtHint1").innerHTML="主题不能为空！";
    		document.getElementById("theme").focus();
    		return;
    	}else
    	tiwen();
    	
    }
    function trim(str){ //删除左右两端的空格
    	　　     return str.replace(/(^\s*)|(\s*$)/g, "");
    }

    function search_ajax(name,value){
    	if(name=="topic_input" && value!=null){
    	$.ajax({
    		url: 'http://localhost:8080/xiaodabang2.0/search_ajax.php',
    		type: 'post',
    		dataType: 'json',
    		data: {case:'lable',lable: value},
 //    		error : function(XMLHttpRequest, textStatus, errorThrown) {//这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
	// 　　　　alert(XMLHttpRequest.responseText); 
	// 		alert(XMLHttpRequest.status);
	// 		alert(XMLHttpRequest.readyState);
	// 		alert(textStatus); // parser error;
	// 		},
    		success:label_ajax
    	});
    }
    	else if(name=="all_search_input" && value!=null){
    		$.ajax({
    		url: 'http://localhost:8080/xiaodabang2.0/search_ajax.php',
    		type: 'post',
    		dataType: 'json',
    		data: {case:'all_search',all_search: value},
 //    		error : function(XMLHttpRequest, textStatus, errorThrown) {//这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
	// 　　　　alert(XMLHttpRequest.responseText); 
	// 		alert(XMLHttpRequest.status);
	// 		alert(XMLHttpRequest.readyState);
	// 		alert(textStatus); // parser error;
	// 		},
    		success:all_search_ajax
    	});}
    	function label_ajax(json) {
    		var input_data=$("#topic_input").val();
    		// alert(input_data);
    		if(json.length<1 || input_data=="")
    			$(".lable_tips").hide();
    		else{
    			$(".lable_tips_ul").html("");
    			$(".lable_tips").show(); // 显示补全提示框

    			var ht = '';
				for(var i=0;i<json.length;i++){//循环json对象，新增li
					ht += "<li>" + json[i].tname +"</li>";
				}
				$('.lable_tips_ul').html(ht);
	    		// alert(json);
	    		// var data = eval("("+json+")");
	    		// alert(json);
	    		// var json=json.json;
	            // for(var i=0;i<5;i++) //将结果添加到提示框中
	            // for (x in data) 
	                // $(".lable_tips_ul").append("<li>" + x +"</li>");
	            // alert(json);
	            $(".lable_tips_ul li").on("click",function(){  //为这些新增的li绑定单击事件，单击后将其值赋到输入框中
	            	$("#topic_input").val($(this).text());
	            	$(".add_topic").click();
	            });
	            $(".lable_tips_ul").append("<li class='text-right off_tips' style='background-color:#f9f9ff'>关闭</li>"); //在提示框的最后添加一个li用来关闭
	            $(".lable_tips_ul li:last").on("click",function(){  // 添加单击事件，单击后隐藏提示框
	            	$(".lable_tips").hide();
	            });
        	}
    	}
    	function all_search_ajax(json) {
    		// alert(json);
    		var input_data=$("#all_search_input").val();
    		// alert(input_data);
    		if(json.length<1 || input_data=="")
    			$(".all_search_tips").hide();
    		else{
    			$(".all_search_tips_ul").html("");
    			$(".all_search_tips").show(); // 显示补全提示框

    // 			var ht = '';
				// for(var i=0;i<json.length;i++){//循环json对象，新增li
				// 	ht += '<li><a href="http://localhost:8080/xiaodabang2.0/comment.php?id=' + json[i].id +'">'+json[i].content+'</a></li>';
				// }
				// $('.all_search_tips_ul').html(ht);

				 $.each(json, function(i, val) { //循环json对象，新增li
				 	console.log(val);
					$(".all_search_tips_ul").append('<li><a href="http://localhost:8080/xiaodabang2.0/comment.php?id=' + val.id +'">'+val.content+'</a></li>');
				});


	            $(".all_search_tips_ul li").on("click",function(){  //为这些新增的li绑定单击事件，单击后将其值赋到输入框中
	            	$("#all_search_input").val($(this).text());
	            	// $(".add_topic").click();
	            });
	            $(".all_search_tips_ul").append("<li class='text-right off_tips' style='background-color:#f9f9ff'>关闭</li>"); //在提示框的最后添加一个li用来关闭
	            $(".all_search_tips_ul li:last").on("click",function(){  // 添加单击事件，单击后隐藏提示框
	            	$(".all_search_tips").hide();
	            });
        	}
    	}
    	
    }
</script>
</html>
