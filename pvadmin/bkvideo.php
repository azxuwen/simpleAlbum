<?php
/*
 * 对视频进行管理
*/
include_once 'header.php';
require_once '../SqlHelper.class.php';
require_once '../AssPage.class.php';
require_once '../PubFunction.php';
$sqlHelper = new SqlHelper();
$assPage = new AssPage();
//通过分页的方式将视频调取出来

$assPage->pageSize = 3; //每页显示3个相册
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}
$sql_all_video_count = "Select count(id) From t_video";//取得相册条数
$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
$end = $assPage->pageSize;

$sql_get_video = "SELECT * FROM t_video ORDER BY time desc LIMIT {$start}, {$end}";//取得本页数据
$sqlHelper->excute_dql_asspage($sql_all_video_count, $sql_get_video, $assPage);
//print_r($assPage->pageArr);

?>
<!-- 确认框 -->
<div id="remove_outer_div" style="">
<div id="remove_inner_div">
	<h2>确定删除吗?</h2>
	<button id="del_video_id" class="" onclick="onDelVideo(this)">确定</button><button onclick="close_video_del_div()">不是的</button>
</div>
</div>
<!--
	执行结果 
 -->
<div class="res_operator">
	<div class="res_word"></div>
</div>
<!-- 当点击编辑视频content时，将信息显示在这个层里面 -->
<div id="edit_video_div">
	
</div>
	<div class="sysmenub">
		<p class="smenubtit">相册与视频管理</p>
			<ul>
				<li><a href="index.php">相册管理</a></li>
				<li><a class="current" href="bkvideo.php">视频管理</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">视频列表</p>
		<div class="exec">
			<p class="execact">
				<a href='addVideo.php' style="color:white;" class='button green'>添加视频</a>
				<span id="index_page">
				<?php
					if($assPage->pageNow > 1){ 
						echo "<a href='bkvideo.php?p=".($assPage->pageNow-1)."'> 上一页  </a>";
					}else {
						echo "当前首页";
					}
					if($assPage->pageNow <= $assPage->pageCount-1){
						echo "<a href='bkvideo.php?p=".($assPage->pageNow+1)."'> 下一页</a>";
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
				if(count($assPage->pageArr) != 0){
					 //通过循环来将视频信息展示出来
					 for($i = 0 ; $i < count($assPage->pageArr) ; $i++){
					 	echo "<div id='bk_video_list'>";
					 	echo "<div><a href='#del' onclick='show_video_del_div(this)' video_id='".$assPage->pageArr[$i]['id']."' class='button red' style='color:white;'>删除该视频</a></div>";
					 	echo "<embed src='".$assPage->pageArr[$i]['address']."' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque' width='400px' height='300'    play='false' >";
					 	echo "<div class='bk_video_content'><span>".utf8Substr($assPage->pageArr[$i]['content'], 0, 120)."</span><a class='".$assPage->pageArr[$i]['id']."' onclick='show_edit_video_input(this)' href='#edit' style='color:blue;'>[编辑]</a></div>";
					 	echo "</div>";
					 }
				}else{
					echo "<div id='textCenter'>暂无视频!</div>";
				}
			?>
		</div>
		</div>
	</div>
</div>
<?php
include_once 'footer.php'; 
?>
