<?php
//删除相册  以及 相册 下的 所有照片
require_once '../../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$album_id = $_POST['album_id'];

//首先删除掉服务器文件夹中的所有照片
$sql_get_album_photo = "SELECT * FROM t_photo WHERE album_id = ".$album_id;
$arr_get_album_photo = $sqlHelper->execute_dql2($sql_get_album_photo);
//通过循环来删除掉文件件中的文件
for($i = 0 ; $i < count($arr_get_album_photo); $i++){
	unlink("../../".$arr_get_album_photo[$i]['address']);
}

//删除掉数据库中的记录
$sql_del_album_photo = "DELETE FROM t_photo WHERE album_id = ".$album_id;
$res_del_album_photo = $sqlHelper->execute_dql($sql_del_album_photo);

//删除掉相册记录
$sql_del_album = "DELETE FROM t_album WHERE id = ".$album_id;
$res_del_album = $sqlHelper->execute_dql($sql_del_album);
if($res_del_album && $res_del_album_photo){
	echo "ok";
}else{
	echo "error";
}
?>