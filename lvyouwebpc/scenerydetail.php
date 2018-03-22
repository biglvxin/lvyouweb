<!DOCTYPE html>
<html>
<head>
	<title>景点详情页</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/scenerydetail.css">
	<link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.4&key=7375cc1ec91d3384eceae3f27387da27&plugin=AMap.Geocoder"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
</head>
<body onload="regeocoder();">
	<!--头部-->
	<?php 
		include_once("lvyouwebpc/inc/header.php");
	 ?>
	 <?php 
	 require_once("lvyouwebpc/services/sceneryDetailService.php");
	 require_once("lvyouwebpc/services/hotelService.php");
	 require_once("lvyouwebpc/services/viewPointService.php");
	 ?>
	 <?php 
	 	$backURL = $_SERVER["HTTP_REFERER"];
	  ?>
	  <?php 
	  $id=$_GET["sceneryId"];
	  //得到单个景点信息
	  $singleScenery=[];
	  $singleScenery=SceneryDetailService::getSingleSceneryById($id);
	  //print_r($singleScenery);
	  $localHotels=HotelService::getHotelBySceneryId($id);
		//print_r($localHotels);

	  //景点的所有评论
	  $views=ViewPointService::getAllSceneryViewPoints($id);
	  print_r($views);
	  $user=(Array)$_SESSION["userInfo"][0];
	  //var_dump($user);
	 ?>
	 <!--景点详情页内容-->
	 <div class="scenerydetail-page">
	 	<!--二级菜单导航-->
	 	<div>
	 		<?php if(strpos($backURL,"gonglvdetail.php")|| strpos($backURL,"scenerydetail.php")|| strpos($backURL,"routedetail.php")){ ?>
					<a href="index.php">首页></a>
					<a href="scenery.php">景点攻略></a>
					<!-- <a href="gonglvdetail.php">攻略详情></a> -->
					<a href="scenerydetail.php?sceneryId=<?php echo $id; ?>">景点详情></a>	
			<?php }?>
	 	</div>
	 	<!--景点详情介绍容器-->
	 	<div class="scenerydetail-content">
	 		<div class="sdetailcontent-title"><?php echo $singleScenery[0]->name; ?></div>
	 		<div class="sdetail-imgtitle">
	 			<div class="imgtitle-left">
	 				<img src="<?php echo $singleScenery[0]->imageList[0]; ?>">
	 			</div>
	 			<div class="imgtitle-right">
	 				<div class="title-rtop">
	 					<img src="<?php echo $singleScenery[0]->imageList[1]; ?>">
	 				</div>
	 				<div class="title-rbottom">
	 					<img src="<?php echo $singleScenery[0]->imageList[2]; ?>">
	 				</div>

	 			</div>
	 		</div>
	 		<!--景点详情介绍细节-->
	 		<div class="sdetail-introude">
	 			<div class="sdetail-titletext">景点简介</div>
	 			<div class="textintround-container">
	 				<?php echo $singleScenery[0]->introduceDetail; ?>
	 			</div>
	 			<div class="text-list">
	 				<div class="text-sdlist-item">
	 					<div class="sdetail-titletext">电话</div>
	 					<div class="textintround-container sizechange"><?php echo $singleScenery[0]->phone; ?></div>
	 				</div>
	 				<div class="text-sdlist-item">
	 					<div class="sdetail-titletext">网址</div>
	 					<div class="textintround-container sizechange"><?php echo $singleScenery[0]->httpAddress; ?></div>
	 				</div>
	 				<div class="text-sdlist-item">
	 					<div class="sdetail-titletext">用时参考</div>
	 					<div class="textintround-container sizechange">1-2个小时</div>
	 				</div>
	 			</div>
	 			<div class="text-listtitle">
	 					<div class="sdetail-titletext">交通</div>
	 					<div class="textintround-container noborder2"><?php echo $singleScenery[0]->transfer; ?></div>
	 				
	 			</div>
	 			<div class="text-listtitle">
	 					<div class="sdetail-titletext">门票</div>
	 					<div class="textintround-container noborder2"><?php echo $singleScenery[0]->price; ?></div>
	 			</div>
	 			<div class="text-listtitle">
	 					<div class="sdetail-titletext">开放时间</div>
	 					<div class="textintround-container noborder2"><?php echo $singleScenery[0]->open; ?></div>
	 				
	 			</div>
	 			<div class="text-listtitle">
	 					<div class="sdetail-titletext">景点位置</div>
	 					<div class="textintround-container noborder2"><?php echo $singleScenery[0]->address; ?></div>
	 			</div>
	 			<!--用户评论-->
	 			<div class="sdetailcontent-title">用户评论
	 				<div class="btn btn-success notes-pos" id="iviewpoint" data-viewpoint-count="0">我要评论</div>
	 			</div>
	 			<div class="pinglun-border">
	 				<?php if($user){  ?>
	 					<textarea  id="area-content" class="pinglun-content"></textarea>
		 					<button user-id="<?php echo $user['id'];  ?>" scenery-id="<?php echo $id; ?>" user-header="<?php echo $user['headerPath']; ?>"   user-infoName="<?php echo $user['nickName'];?>" id="btn-sendView" class="btn btn-success btnhuifupos">发表评论</button>

	 				<?php }else{ ?>
	 					<textarea  id="area-content" class="pinglun-content"></textarea>
		 					<button user-id="<?php echo ' ';  ?>" scenery-id="<?php echo $id; ?>" user-header="<?php echo ' '; ?>"   user-infoName="<?php echo ' '?>" id="btn-sendView" class="btn btn-success btnhuifupos">发表评论</button>

	 				<?php } ?>
		 					
		 		</div>
		 		<div class="discuss-container" id="discuss-container">
		 			<?php if($views){ ?>
		 			<?php foreach ($views as $item) { ?>
		 				<div class="discuss">
			 				<div class="use-discuss-info">
			 					<div class="touxiang">
			 						<img src="<?php echo $item->userList[0]->headerPath; ?>" class="img-urse"></div>
			 						<span class="green"><?php echo $item->userList[0]->nickName; ?></span>
			 						<?php if($item->state==1){ ?>
			 							<img src="images/zang.png" class="zangimg" id="zang" praiseCount="<?php echo $item->praiseCount ?>">
			 							<span  class="praise-count" userid="<?php echo $item->userId; ?>" count-data="0"><?php echo $item->praiseCount ?></span>
			 						<?php }else{ ?>
			 							 <span class="checkState">待审核</span>

			 						<?php  } ?>
			 						
			 						
			 				</div>
			 				<div class="use-discuss-text">
			 					<?php echo $item->content; ?>
			 				</div>
			 				<div class="bandang-opeater">
			 					<span >发布时间：</span>
			 					<span  id="send-fasongtime" class="banggrey" send-time="<?php echo date('Y-m-d H:i:s',time()); ?>" send-stringtime="<?php echo time(); ?>"><?php echo $item->time; ?></span>	
				 			</div>	
	 					</div>
		 			<?php } ?>

		 		<?php }else{ ?>
		 			<span  id="send-fasongtime" class="banggrey" send-time="<?php echo date('Y-m-d H:i:s',time()); ?>" send-stringtime="<?php echo time(); ?>">

		 		<?php } ?>
		 		</div>	
		 		
	 			<!--周边酒店-->
	 			<?php if($localHotels){ ?>
	 				<div class="sdetailcontent-title">周边酒店</div>
	 			<div class="place-hotel-container">
	 				<div class="sdhotel-left">
	 					<a href="hoteldetail.php?hotelId=<?php echo  $localHotels[0]->id;  ?>">
	 						<img src="<?php echo $localHotels[0]->logo; ?>">
	 						<div class="near-hotel-title"><?php echo $localHotels[0]->name; ?>
	 							<span class="sdpricepos"><?php echo $localHotels[0]->priceList[0]->price.'元'; ?></span>
	 						</div>
	 					</a>	
	 				</div>
	 				<div class="sdhotel-right">
	 					<div class="sdright-top">
	 						<a href="hoteldetail.php?hotelId=<?php echo  $localHotels[1]->id;  ?>">
	 							<img src="<?php echo $localHotels[1]->logo; ?>">
	 							<div class="near-hotel-title near-small"><?php echo $localHotels[1]->name; ?>
	 							<span class="sdpricepos-small"><?php echo $localHotels[1]->priceList[0]->price.'元'; ?></span>
	 						</div>
	 						</a>
	 						
	 					</div>
	 					<div class="sdright-bottom">
	 						<a href="hoteldetail.php?hotelId=<?php echo  $localHotels[2]->id;  ?>">
	 							<img src="<?php echo $localHotels[2]->logo; ?>">
	 							<div class="near-hotel-title near-small"><?php echo $localHotels[2]->name; ?>
	 							<span class="sdpricepos-small"><?php echo $localHotels[2]->priceList[0]->price.'元'; ?></span>
	 						</div>
	 						</a>					
	 					</div>
	 				</div>	
	 			</div>
	 			<!--地图-->
				<div id="container"></div>
				<div id="tip">
					<b>地理编码结果:</b>
					<span id="result"></span>
				</div>
				<div id="tip">
					<b>地理编码结果:</b>
					<span id="result1"></span>
				</div>
				<div id="tip">
					<b>地理编码结果:</b>
					<span id="result2"></span>
				</div>

	 			<?php } ?>
	 		</div>
	 	</div>	
		<!--评论成功的提示框-->
		<div class="dialog" id="dialog">
			<div class="dialog-info">评论成功</div>
		</div>



	</div>

	<!--脚注-->
	<?php 
		include_once("lvyouwebpc/inc/footer.php");
	 ?>
	 <script type="text/javascript">
	 var map = new AMap.Map("container", {
        resizeEnable: true,
		zoom: 18
    }),    
    lnglatXY = ['<?php echo $localHotels[0]->positionx ?>','<?php echo $localHotels[0]->positiony; ?>'];
     //已知点坐标]; //已知点坐标
     lnglatXY1 = ['<?php echo $localHotels[1]->positionx ?>','<?php echo $localHotels[1]->positiony; ?>'];
     lnglatXY2 = ['<?php echo $localHotels[2]->positionx ?>','<?php echo $localHotels[2]->positiony; ?>'];
    function regeocoder() {  //逆地理编码
        var geocoder = new AMap.Geocoder({
            radius: 1000,
            extensions: "all"
        });  

        geocoder.getAddress(lnglatXY, function(status, result) {
            if (status === 'complete' && result.info === 'OK') {
                geocoder_CallBack(result);
            }
        });  
        geocoder.getAddress(lnglatXY1, function(status, result1) {
            if (status === 'complete' && result1.info === 'OK') {
                geocoder_CallBack1(result1);
            }
        });  
        geocoder.getAddress(lnglatXY2, function(status, result2) {
            if (status === 'complete' && result2.info === 'OK') {
                geocoder_CallBack2(result2);
            }
        });        
        var marker = new AMap.Marker({  //加点
            map: map,
            position: lnglatXY,
            center: lnglatXY//地图中心点
        });
         var marker = new AMap.Marker({  //加点
            map: map,
            position: lnglatXY1,
            center: lnglatXY1//地图中心点
        });
          var marker = new AMap.Marker({  //加点
            map: map,
            position: lnglatXY2,
            center: lnglatXY2//地图中心点
        });

        map.setFitView();
    }
    function geocoder_CallBack(data) {
         var address= data.regeocode.formattedAddress; //返回地址描述
        document.getElementById("result").innerHTML = address;
    }
    function geocoder_CallBack1(data) {
         var address = data.regeocode.formattedAddress; //返回地址描述
        document.getElementById("result1").innerHTML = address;
    }
    function geocoder_CallBack2(data) {
         var address = data.regeocode.formattedAddress; //返回地址描述
        document.getElementById("result2").innerHTML = address;
    } 

	 </script>
	 <script src="js/sceneryDetail.js"></script>

</body>
</html>