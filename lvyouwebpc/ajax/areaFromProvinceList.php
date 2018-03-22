<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/areasService.php");
$areaId="";
if(array_key_exists("areaId",$_GET)){
	$areaId=$_GET["areaId"];
}else{
	$areaId='1c261708-1f75-11e8-920c-1c872c75b691';
}
//获取所有地区
$provinceName=AreasService::getProvinceByAreaId($areaId);
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($provinceName){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$provinceName;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);