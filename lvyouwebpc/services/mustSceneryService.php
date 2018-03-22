<?php 
require_once("dbHelper.php");
require_once("lvyouwebpc/model/mustSceneryInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/mustSceneryService.php");
class MustSceneryService{
	//得到某个地方必去的几个景点
	public static function getMustSceneryByAreaId($areaId='7dccca45-227b-11e8-902a-1c872c75b691'){
		$sql="select id,name,introducetitle,images,Area from scenerys
where areaid='{$areaId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$mustScenerys=[];
		foreach ($rs as $row) {

			$mustScenery=new MustSceneryService();
			$mustScenery->id=$row[0];
			$mustScenery->name=$row[1];
			$mustScenery->introducetitle=$row[2];
			$mustScenery->images=explode(",",$row[3]);
			$count=count($mustScenery->images);
			for($i=0;$i<$count;$i++){
				$mustScenery->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$mustScenery->images[$i];
			}
			$mustScenery->area=$row[4];
			$mustScenerys[]=$mustScenery;
		}
		return $mustScenerys;
	}
	public static function getMustSceneryByKeyword($keyword='苏州'){
		$sql="select id,name,introducetitle,images,Area from scenerys
where Area='{$keyword}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$mustScenerys=[];
		foreach ($rs as $row) {

			$mustScenery=new MustSceneryService();
			$mustScenery->id=$row[0];
			$mustScenery->name=$row[1];
			$mustScenery->introducetitle=$row[2];
			$mustScenery->images=explode(",",$row[3]);
			$count=count($mustScenery->images);
			for($i=0;$i<$count;$i++){
				$mustScenery->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$mustScenery->images[$i];
			}
			$mustScenery->area=$row[4];
			$mustScenerys[]=$mustScenery;
		}
		//print_r($mustScenerys);
		return $mustScenerys;
	}
}