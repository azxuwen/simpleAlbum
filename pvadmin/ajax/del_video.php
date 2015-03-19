<?php
//修改相册描述
require_once '../../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$del_video_id = $_POST['del_video_id'];


//执行删除
$sqlHelper = new SqlHelper();
$sql_del_ph_cnt= "DELETE FROM  t_video WHERE id=".$del_video_id;
$res_del_ph_cnt = $sqlHelper -> execute_dql($sql_del_ph_cnt);
if($res_del_ph_cnt != null){
	echo "ok";//删除成功
	exit;
}else{
	echo "no";
	exit;
}
?>