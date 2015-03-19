<?php
/*
 * 为老相册 或者 新相册添加图片
*/
include_once 'header.php';
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
//获取当前相册的一些基本信息
$sql_get_crt_add_album = "SELECT * from t_album WHERE id= ".$_GET['id'];
$arr_get_crt_add_album = $sqlHelper -> execute_dql2($sql_get_crt_add_album);
?>
<script type="text/javascript" src="js/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/uploadify.css"/>
<script type="text/javascript">
var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
var i=0;//初始化数组下标
$(function() {
    $('#file_upload').uploadify({
    	'auto'     : false,//关闭自动上传
    	'removeTimeout' : 1,//文件队列上传完成1秒后删除
        'swf'      : 'js/uploadify.swf',
        'uploader' : 'active_addphoto.php',
        'method'   : 'post',//方法，服务端可以用$_POST数组获取数据
		'buttonText' : '选择图片',//设置按钮文本
		'displayData' : 'speed',
        'multi'    : true,//允许同时上传多张图片
        'uploadLimit' : 6,//一次最多只允许上传6张图片
        'fileTypeDesc' : 'Image Files',//只允许上传图像
        'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',//限制允许上传的图片后缀
        'sizeLimit' : '700',//限制上传的图片不得超过200KB 
        'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
               img_id_upload[i] = data;
               i++;
               //从后台 avtive_addphoto.php中返回刚上传完成的图片的路径，然后添加到页面中   
               //data就是从后台传过来的数据  它的格式 是  数据库中的 id*路径
               var arr = data.split('*');
			   var imgDOM = "<div id='add_photo_list'><div id='add_photo_img_list'><img src="+arr[1]+" /></div><div><input type='text' placeholder='相片描述' style='width:115px;height:30px' ></div><span><a href='#' class='"+arr[0]+"' onclick='edit_pic_content(this)'>提交</a></span></div>";
			   $(imgDOM).appendTo($("#img"));
        },'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数
            if(img_id_upload.length>0){
            	//alert(img_id_upload);
            	//alert(queueData);
            	//当上传完所有的图片之后，将那个选择图片 和 上传的链接隐藏
            	$("#file_upload").hide();
            	$("#doUploadPhoto").hide();
            	$("#doAgainUploadPhoto").show();
            }
        },
        'onComplete':function(evt, queueID, fileObj, response, data){
            //alert('ff');
        }
    });

    $("#doAgainUploadPhoto").click(function(){
    	$("#file_upload").show();
    	$("#doUploadPhoto").show();
    	$(this).hide();
    	$("#img").html('');
    });
});

</script>
<!--
	执行结果 
 -->
<div class="res_operator">
	<div class="res_word"></div>
</div>
	<div class="sysmenub">
		<p class="smenubtit">相册与视频管理</p>
			<ul>
				<li><a class="current" href="index.php">相册管理</a></li>
				<li><a href="bkvideo.php">视频管理</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">上传照片</p>
		<div class="exec">
			<?php 
				if(isset($_GET['type']) && $_GET['type'] == 'new'){
					echo "<div id='confirm_div'>新相册《".$arr_get_crt_add_album[0]['name']."》创建成功</div>";
				}
				echo "<center><a href='editAlbum.php?id=".$arr_get_crt_add_album[0]['id']."'></a><a href='editAlbum.php?id=".$arr_get_crt_add_album[0]['id']."' style='color:#CD950C;'>返回".$arr_get_crt_add_album[0]['name']."列表</a></center>";
			?>
		</div>
		<div class="list">
			<center>
			<input type="file" name="file_upload" id="file_upload" />
			<a id="doUploadPhoto" class="button green" href="javascript:$('#file_upload').uploadify('settings', 'formData', {'typeCode':document.getElementById('id_file').value});$('#file_upload').uploadify('upload','*')">上传</a>
			<a id="doAgainUploadPhoto" class="button green" style="display:none;" href="#again" onclick="showUploadLink(this)"><font color='white'>再次添加图片</font></a>
			<input type="hidden" value="<?php echo $_GET['id'];?>" name="tmpdir" id="id_file">
			<span>
				支持JPG、JPEG、GIF和PNG文件,最大6M.<br/>
				<font color='#CD0000'>Note : 一次只能上传 6 张图片</font>
			</span>
			</center>
			<div id="img"></div>
		</div>
		</div>
	</div>
</div>
<?php
	include_once 'footer.php';
?>