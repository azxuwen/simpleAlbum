<?php
/*
 * 后台 userMng.php  
 * 用于对当前的会员进行管理
*/
include_once 'header.php';
//获取待激活会员
require_once '../SqlHelper.class.php';
require_once '../AssPage.class.php';
$sqlHelper = new SqlHelper();
$assPage = new AssPage();
$assPage->pageSize = 7; //每页显示3个相册
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}

$sql_all_active_user_count = "Select count(id) From t_user WHERE active= 'n'";//取得相册条数
$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
$end = $assPage->pageSize;

$sql_get_active_user = "SELECT * FROM t_user WHERE active='n' ORDER BY time desc LIMIT {$start}, {$end}";//取得本页数据
$sqlHelper->excute_dql_asspage($sql_all_active_user_count, $sql_get_active_user, $assPage);
//print_r($assPage->pageArr);
?>
<!--
	执行结果 
 -->
<div class="res_operator">
	<div class="res_word"></div>
</div>
	<div class="sysmenub">
		<p class="smenubtit">会员管理</p>
			<ul>
				<li><a href="userMng.php">已激活会员</a></li>
				<li><a class="current" href="waitActive.php">待激活会员</a></li>
			</ul>
	</div>
	<div class="sysinfo">
		<p class="sinfotit">待激活用户</p>
		<div class="exec">
			<p class="execact">
				<span id="index_page">
				<?php
					if($assPage->pageNow > 1){ 
						echo "<a href='waitAcitve.php?p=".($assPage->pageNow-1)."'> 上一页  </a>";
					}else {
						echo "当前首页";
					}
					if($assPage->pageNow <= $assPage->pageCount-1){
						echo "<a href='waitAcitve.php?p=".($assPage->pageNow+1)."'> 下一页</a>";
					}else{
						echo "当前末页";
					}
					echo " 共".$assPage->pageCount."页";
				?>
				</span>
			</p>
		</div>
		<div class="list">
		<table class="gridtable">
		
			<?php
				//展示还未激活的会员 
				if(count($assPage->pageArr) != 0){
					echo "<tr><th>登录名</th><th>真实姓名</th><th>激活状态</th></tr>";
					for($i = 0 ; $i < count($assPage->pageArr); $i++){
						echo "<tr>";
						echo "<td>".$assPage->pageArr[$i]['user']."</td>";
						echo "<td>".$assPage->pageArr[$i]['name']."</td>";
						echo "<td>未激活&nbsp;&nbsp;&nbsp;<a href='#active' user_id='".$assPage->pageArr[$i]['id']."' class='button red' onclick='active_user(this)' style='color:white;width:60px;height:10px;'>点击激活</a></td>";
						echo "</tr>";
					}
				}else{
					echo "<div id='textCenter'>暂无需要激活的用户!</div>";
				}
			?>
			</table>
		</div>
		</div>
	</div>
</div>
<?php
include_once 'footer.php'; 
?>
