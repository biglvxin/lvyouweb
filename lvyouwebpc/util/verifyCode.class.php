<?php 

require_once("httpClient.class.php");
require_once("stringExtend.class.php");


class VerifyCodeService{

	const ROOT_URL = "http://101.200.58.3/SMWeb/AliyunSM/";
	const ACCESS_KEY = "25CBF9EC9855B5E6873B45106CA6B299580582FFBF5FB307936EFB50BF1146A3";

	/*
		功能描述：发送短信验证码
		参数列表：phone => 手机号码
		返 回 值: -1 => 手机格式无效
				   0 => 发送失败
				   1 => 发送成功
	*/
	public static function send($phone){		

		if(!StringExtend::isPhone($phone)){
			return -1;
		}

		$parameters = [
			"phone" => $phone,
			"key" => self::ACCESS_KEY
		];

		$response = HttpClient::get(self::ROOT_URL . "send" , $parameters);

		if($response){
			$data = json_decode($response);

			if($data->Code == 100){
				return 1;
			}
		}
		return 0;
	}
	/*
		功能描述：发送短信验证码
		参数列表：phone => 手机号码
				  code  => 验证码

		返 回 值: -1 => 手机或验证码格式无效
				   0 => 发送失败
				   1 => 发送成功
	*/
	public static function validate($phone , $code){
		if(!StringExtend::isPhone($phone) || !StringExtend::isVerifyCode($code)){
			return -1;
		}

		$parameters = [
			"phone" => $phone,
			"code" => $code,
			"key" => self::ACCESS_KEY
		];

		$response = HttpClient::get(self::ROOT_URL . "validate" , $parameters);

		if($response){
			$data = json_decode($response);

			if($data->Code == 100){
				return 1;
			}

		}

		return 0;

	}
}