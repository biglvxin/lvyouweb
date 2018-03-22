<?php 
require_once("lvyouwebpc/model/hotelInfo.php");
require_once("lvyouwebpc/services/hotelService.php");
require_once("lvyouwebpc/services/dbHelper.php");
require_once("lvyouwebpc/util/globalSetting.php");
class HotelService{
	//取得所有酒店
	public static function getAllHotel($pageSize=9,$pageIndex=0,$areaId=""){
		$startIndex=$pageSize*$pageIndex;
		$sql1="select id,name,provinceId,areaId,sceneryId,address,logo,images,positionx,positiony,praisecount from hotels where 1=1";
		$sql2="select count(*) from hotels where 1=1";
		if($areaId!=""){
			$sql1=$sql1." and areaId='{$areaId}'";
			$sql2=$sql2." and areaId='{$areaId}'";	
		}
		$sql1=$sql1." limit {$startIndex},{$pageSize};";
		$rs1=DBHelper::executeQuery($sql1);
		$rs2=DBHelper::executeQuery($sql2);
		if(is_bool($rs1)||is_bool($rs2)){
			return false;
		}
		$hotels=[];
		foreach ($rs1 as $row) {

			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotel->name=$row[1];
			$hotel->provinceId=$row[2];
			$hotel->areaId=$row[3];
			$hotel->sceneryId=$row[4];
			$hotel->address=$row[5];
			$hotel->logo=GlobalSetting::IMAGE_URL_ROOT.$row[6];
			$hotel->images=explode(",",$row[7]);
			$count=count($hotel->images);
			for($i=0;$i<$count;$i++){
				$hotel->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$hotel->images[$i];
			}
			$hotel->positionx=$row[8];
			$hotel->positiony=$row[9];
			$hotel->praiseCount=$row[10];
			$hotel->count=$rs2[0][0];
			$hotel->priceList=HotelService::getHotelPrice($row[0]);
			$hotels[]=$hotel;
		}
		return $hotels;
	}
	//获得所有酒店
	public static function getAllHotelNoPage(){
		$sql="select id,name,provinceId,areaId,sceneryId,address,logo,images,positionx,positiony,praisecount from hotels";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$hotels=[];
		foreach ($rs as $row) {
			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotel->name=$row[1];
			$hotel->provinceId=$row[2];
			$hotel->areaId=$row[3];
			$hotel->sceneryId=$row[4];
			$hotel->address=$row[5];
			$hotel->logo=GlobalSetting::IMAGE_URL_ROOT.$row[6];
			$hotel->images=explode(",",$row[7]);
			$count=count($hotel->images);
			for($i=0;$i<$count;$i++){
				$hotel->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$hotel->images[$i];
			}
			$hotel->positionx=$row[8];
			$hotel->positiony=$row[9];
			$hotel->praiseCount=$row[10];
			$hotel->priceList=HotelService::getHotelPrice($row[0]);
			$hotels[]=$hotel;
		}
		return $hotels;
	}
	//获得区域下的酒店
	public static function getHotelByAreaId($areaId){
		$sql="select id,name,provinceId,areaId,sceneryId,address,logo,images,positionx,positiony,praisecount from hotels where areaId='{$areaId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$hotels=[];
		foreach ($rs as $row) {
			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotel->name=$row[1];
			$hotel->provinceId=$row[2];
			$hotel->areaId=$row[3];
			$hotel->sceneryId=$row[4];
			$hotel->address=$row[5];
			$hotel->logo=GlobalSetting::IMAGE_URL_ROOT.$row[6];
			$hotel->images=explode(",",$row[7]);
			$count=count($hotel->images);
			for($i=0;$i<$count;$i++){
				$hotel->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$hotel->images[$i];
			}
			$hotel->positionx=$row[8];
			$hotel->positiony=$row[9];
			$hotel->praiseCount=$row[10];
			$hotel->priceList=HotelService::getHotelPrice($row[0]);
			$hotels[]=$hotel;
		}
		return $hotels;
	}
	//根据酒店地址找到hotelid


	public static function getHotelByAddress($address){
		$sql="select id from hotels where address='{$address}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$hotelId=[];
		foreach ($rs as $row) {
			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotelId=$hotel;
		}
		return $hotelId;
	}

