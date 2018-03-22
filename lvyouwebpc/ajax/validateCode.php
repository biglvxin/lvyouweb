<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");

require_once("lvyouwebpc/util/verifyCode.class.php");
require_once("lvyouwebpc/services/registerService.php");
require_once("lvyouwebpc/util/globalSetting.php");

$phone = $_POST["username"];
$code=$_POST["code"];
$nickName=$_POST["nickname"];
$password=$_POST["password"];
$cover = $_FILES["image"];
//print_r($cover);
$ext = pathinfo($cover["name"] , PATHINFO_EXTENSION);
$fileName = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext;

$flag = move_uploaded_file($cover["tmp_name"] , '../image/'.$fileName);

// 发送请求

$response = VerifyCodeService::validate($phone,$code);
//初始值

$result = [
	"code" => 101,
	"message" => "手机或验证码格式无效",
	"data" => $response
];

if($response == -1){
	$result = [
		"code" => 102,
		"message" => "注册失败."
	];
}
else if($response == 1){
	$result = [
		"code" => 100,
		"message" => "注册成功."
	];
}
//插入数据库
$result ="";
$flag=RegisterService::insertUser($phone,$password,$nickName,$fileName);
if($flag){
	$result = [
		"code" => 100,
		"message" => "注册成功."
	];
}
//判断插入的数据库
// if(!$flag){
// 	exit;
// }
header("content-type:application/json;charset=utf-8");
echo json_encode($result);