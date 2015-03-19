<?php  
	//引入header
	include_once 'header.php';
	//取得主页数据
	require_once 'PubFunction.php';
	require_once 'SqlHelper.class.php';
	$sqlHelper = new SqlHelper();
	$arr_index_data = array();
	$sql_get_index_album = "SELECT * FROM t_album ORDER BY time DESC";//获取主页的相册
	$sql_get_index_video = "SELECT * FROM t_video ORDER BY time DESC";//获取主页的视频信息
	$arr_get_index_album = $sqlHelper -> execute_dql2($sql_get_index_album);	
	$arr_get_index_video = $sqlHelper -> execute_dql2($sql_get_index_video);
	$arr_index_data = array_merge($arr_get_index_album, $arr_get_index_video);//将相册与视频信息结合
	$arr_index_data = array_sort($arr_index_data, 'time');//对从数据库中取出的相册 和 视频 按照时间进行排序
	echo "<pre>";
	//print_r($arr_index_data);
	echo "</pre>";
?>
<!--==============================Content=================================-->
			<div class="content"><div class="ic">More Website Templates @ <a href="http://www.cssmoban.com/" >网页模板</a> - December 30, 2013!</div>
				<div class="container_12">
					<div class="grid_6">
					<?php
						//通过循环展示相册
						//因为布局两侧都需要放内容 ， 所以需要一个标识来控制
						$index_identify = 0;
						foreach($arr_index_data as $k => $val){
							if($index_identify%2 != 0){
								$index_identify++;
								continue;
							}
							if($val['type'] == 'a'){
								echo "<div class='p1_box left cl1'>";
							}else{
								echo "<div class='p1_box left cl3'>";
							}
							echo "<div class='type'></div>";
							//如果是相册，获取到相册中的第一张图片
							if($val['type'] == 'a'){
								$sql_get_album_first = "SELECT COUNT(id) AS count,id, address FROM t_photo WHERE album_id = " . $val['id']." ORDER BY time DESC LIMIT 0, 1 ";
								$arr_get_album_first = $sqlHelper -> execute_dql2($sql_get_album_first);
								if($arr_get_album_first[0]['count'] == 0){
									echo "<a href='gallery.php?id=".$val['id']."'><img src='images/nomore.jpg' alt=''></a>";
									echo "<a href='gallery.php?id=".$val['id']."' class='bot'>".$val['content']."<span>".$arr_get_album_first[0]['count']."<br>张</span></a>";
								}else{
									echo "<a href='gallery.php?id=".$val['id']."'><img src='".$arr_get_album_first[0]['address']."' alt=''></a>";
									echo "<a href='gallery.php?id=".$val['id']."' class='bot'>".$val['content']."<span>".$arr_get_album_first[0]['count']."<br>张</span></a>";
								}
							}else{
								//如果是视频，那么需要跟相册的另一种配置
								//echo "<a href='video.php?id=".$val['id']."#first'><img src='images/big4.jpg' alt=''></a>";
								echo "<embed src='".$val['address']."' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque' width='420px' height='400'    play='false' >";
								echo "<a href='video.php?id=".$val['id']."#first' title='".$val['content']."' class='bot'>".utf8Substr($val['content'], 0, 14)."<span style='font-size:15px'>".substr($val['time'],0, 10)."</span></a>";
							}
							echo "</div>";
							$index_identify ++;
						}
					?>	
						
					</div>
                    <div class="copyrights">Collect from</div>
					<div class="grid_6">
					<!--  index 右侧的部分 START -->
					<?php
						//通过循环展示相册
						//因为布局两侧都需要放内容 ， 所以需要一个标识来控制
						$index_identify = 0;
						foreach($arr_index_data as $k => $val){
							if($index_identify%2 == 0){
								$index_identify++;
								continue;
							}
							if($val['type'] == 'a'){
								echo "<div class='p1_box right cl1'>";
							}else{
								echo "<div class='p1_box right cl3'>";
							}
							echo "<div class='type'></div>";
							//如果是相册，获取到相册中的第一张图片
							if($val['type'] == 'a'){
								$sql_get_album_first = "SELECT COUNT(id) AS count,id, address FROM t_photo WHERE album_id = " . $val['id']." ORDER BY time DESC LIMIT 0, 1 ";
								$arr_get_album_first = $sqlHelper -> execute_dql2($sql_get_album_first);
							if($arr_get_album_first[0]['count'] == 0){
									echo "<img src='images/nomore.jpg' width='400px' alt=''></a>";
									echo "<a href='gallery.php?id=".$val['id']."' class='bot'>".$val['content']."<span>".$arr_get_album_first[0]['count']."<br>张</span></a>";
								}else{
									echo "<a href='gallery.php?id=".$val['id']."'><img src='".$arr_get_album_first[0]['address']."' alt=''></a>";
									echo "<a href='gallery.php?id=".$val['id']."' class='bot'>".$val['content']."<span>".$arr_get_album_first[0]['count']."<br>张</span></a>";
								}
							}else{
								//如果是视频，那么需要跟相册的另一种配置
								//echo "<a href='video.php?id=".$val['id']."#first'><img src='images/big4.jpg' alt=''></a>";
								echo "<embed src='".$val['address']."' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque' width='420px' height='400'    play='false' >";
								echo "<a href='video.php?id=".$val['id']."#first' title='".$val['content']."' class='bot'>".utf8Substr($val['content'], 0, 14)."<span style='font-size:15px'>".substr($val['time'],0, 10)."</span></a>";
							}
							echo "</div>";
							$index_identify ++;
						}
					?>
						
						<!--  index 右侧的部分 END -->
					</div>
					<div class="clear"></div>
					<div class="grid_12">
						<a href="#" class="round">No More...</a>
					</div>
				</div>
			</div>
<?php
//引入footer
include_once 'footer.php';
?>