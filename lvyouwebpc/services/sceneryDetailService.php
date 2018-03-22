<?php 
require_once("dbHelper.php");
require_once("lvyouwebpc/model/mustSceneryInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/sceneryDetailService.php");
class SceneryDetailService{
	public static function getSingleSceneryById($id='04638ca6-203f-11e8-a616-1c872c75b691'){
		$sql="select id,name,introducetitle,phone,provinceId,area,address,httpAddress,transfer,price,open,images,provinceName,introduceDetail,areaid from scenerys
where id='{$id}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$SceneryDetail=[];
		foreach ($rs as $row) {
			$scenery=new SceneryDetailService();
			$scenery->id=$row[0];
			$scenery->name=$row[1];
			$scenery->introduceTitle=$row[2];
			$scenery->phone=$row[3];
			$scenery->provinceId=$row[4];
			$scenery->area=$row[5];
			$scenery->address=$row[6];
			$scenery->httpAddress=$row[7];
			$scenery->transfer=$row[8];
			$scenery->price=$row[9];
			$scenery->open=$row[10];
			$scenery->images=explode(",",$row[11]);
			$count=count($scenery->images);
			for($i=0;$i<$count;$i++){
				$scenery->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$scenery->images[$i];
			}
			$scenery->provinceName=$row[12];
			$scenery->introduceDetail=$row[13];
			$scenery->areaId=$row[14];
			$SceneryDetail[]=$scenery;
		}
		return $SceneryDetail;
	}
	//根据proviceId得到所有的景点
	public static function getAllSceneryByProvinceId($provinceId){
		$sql="select id,name,introducetitle,phone,provinceId,area,address,httpAddress,transfer,price,open,images,provinceName,introduceDetail,areaid from scenerys
where provinceId='{$provinceId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$SceneryDetail=[];
		foreach ($rs as $row) {
			$scenery=new SceneryDetailService();
			$scenery->id=$row[0];
			$scenery->name=$row[1];
			$scenery->introduceTitle=$row[2];
			$scenery->phone=$row[3];
			$scenery->provinceId=$row[4];
			$scenery->area=$row[5];
			$scenery->address=$row[6];
			$scenery->httpAddress=$row[7];
			$scenery->transfer=$row[8];
			$scenery->price=$row[9];
			$scenery->open=$row[10];
			$scenery->images=explode(",",$row[11]);
			$count=count($scenery->images);
			for($i=0;$i<$count;$i++){
				$scenery->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$scenery->images[$i];
			}
			$scenery->provinceName=$row[12];
			$scenery->introduceDetail=$row[13];
			$scenery->areaId=$row[14];
			$SceneryDetail[]=$scenery;
		}
		return $SceneryDetail;


	}
	//得到所有的景点
	public static function getAllScenery(){
		$sql="select id,name,introducetitle,phone,provinceId,area,address,httpAddress,transfer,price,open,images,provinceName,introduceDetail,areaid from scenerys;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$Scenerys=[];
		foreach ($rs as $row) {
			$scenery=new SceneryDetailService();
			$scenery->id=$row[0];
			$scenery->name=$row[1];
			$scenery->introduceTitle=$row[2];
			$scenery->phone=$row[3];
			$scenery->provinceId=$row[4];
			$scenery->area=$row[5];
			$scenery->address=$row[6];
			$scenery->httpAddress=$row[7];
			$scenery->transfer=$row[8];
			$scenery->price=$row[9];
			$scenery->open=$row[10];
			$scenery->images=explode(",",$row[11]);
			$count=count($scenery->images);
			for($i=0;$i<$count;$i++){
				$scenery->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$scenery->images[$i];
			}
			$scenery->provinceName=$row[12];
			$scenery->introduceDetail=$row[13];
			$scenery->areaId=$row[14];
			$Scenerys[]=$scenery;
		}
		return $Scenerys;

	}
	//插入景点详情
public static function insertScenery($name,$introducetitle,$phone='18852921870',$provinceId,$area,$address,$httpAddress,$transfer,$price,$open,$images,$provinceName,$introduceDetail,$areaid){
	$sql="insert into scenerys(id,name,introducetitle,phone,provinceId,area,address,
httpAddress,transfer,price,open,images,provinceName,introduceDetail,areaid) values(UUID(),'{$name}','{$introducetitle}','{$phone}','{$provinceId}','{$area}','{$address}','{$httpAddress}','{$transfer}','{$price}','{$open}','{$images}','{$provinceName}','{$introduceDetail}','{$areaid}');";
$rs=DBHelper::executeNonQuery($sql);
return $rs;
}
//删除一个景点
public static function deteleScenery($sceneryId){
	$sql="delete from scenerys where id='{$sceneryId}'";
$rs=DBHelper::executeNonQuery($sql);
return $rs;
}
//修改一个景点的信息
public static function updateScenery($sceneryId,$name,$introducetitle,$phone='18852921870',$address,$httpAddress,$transfer,$price,$open,$images,$introduceDetail){
	$sql="update scenerys set name='{$name}',introducetitle='{$introducetitle}',phone='{$phone}',address='{$address}',httpAddress='{$httpAddress}',transfer='{$transfer}',price='{$price}',open='{$open}',images='{$images}',introduceDetail='{$introduceDetail}' where id='{$sceneryId}' ";
	$rs=DBHelper::executeNonQuery($sql);
return $rs;
}

	


}