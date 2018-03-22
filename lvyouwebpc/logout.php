<?php 
	session_start();
	//会话销毁
	session_destroy();
	//注销之后去登录页
	header("location:index.php");