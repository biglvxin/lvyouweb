<!DOCTYPE html>
<html>
<head>
	<title>个人中心页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/self.css">
	
</head>
<body>
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	 ?>
	 <?php 
	 require_once("lvyouwebpc/services/orderService.php");
	 require_once("lvyouwebpc/util/orderNumber.class.php");

	  ?>
	 <?php 
	 $user=(Array)$_SESSION["userInfo"][0];
	 //var_dump($user);
	 	//得到所有的订单
	 $orders=[];
	 $orders=OrderService::getAllOrderByUserId($user["id"]);
	// print_r($orders);
	
	  ?>
	
	<div class="self-page">
		<!--二级菜单导航-->
	 	<div class="secenery-twomenu">
	 		<a href="index.php">首页></a>
			<a href="self.php">我的订单></a>
	 	</div>
	 	<!--我的订单-->
	 	<div class="order-container">
	 		<ul class="order-title">
	 			<li>酒店</li>
	 			<li>入住时间</li>
	 			<li>住房类型</li>
	 			<li>交易状态</li>
	 		</ul>
	 		<?php if($orders){ ?>
	 			<?php foreach ($orders as $item) { ?>
	 			<div class="order-item">
	 			<div class="order-item-id"><span>订单号：</span><span><?php echo $item->id; ?></span></div>
	 			<ul class="order-content">
		 			<li>
		 				<img src="<?php echo $item->hotelList->logo; ?>">
		 				<div class="order-info">
		 					<div class="info-item"><span>酒店名称:</span><span class="hotel-name"><?php echo $item->hotelList->name; ?></span></div>
		 					<div class="info-item"><span>酒店位置：</span><span><?php echo $item->hotelList->address; ?></span></div>
		 				</div>
		 			</li>
		 			<li><?php echo $item->orderTime; ?></li>
		 			<li><?php echo $item->roomTypeList[0]->name; ?></li>
		 			<li>已预定</li>
	 			</ul>
	 			<div class="order-opterar">
	 				<button class="btn btn-default">删除</button>
	 			</div>
	 		</div>
	 		<?php } ?>

	 		<?php }else{ ?>
	 			<div>暂无酒店！！</div>

	 		<?php } ?>
			
	 		
	 	</div>
		
	</div>

	<!--脚注-->
	<?php 
		include_once("lvyouwebpc/inc/footer.php");
	 ?>

</body>
</html>