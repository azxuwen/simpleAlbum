<?php
/*
 * 后台的index.php，也就是在登录后第一个显示的就是这个界面
 * 直接显示的是对相册的管理
 * 所以这个界面，直接就到数据库中将相册内容拿出来并显示出来
*/
include_once 'header.php';
require_once '../SqlHelper.class.php';
require_once '../AssPage.class.php';
require_once '../PubFunction.php';
$sqlHelper = new SqlHelper();
$assPage = new AssPage();
$assPage->pageSize = 3; //每页显示3个相册
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}
$sql_all_album_count = "Select count(id) From t_album";//取得相册条数
$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
$end = $assPage->pageSize;

$sql_get_album = "SELECT * FROM t_album ORDER BY time desc LIMIT {$start}, {$end}";//取得本页数据
$sqlHelper->excute_dql_asspage($sql_all_album_count, $sql_get_album, $assPage);
?>
	<div class="sysmenub">
		<p class="smenubtit">相册与视频管理</p>
			<ul>
				<li><a class="current" href="#album">相册管理</a></li>
				<li><a href="bkvideo.php">视频管理</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">相册列表</p>
		<div class="exec">
			<p class="execact">
				<a href='createAlbum.php' style="color:white;"  class="button green">创建新相册</a>
				<span id="index_page">
				<?php
					if($assPage->pageNow > 1){ 
						echo "<a href='index.php?p=".($assPage->pageNow-1)."'> 上一页  </a>";
					}else {
						echo "当前首页";
					}
					if($assPage->pageNow <= $assPage->pageCount-1){
						echo "<a href='index.php?p=".($assPage->pageNow+1)."'> 下一页</a>";
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
				$sqlHelper = new SqlHelper();
				//依次展示相册信息
				if(count($assPage->pageArr) != 0){
					 for($i = 0 ; $i < count($assPage->pageArr); $i++){
					 	//从数据库中获取相册的第一张图片
					 	$sql_get_first_photo = "SELECT count(id) as count,address FROM t_photo WHERE album_id = ".$assPage->pageArr[$i]['id']." LIMIT 0, 1";
					 	//echo $sql_get_first_photo;
					 	$arr_get_first_photo = $sqlHelper -> execute_dql2($sql_get_first_photo);
					 	echo "<a href='editAlbum.php?id=".$assPage->pageArr[$i]['id']."' onmouseover='onMoverAlbum(this)' onmouseout='onMoutAlbum(this)'>";
					 	echo "<div id='album_list'>";
					 	echo "<div id='album_img_list'>";
					 	if($arr_get_first_photo[0]['count'] == 0){
					 		echo "<br/><br/>该相册<br/>暂无图片";
					 	}else{
					 		echo "<img src='../".$arr_get_first_photo[0]['address']."' width='100px' title='".$assPage->pageArr[$i]['content']."'/>";
					 	}
					 	echo "</div>";
					 	echo "<div id='content'><br/>";
					 	echo utf8Substr($assPage->pageArr[$i]['content'], 0, 30);
					 	echo "</div>";
					 	echo "<div id='album_name'>";
					 	echo $assPage->pageArr[$i]['name'];
					 	echo "</div>";
					 	echo "</div>";
					 	echo "</a>";
					 }
				}else{
					echo "<div id='textCenter'>暂无相册!</div>";
				}
			?>
		</div>
		</div>
	</div>
</div>
<?php
include_once 'footer.php'; 
?>
