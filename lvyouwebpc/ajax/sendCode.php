<?php 

require_once("lvyouwebpc/util/verifyCode.class.php");

$phone = $_GET["phone"];

// 检查手机号码是否有效

// $pattern = "/^1[3578]\d{9}$/";

// $flag = preg_match($pattern , $phone);

// if(!flag){
// 	echo "无效";
// 	exit;
// }

// 发送请求

$response = VerifyCodeService::send($phone);

$result = [
	"code" => 101,
	"message" => "发送失败",
	"data" => $response
];

if($response == -1){
	$result = [
		"code" => 102,
		"message" => "手机号码格式无效."
	];
}
else if($response == 1){
	$result = [
		"code" => 100,
		"message" => "短信发送成功"
	];
}

header("content-type:application/json;charset=utf-8");
echo json_encode($result);