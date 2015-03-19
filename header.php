<?php
session_start();
//检查是否存在用户登录
if(!isset($_SESSION['USERID']) || !isset($_SESSION['USERNAME'])){
	header('Location:login.php');
	exit();
}

//连接数据库
require_once 'SqlHelper.class.php';
/*  通过获取当前文件的名称，配置当前的DOM的title  */
$url = $_SERVER['PHP_SELF'];  
$fileType= substr( $url , strrpos($url , '/')+1 );  
$title = "";
if($fileType == 'index.php'){
	$title = '主页';
}else if($fileType == 'primary.php'){
	$title = '用户登录';
}else if($fileType == 'gallery.php'){
	//如果是gallery.php  那么是具体的相册中的相片展示页面，需要获取到当前相册的基本信息，然后展示在title中
	$sqlHelper = new SqlHelper();
	$sql_get_album_title = "SELECT name FROM t_album WHERE id=".$_GET['id'];
	$arr_get_album_title = $sqlHelper -> execute_dql2($sql_get_album_title);
	$title = $arr_get_album_title[0]['name'];
}else if($fileType == 'video.php'){
	//如果是video.php  那么是具体的视频展示页面，需要获取到当前相册的基本信息，然后展示在title中
	$sqlHelper = new SqlHelper();
	$sql_get_video_title = "SELECT content FROM t_video WHERE id=".$_GET['id'];
	$arr_get_video_title = $sqlHelper -> execute_dql2($sql_get_video_title);
	$title = $arr_get_video_title[0]['content'];
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/touchTouch.css"><!-- gallery.php -->
		<!-- <link href='http://fonts.googleapis.com/css?family=Economica:700' rel='stylesheet' type='text/css'> -->
		<script src="js/jquery.js"></script>
		<script src="js/jquery-migrate-1.1.1.js"></script>
		<script src="js/script.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/superfish.js"></script>
		<script src="js/jquery.equalheights.js"></script>
		<script src="js/jquery.mobilemenu.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/touchTouch.jquery.js"></script><!-- gallery.php -->
		<script>
		$(document).ready(function(){
			$().UItoTop({ easingType: 'easeOutQuart' });//返回顶部
			$('.gallery a.gal').touchTouch();//图片放大
		})
		</script>
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
	<?php
		if($fileType == 'index.php'){
			echo "<body class='page1' id='top'>";
		}else{
			echo "<bodu id='top'>";
		}
	?>

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
			<?php
				 if(isset($_SESSION['USERID'])){
					echo "<p align='right'><font color='#CD950C'> {$_SESSION['USERNAME']}</font>欢迎您!　<a href='logout.php'>安全退出</a></p>";
				 } 
			?>
			
	</header>
</div>
<div class="menu_block">
	<div class="container_12">
		<div class="grid_12">
			<nav class="horizontal-nav full-width horizontalNav-notprocessed">
				<ul class="sf-menu">
					<?php
						if($fileType == 'about.php'){
							echo "<li><a href='index.php'>主页</a></li>";
							echo "<li class='current'><a href='about.php'>关于</a></li>";
						}else if($fileType == 'index.php'){
							echo "<li class='current'><a href='index.php'>主页</a></li>";
							echo "<li><a href='about.php'>关于</a></li>";
						}else{
							echo "<li><a href='index.php'>主页</a></li>";
							echo "<li><a href='about.php'>关于</a></li>";
						}
					?>
					
					
				</ul>
			</nav>
		<div class="clear"></div>
	</div>
<div class="clear"></div>
</div>
</div>
<div class="main">