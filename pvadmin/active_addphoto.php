<?php
/*
 * 通过uploadify插件来实现批量上传的PHP文件
 */
require_once '../SqlHelper.class.php';
require_once '../PubFunction.php';
$sqlHelper = new SqlHelper();
//设置上传目录
$path = "../upload/";	

if (!empty($_FILES)) {
	//得到文件原名,并且修改原文件名
	$fileName = iconv("UTF-8","GB2312",$_FILES["Filedata"]["name"]);//上传之前的名称
	
	$randName = date("y-m-d", time())."-".createRandName(15).".".get_extension($fileName);//生成新名字
	
	$oldName = "../upload/".$fileName;//为图片生成一个新名字
	$newName = "../upload/".$randName;//为图片生成一个新名字
	
	
	//$_FILES['Filedata']['name'] = $randName;//将原文件名修改成随机字符串   但是不好使 不知道为什么？
	//现在$randName 中就已经保存了 图片的新名称
	$new_pic_dir = "upload/".$randName;//将该信息填写到数据库
	$files = $_POST['typeCode'];//从uploadify传过来的值 ，实际上是上传图片的相册 的 ID
	//这里存储到数据库
	$sql_ist_new_pic = "INSERT INTO t_photo (address, time, album_id ) VALUES('".$new_pic_dir."', now(), $files)";
	$res_ist_new_pic = $sqlHelper -> execute_dql($sql_ist_new_pic);
	$ist_new_pic_id = mysql_insert_id();
	//接受动态传值
	
	
	//得到上传的临时文件流
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	//最后保存服务器地址
	if(!is_dir($path))
	   mkdir($path);
	if (move_uploaded_file($tempFile, $path.$fileName)){
		echo $ist_new_pic_id."*../upload/".$randName;
	}else{
		echo $fileName."上传失败,请重试";
	}
	/*
	 *因为害怕上传的图片中有重名的 所以希望能够生成一个随机的字符串作为图片的新名字
	 * 但是通过$_FILES[]['name'] 来直接修改 却不可以
	 * 所以只能想到这个办法 rename() 
	*/
	//echo "<br/>老名字".$oldName;
	//echo $newName;
	rename($oldName, $newName);
}
?>