	//得到单个酒店
	public static function getSingleHotel($hotelId='04424291-2118-11e8-9bf5-1c872c75b691'){
		$sql="select id,name,provinceId,areaId,sceneryId,address,logo,images,positionx,positiony,praisecount from hotels where id='{$hotelId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$hotels=[];
		foreach ($rs as $row) {
			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotel->name=$row[1];
			$hotel->provinceId=$row[2];
			$hotel->areaId=$row[3];
			$hotel->sceneryId=$row[4];
			$hotel->address=$row[5];
			$hotel->logo=GlobalSetting::IMAGE_URL_ROOT.$row[6];
			$hotel->images=explode(",",$row[7]);
			$count=count($hotel->images);
			for($i=0;$i<$count;$i++){
				$hotel->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$hotel->images[$i];
			}
			$hotel->positionx=$row[8];
			$hotel->positiony=$row[9];
			$hotel->praiseCount=$row[10];
			$hotel->priceList=HotelService::getHotelPrice($row[0]);
			$hotels[]=$hotel;
		}
		return $hotels[0];
	}
	//得到好评酒店
	public static function getHotHotel(){
		$sql="select id,name,provinceid,areaid,sceneryid,address,logo,images,positionx,positiony,praisecount,info from hotels order by praisecount desc limit 0,8;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$hotelshot=[];
		foreach ($rs as $row) {
			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotel->name=$row[1];
			$hotel->provinceId=$row[2];
			$hotel->areaId=$row[3];
			$hotel->sceneryId=$row[4];
			$hotel->address=$row[5];
			$hotel->logo=GlobalSetting::IMAGE_URL_ROOT.$row[6];
			$hotel->images=explode(",",$row[7]);
			$count=count($hotel->images);
			for($i=0;$i<$count;$i++){
				$hotel->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$hotel->images[$i];
			}
			$hotel->positionx=$row[8];
			$hotel->positiony=$row[9];
			$hotel->praiseCount=$row[10];
			$hotel->info=$row[11];
			$hotel->priceList=HotelService::getHotelPrice($row[0]);
			$hotelshot[]=$hotel;
		}
		return $hotelshot;
	}
	//得到酒店价格
	public static function getHotelPrice($hotelId='d56dc06e-20f9-11e8-9bf5-1c872c75b691'){
		$sql="select id,hotelid,roomtypeid,price from roomprice where hotelid='{$hotelId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		//print_r($rs);
		$romeprice=[];
		foreach ($rs as $row){
			$hotelprice=new HotelInfo();
			$hotelprice->id=$row[0];
			$hotelprice->hotelId=$row[1];
			$hotelprice->roomtypeId=$row[2];
			$hotelprice->price=$row[3];
			$romeprice[]=$hotelprice;
		}
		return $romeprice;
	}
	//根据景点定位到周边酒店
	public static function getHotelBySceneryId($sceneryId='59141e31-2026-11e8-a616-1c872c75b691'){
		$sql="select id,name,provinceId,areaId,sceneryId,address,logo,images,positionx,positiony,praisecount from hotels where sceneryId='{$sceneryId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$hotels=[];
		foreach ($rs as $row) {
			$hotel=new HotelInfo();
			$hotel->id=$row[0];
			$hotel->name=$row[1];
			$hotel->provinceId=$row[2];
			$hotel->areaId=$row[3];
			$hotel->sceneryId=$row[4];
			$hotel->address=$row[5];
			$hotel->logo=GlobalSetting::IMAGE_URL_ROOT.$row[6];
			$hotel->images=explode(",",$row[7]);
			$count=count($hotel->images);
			for($i=0;$i<$count;$i++){
				$hotel->imageList[$i]=GlobalSetting::IMAGE_URL_ROOT.$hotel->images[$i];
			}
			$hotel->positionx=$row[8];
			$hotel->positiony=$row[9];
			$hotel->praiseCount=$row[10];
			$hotel->priceList=HotelService::getHotelPrice($row[0]);
			$hotels[]=$hotel;
		}
		return $hotels;
	}
	//插入酒店
	public static function insertHotel($name,$areaId,$address,$logo,$images,$sceneryId){
		$sql="insert into hotels(id,name,areaid,address,logo,images,sceneryId)values(UUID(),
'{$name}','{$areaId}','{$address}','{$logo}',
'{$images}','{$sceneryId}');";
	$rs=DBHelper::executeNonQuery($sql);
	return $rs;
	}
	//修改酒店
	public static function updateHotel($hotelId,$name,$address,$images){
		$sql="update hotels set name='{$name}', address='{$address}', images='{$images}' where id='{$hotelId}';";
			$rs=DBHelper::executeNonQuery($sql);
	return $rs;
	}

}