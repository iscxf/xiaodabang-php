<?php 
include '../db_connect.inc.php';
if($_POST['case']=='recommend')
{
	// $records_per_page=10;		//设置每页数据条数
	// if(isset($_GET["page"]))	//获取页码
	// $page=$_GET["page"];	
	// else
	// 	$page=1;				//若没指定则设为第一页
	// $total_records=mysqli_num_rows($result);				//获取数据量
	// $total_pages=ceil($total_records/$records_per_page);	//计算获取总页数
	// $started_record=$records_per_page*($page-1);			//获取本页开始序号
	// mysqli_data_seek($result,$started_record);				//将记录指针移到本页第一条数据
	class Recommend 
	{
		public  $id ;
		public  $author ;
		public  $theme ;
		public  $content ;
		public  $qtopic ;
		public  $photo_url ;
		public  $date;
		public  $reply ;
	}
	$recommend_sql="SELECT * FROM question WHERE qtopic <> '' limit 10";
	$result=mysqli_query($db,$recommend_sql);
	$json=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$now_time=date("Y-m-d H:i:s", time());  
		$now_time=strtotime($now_time);
		$dur=$now_time-strtotime($row['qdate']); 
		if ($dur<60) {  
			$date=$dur .'秒前';  
		} else {  
			if ($dur<3600) {  
				$date=floor($dur/60) . '分钟前';  
			} else {  
				if ($dur<86400) {  
					$date=floor($dur/3600) . '小时前';  
				} else {  
					$date=floor($dur/86400) . '天前';  
				}  
			}  
		}  
		$recommend =new Recommend();
		$recommend->id = $row["id"];
		$recommend->author = $row["author"];
		$recommend->theme = $row["theme"];
		$recommend->content = $row["content"];
		$recommend->qtopic = $row["qtopic"];
		$recommend->photo_url = $row["photo_url"];
		$recommend->date = $date;
		$recommend->reply = $row["reply"];
		$json[]=$recommend;
	}   
	echo json_encode($json);
}else if ($_POST['case']=='search_lable') {
	$lable_sql="SELECT tname FROM topic WHERE id='${_POST['lable_id']}'";
	$result=mysqli_query($db,$lable_sql);
	$text =null;
	while ($row= mysqli_fetch_assoc($result))
	{
		$text = $row['tname'];
	}
	if($text!=null)
		echo $text;
	else 
		exit();
}else{
	class Recommend 
	{
		public  $id ;
		public  $author ;
		public  $theme ;
		public  $content ;
		public  $qtopic ;
		public  $photo_url ;
		public  $date;
		public  $reply ;
	}
	$recommend_sql="SELECT * FROM question WHERE qtopic='${_POST['case']}' limit 10";
	$result=mysqli_query($db,$recommend_sql);
	$json=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$now_time=date("Y-m-d H:i:s", time());  
		$now_time=strtotime($now_time);
		$dur=$now_time-strtotime($row['qdate']); 
		if ($dur<60) {  
			$date=$dur .'秒前';  
		} else {  
			if ($dur<3600) {  
				$date=floor($dur/60) . '分钟前';  
			} else {  
				if ($dur<86400) {  
					$date=floor($dur/3600) . '小时前';  
				} else {  
					$date=floor($dur/86400) . '天前';  
				}  
			}  
		}  
		$recommend =new Recommend();
		$recommend->id = $row["id"];
		$recommend->author = $row["author"];
		$recommend->theme = $row["theme"];
		$recommend->content = $row["content"];
		$recommend->qtopic = $row["qtopic"];
		$recommend->photo_url = $row["photo_url"];
		$recommend->date = $date;
		$recommend->reply = $row["reply"];
		$json[]=$recommend;
	}   
	echo json_encode($json);
}
 ?>