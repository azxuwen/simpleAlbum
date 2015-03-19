<?php
/*
 * 创建新相册页面  或者修改相册信息  通过URL 是否存在 type 和 type是否 = edit来判断
*/
include_once 'header.php';
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$album_name = "";
$album_content = "";
if(isset($_GET['type']) && $_GET['type'] == 'edit'){
	//证明是编辑相册信息
	if(!isset($_GET['id'])){
		header("Location:index.php");
		exit();
	}
	$sql_get_album_info = "SELECT name, content FROM t_album WHERE id= " . $_GET['id'];
	$arr_get_album_info = $sqlHelper->execute_dql2($sql_get_album_info);
	$album_name = $arr_get_album_info[0]['name'];
	$album_content = $arr_get_album_info[0]['content'];
}

?>
	<div class="sysmenub">
		<p class="smenubtit">相册与视频管理</p>
			<ul>
				<li><a class="current" href="index.php">相册管理</a></li>
				<li><a href="bkvideo.php">视频管理</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">创建新相册</p>
		<div class="exec">
			<center>
				<?php	
					if(isset($_GET['type']) && $_GET['type']){
						echo "<a href='editAlbum.php?id=".$_GET['id']."' style='color:white;' class='button green'>返回".$album_name."</a>";
					}else{
						echo "<a href='index.php' style='color:white;' class='button green'>返回相册列表</a>";
					} 
				?>
			</center>
		</div>
		<div class="list">
			<form class="form-4" id="createAlbumForm" action="active_createalbum.php<?php if(isset($_GET['id'])){echo "?id=".$_GET['id'];}?>" method='post'>
			<h1>填写新相册信息</h1>
			<p>相册名称
				<label for="login">相册名称</label>
				<input type="text" name="album_name" id="album_name" placeholder="相册名称" required value="<?php echo $album_name;?>"/>
			</p>
			<p>相册介绍　　　　　　　　　　 <font color='red'> (Note:字数控制在300以内) </font><span class='crt_input_span' style="color:gray;">已经输入了<span class='input_count'>0</span>个字</span>
				<label for="password">相册介绍</label>
				<textarea cols='10' rows='10' name="album_content" id="album_content" required><?php echo $album_content;?> </textarea>
				
			</p>
			<p class="newAlbumInfo"></p>
			<p>
				<?php
					if(isset($_GET['type']) && $_GET['type'] == 'edit' ){ 
						echo '<input type="button" name="newAlbumButton" id="newAlbumButton" value="修改">';
					}else{
						echo '<input type="button" name="newAlbumButton" id="newAlbumButton" value="添加">';
					}
					
				?>
			</p>       
		</form>
		</div>
		</div>
	</div>
</div>
<?php
include_once 'footer.php'; 
?>
