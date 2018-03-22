<?php 
require_once("lvyouwebpc/services/dbHelper.php");
require_once("lvyouwebpc/model/routesInfo.php");
require_once("lvyouwebpc/services/routeService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/model/plansInfo.php");
require_once("lvyouwebpc/services/plansService.php");
require_once("lvyouwebpc/services/provincesService.php");
class RouteService{
	public static function getAllRoute($pageSize=4,$pageIndex=0,$rid=""){
		$startIndex=$pageSize*$pageIndex;
		$sql1="select id,name,image,provinceId,info from routes where 1=1";
		$sql2="select count(*) from routes where 1=1";
		if($rid!=""){
			$sql1=$sql1." and provinceId='{$rid}'";
			$sql2=$sql2." and provinceId='{$rid}'";	
		}
		$sql1=$sql1." limit {$startIndex},{$pageSize};";
		$rs1=DBHelper::executeQuery($sql1);
		$rs2=DBHelper::executeQuery($sql2);
		if(is_bool($rs1)||is_bool($rs2)){
			return false;
		}
		$routes=[];
		foreach ($rs1 as $row) {
			$route=new RoutesInfo();
			$route->id=$row[0];
			$route->name=$row[1];
			$route->image=GlobalSetting::IMAGE_URL_ROOT.$row[2];
			$route->provinceId=$row[3];
			$route->info=$row[4];
			$route->count=$rs2[0][0];
			//$route->planList=PlansService::getAllPlans($row[0]);
			$routes[]=$route;
		}
		return $routes;
	}
	//得到所有路线
	public static function getAllRouteNoPage(){
		$sql="select id,name,image,provinceId,info from routes";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$routes=[];
		foreach ($rs as $row) {
			$route=new RoutesInfo();
			$route->id=$row[0];
			$route->name=$row[1];
			$route->image=GlobalSetting::IMAGE_URL_ROOT.$row[2];
			$route->provinceId=$row[3];
			$route->info=$row[4];
			$routes[]=$route;
		}
		return $routes;

	}
	//根据routeid得到省份名称
	public static function getProvinceByRouteId($routeId='7dccca45-227b-11e8-902a-1c872c75b691'){
		$sql="select provinceId from routes where id='{$routeId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$provinceName=[];
		foreach ($rs as $row) {
			$route=new RoutesInfo();
			
			$route->provinceId=$row[0];
			$route->provinceId=ProvincesService::getProvinceById($row[0]);
			$provinceName[]=$route;
		}
		return $provinceName;
	}
	//添加路线
	public static function insertRoute($name,$provinceId,$image){
		$sql="insert into routes(id,name,provinceId,image) values(uuid(),'{$name}','{$provinceId}','{$image}');";
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;

	}
}