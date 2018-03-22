<?php 
require_once("lvyouwebpc/services/dbHelper.php");
require_once("lvyouwebpc/model/provincesInfo.php");

class ProvincesService{
	//得到所有的省份
	public static function getAllProvince(){
		$sql="select id,name from provinces;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$provinces=[];
		foreach ($rs as $row) {

			$province=new ProvincesInfo();
			$province->id=$row[0];
			$province->name=$row[1];	
			$provinces[]=$province;
		}
		return $provinces;
	}
	//通过provinceid得到省份
	public static function getProvinceById($provinceId){
		$sql="select id,name from provinces where id='{$provinceId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$provinces=[];
		foreach ($rs as $row) {

			$province=new ProvincesInfo();
			$province->id=$row[0];
			$province->name=$row[1];	
			$provinces[]=$province;
		}
		return $provinces;
	}
}