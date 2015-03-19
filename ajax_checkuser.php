<?php
//检查是否存在管理员账号
require_once 'SqlHelper.class.php';
$user = $_POST['user'];
//执行查询
$sqlHelper = new SqlHelper();
$sql_check_user_exist = "SELECT COUNT(id) AS count FROM t_user WHERE user='".$user."'";
$arr_check_user_exist = $sqlHelper -> execute_dql2($sql_check_user_exist);
if($arr_check_user_exist[0]['count'] > 0){
	echo "no";//不存在该账户
	exit;
}else{
	echo "yes";
	exit;
}
?>