<?php 
require_once("lvyouwebpc/model/roomsInfo.php");
require_once("lvyouwebpc/services/dbHelper.php");
class RoomsService{
	//得到酒店住房名称类型
	public static function getRoomNameByRoomTypeId($roomTypeId='a7e750bb-20d9-11e8-9bf5-1c872c75b691'){
		$sql="select id,name,priority from rooms  where id='{$roomTypeId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		//print_r($rs);
		$romeType=[];
		foreach ($rs as $row){
			$roomInfo=new RoomsInfo();
			$roomInfo->id=$row[0];
			$roomInfo->name=$row[1];
			$roomInfo->priority=$row[2];
			$romeType[]=$roomInfo;
		}
		return $romeType;
	}
	//得到所有房间类型
	public static function getAllRooms(){
		$sql="select id,name,priority from rooms;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		//print_r($rs);
		$romeType=[];
		foreach ($rs as $row){
			$roomInfo=new RoomsInfo();
			$roomInfo->id=$row[0];
			$roomInfo->name=$row[1];
			$roomInfo->priority=$row[2];
			$romeType[]=$roomInfo;
		}
		return $romeType;
	}
	//得到酒店名称类型通过优先级
	public static function getRoomNameByRoomPriority($priority='0'){
		$sql="select id,name,priority from rooms where priority='{$priority}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		//print_r($rs);
		$romeType=[];
		foreach ($rs as $row){
			$roomInfo=new RoomsInfo();
			$roomInfo->id=$row[0];
			$roomInfo->name=$row[1];
			$roomInfo->priority=$row[2];
			$romeType[]=$roomInfo;
		}
		return $romeType;
	}
	//插入房间价格
	public static function insertRoomPrice($hotelid,$roomTypeId,$price,$areaid){
		$sql="insert into roomprice(id,hotelid,roomtypeid,price,areaId)values(UUID(),'{$hotelid}','{$roomTypeId}',$price,'{$areaid}');";
		//echo $sql;
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;

	}
	

}