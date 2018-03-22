<!DOCTYPE html>
<html>
<head>
	<title>酒店详情页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/hoteldetail.css">
	<link rel="stylesheet" type="text/css" href="css/scenerydetail.css">
</head>
<body>
	<!--头部-->
	<?php 
		include_once("inc/header.php");
	 ?>
	 <?php 
	 	require_once("lvyouwebpc/services/hotelService.php");
		require_once("lvyouwebpc/model/hotelInfo.php");
		require_once("lvyouwebpc/util/orderNumber.class.php");
		require_once("lvyouwebpc/services/roomsService.php");
	 ?>
	 <?php 
	 	//得到酒店详情
	 	$hotelId=$_GET["hotelId"];
	 	$hotel=[];
		$hotel=HotelService::getSingleHotel($hotelId);
		$roomprice=HotelService::getHotelPrice($hotelId);
		//获取订单号
		$orderNo = OrderNumber::buildOrderNumber();
		//echo $orderNo;
		//$roomprice[0]->roomtypeId;
		//print_r($roomprice);
		//print_r($hotel);
		$user=(Array)$_SESSION["userInfo"][0];
	 ?>
	 <?php 
	 	$backURL = $_SERVER["HTTP_REFERER"];
	  ?>
	  <!--酒店详情容器-->
	 <div class="hoteldetail-page">
	  	<!--二级菜单导航-->
	 	<div>
	 		<?php if(strpos($backURL,"index.php") || strpos($backURL,"hotel.php")){ ?>
				<a href="index.php">首页></a>
				<a href=" hoteldetail.php?hotelId=<?php echo $hotelId; ?>">酒店详情></a>
			<?php } else if(strpos($backURL,"scenerydetail.php")) {  ?>
			 	<a href="index.php">首页></a>
				<a href="scenery.php">景点攻略></a>
				<a href="gonglvdetail.php">攻略详情></a>
				<a href="scenerydetail.php">景点详情></a>
				<a href=" hoteldetail.php">酒店详情></a>
			<?php } ?>
	 	</div>
	 	<!--酒店详情内容-->
	 	<div class="hoteldetail-content">
	 		<div class="hoteldetail-place" order-name="<?php echo $orderNo; ?>" user-id="<?php echo $user['id']; ?>" hotel-id="<?php echo $hotel->id; ?>" phone="<?php echo $user['phone']; ?>" id="hotelListInfo"><?php echo $hotel->name; ?></div>
	 		<div class="hoteldetail-img">
	 			<img src="<?php echo $hotel->imageList[0] ?>">
	 			<img src="<?php echo $hotel->imageList[1] ?>">
	 			<img src="<?php echo $hotel->imageList[2] ?>">
	 		</div>
	 		<!--选择预定什么类型的酒店-->
	 		<div class="hotel-opteater">
	 	
	 				入住时间：<input type="date" name="inhotel" id="livein-time">
	 				住房类型：
	 				<select id="hotel-typewhat">
		 				<option value="0">大床房</option>
		 				<option value="1">双人间</option>
	 			</select>
	 			<button class="btn btn-success"  id="yudinghotel" type="button">预定酒店</button>
	 		
	 			<table class="table table-hover">
	 				<thead>
	 					<th>住房类型：</th>
	 					<th>价格/（每晚）元</th>
	 				</thead>
	 				<tbody>
	 					<tr>
	 						<td>大床房</td>
	 						<td><?php echo $roomprice[0]->price; ?></td>
	 					</tr>
	 					<tr>
	 						<td>双人间</td>
	 						<td><?php echo $roomprice[1]->price; ?></td>
	 					</tr>
	 				</tbody>
	 			</table>
	 		</div>
	 		<!--酒店攻略详情-->
	 		<div class="hotel-gonglv">
	 			<ul class="hotelgonglv-pageul">基本信息:
	 				<li>入住时间：14：00-18：00</li>
	 				<li>离店时间：12：00之前</li>
	 			</ul>
	 			<ul class="hotelgonglv-pageul">主要设施:
	 				<li><img src="images/wifi2.png">免费wifi</li>
	 				<li><img src="images/dianti.png">电梯</li>
	 				<li><img src="images/cnagtang.png">餐厅</li>
	 				<li><img src="images/xingli.png">行李寄存</li>
	 				<li><img src="images/allday.png">24小时服务</li>
	 				<li><img src="images/reshuihu.png">热水壶</li>
	 				<li><img src="images/chuifengji.png">吹风机</li>
	 			</ul>
	 			<ul class="hotelgonglv-pageul">酒店攻略:
	 				<li>酒店内设免费停车场，客房干净卫生，基础设施齐全，提供免费wifi服务。</li>
	 			</ul>
	 			<ul class="hotelgonglv-pageul">品牌信息:
	 				<li>经济型酒店品牌。</li>
	 			</ul>
	 			<ul class="hotelgonglv-pageul">酒店地址:
	 				<li><?php echo $hotel->address; ?></li>
	 			</ul>
	 		</div>
	 	</div>

	  	
	  </div>
	  <!--评论成功的提示框-->
		<div class="dialog" id="dialog">
			<div class="dialog-info">预定成功</div>
		</div>
	<!--脚注-->
	<?php 
		include_once("inc/footer.php");
	 ?>
	 <script type="text/javascript" src="js/hotelDetail.js"></script>

</body>
</html>