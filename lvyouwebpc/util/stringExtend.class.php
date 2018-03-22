<?php 

/**
*/
class StringExtend{
	// 手机表达式
	const PATTERN_PHONE = "/^1[34578]\d{9}$/";
	const PATTERN_VERIFY_CODE = "/^\d{4}$/";
	const PATTERN_POSTAL_CODE = "/^\d{6}$/";

	/*
		检查是否为手机号码
	*/
	public static function isPhone($input){
		return preg_match(self::PATTERN_PHONE , $input) > 0;
	}

	/*
		检查是否为短信验证码
	*/
	public static function isVerifyCode($input){
		return preg_match(self::PATTERN_VERIFY_CODE , $input) > 0;
	}

	/*
	
	*/
	public static function isPostalCode($input){
		return preg_match(self::PATTERN_POSTAL_CODE , $input) > 0;
	}
}