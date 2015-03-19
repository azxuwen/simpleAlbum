<?php
/*
 * 展示相册中的相片，会有相片的删除或者编辑相片的描述  等等功能
*/
include_once 'header.php';
require_once '../SqlHelper.class.php';
require_once '../AssPage.class.php';
require_once '../PubFunction.php';
$sqlHelper = new SqlHelper();

//获取当前的相册名称
$sql_get_album_name = "SELECT name,content from t_album WHERE id= ".$_GET['id'];
$arr_get_album_name = $sqlHelper->execute_dql2($sql_get_album_name);

$assPage = new AssPage();
//这里通过分页显示相册中的相片，
$assPage->pageSize = 24; //每页显示24个
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}
$sql_all_photo_count = "Select count(id) From t_photo WHERE album_id = ".$_GET['id'];//取得相册条数
$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
$end = $assPage->pageSize;

$sql_get_photos = "SELECT * FROM t_photo WHERE album_id = ".$_GET['id']."  ORDER BY time desc LIMIT {$start}, {$end}";//取得本页数据
$sqlHelper->excute_dql_asspage($sql_all_photo_count, $sql_get_photos, $assPage);




?>
<!-- 确认框 -->
<div id="remove_outer_div" style="">
<div id="remove_inner_div">
	<h2>确定删除吗?</h2>
	<p style="color:red;">该相册下所有的照片都将被删除!!</p>
	<button id="del_album_id" class="" onclick="onDelAlbum(this)">确定</button><button onclick="close_remove_div()">不是的</button>
</div>
</div>
<!--
	执行结果 
 -->
<div class="res_operator">
	<div class="res_word"></div>
</div>
<!-- 当点击编辑图片时，将信息显示在这个层里面 -->
<div id="edit_photo_div">
	
</div>

	<div class="sysmenub">
		<p class="smenubtit">相册与视频管理</p>
			<ul>
				<li><a class="current" href="index.php">相册管理</a></li>
				<li><a href="bkvideo.php">视频管理</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">
			<?php echo $arr_get_album_name[0]['name'];?>
			<font style="font-size:10px;color:gray;"><?php echo utf8Substr($arr_get_album_name[0]['content'], 0, 100)?></font>
		</p>
		<div class="exec">
			<p class="execact">
				<a href='addPhoto.php?id=<?php echo $_GET['id'];?>' class='button green' style="color:white;"><img src="images/cloud2.png"/><br/>上传照片</a>
				<center>
					<a href='index.php' style="color:white;" class="button green">返回相册列表</a>
					<a href='createAlbum.php?id=<?php echo $_GET['id'];?>&type=edit' style="color:white;" class="button green">编辑相册</a>
					<a href='#delAlbum' id="<?php echo $_GET['id'];?>" onclick="onClkDelAlbum(this)" style="color:white;" class="button red">删除该相册</a>
				</center>
				<span id="page">
				<?php
					if($assPage->pageNow > 1){ 
						echo "<a href='editAlbum.php?id=".$_GET['id']."&p=".($assPage->pageNow-1)."'> 上一页  </a>";
					}else {
						echo "当前首页";
					}
					if($assPage->pageNow <= $assPage->pageCount-1){
						echo "<a href='editAlbum.php?id=".$_GET['id']."&p=".($assPage->pageNow+1)."'> 下一页</a>";
					}else{
						echo "当前末页";
					}
					echo " 共".$assPage->pageCount."页";
				?>
				</span>
			</p>
		</div>
		<div class="list">
			<?php
				//依次展示该相册的相片
				if(count($assPage->pageArr) != 0){
					for($i = 0 ;  $i < count($assPage->pageArr); $i++){
						echo "<a href='#photo' onmouseover='onMoverPhoto(this)'>";
						echo "<div id='photo_list'>";
						echo "<div id='photo_img_list'>";
						echo "<img src='../".$assPage->pageArr[$i]['address']."' title='".$assPage->pageArr[$i]['content']."'/>";
						echo "</div>";
						echo "<div>";
						echo "<a style='color:blue;' href='#edit' class='".$assPage->pageArr[$i]['content']."' onclick='onClkShowEditPhoto(this, ".$assPage->pageArr[$i]['id'].")'>编辑</a> | <a style='color:red;' href='#del' onclick='onClkShowDelConfirm(this, ".$assPage->pageArr[$i]['id'].")'>删除</a>";
						echo "</div>";
						echo "</div>";
						echo "</a>";
					}
				}else{
					echo "<div id='textCenter'>该相册下暂无图片!</div>";
				}
			?>
		</div>
		</div>
	</div>
</div>
<?php
include_once 'footer.php'; 
?>
