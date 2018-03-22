<!DOCTYPE html>
<html>
<head>
	<title>路线推荐</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/scenery.css">
	<link rel="stylesheet" type="text/css" href="css/route.css">
</head>
<body>
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	?>
	<?php 
	require_once("lvyouwebpc/services/provincesService.php");
	require_once("lvyouwebpc/model/provincesInfo.php");
	require_once("lvyouwebpc/services/routeService.php");
	require_once("lvyouwebpc/model/routesInfo.php");
	require_once("lvyouwebpc/model/plansInfo.php");
	require_once("lvyouwebpc/services/plansService.php");
	 ?>
	 <?php 
	 //得到所有省份
		$provinces=ProvincesService::getAllProvince();
		$pageSize=4;
		$pageIndex=0;
		$rid="";
		if(array_key_exists("rid",$_GET)){
			$rid=$_GET["rid"];
		}
		$index="";
		if(array_key_exists("index",$_GET)){
			$pageIndex=$_GET["index"];
		}
		$routes=[];
		//得到所有的线路
		$routes =RouteService::getAllRoute($pageSize,$pageIndex,$rid);
		//print_r($routes);
		if($routes){
			$totalpages=ceil($routes[0]->count/$pageSize);
		}
		
	 ?>
	<!--线路内容页-->
	<div class="route-page">
		<!--二级菜单导航-->
	 	<div class="secenery-twomenu">
	 		<a href="index.php">首页></a>
			<a href="route.php">路线推荐></a>
	 	</div>
	 	<!--地区具体分类-->
	 	<div class="place-category">
	 		<div class="all-category">地区</div>
	 		<div class="all-area">
	 			<ul class="place-pageul">
	 				<?php 
	 					$all=new ProvincesInfo();
	 					$all->id="";
	 					$all->name="全部";
	 					array_unshift($provinces,$all);
	 				?>
	 				<?php foreach ($provinces as $province): ?>
	 					<li><a href="route.php?rid=<?php echo $province->id; ?>" <?php echo $rid==$province->id ?'class=activeds':''; ?>><?php echo $province->name; ?></a></li>
	 				<?php endforeach ?>
	 			</ul>
	 		</div>
	 	</div>
	 	<!--本月热推头-->
	 	<div class="recommend-title">
					<div class="title-left">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-right">
						<img src="images/titletiao.jpg">
					</div>
					<!--分页显示所有攻略-->
					<div class="title-midden">城市线路</div>	
		</div>
		<!--城市线路-->
		<div class="route-recommend">
			<div class="route-recommend-pos">
				<?php if($routes==null){ ?>
					<div>暂无线路!敬请期待发布新的线路！</div>

				<?php } else{ ?>
					<?php foreach ($routes as $key => $item): ?>
					<div class="area-route-item">
						<a href="routedetail.php?routeId=<?php echo $item->id; ?>&info=<?php echo $item->info; ?>">
							<div calss="route-item-top">
								<div class="route-title"><?php echo $item->name; ?></div>
							</div>
							<div class="route-item-midden">
								 <img src="<?php echo $item->image;?>"> 
							</div>
							<div class="route-item-button">
								<div class="route-plan">行程安排</div>
								<div class="route-plan">小时</div>
								<div class="route-day-more">
									<a href="#">更多...</a>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach ?>

				<?php } ?>
				
			</div>
		</div>
		<!--分页信息-->
				<div class="pageitem" style="margin-top:20px;">
					<?php if($pageIndex!=0){ ?>
						<a href="route.php?index=<?php echo $pageIndex-1; ?>&rid=<?php echo $rid ?>">上一页</a>
					<?php } ?>
					<?php if($routes){ ?>
						<?php for($i=0;$i<$totalpages;$i++){ ?>
						<a id="page" href="route.php?index=<?php echo $i; ?>&rid=<?php echo $rid ?>" <?php echo $pageIndex==$i?'class=activeda':' '; ?>><?php echo $i+1; ?></a>
						<?php } ?>
						<?php if($pageIndex+1!=$totalpages){ ?>
							<a href="route.php?index=<?php echo $pageIndex+1; ?>&rid=<?php echo $rid ?>">下一页</a>
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