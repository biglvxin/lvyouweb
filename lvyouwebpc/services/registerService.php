<?php
require_once("lvyouwebpc/model/registerInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/dbHelper.php");
class RegisterService{
	public static function insertUser($phone,$password,$nickName,$fileName){
		$sql="insert into users(id,phone,password,nickname,header)values(UUID(),'{$phone}',md5('{$password}'),'{$nickName}','{$fileName}');";
		$rs=DBHelper::executeNonQuery($sql);
		//var_dump($rs);
		return $rs;	

	}
}