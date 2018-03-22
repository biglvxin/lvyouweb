<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/hotelService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/roomsService.php");

$areaId=$_GET["areaId"];
$romeTypeId=$_GET["romeTypeId"];
$price=$_GET["price"];
// echo $areaId;
// echo $romeTypeId;
// echo $price;

$rs=RoomsService::insertRoomPrice($romeTypeId,$price,$areaId);



//$rooms=RoomsService::getAllRooms();
// //给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($rs){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$rs;
}
//print_r($result);
//返回一组json格式的数据
echo json_encode($result);