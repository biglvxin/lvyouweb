<!DOCTYPE html>
<html>
<head>
	<title>攻略详情页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/gonglvdetail.css">
</head>
<body>
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	 ?>
	 <?php 
	 require_once("lvyouwebpc/services/mustSceneryService.php");
	 require_once("lvyouwebpc/model/mustSceneryInfo.php");


	  ?>
	 <?php 
	 	$backURL = $_SERVER["HTTP_REFERER"];
	  ?>
	  <?php 
	  $areaIntroduce="";
	  if(array_key_exists("introduce", $_GET)){
	  	$areaIntroduce=$_GET["introduce"];
	  }
	  $areaId="";
	   if(array_key_exists("areaId", $_GET)){
	 		$areaId=$_GET["areaId"];
	  }
	  $keyword="";
	  if(array_key_exists("keyword", $_GET)){
	 		$keyword=$_GET["keyword"];
	  }
	  //echo $keyword;
	  
	  //一个地方的所有景点
	  	$mustScenerys="";
	  	$mustScenerys=MustSceneryService::getMustSceneryByAreaId($areaId);
	  	if($keyword) {
	  	$mustScenerys=MustSceneryService::getMustSceneryByKeyword($keyword);
	  	}
	
	  //print_r($mustScenerys);



	   ?>
	 <!--攻略详情页内容-->
	 <div class="gonglvdetail-page">
	 	<!--二级菜单导航-->
	 	<div>
	 		<?php if(strpos($backURL,"index.php")||strpos($backURL,"gonglvdetail.php")){ ?>
					<a href="index.php">首页></a>
					<a href="gonglvdetail.php?areaId=<?php echo $areaId; ?>&introduce=<?php echo $areaIntroduce; ?>">攻略详情></a>	
			<?php }else if(strpos($backURL,"scenery.php")||strpos($backURL,"gonglvdetail.php") || strpos($backURL,"scenerydetail.php")){ ?>
					<a href="index.php">首页></a>
					<a href="scenery.php">景点攻略></a>
					<a href="gonglvdetail.php?areaId=<?php echo $areaId; ?>&introduce=<?php echo $areaIntroduce; ?>">攻略详情></a>
			<?php }?>
	 	</div>
	 	<!--攻略内容-->
	 	<div class="gonglvdetail-content">
	 		<div class="gonglv-place"><?php echo $mustScenerys[0]->area; ?>简介：</div>
 			<div class="gonglv-place-content">
		 	<?php echo $areaIntroduce; ?>
 			</div>
	 		<!-- 必去景点-->
	 		<div class="mustto-scenery">
	 			<div class="recommend-title">
					<div class="title-left">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-right">
						<img src="images/titletiao.jpg">
					</div>
					<div class="title-midden">必去景点</div>
				</div>
				<!--必去景点内容-->	
				<div class="mustto-context">
					<?php foreach ($mustScenerys as $key => $item): ?>
						<div class="mustto-item">
						<div class="itemg-left">
							<div class="leftg-title">
								<div><?php echo $key+1; ?></div>
								<a href="scenerydetail.php?sceneryId=<?php echo $item->id; ?>"><?php echo $item->name; ?></a>
							</div>
							<div class="leftg-text"><?php echo $item->introducetitle; ?></div>
						</div>
						<div class="itemg-right">
							<div class="img-left">
								<a href="scenerydetail.php?sceneryId=<?php echo $item->id; ?>"><img src="<?php echo $item->imageList[0]; ?>"></a>
							</div>
							<div class="img-right">
								<div class="rigth-top">
									<a href="scenerydetail.php?sceneryId=<?php echo $item->id; ?>"><img src="<?php echo $item->imageList[1]; ?>"></a>
								</div>
								<div class="right-bottom">
									<a href="scenerydetail.php?sceneryId=<?php echo $item->id; ?>"><img src="<?php echo $item->imageList[2]; ?>"></a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach ?>
					
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