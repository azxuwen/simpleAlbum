<?php  
	//引入header
	include_once 'header.php';
	//取得主页数据
	require_once 'PubFunction.php';
	require_once 'SqlHelper.class.php';
	$sqlHelper = new SqlHelper();
	//获取当前播放的视频信息
	$sql_get_crt_video = "SELECT * FROM t_video WHERE id=".$_GET['id']." LIMIT 0, 1" ;
	$arr_get_crt_video = $sqlHelper -> execute_dql2($sql_get_crt_video);
	$crt_video_content = $arr_get_crt_video[0]['content'];//当前播放视频的介绍
	$crt_video_address = $arr_get_crt_video[0]['address'];//当前播放视频的地址
	$crt_video_like = $arr_get_crt_video[0]['like'];//当前视频的点赞次数
	$crt_video_time = $arr_get_crt_video[0]['time'];//上传时间
	
	//获取全部其他视频
	$sql_get_other_video = "SELECT * FROM t_video WHERE id!=".$_GET['id']." ORDER BY time DESC";
	$arr_get_other_video = $sqlHelper -> execute_dql2($sql_get_other_video);
?>
<!--==============================Content=================================-->

<script type="text/javascript">
	/*
		因为出现了，当进入vide.php?id=X 时，页面中的布局有问题，但是刷新一次之后就没问题了
		所以这里对是否是第一次进入页面进行了一个判断，如果是第一次进入该页面，就执行一次刷新
	*/
	//获取当前页面的URL
	function getUrlParam(url){
		arg = url.split("#");
		return arg[1];
	}
	var crt_url = document.URL;
	var onFirst = getUrlParam(document.URL);//检查是否是第一次进入video.php
	var go_url = crt_url.substr(0, crt_url.length-6);
	if(onFirst == 'first'){
		window.location.href = go_url;
		return false;
	}
</script>
<div class="content"><div class="ic">More Website Templates @ <a href="http://www.cssmoban.com/" >网页模板</a> - December 30, 2013!</div>
				<div class="container_12">
					<div class="grid_8">
						<div class="box">
							<div class="inner maxheight">
								<p><br/><img src="images/house.png" width="15px" height="15px"/>  <a href='index.php'>首页</a>  > 视频 </p>
								<div class="video_block"> 
									<div class="title">&nbsp;</div>
									
									<figure class="video">
										<?php
											//显示视频 
											echo "<embed src='".$crt_video_address."' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque' width='550' height='400'    play='false' >";
										?>
									</figure>
									<p>
										<?php
											//显示视频介绍
											echo $crt_video_content; 
										?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="grid_4">
						<div class="box">
							<div class="inner maxheight">
								<h4>全部视频</h4>
								<ul class="list">
									<?php
										if(count($arr_get_other_video)!=0){
											for($i = 0 ; $i < count($arr_get_other_video); $i++){
												echo "<li class='li'><embed src='".$arr_get_other_video[$i]['address']."' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque' width='220px' height='160'    play='false' ></li>"; 
											}
										}else{
											echo "暂无其他视频。";
										}
									?>		
								</ul>
								
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
//引入footer
include_once 'footer.php';
?>