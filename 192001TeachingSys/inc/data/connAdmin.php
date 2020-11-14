<?php
$serverName = "127.0.0.1";
	$userName = "cait";
	$password = "123456";
	$db = "cait_school";
	//5组 连接对象的创建
	$conn = @new mysqli($serverName,$userName,$password,$db);
	if($conn->connect_error){
		//180310201 连接失败
		die("连接失败，原因为：".$conn->connect_error);
	}
?>