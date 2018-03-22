<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/viewPointService.php");

$nickName=$_POST["nickName"];
$header=$_POST["header"];
$content=$_POST["content"];
$time=$_POST["time"];
$userId=$_POST["userId"];
$sceneryId=$_POST["sceneryId"];
$praiseCount=$_POST["praiseCount"];
// //给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
$flag=ViewPointService::submitViewPoint($userId,$sceneryId,$content,$time,$praiseCount);
// //不为null值，就返回是有值的。
if($flag){
	$result -> code=100;
	$result -> message="评论成功";
	$result -> data=$content;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);