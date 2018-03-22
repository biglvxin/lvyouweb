<?php 
	session_start();
	//print_r($_SESSION["userInfo"]);
	if(array_key_exists("userInfo",$_SESSION)){
		$nickName=(Array)$_SESSION["userInfo"][0];
		//var_dump($nickName["nickName"]);
	}
 ?>
<!--头部-->
	<div class="header-page">
		<!--logo部分-->
		<div class="header-logo">
			<div class="logo-left">
				<img src="images/logo.jpg" id="logoimg">
				<div class="logo-title">旅游go</div>
			</div>
			<div class="logo-right">
				<?php if(array_key_exists("userInfo",$_SESSION)){ ?>
					<img src="<?php echo $nickName['headerPath'] ?>" style="width: 50px;height: 50px;border-radius: 50%;"><span href="login.php"><?php echo $nickName["nickName"]; ?> ,欢迎你   |</span>
					<a href="logout.php">注销</a>
				<?php }else{ ?>
					<a href="login.php">登录  |</a>
					<a href="register.php">注册  |</a>

				<?php } ?>
				
			</div>
			<div class="logo-middle">
				<input type="text" name="keyword" id="keywordCity" placeholder="请输入城市">
				<button class="btn btn-success" id="keywordbtn"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
		<?php
			$flag=0;
			if(strpos($_SERVER["SCRIPT_NAME"],"index.php")){
				$flag=0;
			}else if(strpos($_SERVER["SCRIPT_NAME"],"scenery.php")||strpos($_SERVER["SCRIPT_NAME"],"gonglvdetail.php")||strpos($_SERVER["SCRIPT_NAME"],"scenerydetail.php")){
				$flag=1;
			}else if(strpos($_SERVER["SCRIPT_NAME"],"route.php")||strpos($_SERVER["SCRIPT_NAME"],"routedetail.php")){
				$flag=2;
			}else if(strpos($_SERVER["SCRIPT_NAME"],"hotel.php")|| strpos($_SERVER["SCRIPT_NAME"],"hoteldetail.php")){
				$flag=3;
			}else if(strpos($_SERVER["SCRIPT_NAME"],"self.php")){
				$flag=4;
			}
		 ?>	
		<!--导航部分-->
		<div class="header-menu">
			<div class="menu-container">
				<ul class="page-ulheader">
					<li><a href="index.php" <?php echo $flag==0?'class=actived':'' ?>>主页</a></li>
					<li><a href="scenery.php" <?php echo $flag==1?'class=actived':'' ?>>景点攻略</a></li>
					<li><a href="route.php" <?php echo $flag==2?'class=actived':'' ?>>精选路线</a></li>
					<li><a href="hotel.php" <?php echo $flag==3?'class=actived':'' ?>>预定酒店</a></li>
					<?php if(array_key_exists("userInfo",$_SESSION)){ ?>
						<li><a href="self.php" <?php echo $flag==4?'class=actived':'' ?>>我的订单</a></li>
					<?php }else{ ?>
						<li><a href="login.php" <?php echo $flag==4?'class=actived':'' ?>>我的订单</a></li>
					<?php } ?>

					
				</ul>
			</div>	
		</div>	
	</div>
	