<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/planSceneryService.php");
require_once("lvyouwebpc/model/planSceneryInfo.php");
$planId="";
if(array_key_exists("planId",$_GET)){
	$planId=$_GET["planId"];
}else{
	$planId='2fdad520-2289-11e8-902a-1c872c75b691';
}

//获取所有地区
$planScenerys=PlanSceneryService::getPlanScenerysByPlanId($planId);
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($planScenerys){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$planScenerys;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);