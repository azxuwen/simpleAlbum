<!DOCTYPE html>
<html>
<head>
<title>同学回忆30年后台管理系统</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="keywords" content="同学回忆30年后台管理系统">
<meta name="discription" content="同学回忆30年后台管理系统">
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/system.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
</head>
<body id="loginpage">
	<div id="login" class="clearfix">
		<div class="main clearfix">
			<div class="logbox">
				<div class="header">
					同学管理系统管理员登录
				</div>
				<div class="web_login" id="web_login">
					<form id="loginform"  name="loginform" action="active_login.php" method="post" target="_self">
						<div class="inputOuter">
                          	 <input type="text" class="inputstyle" id="admin_name" placeholder="输入账号" name="admin_name" value="" tabindex="1">
                        </div>
						<div class="inputOuter">
							<input type="password" class="inputstyle password" placeholder="输入密码" id="admin_password" name="admin_password" value="" maxlength="16" tabindex="2"> 
                        </div>
                        <div class="submit">
	                        <a class="login_button" href="#">
	                            <input type="button" tabindex="6" value="登 录" class="btn" id="login_button">
	                        </a>
                        </div>
                        <div style="height:1px;">
	                        <p id="login_info"></p>
                        </div>
					</form>
				</div>
				<div class="footer">
					<a href="javascript:void(0);" target="_blank" >忘了密码？</a>
					<a href="javascript:void(0);" target="_blank" >内部注册</a>
					<a href="javascript:void(0);" target="_blank" >意见反馈</a>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
