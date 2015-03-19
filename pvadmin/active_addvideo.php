<?php
session_start();
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
//处理管理员添加视频
$videoLink =  $_POST['videoLink'];
$videoContent = $_POST['videoContent'];
if(strlen($videoLink) == 0){
	echo "<script> alert('视频链接还未填写'); location.replace('addVideo.php')</script>";
	exit();
}
//下面通过sql来添加视频
$sqlHelper = new SqlHelper();
$sql_add_video = "INSERT INTO t_video (address, content, time, type) VALUES('".$videoLink."', '".$videoContent."', now(), 'v')";
$res_add_video = $sqlHelper->execute_dql($sql_add_video);
if($res_add_video != null){
	header("Location:bkvideo.php");
	exit();
}else{
	echo "<script> alert('视频添加失败,请重试'); location.replace('addVideo.php')</script>";
	exit();
}
?>