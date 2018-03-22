<?php 
require_once("dbHelper.php");
require_once("lvyouwebpc/model/plansInfo.php");
require_once("lvyouwebpc/services/planSceneryService.php");
require_once("lvyouwebpc/services/sceneryDetailService.php");
class PlanSceneryService{
	//得到行程下的景点
	public static function getPlanScenerysByPlanId($planId='2fdad520-2289-11e8-902a-1c872c75b691'){
		$sql="select id,planid,sceneryid,time from planscenerys where planid='{$planId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$scenerys=[];
		foreach ($rs as $row) {
			$scenery=new PlansInfo();
			$scenery->id=$row[0];
			$scenery->planId=$row[1];
			$scenery->sceneryId=$row[2];
			$scenery->time=$row[3];
			$scenery->sceneryDetail=SceneryDetailService::getSingleSceneryById($row[2]);
			$scenerys[]=$scenery;
		}
		return $scenerys;

	}
}