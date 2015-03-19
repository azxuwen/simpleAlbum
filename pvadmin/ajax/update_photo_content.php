<?php
//修改相册描述
require_once '../../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$up_ph_cnt_arr = explode('*', $_POST['up_ph_cnt']);
if(count($up_ph_cnt_arr) != 2){
	echo "error";
	exit();
}
$photo_id = $up_ph_cnt_arr[0];//相片ID
$photo_content = $up_ph_cnt_arr[1];//相片描述
//执行查询
$sqlHelper = new SqlHelper();
$sql_up_ph_cnt= "UPDATE t_photo SET content = '".$photo_content."' WHERE id=".$photo_id;
$res_up_ph_cnt = $sqlHelper -> execute_dql($sql_up_ph_cnt);
if($res_up_ph_cnt != null){
	echo "ok";//不存在该账户
	exit;
}else{
	echo "no";
	exit;
}
?>