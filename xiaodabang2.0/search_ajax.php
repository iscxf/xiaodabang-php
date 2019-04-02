<?php 
header("Content-type: text/json; charset=utf-8");
// $_POST['lable'];
// $json = array('a' => "aaa");
// $json = array('b' => "aaa");	
// $jsonString = 'jsong string';
   // $json = array('json'=>$jsonString,'json2'=>"sss");
    // $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
   // $json = array();

// $json = json_encode($json);
// $json1="aaa";
// echo $json;
include'db_connect.inc.php';
if($_POST['case']=='lable')
{
	class Tname 
	{
		public  $tname ;
	}
	$lable_sql="SELECT tname FROM topic WHERE tname like '%".$_POST['lable']."%' limit 4";
	$result=mysqli_query($db,$lable_sql);
	$json=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$tname =new Tname();
		$tname->tname = $row["tname"];
		$json[]=$tname;
	}   
	echo json_encode($json);
}else if($_POST['case']=='all_search')
{
	class Search 
	{
		public  $id ;
		public  $content ;
	}
	$search_sql="SELECT id,theme FROM question WHERE theme like '%".$_POST['all_search']."%' limit 5";
	$result=mysqli_query($db,$search_sql);
	$json=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$search =new Search();
		$search->id = $row["id"];
		$search->content = $row["theme"];
		$json[]=$search;
	}   
	echo json_encode($json);
}

 ?>