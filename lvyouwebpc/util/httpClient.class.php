<?php 


class HttpClient{
	/*
		功能描述：HTTP Get请求
		参数列表：url => 访问的URL
				  parameters => 参数(关联数组)
		返 回 值：请求失败返回false
				  请求成功返回请求内容
	*/
	public static function get($url , $parameters = null ){
		$response = false;

		$params = null;
		if(is_array($parameters)){
			$params = self::buildParameter($parameters);
		}
		if(!is_null($params)){
			$url = $url . "?" . $params;
		}

		$con=curl_init($url);

		if($con){
			curl_setopt($con,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($con,CURLOPT_BINARYTRANSFER,true);
			$response=curl_exec($con);
			curl_close ( $con);
		}
		
		return $response;

		
	}

	/*
		功能描述：HTTP POST请求
		参数列表：url => 访问的URL
				  parameters => 参数(关联数组)
		返 回 值：请求失败返回false
				  请求成功返回请求内容
	*/
	public static function post($url , $parameters = null){

	}

	/*
		构建查询字符串
	*/
	private static function buildParameter($parameters){
		$result = null;
		foreach ($parameters as $key => $value) {
			if(is_null($result)){
				$result = "{$key}={$value}";
			}
			else{
				$result .= "&{$key}={$value}";
			}
		}

		return $result;
	}
}