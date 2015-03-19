$(document).ready(function(){
	//当点击登录按钮时
	$("#login_button").click(function(){
		if($("#admin_name").val().length == 0){
			$("#login_info").html('请填写账号');
			return false;
		}
		if($("#admin_password").val().length == 0){
			$("#login_info").html('请填写密码');
			return false;
		}
		var login_string = $("#admin_name").val().trim()+"*"+$("#admin_password").val().trim();
		//如果已经填写了账号和密码，那就通过Ajax来核实是否正确
		$.ajax({
			type:'post',
			url:'ajax/check_login.php',
			data:"login_string="+login_string,
			success:function(data){
				//alert(data);
				if(data == 'yes'){
					$("#loginform").submit();
					return false;
				}else{
					$("#login_info").html('不存在该管理员！！');
					return false;
				}
			}
		});
		
	});
	
	//在createAlbum.php中实现创建新相册时，点击添加按钮的事件
	$("#newAlbumButton").click(function(){
		$("#createAlbumForm").submit();
		var album_name = $("#album_name").val();
		if(album_name.length == 0){
			$(".newAlbumInfo").html("<font color='blue'>还未填写相册名称</font>");
			return false;
		}
		if(album_name.length >= 16){
			$(".newAlbumInfo").html("<font color='blue'>相册名称不能超过16个字</font>");
			return false;
		}
		if($("#album_content").val().length >= 300){
			$(".newAlbumInfo").html("<font color='blue'>相册介绍尽量控制在300字以内</font>");
			return false;
		}
		//alert('ff');
		//alert($("#createAlbumForm"));
		$("#createAlbumForm").submit();
	});
	//当填写相册介绍时，keyup事件，用于通知管理员现在输入的字数
	$("#album_content").keyup(function(){
		if($(this).val().length < 300){
			$(".crt_input_span").html("已经输入了<span class='input_count'>0</span>个字");
			$(".input_count").html($(this).val().length);
			return false;
		}else{
			$(".crt_input_span").html('字数不允许超过300');
			return false;
		}
	});
	
});

//在index.php中，当把鼠标放在各个相册图片上时，显示 相册的描述  和 对相册的操作链接 START
function onMoverAlbum(obj){
	//当将鼠标放在相册图片的时候，使相册的描述显示出来
	var children1 = obj.children;
	var children2 = children1[0].children;
	children2[1].style.display = 'block';//将相册描述show出来
}
//当鼠标离开时
function onMoutAlbum(obj){
	var children1 = obj.children;
	var children2 = children1[0].children;
	children2[1].style.display = 'none';//将相册描述show出来
}

//在index.php中，当把鼠标放在各个相册图片上时，显示 相册的描述  和 对相册的操作链接 END
//在editAlbum.php中，当鼠标放在各个图片上时的鼠标事件
function onMoverPhoto(obj){
	//alert(obj);
}

