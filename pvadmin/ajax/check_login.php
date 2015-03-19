<?php
//检查是否存在管理员账号
require_once '../../SqlHelper.class.php';
$login_arr = explode('*', $_POST['login_string']);
$admin_name = $login_arr[0];
$admin_password = $login_arr[1];
//执行查询
$sqlHelper = new SqlHelper();
$sql_check_admin_exist = "SELECT COUNT(id) AS count FROM t_admin WHERE name='".$admin_name."'";
$arr_check_admin_exist = $sqlHelper -> execute_dql2($sql_check_admin_exist);
if($arr_check_admin_exist[0]['count'] == 0){
	echo "no";//不存在该账户
	exit;
}else{
	echo "yes";
	exit;
}
?>