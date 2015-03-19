<?php
	class AssPage{
		var $pageNow;  //当前页
		var $pageCount; //总 页数
		var $pageSize;	  //一页的记录数
		var $pageRows;  //数据库中总记录数
		var $pageArr;  //用于接收当前页面的数据 是个数组
		
		var $pageTitle;
		var $pageContent; //用于统计一个文章的长度
	}
?>