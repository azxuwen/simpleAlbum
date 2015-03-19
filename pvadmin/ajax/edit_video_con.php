<?php
//修改视频content
require_once '../../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$edit_video_arr = explode('*', $_POST['edit_video_arr']);
if(count($edit_video_arr) != 2){
	echo "error";
	exit();
}
$video_id = $edit_video_arr[0];//相片ID
$video_content = $edit_video_arr[1];//相片描述
//执行查询
$sqlHelper = new SqlHelper();
$sql_up_vi_cnt= "UPDATE t_video SET content = '".$video_content."' WHERE id=".$video_id;
$res_up_vi_cnt = $sqlHelper -> execute_dql($sql_up_vi_cnt);
if($res_up_vi_cnt != null){
	echo "ok";//不存在该账户
	exit;
}else{
	echo "no";
	exit;
}
?>