<?php 
	require_once '../head.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>话题</title>
	<script src="http://localhost:8080/xiaodabang2.0/js/myfunction.js"></script>
</head>
<body style="background-color: #f6f6f6">

	<div class="container" style="margin-top: 5em">
		<div class="container" style="margin-top: 5em">
			<ul class="nav nav-tabs">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">快速分类</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">失物招领</a>
						<a class="dropdown-item" href="#">校园网络</a>
						<a class="dropdown-item" href="#">询问</a>
						<a class="dropdown-item" href="#">游戏</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php">最新</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="top_topic.php">热门</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="classify.php">分类</a>
				</li>
			</ul>
		</div>
		<div class="">

		</div>
	</div>
	<?php 
	include "foot.php";
	?>
</body>
</html>