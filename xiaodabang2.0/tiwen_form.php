<?php 
//1.限制文件的类型，防止注入php或其他文件，提升安全
//2.限制文件的大小，减少内存压力
//3.防止文件名重复，提升用户体验
    //方法一：  修改文件名    一般为:时间戳+随机数+用户名
    // 方法二:建文件夹
    
//4.保存文件
if(!isset($_COOKIE['user'])){
	echo "请先登录！";
	exit;
}
include 'db_connect.inc.php';
$cookie=$_COOKIE['user'];		//接收cookie的值
$theme=$_POST['theme'];			
$content=urldecode(urlencode($_POST['content']));   //接收数据（解码暂无用处）
$topic=$_POST['topic'];
$qdate=date("Y-m-d H:i:s");
$date=date("Y-m-d H:i");
if(!empty($_FILES['file']['tmp_name']))
	if($_FILES["file"]["error"])
	{
		echo $_FILES["file"]["error"]."图片上传出错！请重试！";
	}
	else
	{
	    //控制上传文件的类型，大小
		if(($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png"))
		{
	        $filename = explode(".",$_FILES["file"]["name"]);
	        //找到文件存放的位置
	        //把图片名前缀名改成“用户名+时间”，后缀大写改成小写
			$filename = "question_images/".$cookie.date("YmdHi").".".strtolower($filename[1]);
	        //转换编码格式
	        $filename = iconv("UTF-8","gb2312",$filename);  //这是服务器编码，怪怪的
	        //判断文件是否存在
			if(file_exists($filename))
			{
				echo "你操作太快啦！请稍后重试！";
			}
			else
			{
	            //保存文件
				move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
				$filename = iconv("gb2312","UTF-8",$filename);   //这是数据库编码utf-8
				$sql_topic_check="SELECT tname FROM topic WHERE tname='$topic'";
				$result= mysqli_query($db,$sql_topic_check);
				if (!$result) {
					printf("Error: %s\n", mysqli_error($db));
					exit();
				}
				$row = mysqli_fetch_object($result);
				if($row==null){
					$sql_topic_insert="INSERT INTO topic (tname) VALUES ('$topic')";
					mysqli_query($db,$sql_topic_insert);
				}
				$sql_insert_question="INSERT INTO question (author,theme,content,qtopic,photo_url,qdate) VALUES ('$cookie','$theme','$content','$topic','$filename','$qdate')";
				if(!mysqli_query($db,$sql_insert_question)){		//执行sql命令
					die('Error: ' . mysqli_error($db));
				}
				else{	
					echo "发布成功！";   //发布成功则返回提示信息
					mysqli_close($db);
				}
			}
		}
		else
		{
			echo "图片类型不正确！";
		}
	}
else{
	$sql_topic_check="SELECT tname FROM topic WHERE tname='$topic'";
	$result= mysqli_query($db,$sql_topic_check);
	if (!$result) {
		printf("Error: %s\n", mysqli_error($db));
		exit();
	}
	$row = mysqli_fetch_object($result);
	if($row==null){
		$sql_topic_insert="INSERT INTO topic (tname) VALUES ('$topic')";
		mysqli_query($db,$sql_topic_insert);
	}
	$sql_insert_question="INSERT INTO question (author,theme,content,qtopic,qdate) VALUES ('$cookie','$theme','$content','$topic','$qdate')";
	if(!mysqli_query($db,$sql_insert_question)){		//执行sql命令
		die('Error: ' . mysqli_error($db));
	}
	else{	
		echo "发布成功！";   //发布成功则返回提示信息
		mysqli_close($db);
	}
}
?>
