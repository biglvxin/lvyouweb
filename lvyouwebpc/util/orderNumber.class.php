<?php 

class OrderNumber{
	/*
		功能描述：生成订单号

	*/
	public static function buildOrderNumber(){
		// 第1部分:随机生成6位字符串
		$s1 = substr(md5(uniqid(microtime(true) . mt_rand())) , 0 , 7);

		// 第2部分:当前时间
		$s2 = date("Ymdhis");

		// 第3部分:毫秒数
		$now = microtime();
		$index = strpos($now , " ");
		$s3 = substr($now , 0 , $index);

		$s3 = intval($s3 * 1000000);

		// 第四部分: 6位随机数
		$s4 = mt_rand(100001 , 999999);

		return "{$s1}-{$s2}-{$s3}-{$s4}";
	}
}

