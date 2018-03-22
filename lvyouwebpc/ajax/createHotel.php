<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/hotelService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/roomsService.php");
require_once("lvyouwebpc/services/hotelService.php");
require_once("lvyouwebpc/services/mustSceneryService.php");
$name=$_POST["name"];
$address=$_POST["address"];
$areaId=$_POST["areaId"];
$roomTypeId=$_POST["roomTypeId"];
$price=$_POST["price"];



// echo $areaId;
// echo $roomTypeId;
// echo $price;
// echo $name;
// echo $address;


$image1=$_FILES["logo"];
$image2=$_FILES["image2"];
$image3=$_FILES["image3"];
$image4=$_FILES["image4"];


$file1=$image1["name"];
$file2=$image2["name"];
$file3=$image3["name"];
$file4=$image4["name"];

$ext1 = pathinfo($file1 , PATHINFO_EXTENSION);
$fileName1 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext1;
//$sceneryImage[] = $fileName1;
move_uploaded_file($image1["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName1);

$ext2 = pathinfo($file2 , PATHINFO_EXTENSION);
$fileName2 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext2;
$sceneryImage[] = $fileName2;
move_uploaded_file($image2["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName2);

$ext3 = pathinfo($file3 , PATHINFO_EXTENSION);
$fileName3 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext3;
$sceneryImage[] = $fileName3;
move_uploaded_file($image3["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/"  . $fileName3);



$ext4 = pathinfo($file4 , PATHINFO_EXTENSION);
$fileName4 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext4;
$sceneryImage[] = $fileName4;
move_uploaded_file($image4["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/"  . $fileName4);
$im=implode($sceneryImage,",");


// echo $fileName1;
// echo $im;

//根据areaId找到sceneryId
$sceneryId=MustSceneryService::getMustSceneryByAreaId($areaId)[0]->id;

//插入酒店
$rs1=HotelService::insertHotel($name,$areaId,$address,$fileName1,$im,$sceneryId);
if($rs1){
	//根据插入的地址找到hotelid
	$hotelId=HotelService::getHotelByAddress($address)->id;
	//echo $hotelId;
}
//插入价格(必须一下子发布两个)

if($roomTypeId="a7e750bb-20d9-11e8-9bf5-1c872c75b691"){
	$price=$price*2;
	$rs2=RoomsService::insertRoomPrice($hotelId,$roomTypeId,$price,$areaId);
	$rs3=RoomsService::insertRoomPrice($hotelId,'a7eb789d-20d9-11e8-9bf5-1c872c75b691',$price/2,$areaId);
}else{
	$rs2=RoomsService::insertRoomPrice($hotelId,$roomTypeId,$price,$areaId);
	$rs3=RoomsService::insertRoomPrice($hotelId,'a7e750bb-20d9-11e8-9bf5-1c872c75b691',$price*2,$areaId);
}

//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($rs1&&$rs2){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=1;
}
//print_r($result);
//返回一组json格式的数据
echo json_encode($result);