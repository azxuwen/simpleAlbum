<?php
session_start();
header("Content-Type:text/html; charset=utf8");
//处理管理员登录
require_once '../SqlHelper.class.php';
$admin_name = $_POST['admin_name'];
$admin_password = $_POST['admin_password'];
//执行查询
$sqlHelper = new SqlHelper();
$sql_check_admin = "SELECT count(id) as count , id, password FROM t_admin WHERE name='".$admin_name."'";
$arr_check_admin = $sqlHelper -> execute_dql2($sql_check_admin);
if($arr_check_admin[0]['count'] == 0){
	echo '<script> alert("不存在该账号"); location.replace("login.php")</script>';
	exit();
}else{
	if($arr_check_admin[0]['password'] == $admin_password){
		$_SESSION['ADMINID'] = $arr_check_admin[0]['id'];
		$_SESSION['ADMINNAME'] = $admin_name;
		header("Location:index.php");
		exit;
	}else{
		echo '<script> alert("密码填写错误,请重试"); location.replace("login.php")</script>';
		exit();
	}
}
?>