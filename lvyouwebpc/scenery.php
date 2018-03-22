<!DOCTYPE html>
<html>
<head>
	<title>景点攻略</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/scenery.css">
</head>
<body>
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	?>
	<?php 
		require_once("lvyouwebpc/services/areasService.php");
		require_once("lvyouwebpc/services/provincesService.php");
	 ?>
	<?php 
		$pageSize=16;
		$pageIndex=0;
		
		$sid="";
		if(array_key_exists("sid",$_GET)){
			$sid=$_GET["sid"];
		}
		$index="";
		if(array_key_exists("index",$_GET)){
			$pageIndex=$_GET["index"];
		}
		//得到所有城市
		$areas=[];
		$areas=AreasService::getAllAreas($pageSize,$pageIndex,$sid);
		$totalpages=ceil($areas[0]->count/$pageSize);
		//得到所有省份
		$provinces=ProvincesService::getAllProvince();

	?>
	 <!--景点攻略内容部分-->
	 <div class="scenery-page">
	 	<!--二级菜单导航-->
	 	<div class="secenery-twomenu">
	 		<a href="index.php">首页></a>
			<a href="scenery.php">景点攻略></a>
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
	 					<li><a href="scenery.php?sid=<?php echo $province->id; ?>" <?php echo $sid==$province->id ?'class=activeds':''; ?>><?php echo $province->name; ?></a></li>
	 				<?php endforeach ?>
	 			</ul>
	 		</div>
	 	</div>
	 	<!--显示所有中的部分景点--> 
	 	<div class="all-scenery">
	 		<div class="recommend-title">
					<div class="title-left">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-right">
						<img src="images/titletiao.jpg">
					</div>
					<!--分页显示所有攻略-->
					<div class="title-midden">景点城市</div>	
			</div>
			<!--分页显示所有景并且可以查看具的景攻略-->
			<div class="scenery-show">
				<ul class="scenery-list">
					<?php foreach ($areas as $area): ?>
						<li>
						<a href="gonglvdetail.php?areaId=<?php echo $area->id; ?>&introduce=<?php echo $area->introduce; ?>">
							<div class="slist-top">
								<img src=<?php echo $area->image;?>>
								<div class="slist-cover">
									<div class="title-slist"><?php echo $area->name; ?></div>
									<div class="introduce-small"><?php echo $area->introduce; ?></div>
									<div class="secenery-more">更多</div>
								</div>	
							</div>
							<div class="slist-bottom">
								<div class="sbottom-left">
									<a href="fooddetail.php" class="meisia">美食</a>
									<a href="fooddetail.php" class="gowua">购物</a>
								</div>
								<div class="sbottom-right">
									<a href="#"><img src="images/brower.png"></a>	
									<a href="#"><img src="images/notes.png"></a>
								</div>
							</div>
						</a>
					</li>
					<?php endforeach ?>	
				</ul>
				<!--分页信息-->
				<div class="pageitem">
					<?php if($pageIndex!=0){ ?>
						<a href="scenery.php?index=<?php echo $pageIndex-1; ?>&sid=<?php echo $sid ?>">上一页</a>
					<?php } ?>

					<?php for($i=0;$i<$totalpages;$i++){ ?>
						<a id="page" href="scenery.php?index=<?php echo $i; ?>&sid=<?php echo $sid ?>" <?php echo $pageIndex==$i?'class=activeda':' '; ?>><?php echo $i+1; ?></a>
					<?php } ?>
		
					<?php if($pageIndex+1!=$totalpages){ ?>
						<a href="scenery.php?index=<?php echo $pageIndex+1; ?>&sid=<?php echo $sid ?>">下一页</a>
					<?php } ?>
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