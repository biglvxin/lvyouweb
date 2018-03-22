<!DOCTYPE html>
<html>
<head>
	<title>预定酒店</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/scenery.css">
	<link rel="stylesheet" type="text/css" href="css/scenerydetail.css">
	<link rel="stylesheet" type="text/css" href="css/hotel.css">
</head>
<body>
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	?>
	<?php
	require_once("lvyouwebpc/services/provincesService.php");
	require_once("lvyouwebpc/model/provincesInfo.php");
	require_once("lvyouwebpc/services/hotelService.php");
	require_once("lvyouwebpc/model/hotelInfo.php");
	require_once("lvyouwebpc/services/areasService.php");
	require_once("lvyouwebpc/model/areasInfo.php");


	?>
	<?php
		$pageSize=9;
		$pageIndex=0;

		$areas=[];
		$areas=AreasService::getAllAreasCatagroy();
		//print_r($areas);
		$areaId="";
		if(array_key_exists("areaId",$_GET)){
			$areaId=$_GET["areaId"];
		}
		$index="";
		if(array_key_exists("index",$_GET)){
			$pageIndex=$_GET["index"];
		}
		//得到所有酒店。
		$hotels=[];
		$hotels=HotelService::getAllHotel($pageSize,$pageIndex,$areaId);
		if($hotels){
			$totalpages=ceil($hotels[0]->count/$pageSize);
		}
		//print_r($hotels);
	?>
	 <!--预定酒店的内容-->
	 <div class="hotel-page">
	 	<!--二级菜单导航-->
	 	<div class="secenery-twomenu">
	 		<a href="index.php">首页></a>
			<a href="hotel.php?areaId=<?php echo $areaId; ?>">预定酒店></a>
	 	</div>
	 	<!--地区具体分类-->
	 	<div class="place-category">
	 		<div class="all-category">地区</div>
	 		<div class="all-area">
	 			<ul class="place-pageul">
	 				<?php 
	 					$all=new AreasInfo();
	 					$all->id="";
	 					$all->name="全部";
	 					array_unshift($areas,$all);
	 				?>
	 				<?php foreach ($areas as $item): ?>
	 					<li><a href="hotel.php?areaId=<?php echo $item->id ?>" <?php echo $areaId==$item->id?'class="activeds"':''; ?>><?php echo $item->name; ?></a></li>
	 				<?php endforeach ?>
	 			</ul>
	 		</div>
	 	</div>
	 	<!--周边酒店头-->
	 	<div class="recommend-title">
			<div class="title-left">
				<img src="images/titletiao.jpg">
			</div>
			<div class="title-right">
				<img src="images/titletiao.jpg">
			</div>
			<!--分页显示所有攻略--><!--默认选中一个酒店的周边酒店，一上来显示的是选中的-->
			<div class="title-midden">热门酒店</div>
		</div>
		<!--推荐酒店-->
		<div class="place-hotel-container">
				<div class="place-hotel-center">	
			 			<div class="sdhotel-right">
			 				<?php if($hotels==null){?>
								<div class="">暂无酒店！</div>
							
			 				<?php } else{ ?>
			 					<?php foreach ($hotels as $item): ?>
			 					<div class="sdright-top pos-top">
			 						<a href="hoteldetail.php?hotelId=<?php echo $item->id; ?>">
			 							<img src="<?php echo $item->logo; ?>">
			 							<div class="near-hotel-title near-small"><?php echo $item->name; ?>
			 							</div>
			 							<?php 
			 							$roomprice=HotelService::getHotelPrice($item->id);
										//print_r($roomprice);
			 							 ?>
			 							<span class="juli"><?php echo $roomprice[0]->price; ?></span><span class="price">元</span>
			 						</a>
			 					</div>
			 				<?php endforeach ?>		

			 				<?php } ?>
			 				
			 			</div>
					</div> 				
	 	</div>	
	 	<!--分页信息-->
				<div class="pageitem">
					<?php if($pageIndex!=0){ ?>
						<a href="hotel.php?index=<?php echo $pageIndex-1; ?>&areaId=<?php echo $areaId ?>">上一页</a>
					<?php } ?>
					<?php if($hotels){ ?>
						<?php for($i=0;$i<$totalpages;$i++){ ?>
						<a id="page" href="hotel.php?index=<?php echo $i; ?>&areaId=<?php echo $areaId ?>" <?php echo $pageIndex==$i?'class=activeda':' '; ?>><?php echo $i+1; ?></a>
					<?php } ?>
					<?php if($pageIndex+1!=$totalpages){ ?>
						<a href="hotel.php?index=<?php echo $pageIndex+1; ?>&areaId=<?php echo $areaId ?>">下一页</a>
					<?php } ?>

					<?php } ?>	
				</div>
	 </div>
	 <!--脚注-->
	<?php 
		include_once("lvyouwebpc/inc/footer.php");
	 ?>

</body>
</html>