<?php
//修改相册描述
require_once '../../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$photo_id = $_POST['photo_id'];


//执行删除
$sqlHelper = new SqlHelper();
$sql_up_ph_cnt= "DELETE FROM  t_photo WHERE id=".$photo_id;
$res_up_ph_cnt = $sqlHelper -> execute_dql($sql_up_ph_cnt);
if($res_up_ph_cnt != null){
	echo "ok";//删除成功
	exit;
}else{
	echo "no";
	exit;
}
?>