//在addPhoto.php中 对上传的图片添加描述时
function edit_pic_content(obj){
	var par_obj = obj.parentNode;//获取父节点(span)对象 
	var privious_obj = par_obj.previousSibling;//span前面的div对象
	var children_input = privious_obj.children;
	var input_value = children_input[0].value;//输入框的值
	var photo_id = obj.getAttribute("class");
	if(input_value.length >= 30){
		alert("相片描述控制在30以内");
		return false;
	}
	var up_ph_cnt = photo_id+"*"+input_value;
	//下面通过ajax执行修改相片的秒数
	$.ajax({
		type:"post",
		url:"ajax/update_photo_content.php",
		data:"up_ph_cnt="+up_ph_cnt,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				$(".res_operator .res_word").html("添加相册描述成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'no'){
				$(".res_operator .res_word").html("添加相册描述失败");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("出现错误,请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		}
	});
}

//在editAlbum.php中点击删除相册按钮时触发
function onClkDelAlbum(obj){
	var album_id = obj.getAttribute('id');
	$("#del_album_id").attr('class', album_id);
	$("#remove_outer_div").show();//显示提示框  是否确定删除
}
/*执行删除*/
function onDelAlbum(obj){
	var album_id = $("#del_album_id").attr('class');
	//下面通过Ajax来删除该相册下的图片 和 相册的基本信息
	$.ajax({
		type:"post",
		url:"ajax/del_album.php",
		data:"album_id="+album_id,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				$("#remove_outer_div").hide('fast');
				$(".res_operator .res_word").html("删除成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				window.location.href = "index.php";
				return false;
			}else{
				$("#remove_outer_div").hide('fast');
				$(".res_operator .res_word").html("出现错误,请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				window.reload();
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			var load = "<center><img src='images/5-120P50T641.gif' width='200px' height='40px'/><br/>正在删除...<br/><button onclick='close_remove_div()'>取消</button></center>";
			$("#remove_inner_div").html(load);
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
		}
	});
}

/*   关闭遮罩层   */
function close_remove_div(){
	$("#remove_outer_div").fadeOut('fast');
	$("#remove_inner_div").html('<h2>确定删除吗?</h2><p style="color:red;">该相册下所有的照片都将被删除!!</p><button id="del_album_id" class="" onclick="onDelAlbum(this)">确定</button><button onclick="close_remove_div()">不是的</button>');
	return false;
}


/* 在editAlbum.php 中，当点击照片下面的编辑的时候，显示出来下面的输入框和提交链接 */
function onClkShowEditPhoto(obj, photo_id){
	//photo_id  为要修改的相册id
	$("#edit_photo_div").show();//将那个层显示出来
	//获取图片对象
	var orignal_content = obj.getAttribute('class');
	var ImgObj = obj.parentNode.previousSibling.children;
	$("#edit_photo_div").html("<h2>编辑相片</h2></span><br/>"+ImgObj[0].innerHTML+"<br/>");
	$("#edit_photo_div").append("<textarea id='new_photo_content' cols='20' height='10'>"+orignal_content+"</textarea>");
	$("#edit_photo_div").append("<br/><a class='button green' style='color:white;' onclick='onClkDoEditPhoto(this, "+photo_id+")' href='#'>修改</a><a class='button red' style='color:white;' href='#' onclick='onClkCancelEditPhoto(this)'>取消</a>");
}
//当点击修改时，通过Ajax来执行修改
function onClkDoEditPhoto(obj, photo_id){
	var new_photo_content = $("#new_photo_content").val();//新添加的 相片的content
	if(new_photo_content.length >= 30){
		alert('相片描述请控制在30字以内..');
		return false;
	}
	var edit_photo_content_string = photo_id+"*"+new_photo_content;
	//photo_id  为需要修改的相片 的 ID
	$.ajax({
		type:"post",
		url:"ajax/update_photo_content.php",
		data:"up_ph_cnt="+edit_photo_content_string,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				//ImgListDiv.remove();
				$("#edit_photo_div").hide('fast');
				$(".res_operator .res_word").html("修改成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$("#edit_photo_div").hide('fast');
				$(".res_operator .res_word").html("出现错误,请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				window.reload();
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){ 
			var load = "<center><img src='images/5-120P50T641.gif' width='200px' height='40px'/><br/>正在修改...<br/><button onclick='close_remove_div()'>取消</button></center>";
			$("#edit_photo_div").html(load);
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
		}
	});
	
}
//取消修改当前相册的信息
function onClkCancelEditPhoto(obj){
	$("#edit_photo_div").fadeOut();
}

//在editAlbum.php  中点击其中的相片下面的 删除链接时  显示出提示框 , 参数2为需要删除的相片的ID
function onClkShowDelConfirm(obj, photo_id){
	var innerCon  = "<h2>确定删除吗?</h2><button class='"+photo_id+"' onclick='onDelPhoto(this)'>确定</button><button onclick='close_remove_div()'>不是的</button>";
	$("#remove_inner_div").html(innerCon);
	$("#remove_outer_div").show();//显示提示框  是否确定删除
}
//执行删除具体的相片
function onDelPhoto(obj){
	var photo_id = obj.getAttribute('class');//需要删除的相片ID
	//通过ajax来删除相片
	$.ajax({
		type:"post",
		url:"ajax/del_photo.php",
		data:"photo_id="+photo_id,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				$("#remove_outer_div").hide('fast');
				$(".res_operator .res_word").html("删除成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				window.location.reload();//从新加载页面
				return false;
			}else{
				$("#remove_outer_div").hide('fast');
				$(".res_operator .res_word").html("删除失败,请重试!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){ 
			var load = "<center><img src='images/5-120P50T641.gif' width='200px' height='40px'/><br/>正在删除...<br/><button onclick='close_remove_div()'>取消</button></center>";
			$("#remove_inner_div").html(load);
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
		}
	});
}


//在 vkvideo.php 中，当点击视频content紧接着的[编辑]链接时
function show_edit_video_input(obj){
	$("#edit_video_div").show();
	var video_id = obj.getAttribute('class');//需要编辑视频的ID
	var video_original_con = obj.previousSibling.innerHTML;
	//alert(video_id);
	var edit_video_html = "<a href='#' onclick='cancel_edit_video_content()' class='button red' style='color:white;'>取消编辑</a><br/><br/><textarea id='video_con_textarea' cols='60' rows='15'>"+video_original_con+"</textarea><br/><a href='#save' onclick='save_video_con(this)' video_id = '"+video_id+"' class='button green' style='color:white;'>保存</a>";
	//alert(edit_video_html);
	$(edit_video_html).appendTo($("#edit_video_div"));
}
//当点击取消 链接 时，将原 content显示出来，将带有textarea标签的隐藏
function cancel_edit_video_content(){
	$("#edit_video_div").html('');
	$("#edit_video_div").fadeOut();
}
//当点击编辑视频信息时 的保存按钮时 触发
function save_video_con(obj){
	var video_id = obj.getAttribute('video_id');//要编辑的视频的ID
	var video_con = $("#video_con_textarea").val();//编辑好的视频content
	var edit_video_arr = video_id+"*"+video_con;
	//通过Ajax来保存视频content
	$.ajax({
		type:"post",
		url:"ajax/edit_video_con.php",
		data:"edit_video_arr="+edit_video_arr,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				$("#edit_video_div").html('');
				$("#edit_video_div").hide('fast');
				$(".res_operator .res_word").html("编辑成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏				
				return false;
			}else if(data == 'no'){
				$("#edit_video_div").html('');
				$("#edit_video_div").hide('fast');
				$(".res_operator .res_word").html("编辑失败，请重试!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$("#edit_video_div").html('');
				$("#edit_video_div").hide('fast');
				$(".res_operator .res_word").html("编辑失败,请重试!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){ 
			var load = "<center><img src='images/5-120P50T641.gif' width='200px' height='40px'/><br/>正在编辑...<br/><button onclick='close_remove_div()'>取消</button></center>";
			$("#edit_video_div").html(load);
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
		}
	});
}
//点击删除该视频时，显示出确认框
function show_video_del_div(obj){
	$("#remove_outer_div").show();
	$("#remove_inner_div").show();
	var video_id = obj.getAttribute('video_id');//视频id
	//调用真正的执行删除
	$("#del_video_id").attr('class', video_id);
}
//点击取消删除
function close_video_del_div(){
	$("#remove_outer_div").fadeOut();
	$("#remove_inner_div").fadeOut();
}
function onDelVideo(obj){
	var video_id = $("#del_video_id").attr('class');
	//下面执行删除
	$.ajax({
		type:"post",
		url:"ajax/del_video.php",
		data:"del_video_id="+video_id,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				$("#remove_outer_div").hide();
				$("#remove_inner_div").hide();
				window.location.reload();				
				return false;
			}else if(data == 'no'){
				$("#remove_outer_div").hide('fast');
				$("#remove_inner_div").hide('fast');
				$(".res_operator .res_word").html("删除失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$("#remove_outer_div").hide('fast');
				$("#remove_inner_div").hide('fast');
				$(".res_operator .res_word").html("删除失败,请重试!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		}
	});
}
//addVideo.php 中 点击添加按钮时触发
function addVideoButton(){
	var VideoLink = $("#videoLink").val();//视频链接
	var VideoContent = $("#videoContent").val();//视频介绍
	if(VideoLink.length == 0){
		$("#newVideoInfo").html("<font color='blue'>还未填写视频链接</font>");
		return false;
	}	
	$("#addVideoForm").submit();
}

//在waitActive.php  中点击  点击激活 按钮时 触发
function active_user(obj){
	var user_id = obj.getAttribute('user_id');
	var parentTd = obj.parentNode;
	//通过Ajax来激活user
	$.ajax({
		type:"post",
		url:"ajax/active_user.php",
		data:"user_id="+user_id,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				parentTd.innerHTML = "已激活";
				$(".res_operator .res_word").html("激活成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'no'){				
				$(".res_operator .res_word").html("激活失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{	
				$(".res_operator .res_word").html("激活失败,请重试!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		}
	});
}
//在 userMng.php  中点击冻结账户 按钮时触发
function freeze_user(obj){
	var user_id = obj.getAttribute('user_id');
	var parentTd = obj.parentNode;
	//通过Ajax来冻结user
	$.ajax({
		type:"post",
		url:"ajax/freeze_user.php",
		data:"user_id="+user_id,
		dataType:"text",
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				parentTd.innerHTML = "已冻结";
				$(".res_operator .res_word").html("冻结成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'no'){				
				$(".res_operator .res_word").html("冻结失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{	
				$(".res_operator .res_word").html("冻结失败,请重试!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		}
	});
}




