<?php
//实现前台页面的登录控制
header("Content-Type:text/html; charset=utf8");
require_once 'SqlHelper.class.php';
$user = $_POST['reg_user'];//账户名
$password1 = $_POST['reg_password1'];//密码1
$password2 = $_POST['reg_password2'];//密码1
$name = $_POST['reg_name'];//真实姓名 
if($user == ""){
	echo '<script> alert("还未填写账户名"); location.replace("reg.php")</script>';
	exit();
}
if(strlen($user) < 6 || strlen($user) > 10){
	echo '<script> alert("账户名应控制在6-10位"); location.replace("reg.php")</script>';
	exit();
}
//这里检查一下该账户名 是否已经存在了，如果存在提示一下，注册失败
$sqlHelper = new SqlHelper();
$sql_check_user_exist = "SELECT COUNT(id) AS count FROM t_user WHERE user='".$user."'";
$arr_check_user_exist = $sqlHelper -> execute_dql2($sql_check_user_exist);
if($arr_check_user_exist[0]['count'] > 0){
	echo '<script> alert("该账户名已经存在,请您更换一个"); location.replace("reg.php")</script>';
	exit();
}
if($password1 == "" || $password2 == ""){
	echo '<script> alert("还未填写密码"); location.replace("reg.php")</script>';
	exit();
}
if(strlen($password1) < 6 || strlen($password1) > 20){
	echo '<script> alert("密码应控制在6-20位"); location.replace("reg.php")</script>';
	exit();
}
if($password1 != $password2){
	echo '<script> alert("两次输入密码不一致"); location.replace("reg.php")</script>';
	exit();
}
if($name == ""){
	echo '<script> alert("还未填写您的真实姓名"); location.replace("reg.php")</script>';
	exit();
}
//验证中文真实姓名是否正确
if (!preg_match("/^[\x80-\xff]{6,30}$/",$name)){ 
    echo '<script> alert("真实姓名中请不要存在字母或数字"); location.replace("reg.php")</script>';
	exit();
} 
$sql_reg_user = "INSERT INTO t_user(user, name, password, active, time) VALUES('".$user."', '".$name."', '".$password1."', 'n', NOW())";
$res_reg_user = $sqlHelper->execute_dql($sql_reg_user);
if($res_reg_user != null){
	header("Location:resReg.php");
	exit();
}else{
	echo '<script> alert("注册失败,请重试"); location.replace("reg.php")</script>';
	exit();
}
?>