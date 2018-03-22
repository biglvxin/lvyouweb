<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/hotelService.php");
$hotelId="";
if(array_key_exists("$hotelId",$_GET)){
	$hotelId=$_GET["$hotelId"];
}else{
	$hotelId='04424291-2118-11e8-9bf5-1c872c75b691';
}
//获取所有地区
$hotels=HotelService::getSingleHotel($hotelId);
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($hotels){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$hotels;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);