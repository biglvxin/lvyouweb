<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/orderService.php");
$userId="";
if(array_key_exists("userId",$_GET)){
	$userId=$_GET["userId"];
	$orders=OrderService::getAllOrderByUserId($userId);
	//给接口一个初始返回值
	$result=new ResponseResultInfo(101,"请求失败",null);
	//不为null值，就返回是有值的。
	if($orders){
		$result -> code=100;
		$result -> message="请求成功";
		$result -> data=$orders;
	}
}else{
	$orders=OrderService::getAllOrder();
	//给接口一个初始返回值
	$result=new ResponseResultInfo(101,"请求失败",null);
	//不为null值，就返回是有值的。
	if($orders){
		$result -> code=100;
		$result -> message="请求成功";
		$result -> data=$orders;
	}
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);