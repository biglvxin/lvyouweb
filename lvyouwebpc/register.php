<!DOCTYPE html>
<html>
<head>
	<title>注册页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
<div class="login-bg">
		<img src="images/bg.jpg" alt="">		
	</div>
	<div class="reg-logo">
			<img src="images/logo.jpg">旅游go注册
		</div>
	<div class="login-page reg-page" id="login-page">
		
		<div class="login-right res-container">
			<form method="post" name="frm" id="frm">
				<div class="login-input reg-input">
					<label>用户</label>
					<input type="text" name="username" id="username" placeholder="输入手机号码" class="inputuserpwd" required>
				</div>
				<div class="login-input reg-input">
					<label>密码</label>
					<input type="text" name="password" id="password"  class="inputuserpwd" required>
				</div>
				<div class="login-input reg-input">
					<label>昵称</label>
					<input type="text" name="nickname" id="nickname"  class="inputuserpwd" required>
				</div>
				<div class="login-input reg-input">
					<label>验证码</label>
					<input type="text" name="code" id="code" class="inputuserpwd inppos" required>
					<button type="button" class="btn btn-default" id="sendCode">发送验证码</button>
					<div id="reg-info"></div>
				</div>
				<div class="login-input reg-input">
					<button type="button" id="btnBower">上传头像</button>
					<img src="images/pig.jpg" id="image">
					<input type="file" name="image" id="fileUpload"  class="inputuserpwd" style="display: none;">
				</div>
				<div class="login-input reg-input">
					<a class="btn btn-default posbtn2" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">取消</a>
				<button  class="btn btn-success" id="btnValidateCode">注册</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="lib/js/jquery.min.js"></script>
	<script src="lib/js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/register.js"></script>
</body>
</html>