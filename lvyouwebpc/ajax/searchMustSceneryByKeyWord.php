<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/mustSceneryService.php");

$keyword="";
if(array_key_exists("keyword",$_GET)){
	$keyword=$_GET["keyword"];
}else{
	$keyword='苏州';
}
//获取所有地区
$mustScenerys=MustSceneryService::getMustSceneryByKeyword($keyword);
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($mustScenerys){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$mustScenerys;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);