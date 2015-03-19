<?php
/*
 * 对二维数组进行排序
*/
function array_sort($arr, $keys, $type = 'desc'){
	$keysvalue = $new_array = array();
	foreach($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach($keysvalue as $k => $v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array;
}

/*
 * 生成随机字符串
*/
//生成随机字符串
function createRandName($length){
	$randStr = '';
	$pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	for($i=0 ; $i<$length; $i++){
		$randStr .= $pattern[rand(0, 51)];
	}
	return $randStr;
}

/*
 * 获取文件的后缀
*/
function get_extension($file){
	$arr = explode('.', $file);
	return 	$arr[count($arr)-1];
}

/*
 * 字符串截取
 */
function utf8Substr($str, $from, $len){
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
			'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
			'$1',$str);
}//function utf8Substr() 结束


?>