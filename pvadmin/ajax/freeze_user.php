<?php
//激活用户
require_once '../../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$user_id = $_POST['user_id'];//需要激活的用户的ID
//执行修改
$sql_up_user_active= "UPDATE t_user SET active = 'n' WHERE id=".$user_id;
$res_up_user_active = $sqlHelper -> execute_dql($sql_up_user_active);

if($res_up_user_active != null){
	echo "ok";//不存在该账户
	exit;
}else{
	echo "no";
	exit;
}
?>