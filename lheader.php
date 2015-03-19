<?php
//登录界面的header部分，因为在此界面无需检查是否登录，所以才新建了这个lheader.php 以 和 header.php进行区分
/*  通过获取当前文件的名称，配置当前的DOM的title  */
$url = $_SERVER['PHP_SELF'];  
$fileType= substr( $url , strrpos($url , '/')+1 );  
$title = "";
if($fileType == 'login.php'){
	$title = '登陆页面';
}else if($fileType == 'reg.php'){
	$title = '注册界面';
}else{
	$title = '注册结果';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title;?></title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/touchTouch.css"><!-- gallery.php -->
		<!-- <link href='http://fonts.googleapis.com/css?family=Economica:700' rel='stylesheet' type='text/css'> -->
		<script src="js/jquery.js"></script>
		<script src="js/main.js"></script>
		<!--[if lt IE 8]>
		<div style=' clear: both; text-align:center; position: relative;'>
			<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
				<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
			</a>
		</div>
		<![endif]-->
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<link rel="stylesheet" media="screen" href="css/ie.css">
		<![endif]-->
	</head>
<bodu id='top'>
<!--==============================header=================================-->
<div class="main">
	<header>
		<div class="clear"></div>
			<div class="container_12">
				<div class="grid_12">
					<h1>
						<a href="index.html">
							<img src="images/logo.png" alt="logo">
						</a>
					</h1>
				</div>
			</div>
	</header>
</div>
<div class="menu_block">
	<div class="container_12">
		<div class="grid_12">
			<nav class="horizontal-nav full-width horizontalNav-notprocessed">
				<ul class="sf-menu">
					<li><a href='index.php'>主页</a></li>
					<li><a href='about.php'>关于</a></li>
				</ul>
			</nav>
		<div class="clear"></div>
	</div>
<div class="clear"></div>
</div>
</div>
<div class="main">