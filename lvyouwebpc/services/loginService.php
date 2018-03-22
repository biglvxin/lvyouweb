<?php 
require_once("lvyouwebpc/model/loginInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/dbHelper.php");

class LoginService{
	//登录判断并且当前用户的信息
	public static function isUser($phone,$password){
		//echo $password;
		$sql="select id, phone,password,nickName,header from users where phone='{$phone}' and password=md5('{$password}')";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$users=[];
		foreach ($rs as $row) {
			$user=new LoginInfo();
			$user->id=$row[0];
			$user->phone=$row[1];
			$user->password=$row[2];
			$user->nickName=$row[3];
			$user->header=$row[4];
			$user->headerPath=GlobalSetting::IMAGE_URL_ROOT.$row[4];
			$users[]=$user;	
		}
		return $users;
	}
	//通过userid得到用户信息
	public static function getUserInfoByUserId($userId='2587b15c-1f61-11e8-920c-1c872c75b691'){
		$sql="select id, phone,password,nickName,header from users where id='{$userId}'";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$users=[];
		foreach ($rs as $row) {
			$user=new LoginInfo();
			$user->id=$row[0];
			$user->phone=$row[1];
			$user->password=$row[2];
			$user->nickName=$row[3];
			$user->header=$row[4];
			$user->headerPath=GlobalSetting::IMAGE_URL_ROOT.$row[4];
			$users[]=$user;	
		}
		return $users;

	}
	//得到所有的用户列表
	public static function getAllUser(){
		$sql="select id, phone,password,nickName,header from users;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$users=[];
		foreach ($rs as $row) {
			$user=new LoginInfo();
			$user->id=$row[0];
			$user->phone=$row[1];
			$user->password=$row[2];
			$user->nickName=$row[3];
			$user->header=$row[4];
			$user->headerPath=GlobalSetting::IMAGE_URL_ROOT.$row[4];
			$users[]=$user;	
		}
		return $users;
	}
}