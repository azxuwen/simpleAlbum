<?php
session_start();
$_SESSION['USERID'] = NULL;
$_SESSION['USERNAME'] = NULL;
session_destroy();
header("Location:login.php");
exit();
?>