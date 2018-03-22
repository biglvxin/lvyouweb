<!DOCTYPE html>
<html>
<head>
	<title>旅游网情网站</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
</head>
<body>
	 <!--头部分-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	?>
	<?php 
		require_once("lvyouwebpc/services/areasService.php");
		require_once("lvyouwebpc/model/areasInfo.php");
		require_once("lvyouwebpc/services/hotelService.php");
		require_once("lvyouwebpc/model/hotelInfo.php");
	 ?>
	 <?php 
	 $areashot=[];
	 $areashot=AreasService::getHotArea();
	 //print_r($areashot);
	 $hotelhot=[];
	 $hotelhot=HotelService::getHotHotel();
	 //print_r($hotelhot);
	 ?>
	<!--内容-->
	<div class="index-page">
		<!--二级菜单导航-->
		<a href="index.php" class="two-meun">首页></a>
		<!--地区和轮播-->
		<div class="advplace-container">
			<!--地区列表-->
			<div class="place-container">
				<div class="index-place">
					<div class="place-item">
						<h5>假日狂欢</h5>
						<ul class="index-ulpage">
							<li><a href="gonglvdetail.php?keyword=苏州" class="index-active">苏州</a></li>
							<li><a href="gonglvdetail.php?keyword=常州">常州</a></li>
							<li><a href="gonglvdetail.php?keyword=成都">成都</a></li>
						</ul>
						<a href="scenery.php"><i class="fa fa-chevron-right"></i></a>
					</div>
					<div class="place-item">
						<h5>华南华中</h5>
						<ul class="index-ulpage">
							<li><a href="gonglvdetail.php?keyword=广州">广州</a></li>
							<li><a href="gonglvdetail.php?keyword=武汉" class="index-active">武汉</a></li>
							<li><a href="gonglvdetail.php?keyword=张家界">张家界</a></li>
							<li><a href="gonglvdetail.php?keyword=三亚湾">三亚湾</a></li>
						</ul>
						<a href="scenery.php"><i class="fa fa-chevron-right"></i></a>
					</div>
					<div class="place-item">
						<h5>多彩西南</h5>
						<ul class="index-ulpage">
							<li><a href="gonglvdetail.php?keyword=香格里拉" class="index-active">香格里拉</a></li>
							<li><a href="gonglvdetail.php?keyword=重庆">重庆</a></li>
							<li><a href="gonglvdetail.php?keyword=贵州">贵州</a></li>
						</ul>
						<a href="scenery.php"><i class="fa fa-chevron-right"></i></a>
					</div>
					<div class="place-item">
						<h5>华北东北</h5>
						<ul class="index-ulpage">
							<li><a href="gonglvdetail.php?keyword=哈尔滨" class="index-active">哈尔滨</a></li>
							<li><a href="gonglvdetail.php?keyword=满洲里">满洲里</a></li>
							<li><a href="gonglvdetail.php?keyword=青岛">青岛</a></li>
						</ul>
						<a href="scenery.php"><i class="fa fa-chevron-right"></i></a>
					</div>
					<div class="place-item">
						<h5>中原西北</h5>
						<ul class="index-ulpage">
							<li><a href="gonglvdetail.php?keyword=兰州">兰州</a></li>
							<li><a href="gonglvdetail.php?keyword=西安" class="index-active">西安</a></li>
							<li><a href="gonglvdetail.php?keyword=开封">开封</a></li>
							<li><a href="gonglvdetail.php?keyword=西宁">西宁</a></li>
						</ul>
						<a href="scenery.php"><i class="fa fa-chevron-right"></i></a>
					</div>
			</div>
			</div>
			
			<!--轮播部分-->
			<div class="adv">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
				      <img src="images/adv1.jpeg" alt="图片1">
				      <div class="carousel-caption">
				      	<!--可以增加内容-->
				      </div>
				    </div>
				    <div class="item">
				      <img src="images/adv2.jpeg" alt="图片2">
				      <div class="carousel-caption">
				      
				      </div>
				    </div>
				    <div class="item">
				      <img src="images/adv3.jpeg" alt="图片3">
				      <div class="carousel-caption">
				        
				      </div>
				    </div>
				    <div class="item">
				      <img src="images/adv4.jpeg" alt="图片4">
				      <div class="carousel-caption">
				       
				      </div>
				    </div>
				  </div>

				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>
		<!--主页展示的内容-->
		<div class="index-content">
			<!--景点推荐-->
			<div class="recommend-scenery">
				<!--景点推荐标题-->
				<div class="recommend-title">
					<div class="title-left">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-right">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-midden">热门目的地</div>	
				</div>
				<!--景点推荐显示-->
				<div class="recommend-content">
						<ul class="recommend-pageul">
							<?php foreach ($areashot as $key=>$item): ?>
								<li>
									<a href="gonglvdetail.php?areaId=<?php echo $item->id; ?>&introduce=<?php echo $item->introduce; ?>">
										<div class="img-top">
											<img src="<?php echo $item->image; ?>">
											<?php if($key+1==1){ ?>
												<div class="number1"><?php echo $key+1; ?></div>

											<?php }else if($key+1==2){ ?>
												<div class="number1 number2"><?php echo $key+1; ?></div>

											<?php }else if($key+1==3){ ?>
												<div class="number1 number3"><?php echo $key+1; ?></div>

											<?php }else{ ?>
												<div class="number1 number4"><?php echo $key+1; ?></div>

											<?php } ?>
										</div>
										<div class="place-bottom">
											<p><?php echo $item->name; ?></p>
											<div class="stars">
												<img src="images/star2.png">
												<img src="images/star2.png">
												<img src="images/star2.png">
												<img src="images/star2.png">
												<img src="images/nullstar2.png">
											</div>
											<span class="green"><?php echo $item->score; ?>分</span>
											<span class="grey"><span class="greyyichu"><?php echo $item->count; ?></span><span class="grey2">人</span><img src="images/zang.png"></span>
										</div>
									</a>
							</li>
							<?php endforeach ?>
						</ul>
				</div>		
			</div>

			<!--好评酒店-->
			<div class="recommend-hotel">
				<!--好评酒店标题-->
				<div class="recommend-title">
					<div class="title-left">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-right">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-midden">好评酒店</div>	
				</div>
				<!--好评酒店显示-->
				<div class="recommend-content">
						<ul class="recommend-pageul">
							<?php foreach ($hotelhot as $key => $item): ?>
								<li>
									<a href="hoteldetail.php?hotelId=<?php echo $item->id; ?>">
										<div class="img-top">
											<img src="<?php echo $item->imageList[0]; ?>">
											<?php if($key==0||$key==4){ ?>
												<div class="number1 numberpos">人气高</div>
											<?php }else if($key==1||$key==5){ ?>
												<div class="number1 number2 numberpos numberpos-color2">评价好</div>
											<?php }else if($key==2||$key==6){ ?>
												<div class="number1 number3 numberpos numberpos-color3">性价比高</div>
											<?php }else{ ?>
												<div class="number1 number4 numberpos numberpos-color4">地理位置好</div>
											<?php } ?>
										</div>
										<div class="place-bottom">
											<p><?php echo $item->name; ?></p>
											<!-- <div class="btn btn-default ding">预定酒店</div> -->
											<span class="green"></span>
											<span class="grey wifipos">
												<span class="greyyichu price"><?php echo $item->priceList[0]->price; ?></span>
												<span class="grey2 price">元</span>
												<img src="images/wifi.png">
											</span>
										</div>
									</a>
							</li>
							<?php endforeach ?>	
						</ul>
				</div>
			</div>
		</div>	
	</div>
	<!--脚注-->
	<?php 
		include_once("lvyouwebpc/inc/footer.php");
	 ?>

</body>
</html>