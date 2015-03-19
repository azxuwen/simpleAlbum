//当在login.php中点击登录按钮的时候，这里进行一个验证
function onClkLogin(obj){
	//获取账户名和密码
	var username = $("#user").val();
	var password = $("#password").val();
	if(username.length == 0){
		$(".login_info").html('还未填写账户名');
		return false;
	}
	if(password.length == 0){
		$(".login_info").html('还未填写密码');
		return false;
	}
	$("#login_form").submit();
}

//在reg.php 中 当点击注册 按钮时 触发
function onClkReg(obj){
	var reg_user = $("#reg_user").val();
	var reg_password1 = $("#reg_password1").val();
	var reg_password2 = $("#reg_password2").val();
	var reg_name = $("#reg_name").val();
	if(reg_user.length == 0){
		$(".reg_info").html("还未填写账户名");
		return false;
	}
	if(reg_user.length < 6 || reg_user.length > 10){
		$(".reg_info").html("账户名请保证在6-10位");
		return false;
	}
	$.ajax({
		type:'post',
		url:'ajax_checkuser.php',
		data:'user='+reg_user,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'no'){
				$(".reg_info").html("该账户名已经存在,请您更换一个。");
				return false;
			}
		}
	});	
	if(reg_password1.length == 0){
		$(".reg_info").html("还未填写密码");
		return false;
	}
	if(reg_password1.length < 6 || reg_user.length > 20){
		$(".reg_info").html("密码请保证在6-20位");
		return false;
	}
	if(reg_password1 != reg_password2){
		$(".reg_info").html("两次输入的密码不一致");
		return false;
	}
	if(reg_name.lenght == 0){
		$(".reg_info").html("还未填写真实姓名");
		return false;
	}
	//检查中文真实姓名
	var m =  reg_name.match(/^[\u4e00-\u9fa5]{2,4}$/i);
	if(m != reg_name){
		$(".reg_info").html("请输入正确的中文姓名");
		return false;
	}
	$("#reg_form").submit();
}