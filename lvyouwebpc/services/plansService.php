<?php 
require_once("dbHelper.php");
require_once("lvyouwebpc/model/plansInfo.php");
require_once("lvyouwebpc/services/plansService.php");
require_once("lvyouwebpc/model/planSceneryInfo.php");
require_once("lvyouwebpc/services/planSceneryService.php");
class PlansService{
	//得到所有行程.
	public static function getAllPlans(){
		$sql="select id,title,priority,routeId from plans ;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$plans=[];
		foreach ($rs as $row) {
			$plan=new PlansInfo();
			$plan->id=$row[0];
			$plan->title=$row[1];
			$plan->priority=$row[2];
			$plan->routeId=$row[3];
			$plan->sceneryList=PlanSceneryService::getPlanScenerysByPlanId($row[0]);
			$plans[]=$plan;
		}
		//print_r($plans);
		return $plans;
	}
	//根据routeid得到这个地方的所有行程。
	public static function getPlanByRouteId($routeId='7dccca45-227b-11e8-902a-1c872c75b691'){
		$sql="select id,title,priority,routeId from plans where routeId='{$routeId}' order by priority;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$plans=[];
		foreach ($rs as $row) {
			$plan=new PlansInfo();
			$plan->id=$row[0];
			$plan->title=$row[1];
			$plan->priority=$row[2];
			$plan->routeId=$row[3];
			$plan->sceneryList=PlanSceneryService::getPlanScenerysByPlanId($row[0]);
			$plans[]=$plan;
		}
		//print_r($plans);
		return $plans;
	}
	//插入新的行程根据线路routeId
	public static function insertPlan($name,$priority,$routeId){
		$sql="insert into plans(id,title,priority,routeid)values(uuid(),'{$name}',$priority,'{$routeId}');";
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;

	}
	//插入新的行程下的景点
	public static function insertPlanScenery($planId,$sceneryId,$time){
		$sql="insert into planscenerys(id,planid,sceneryId,time)values(uuid(),'{$planId}','{$sceneryId}',$time);";
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;
	}
	//删除行程下的景点
	public static function detelePlanScenery($sceneryId,$planId){
		$sql="delete from planscenerys where sceneryid='{$sceneryId}' and planid='{$planId}';";
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;

	}





}