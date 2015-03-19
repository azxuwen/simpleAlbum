<?php
session_start(); 
header("Content-Type:text/html; charset=utf8");
if(!isset($_SESSION['ADMINID']) || !isset($_SESSION['ADMINNAME'])){
	echo '<script> alert("管理员请先登录!"); location.replace("login.php")</script>';
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>同学30年后台管理系统</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="keywords" content="哈尔滨理工大学-同学30年后台管理系统">
<meta name="discription" content="哈尔滨理工大学-同学30年后台管理系统">
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/system.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>

</head>
<body id="sysmain">
	<div class="content">
		<div class="syshead">
			<div class="clearfix">
				<p class="left" style="font-size:25px;color:white;">同学30年回忆管理系统</p>
				<p class="right"><span>管理员</span>
				<a href="javascript:void(0);">
					<?php
						echo $_SESSION['ADMINNAME']; 
					?>
				</a><a class="outsys" title="退出系统" href="logout.php"><img src="images/index/outsys.gif" width="16" height="16" alt="" />退出</a></p>
			</div>
		</div>
		<div class="sysmain clearfix">
			<div class="sysmenua">
				<ul>
					<?php
						/*  通过获取当前文件的名称，配置当前的DOM的title  */
						$url = $_SERVER['PHP_SELF'];  
						$fileType= substr( $url , strrpos($url , '/')+1 );  
						if($fileType == 'userMng.php' || $fileType == 'waitActive.php'){
							echo "<li><a href='index.php'>后台首页</a></li>";
							echo "<li><a class='current' href='userMng.php'>会员管理</a></li>";
						}else{
							echo "<li><a class='current' href='index.php'>后台首页</a></li>";
							echo "<li><a href='userMng.php'>会员管理</a></li>";
						}
					?>
					
				</ul>
			</div>