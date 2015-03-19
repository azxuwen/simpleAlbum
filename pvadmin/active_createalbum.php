<?php
session_start();
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
//处理管理员创建新相册  或者 是修改相册 通过URL中是否存在id来判断
$album_name = $_POST['album_name'];//相册名称
$album_content = $_POST['album_content'];//相册介绍
$sqlHelper = new SqlHelper();
if(isset($_GET['id'])){
	//如果存在id证明执行修改
	$sql_up_album = "UPDATE t_album SET name='".$album_name."', content='".$album_content."' WHERE id = ".$_GET['id'];
	$res_up_album = $sqlHelper->execute_dql($sql_up_album);
	if($res_up_album != null){
		header("Location:editAlbum.php?id=".$_GET['id']);
		exit();
	}else{
		echo "<script> alert('相册信息修改失败,请重试'); location.replace('createAlbum.php?id=".$_GET['id']."&type=edit')</script>";
		exit();
	}
}else{
	$sql_ist_album = "INSERT INTO t_album(name, content, time, type) VALUES ('".$album_name."', '".$album_content."', NOW(), 'a')";
	echo $sql_ist_album;
	$res_ist_album = $sqlHelper -> execute_dql($sql_ist_album);
	if($res_ist_album != null){
		$new_id = mysql_insert_id();
		header("Location:addPhoto.php?id=".$new_id."&type=new");
		exit();
	}else{
		echo '<script> alert("相册添加失败,请重试"); location.replace("login.php")</script>';
		exit();
	}
}
?>