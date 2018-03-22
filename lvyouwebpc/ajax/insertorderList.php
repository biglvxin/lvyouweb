<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");

require_once("lvyouwebpc/services/roomsService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/orderService.php");
	//获取值
	$orderId=$_POST["orderId"];
	$liveinTime=$_POST["liveinTime"];
	$liveinTime=strtotime($liveinTime);
	$userId=$_POST["userId"];
	$hotelId=$_POST["hotelId"];
	$roomTypeId=$_POST["roomTypeId"];
	$phone=$_POST["phone"];
	$roomTypeName=RoomsService::getRoomNameByRoomPriority($roomTypeId)[0]->id;
	//插入订单
	$result=new ResponseResultInfo(101,"请求失败",null);

	$rs=OrderService::insertOrder($orderId,$liveinTime,$userId,$hotelId,$roomTypeName,$phone);
	if($rs){
		$result -> code=100;
		$result -> message="请求成功";
		$result -> data=$rs;

	}else{
		$result -> code=102;
		$result -> message="请求失败";
		$result -> data=$rs;
	}
	echo json_encode($result);

