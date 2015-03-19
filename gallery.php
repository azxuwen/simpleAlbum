<?php  
	//引入header
	include_once 'header.php';
	//取得主页数据
	require_once 'PubFunction.php';
	require_once 'SqlHelper.class.php';
	$sqlHelper = new SqlHelper();
	//获取当前查看的相册的基本信息以及获取当前相册下的相片
	$sql_get_crt_album = "SELECT * FROM t_album WHERE id=".$_GET['id']." LIMIT 0, 1";
	$arr_get_crt_album = $sqlHelper -> execute_dql2($sql_get_crt_album);
	$sql_get_crt_photo = "SELECT * FROM t_photo WHERE album_id=".$_GET['id']."" ;
	$arr_get_crt_photo = $sqlHelper -> execute_dql2($sql_get_crt_photo);
?>
<!--==============================Content=================================-->
<div class="content"><div class="ic">More Website Templates @ <a href="http://www.cssmoban.com/" >网页模板</a> - December 30, 2013!</div>
				<div class="container_12">
					<div class="grid_12">
						<div class="box bx1">
							<div class="inner">
								<h3>
									<p><img src="images/house.png" width="15px" height="15px"/>  <a href='index.php' style="font-size:13px;color:gray;">返回首页>></a> </p>
									<?php
										echo $arr_get_crt_album[0]['name'];
									?>
								</h3>
								<div class="gallery">
									<?php
										if(count($arr_get_crt_photo) != 0){
											for($i = 0 ; $i < count($arr_get_crt_photo); $i ++){
												echo "<a href='".$arr_get_crt_photo[$i]['address']."' class='gal'><img src='".$arr_get_crt_photo[$i]['address']."' width='200px' alt=''></a>";
											}
										}else{
											echo "<p><center>很抱歉,当前相册暂无图片.</center></p>";
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
//引入footer
include_once 'footer.php';
?>