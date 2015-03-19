<?php
//退出后台系统
session_start();
$_SESSION['ADMINID'] = null;
$_SESSION['ADMINNAME'] = null;
session_destroy();
header("Location:login.php");
exit;
?>