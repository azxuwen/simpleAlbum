<?php
/**
 * Page-Level DocBlock example.
 * This DocBlock precedes another DocBlock and will be parsed as the page-level.
 * Put your @package and @subpackage tags here
 * @package pagelevel_package
 */
header("Content-Type:text/html; charset=utf8");
/**
 * require class SqlHelper
 */
require_once 'SqlHelper.class.php';
	$username = $_POST['user'];//账户名
	$password = $_POST['password'];//密码
	if($username == ""){
		echo '<script> alert("还未填写账户名"); location.replace("login.php")</script>';
		exit();
	}
	if($password == ""){
		echo '<script> alert("还未填写密码"); location.replace("login.php")</script>';
		exit();
	}
	/**
	 * define class's obj
	 */
	$sqlHelper = new SqlHelper();
	$sql_check_user = "SELECT count(id) as count,id, password, name,active FROM t_user WHERE user = '".$username."'";
	$arr_check_user = $sqlHelper->execute_dql2($sql_check_user);
	if($arr_check_user[0]['count'] == 0){
		echo '<script> alert("不存在该用户,请重试"); location.replace("login.php")</script>';
		exit();
	}
	if($arr_check_user[0]['active'] == 'n'){
		echo '<script> alert("您的账号还在审核中,请耐心等待"); location.replace("login.php")</script>';
		exit();
	}
	if($arr_check_user[0]['password'] != $password){
		echo '<script> alert("密码填写错误,请重试"); location.replace("login.php")</script>';
		exit();
	}
	//到达这里，已经证明登录成功
	session_start();
	$_SESSION['USERID'] = $arr_check_user[0]['id'];
	$_SESSION['USERNAME'] = $arr_check_user[0]['name'];
	header("Location:index.php");
	exit();
?>