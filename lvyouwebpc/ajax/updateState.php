<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/viewPointService.php");
$id=$_GET["id"];
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
$flag=ViewPointService::updateViewState($id);
// //不为null值，就返回是有值的。
if($flag){
	$result -> code=100;
	$result -> message="点赞成功";
	$result -> data=$flag;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);