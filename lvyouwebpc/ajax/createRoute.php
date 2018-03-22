<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/routeService.php");

$name=$_POST["name"];
$provinceId=$_POST["provinceId"];
// echo $name;
// echo $provinceId;
// print_r($_FILES);

$image1=$_FILES["image1"];
$file1=$_FILES["image1"]["name"];
$ext1 = pathinfo($file1 , PATHINFO_EXTENSION);
$fileName1 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext1;
// $sceneryImage[0] = $fileName1;
move_uploaded_file($image1["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName1);
//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//添加新的线路
$route=RouteService::insertRoute($name,$provinceId,$fileName1);
//不为null值，就返回是有值的。

if($route){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$route;
}

//返回一组json格式的数据
echo json_encode($result);