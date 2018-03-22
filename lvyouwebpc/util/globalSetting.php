<?php 

class GlobalSetting{
	const IMAGE_URL_ROOT="http://127.0.0.1:9090/lvyouwebpc/image/";
	public static function getUUID(){
		return md5(uniqid(microtime(true).mt_rand()));
	}
}