<?php  
	//引入header
	include_once 'lheader.php';
?>
<!--==============================Content=================================-->
<div class="content">
<div class="ic">More Website Templates @ <a href="http://www.cssmoban.com/" >网页模板</a> - December 30, 2013!</div>
	<div class="container_12">
		<div class="grid_12">
			
			<div id="width_50">
			<form id="login_form" class="form-container" action="active_login.php" method="post">
				<div class="form-title"><h2>登录账号</h2></div>
				<div class="form-title">账号</div>
				<input class="form-field" type="text" id="user" name="user" placeholder="输入账户"/><br />
				<div class="form-title">密码</div>
				<input class="form-field" type="password" id="password" name="password" placeholder="输入密码" /><br />
				<div class="submit-container">
				<span class="login_info" style="color:red;"></span><br/>
				<input class="submit-button" type="button" name="submitLogin" onclick="onClkLogin(this)" value="登录" />
				</div>
			</form>
			</div>
			<div id="width_50">
				<div class="av_center">
					<p>&nbsp;&nbsp;欢迎您访问哈三中30年同学纪念网站,由于涉及到您和同学们的个人信息及隐私,您在登录后方可访问网站内容。</p>
					<hr />
					如何您还没有账号?<br/>
					<a href='reg.php' style="color:blue;">去注册>></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
//引入footer
include_once 'footer.php';
?>