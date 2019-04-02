<?php 
include 'db_connect.inc.php';
if($_POST['case']=='lable_choose')
{
	class Lable 
	{
		public  $id ;
		public  $name ;
	}
	// $sql="SELECT * FROM topic WHERE id >= ((SELECT MAX(id) FROM topic)-(SELECT MIN(id) FROM topic)) * RAND() + (SELECT MIN(id) FROM topic)  LIMIT 6";
	$sql="SELECT * from topic WHERE id >= (SELECT floor( RAND() * ((SELECT MAX(id) FROM topic)-(SELECT MIN(id) FROM topic)) + (SELECT MIN(id) FROM topic)))  
ORDER BY id LIMIT 6";
	$result=mysqli_query($db,$sql);
	$json=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$lable_choose =new Lable();
		$lable_choose->id = $row["id"];
		$lable_choose->name = $row["tname"];
		$json[]=$lable_choose;
	}   
	echo json_encode($json);
}
 ?>
