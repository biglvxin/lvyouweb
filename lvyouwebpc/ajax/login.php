<?php 
session_start();
require_once("lvyouwebpc/services/loginService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/dbHelper.php");
require_once("lvyouwebpc/services/registerService.php");
require_once("lvyouwebpc/model/responseResultInfo.php");
$phone=$_POST["phone"];
$password=$_POST["password"];

$user=LoginService::isUser($phone,$password);
// print_r($user);
// $_SESSION["userInfo"]=$user;
// print_r($_SESSION["userInfo"]);
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//不为null值，就返回是有值的。
if($user){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$user;
}
 //print_r($result);
//返回一组json格式的数据
echo json_encode($result);