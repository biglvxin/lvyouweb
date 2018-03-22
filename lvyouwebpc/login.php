<!DOCTYPE html>
<html>
	<head>
		<title>登录页</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	</head>
	<body>
		<?php 
		session_start();
		require_once("lvyouwebpc/services/loginService.php");
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$backURL = $_SERVER["HTTP_REFERER"];
			$phone=$_POST["username"];
			$password=$_POST["password"];
			echo $phone;
			echo $password;
			$user=LoginService::isUser($phone,$password);
			print_r($user);
			if($user){
				$_SESSION["userInfo"]=$user;
				//header("location:index.php");
				if(strpos($_SESSION["BackUrl"],"register.php")){
					header("location:index.php");
					unset($_SESSION["BackUrl"]);
					exit;
				}else{
					header("location:" . $_SESSION["BackUrl"]);
					unset($_SESSION["BackUrl"]);
					exit;
				}	
			}
		}else{
				//保存上一个页面的路径值
				$backURL = $_SERVER["HTTP_REFERER"];
				$_SESSION["BackUrl"] = $backURL;
			}

		 ?>
		<div class="login-bg">
			<img src="images/bg.jpg" alt="">		
		</div>
		<div class="login-page" id="login-page">
			<div class="login-left">
				<img src="images/bg2.jpg">
			</div>
			<div class="login-right">
				<form method="post" name="frm" id="frm">
					<i class="fa fa-undo backico" id="backurl"></i>
					<div class="login-input">
						<label>用户</label>
						<input type="text" name="username"  id="username" class="inputuserpwd" required>
					</div>
					<div class="login-input">
						<label>密码</label>
						<input type="text" name="password"  id="password" class="inputuserpwd" required>
					</div>
					<div class="login-input">
						<input type="checkbox" name="going">自动登录
						<a type="button" class="btn btn-default posbtn" href="register.php">注册</a>
						<button  class="btn btn-success">登录</button>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="lib/js/jquery.min.js"></script>
		<script src="lib/js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
	</body>
</html>