<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/plansService.php");

$name=$_POST["name"];
$priority=$_POST["priority"];
$routeId=$_POST["routeId"];




//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//添加新的线路
$plan=PlansService::insertPlan($name,$priority,$routeId);
//不为null值，就返回是有值的。

if($plan){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$plan;
}

//返回一组json格式的数据
echo json_encode($result);