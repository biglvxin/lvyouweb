<!DOCTYPE html>
<html>
<head>
	<title>线路详情页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/scenery.css">
	<link rel="stylesheet" type="text/css" href="css/route.css">
	<link rel="stylesheet" type="text/css" href="css/routedetail.css">	
</head>
<body>
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	 ?>
	 <?php 
	 	require_once("lvyouwebpc/services/plansService.php");
	 	require_once("lvyouwebpc/model/plansInfo.php");
	 	require_once("lvyouwebpc/services/routeService.php");
	 	require_once("lvyouwebpc/services/sceneryDetailService.php");
		
	  ?>
	  <?php 
	  $routeId="";
	  if(array_key_exists("routeId",$_GET)){
	  	$routeId=$_GET["routeId"];
	  }
	  //得到省份的名称
	  $province=RouteService::getProvinceByRouteId($routeId);
	 	//print_r($province);
	  $info="";
	  if(array_key_exists("info",$_GET)){
	  	$info=$_GET["info"];
	  }
	  $plans=[];
	  //得到所有行程
	  $plans=PlansService::getPlanByRouteId($routeId);
	 // print_r($plans);
	   ?>
	 <!--线路详情内容-->
	 <div class="routedetail-page">
	 	<!--二级菜单导航-->
	 	<div class="secenery-twomenu">
	 		<a href="index.php">首页></a>
			<a href="route.php">路线推荐></a>
			<a href="routedetail.php">路线详情></a>
	 	</div>
	 	<!--线路详情-->
	 	<?php if($plans){ ?>
	 		<div class="routedetail-container">
	 			<div class="routedetail-title"><?php echo $province[0]->provinceId[0]->name; ?></div>
	 		</div>
		 	<div class="route-more">
		 		<!--行程安排-->
		 		<div class="route-conscencery">
		 			<!--行程天数-->
		 			<div class="route-secencery-container">
		 				<div><?php echo $info; ?></div>
		 				<!--几日游头部-->
		 				<div class="route-scencery"><span><?php echo count($plans); ?></span>日游</div>
			 			<!--行程下的景点-->
			 			<div class="everyday-scenery">
			 				<div class="days">
			 					<?php foreach ($plans as $key => $item): ?>
			 						<div class="days-item">
				 						<div class="item-secenery"><?php echo "day".($key+1); ?></div>
				 						<div class="font-width"><?php echo $item->title; ?></div>
				 						<div class="scenerysingle-imgs">
				 							<?php if($item->sceneryList){ ?>
				 								<?php foreach ($item->sceneryList as $index => $scenery): ?>
				 									<?php 
				 										$sceneryDetail=SceneryDetailService::getSingleSceneryById($scenery->sceneryId);
				 										//print_r($sceneryDetail);

				 									 ?>
					 								<a href="scenerydetail.php?sceneryId=<?php echo $sceneryDetail[0]->id; ?>">
					 									<?php if($scenery){ ?>
					 										<img src="<?php echo $sceneryDetail[0]->imageList[1]; ?>">
						 									<div class="route-cover"><?php echo $sceneryDetail[0]->name.'('.$scenery->time.'小时)'; ?></div>

					 									<?php }else{ ?>
					 										<div class="route-alert">暂无行程景点！</div>

					 									<?php } ?>
						 								
					 								</a>
				 								<?php endforeach ?>

				 							<?php }else{ ?>
				 								<div class="route-alert">暂无行程安排！</div>

				 							<?php } ?>
				 							
				 						</div>
			 					</div>
			 					<?php endforeach ?>
			 				</div>	
			 			</div>
		 			</div>
		 			
		 			
		 		</div>
		 	</div>

	 	<?php }else{ ?>
	 		<div class="route-alert">暂无路线！</div>

	 	<?php } ?>
	 		
	 </div>

	<!--脚注-->
	<?php 
		include_once("lvyouwebpc/inc/footer.php");
		$msg="成都";
	?>
</body>
</html>