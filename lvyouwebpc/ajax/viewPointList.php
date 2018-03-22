<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");

require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/viewPointService.php");
	
$result=new ResponseResultInfo(101,"请求失败",null);
$rs=ViewPointService::getAllViewPoints();
if($rs){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$rs;

}
echo json_encode($result);
