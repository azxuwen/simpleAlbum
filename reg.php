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
			<form id="reg_form" class="form-container" action="active_reg.php" method="post">
				<div class="form-title"><h2>注册账号</h2></div>
				<div class="form-title">账号 (6-10位英文和数字组成)</div>
				<input class="form-field" type="text" id="reg_user" name="reg_user" placeholder="输入账户"/><br />
				<div class="form-title">密码 (6-20位英文和数字组成)</div>
				<input class="form-field" type="password" id="reg_password1" name="reg_password1" placeholder="输入密码" /><br />
				<div class="form-title">再次输入密码</div>
				<input class="form-field" type="password" id="reg_password2" name="reg_password2" placeholder="核实刚刚输入的密码" /><br />
				<div class="form-title">真实姓名 (填写中文姓名,更容易被管理员审核通过)</div>
				<input class="form-field" type="text" id="reg_name" name="reg_name" placeholder="输入真实姓名"/><br />
				<div class="submit-container">
				<span class="reg_info" style="color:red;"></span><br/>
				<input class="submit-button" type="button" name="submitLogin" onclick="onClkReg(this)" value="注册" />
				</div>
			</form>
			</div>
			<div id="width_50">
				<div class="av_center">
					<p>注册完成之后,还需要管理员审核通过,方可完成注册。</p>
					<p><a href='login.php' style="color:blue;"><<返回登陆页面</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
//引入footer
include_once 'footer.php';
?>