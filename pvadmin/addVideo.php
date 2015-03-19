<?php
/*
 * 创建新相册页面  或者修改相册信息  通过URL 是否存在 type 和 type是否 = edit来判断
*/
include_once 'header.php';
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
?>
	<div class="sysmenub">
		<p class="smenubtit">相册与视频管理</p>
			<ul>
				<li><a href="index.php">相册管理</a></li>
				<li><a class="current" href="bkvideo.php">视频管理</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">添加视频</p>
		<div class="exec">
			<center>
				<a href='bkvideo.php' class='button green' style='color:white;'>返回视频列表</a>
				<a href='addVideoMethod.php' class='button green' target="_blank" style='color:white;'>上传视频方法</a>
			</center>
		</div>
		<div class="list">
			<form class="form-4" id="addVideoForm" action="active_addvideo.php" method='post'>
			<h1>填写视频信息</h1>
			<p>视频链接<span style="color:gray">(填写土豆或优酷网上的视频链接)</span>
				<label for="login">视频链接</label>
				<input type="text" name="videoLink" id="videoLink" placeholder="视频链接" required value=""/>
			</p>
			<p>视频介绍
				<label for="password">视频介绍</label>
				<textarea cols='10' rows='10' name="videoContent" id="videoContent" required></textarea>
				
			</p>
			<p class="newVideoInfo"></p>
			<p>
				<input type="button" name="newVideoButton" onclick="addVideoButton()" id="newVideoButton" value="添加">
			</p>       
		</form>
		</div>
		</div>
	</div>
</div>
<?php
include_once 'footer.php'; 
?>
