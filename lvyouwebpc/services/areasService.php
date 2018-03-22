<?php 
require_once("dbHelper.php");
require_once("lvyouwebpc/model/areasInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");

class AreasService{
	//得到所有区域有分页
	public static function getAllAreas($pageSize=8,$pageIndex=0,$sid=""){
		$count=0;
	 	$startIndex=$pageSize*$pageIndex;
		$sql1="select Id,Name,Introduce,Image,ProvinceId,provinceName from areas where 1=1";
		$sql2="select count(*) from areas where 1=1";
		if($sid!=""){
			$sql1=$sql1." and ProvinceId='{$sid}'";
			$sql2=$sql2." and ProvinceId='{$sid}'";	
		}
		$sql1=$sql1." limit {$startIndex},{$pageSize};";
		$rs1=DBHelper::executeQuery($sql1);
		$rs2=DBHelper::executeQuery($sql2);
		if(is_bool($rs1)||is_bool($rs2)){
			return false;
		}
		// print_r($rs2[0][0]);
		$areas=[];
		foreach ($rs1 as $row) {
			$area=new AreasInfo();
			$area->id=$row[0];
			$area->name=$row[1];
			$area->introduce=$row[2];
			$area->imagename=$row[3];
			$area->image=GlobalSetting::IMAGE_URL_ROOT.$row[3];
			$area->provinceId=$row[4];
			$area->provinceName=$row[5];
			$area->count=$rs2[0][0];
			$areas[]=$area;
		}
		return $areas;
	}
	//得到所有的的区域
	public static function getAllAreasCatagroy(){
		$sql="select Id,Name,Introduce,Image,ProvinceId,provinceName from areas";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$areas=[];
		foreach ($rs as $row) {
			$area=new AreasInfo();
			$area->id=$row[0];
			$area->name=$row[1];
			$area->introduce=$row[2];
			$area->imagename=$row[3];
			$area->image=GlobalSetting::IMAGE_URL_ROOT.$row[3];
			$area->provinceId=$row[4];
			$area->provinceName=$row[5];
			$areas[]=$area;
		}
		return $areas;
	}
	//得到热门目的地
	public static function getHotArea(){
		$sql="select id,name,introduce,image,provinceid,provincename,praisecount,Score from areas order by praisecount desc limit 0,8;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$areas=[];
		foreach ($rs as $row) {
			$area=new AreasInfo();
			$area->id=$row[0];
			$area->name=$row[1];
			$area->introduce=$row[2];
			$area->imagename=$row[3];
			$area->image=GlobalSetting::IMAGE_URL_ROOT.$row[3];
			$area->provinceId=$row[4];
			$area->provinceName=$row[5];
			$area->count=$row[6];
			$area->score=$row[7];
			$areas[]=$area;
		}
		return $areas;

	}
	//通过区号得到省
	public static function getProvinceByAreaId($areaId){
		$sql="select provinceid,provincename from areas where id='{$areaId}' ;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$province=[];
		foreach ($rs as $row) {
			$area=new AreasInfo();
			$area->provinceId=$row[0];
			$area->provinceName=$row[1];
			$province[]=$area;
		}
		return $province;
	}
		//通过区域名得到areaId,proviceId
	public static function getProvinceByAreaName($areaName){
		$sql="select id,name,Introduce,provinceid,provinceName from areas where name='{$areaName}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$province=[];
		foreach ($rs as $row) {
			$area=new AreasInfo();
			$area->id=$row[0];
			$area->name=$row[1];
			$area->introduce=$row[2];
			$area->provinceId=$row[3];
			$area->provinceName=$row[4];
			$province[]=$area;
		}
		return $province;
	}
}